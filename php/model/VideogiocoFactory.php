<?php

include_once 'Videogioco.php';
include_once 'Genere.php';
include_once 'Console.php';
include_once 'Db.php';
include_once 'ConsoleFactory.php';
include_once 'GenereFactory.php';


class VideogiocoFactory{
	private static $singleton;

	private function __construct(){}

	public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new VideogiocoFactory();
        }

        return self::$singleton;
    }

	public function &getVideogiocoPerGenere(Genere $genere){
		$videogiochi = array();
		$query = '  select
					videogiochi.id videogiochi_id
					videogiochi.titolo videogiochi_titolo
					videogiochi.anno videogiochi_anno
					videogiochi.trama videogiochi_trama
					videogiochi.prezzo videogiochi_prezzo
					
					console.id console_id
					console.nome console_nome

					from videogiochi
					join console on videogiochi.idConsole = console.id
					where videogiochi.idGenere = ?';

		$mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[videogiochiPerGenere] impossibile inizializzare il database");
            $mysqli->close();
            return $videogiochi;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[videogiochiPerGenere] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $videogiochi;
        }

        if (!$stmt->bind_param('i', $user->getId())) {
            error_log("[videogiochiPerGenere] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $videogiochi;
        }

        $videogiochi = self::caricaVideogiochiDaStmt($stmt);
        $mysqli->close();
        return $videogiochi;
	}

	public function &getVideogiocoPerConsole(Console $console){
		$videogiochi = array();
		$query = '  select
					videogiochi.id videogiochi_id
					videogiochi.titolo videogiochi_titolo
					videogiochi.anno videogiochi_anno
					videogiochi.trama videogiochi_trama
					videogiochi.prezzo videogiochi_prezzo
					
					genere.id genere_id
					genere.nome genere_nome

					from videogiochi
					join genere on videogiochi.idGenere = genere.id
					where videogiochi.idConsole = ?';

		$mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[videogiochiPerConsole] impossibile inizializzare il database");
            $mysqli->close();
            return $videogiochi;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[videogiochiPerConsole] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $videogiochi;
        }

        if (!$stmt->bind_param('i', $user->getId())) {
            error_log("[videogiochiPerConsole] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $videogiochi;
        }

        $videogiochi = self::caricaVideogiochiDaStmt($stmt);
        $mysqli->close();
        return $videogiochi;
	}

	public function &creaVideogiocoDaId($id){
		$videogiochi = array();
        
        $query = "select 
               videogiochi.id videogiochi_id,
			   videogiochi.titolo videogiochi_titolo,
			   videogiochi.anno videogiochi_anno,
			   videogiochi.trama videogiochi_trama,
			   videogiochi.prezzo videogiochi_prezzo,
			   genere.id genere_id,
			   genere.nome genere_nome,
			   console.id console_id,
			   console.nome console_nome

			   from videogiochi
			   join genere on videogiochi.idgenere = genere.id
			   join console on videogiochi.idconsole = console.id
			   where videogiochi.id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[creaVideogiocoDaId] impossibile inizializzare il database");
            $mysqli->close();
            return $videogiochi;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[creaVideogiocoDaId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $id)) {
            error_log("[creaVideogiocoDaId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $videogiochi = self::caricaVideogiochiDaStmt($stmt);
        if(count($videogiochi) > 0){
            $mysqli->close();
            return $videogiochi[0];
        }else{
            $mysqli->close();
            return null;
        }
    }
	public function &getVideogiochi(){
		$videogiochi = array();
		$query = '  select
					videogiochi.id videogiochi_id,
					videogiochi.titolo videogiochi_titolo,
					videogiochi.anno videogiochi_anno,
					videogiochi.trama videogiochi_trama,
					videogiochi.prezzo videogiochi_prezzo,
					
					genere.id genere_id,
					genere.nome genere_nome,

					console.id console_id,
					console.nome console_nome

					from videogiochi
					join genere on videogiochi.idgenere = genere.id
					join console on videogiochi.idconsole = console.id';

		$mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[videogiochiPerConsole] impossibile inizializzare il database");
            $mysqli->close();
            return $videogiochi;
        }

        $result = $mysqli->query($query);
        if (!$result) {
            error_log("[videogiochiPerConsole] impossibile" .
                    " eseguire la query");
            $mysqli->close();
            return $videogiochi;
        }
		while($row = $result->fetch_array()){
        	$videogiochi[] = self::creaVideogiocoDaArray($row);
		}
        $mysqli->close();
        return $videogiochi;
	}

	public function salvaVideogioco(Videogioco $video){
		$mysqli = Db::getInstance()->connectDb();
		$titolo = $video->getTitolo();
		$anno = $video->getAnno();
		$trama = $video->getTrama();
		$prezzo = $video->getPrezzo();
		$idgenere = $video->getGenere()->getId();
		$idconsole = $video->getConsole()->getId();
		$query = "INSERT INTO videogiochi
				  (id, titolo, anno, trama, prezzo, idgenere, idconsole)
				  VALUES
				  (default,'$titolo','$anno','$trama','$prezzo',$idgenere,$idconsole)";
		if($result = $mysqli->query($query)){} else {echo $mysqli->error;}
		if(isset($result)){
			return true;
		}
		return false;
	}	

	public function &caricaVideogiochiDaStmt(mysqli_stmt $stmt) {
        $videogiochi = array();
        if (!$stmt->execute()) {
            error_log("[caricaVideogiochiDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['videogiochi_id'], 
                $row['videogiochi_titolo'], 
                $row['videogiochi_anno'], 
                $row['videogiochi_trama'], 
                $row['videogiochi_prezzo'], 
                $row['console_id'], 
                $row['console_nome'],
				$row['genere_id'],
				$row['genere_nome']);
        if (!$bind) {
            error_log("[caricaVideogiochiDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $videogiochi[] = self::creaVideogiocoDaArray($row);
        }

        $stmt->close();

        return $videogiochi;
    }
	
	public function creaVideogiocoDaArray($row) {
        $videogioco = new Videogioco();
        $videogioco->setId($row['videogiochi_id']);
        $videogioco->setTitolo($row['videogiochi_titolo']);
        $videogioco->setAnno($row['videogiochi_anno']);
        $videogioco->setTrama($row['videogiochi_trama']);
        $videogioco->setPrezzo($row['videogiochi_prezzo']);
		$videogioco->setConsole(ConsoleFactory::instance()->creaConsoleDaArray($row));
		$videogioco->setGenere(GenereFactory::instance()->creaGenereDaArray($row));
        return $videogioco;
	}
}
?>

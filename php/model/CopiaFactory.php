<?php

include_once 'VideogiocoFactory.php';
include_once 'UserFactory.php';
include_once 'Venditore.php';
include_once 'Compratore.php';
include_once 'Copia.php';
include_once 'Db.php';

class CopiaFactory{
	
	private static $singleton;

	public function __constructor(){}

    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new CopiaFactory();
        }

        return self::$singleton;
    }

	public function cercaCopiaPerId($copiaId){
		$copie = array();
		$query = "select 
               copia.id copia_id,

               videogiochi.id videogiochi_id,
               videogiochi.titolo videogiochi_titolo,
			   videogiochi.prezzo videogiochi_prezzo,

			   genere.id genere_id,
			   genere.nome genere_nome,

               venditore.id venditore_id,
               venditore.nome venditore_nome,
               venditore.cognome venditore_cognome,
               venditore.email venditore_email,
               venditore.citta venditore_citta,
               venditore.cap venditore_cap,
               venditore.via venditore_via,
               venditore.provincia venditore_provincia,
               venditore.ncivico venditore_numero_civico,
               venditore.username venditore_username,
               venditore.password venditore_password,

               from copia
               join videogiochi on copia.idvideogioco = videogiochi.id
               join venditore on copia.idvenditore = venditore.id 
               join genere on videogiochi.idgenere = genere.id 
               where copia.id = ?";
		$mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[cercaCopiaPerId] impossibile inizializzare il database");
            $mysqli->close();
            return $copie;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[cercaCopiaPerId] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $copie;
        }

        
        if (!$stmt->bind_param('i', $copiaId)) {
            error_log("[cercaCopiaPerId] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return $copie;
        }

        $copie =  self::caricaCopieDaStmt($stmt);
        if(count($copie > 0)){
            $mysqli->close();
            return $copie[0];
        }else{
            $mysqli->close();
            return null;
        }
	}

	public function &getCopie(){
		$copie = array();
		
		$query = "  select
					copia.id copia_id,

               		videogiochi.id videogiochi_id,
               		videogiochi.titolo videogiochi_titolo,
			   		videogiochi.prezzo videogiochi_prezzo,
					videogiochi.anno videogiochi_anno,
					videogiochi.trama videogiochi_trama,

			   		genere.id genere_id,
			  		genere.nome genere_nome,

					console.id console_id,
					console.nome console_nome,

              		venditore.id venditore_id,
              		venditore.nome venditore_nome,
              		venditore.cognome venditore_cognome,
					venditore.email venditore_email,
               		venditore.citta venditore_citta,
               		venditore.cap venditore_cap,
               		venditore.via venditore_via,
               		venditore.provincia venditore_provincia,
               		venditore.ncivico venditore_numero_civico,
               		venditore.username venditore_username,
               		venditore.password venditore_password,

					compratore.id compratore_id,
					compratore.nome compratore_nome,
					compratore.cognome compratore_cognome,
					compratore.email compratore_email,
               		compratore.citta compratore_citta,
               		compratore.cap compratore_cap,
               		compratore.via compratore_via,
               		compratore.provincia compratore_provincia,
               		compratore.ncivico compratore_numero_civico,
               		compratore.username compratore_username,
               		compratore.password compratore_password
					
					from copia
					join videogiochi on copia.idvideogioco = videogiochi.id
               		join venditore on copia.idvenditore = venditore.id 
               		join genere on videogiochi.idgenere = genere.id
					join console on videogiochi.idconsole = console.id
					join compratore on copia.idcompratore = compratore.id";
		$mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCopie] impossibile inizializzare il database");
            $mysqli->close();
            return $copie;
        }
		$result = $mysqli->query($query);
		if($mysqli->errno > 0){
			error_log("[getCopie] Errore nell'esecuzione della query" .
						"$mysqli->errno : $mysqli->error ", 0);
		}
		else{
			while($row = $result->fetch_array()){
        		$copie[] = self::creaDaArray($row);
			}
        	$mysqli->close();
		}
		return $copie;
	}
	
	public function &getCopieNonComprate(){
		$copie = array();
		
		$query = "  select
					copia.id copia_id,

               		videogiochi.id videogiochi_id,
               		videogiochi.titolo videogiochi_titolo,
			   		videogiochi.prezzo videogiochi_prezzo,
					videogiochi.anno videogiochi_anno,
					videogiochi.trama videogiochi_trama,

			   		genere.id genere_id,
			  		genere.nome genere_nome,

					console.id console_id,
					console.nome console_nome,

              		venditore.id venditore_id,
              		venditore.nome venditore_nome,
              		venditore.cognome venditore_cognome,
					venditore.email venditore_email,
               		venditore.citta venditore_citta,
               		venditore.cap venditore_cap,
               		venditore.via venditore_via,
               		venditore.provincia venditore_provincia,
               		venditore.ncivico venditore_numero_civico,
               		venditore.username venditore_username,
               		venditore.password venditore_password,

					compratore.id compratore_id,
					compratore.nome compratore_nome,
					compratore.cognome compratore_cognome,
					compratore.email compratore_email,
               		compratore.citta compratore_citta,
               		compratore.cap compratore_cap,
               		compratore.via compratore_via,
               		compratore.provincia compratore_provincia,
               		compratore.ncivico compratore_numero_civico,
               		compratore.username compratore_username,
               		compratore.password compratore_password
					
					from copia
					join videogiochi on copia.idvideogioco = videogiochi.id
               		join venditore on copia.idvenditore = venditore.id 
               		join genere on videogiochi.idgenere = genere.id
					join console on videogiochi.idconsole = console.id
					join compratore on copia.idcompratore = compratore.id
					where copia.idcompratore = 1";
		$mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCopie] impossibile inizializzare il database");
            $mysqli->close();
            return $copie;
        }
		$result = $mysqli->query($query);
		if($mysqli->errno > 0){
			error_log("[getCopie] Errore nell'esecuzione della query" .
						"$mysqli->errno : $mysqli->error ", 0);
		}
		else{
			while($row = $result->fetch_array()){
        		$copie[] = self::creaDaArray($row);
			}
        	$mysqli->close();
		}
		return $copie;
	}

	public function &getCopiePerVenditore(Venditore $venditore) {
       $copie = array();
        
        $query = "select 
               copia.id copia_id,

               videogiochi.id videogiochi_id,
               videogiochi.titolo videogiochi_titolo,
			   videogiochi.prezzo videogiochi_prezzo,
			   videogiochi.anno videogiochi_anno,
			   videogiochi.trama videogiochi_trama,

			   genere.id genere_id,
			   genere.nome genere_nome,

			   console.id console_id,
			   console.nome console_nome,

               venditore.id venditore_id,
               venditore.nome venditore_nome,
               venditore.cognome venditore_cognome,
               venditore.email venditore_email,
               venditore.citta venditore_citta,
               venditore.cap venditore_cap,
               venditore.via venditore_via,
               venditore.provincia venditore_provincia,
               venditore.ncivico venditore_numero_civico,
               venditore.username venditore_username,
               venditore.password venditore_password,

			   compratore.id compratore_id,
			   compratore.nome compratore_nome,
			   compratore.cognome compratore_cognome,
			   compratore.email compratore_email,
               compratore.citta compratore_citta,
               compratore.cap compratore_cap,
               compratore.via compratore_via,
               compratore.provincia compratore_provincia,
               compratore.ncivico compratore_numero_civico,
               compratore.username compratore_username,
               compratore.password compratore_password

               from copia
               join videogiochi on copia.idvideogioco = videogiochi.id
               join venditore on copia.idvenditore = venditore.id 
               join genere on videogiochi.idgenere = genere.id
			   join compratore on copia.idcompratore = compratore.id
			   join console on videogiochi.idconsole = console.id
               where venditore.id = ?";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getCopiePerVenditore] impossibile inizializzare il database");
            $mysqli->close();
            return $copie;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[getCopiePerVenditore] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $venditore->getId())) {
            error_log("[getCopiePerVenditore] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $copie = self::caricaCopieDaStmt($stmt);
        $mysqli->close();
        return $copie;
    }

	public function compratoreCopia(Compratore $buyer, $id){
		$query = " update copia set 
                    idcompratore = ?
					where copia.id = ?";
		$mysqli = Db::getInstance()->connectDb();
		$stmt = $mysqli->stmt_init();
		$stmt->prepare($query);
		if (!$stmt) {
            error_log("[compratoreCopia] impossibile" .
                    " inizializzare il prepared statement");
            return 0;
        }
		if (!$stmt->bind_param('ii', $buyer->getId(), $id)) {
            error_log("[compratoreCopia] impossibile" .
                    " effettuare il binding in input");
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("[compratoreCopia] impossibile" .
                    " eseguire lo statement");
            return 0;
        }

		return 1;
	}

	public function salvaCopia(Copia $copia){
		$mysqli = Db::getInstance()->connectDb();
		$idvideo = $copia->getVideogioco()->getId();
		$idvenditore = $copia->getVenditore()->getId();
		$query = "INSERT INTO copia
				  (id, idvideogioco, idvenditore, idcompratore)
				  VALUES
				  (default, $idvideo, $idvenditore, 1)";
		$result = $mysqli->query($query);
		if(isset($result)){
			return true;
		}
		return false;
	}

	private function &caricaCopieDaStmt(mysqli_stmt $stmt){
        $copie = array();
         if (!$stmt->execute()) {
            error_log("[caricaCopieDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['copia_id'],
                $row['videogiochi_id'],
                $row['videogiochi_titolo'],
                $row['videogiochi_prezzo'],
				$row['videogiochi_anno'],
				$row['videogiochi_trama'],
                $row['genere_id'],
                $row['genere_nome'],
				$row['console_id'],
                $row['console_nome'],
                $row['venditore_id'],
                $row['venditore_nome'], 
                $row['venditore_cognome'], 
                $row['venditore_email'], 
                $row['venditore_citta'], 
                $row['venditore_cap'],
                $row['venditore_via'],
                $row['venditore_provincia'],
                $row['venditore_numero_civico'], 
                $row['venditore_username'], 
                $row['venditore_password'],
				$row['compratore_id'],
			    $row['compratore_nome'],
			    $row['compratore_cognome'],
			    $row['compratore_email'],
                $row['compratore_citta'],
                $row['compratore_cap'],
                $row['compratore_via'],
                $row['compratore_provincia'],
                $row['compratore_numero_civico'],
                $row['compratore_username'],
                $row['compratore_password']);
        if (!$bind) {
            error_log("[caricaCopieDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $copie[] = self::creaDaArray($row);
        }
        
        $stmt->close();
        
        return $copie;
    }

	public function creaDaArray($row){
        $copia = new Copia();
        $copia->setId($row['copia_id']);
        if(isset($row['venditore_id'])){
            $copia->setVenditore(UserFactory::instance()->creaVenditoreDaArray($row));
        }
		if(isset($row['videogiochi_id'])){
            $copia->setVideogioco(VideogiocoFactory::instance()->creaVideogiocoDaArray($row));
        }
		if(isset($row['compratore_id'])){
			$copia->compra(UserFactory::instance()->creaCompratoreDaArray($row));
		}
        return $copia;
    }
}
?>

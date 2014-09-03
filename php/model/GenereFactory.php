<?php

include_once 'Genere.php';
include_once 'Db.php';

class GenereFactory{
	private static $singleton;

	private function __construct(){}

	public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new GenereFactory();
        }

        return self::$singleton;
    }

	public function getGenereDaId($id){
		$genere = new Genere();
		$mysqli = Db::getInstance()->connectDb();
		$query = "SELECT
				  id genere_id,
				  nome genere_nome
				  FROM genere
				  WHERE genere.id = $id";
		$result = $mysqli->query($query);
		$row = $result->fetch_array();
		$genere = $this->creaGenereDaArray($row);
		return $genere;
	}

	public function &getGeneri(){
		$generi = array();
		$mysqli = Db::getInstance()->connectDb();
		$query = "SELECT 
				  id genere_id,
				  nome genere_nome
				  FROM genere";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array()){
			$generi[] = $this->creaGenereDaArray($row);
		}
		return $generi;
	}

	public function creaGenereDaArray($row) {
        $genere = new Genere();
        $genere->setId($row['genere_id']);
        $genere->setNome($row['genere_nome']);
        return $genere;
	}
}

?>

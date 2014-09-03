<?php

include_once 'Console.php';
include_once 'Db.php';


class ConsoleFactory{
	private static $singleton;

	private function __construct(){}

	public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new ConsoleFactory();
        }

        return self::$singleton;
    }

	public function getConsoleDaId($id){
		$console = new Console();
		$mysqli = Db::getInstance()->connectDb();
		$query = "SELECT
				  id console_id,
				  nome console_nome
				  FROM console
				  WHERE console.id = $id";
		$result = $mysqli->query($query);
		$row = $result->fetch_array();
		$console = $this->creaConsoleDaArray($row);
		return $console;
	}

	public function &getConsole(){
		$console = array();
		$mysqli = Db::getInstance()->connectDb();
		$query = "SELECT 
				  id console_id,
				  nome console_nome
				  FROM console";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array()){
			$console[] = $this->creaConsoleDaArray($row);
		}
		return $console;
	}

	public function creaConsoleDaArray($row) {
        $console = new Console();
        $console->setId($row['console_id']);
        $console->setNome($row['console_nome']);
        return $console;
	}
}
?>

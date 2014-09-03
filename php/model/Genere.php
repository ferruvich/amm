<?php

class Genere{
	private $id;

	private $nome;

	public function __construct() {

    }

	public function getId(){
        return $this->genereID;
    }
    
    public function setId($id){
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal)){
            return false;
        }
        $this->genereID = $intVal;
    }

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
		return true;
	}

	public function equals(Genere $genere) {
        return  $this->genereID == $genere->genereID &&
                $this->nome == $genere->nome;
    }
}

?>

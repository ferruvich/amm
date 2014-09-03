<?

class Console{
	private $id;
	private $nome;

	public function __construct(){}

	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal)){
            return false;
        }
        $this->id = $intVal;
	}

	public function getNome(){
		return $this->nome;
	}
	public function setNome($nome){
		$this->nome = $nome;
		return true;
	}

	public function equals(Console $console){
		return  $this->id == $console->id &&
				$this->nome == $console->nome;
	}
}

?>

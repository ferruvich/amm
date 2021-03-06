<?
include_once "Genere.php";
include_once "Console.php";

class Videogioco{
	private $id;
	private $titolo;
	private $anno;
	private $trama;
	private $prezzo;
	private $console;
	private $genere;

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

	public function getTitolo(){
		return $this->titolo;	
	}
	public function setTitolo($title){
		$this->titolo = $title;
		return true;
	}

	public function getAnno(){
		return $this->anno;
	}
	public function setAnno($anno){
		$intVal = filter_var($anno, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal)){
            return false;
        }
        $this->anno = $intVal;
		return true;
	}

	public function getTrama(){
		return $this->trama;
	}
	public function setTrama($trama){
		$this->trama = $trama;
		return true;	
	}

	public function getPrezzo(){
		return $this->prezzo;
	}
	public function setPrezzo($prezzo){
        $this->prezzo = $prezzo;
		return true;
	}

	public function getConsole(){
		return $this->console;
	}	
	public function setConsole(Console $console){
		$this->console = $console;
		return true;
	}
	
	public function getGenere(){
		return $this->genere;
	}	
	public function setGenere(Genere $genere){
		$this->genere = $genere;
		return true;
	}

	public function equals(Videogioco $video) {
        return  $this->id == $video->id &&
                $this->titolo == $video->titolo &&
				$this->anno == $video->anno &&
				$this->prezzo == $video->prezzo &&
				$this->console == $video->console &&
				$this->genere == $video->genere;
    }
}

?>

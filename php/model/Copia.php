<?

include_once "Videogioco.php";
include_once "Venditore.php";
include_once "Compratore.php";
include_once "CopiaFactory.php";

class Copia{
	private $id;
	private $videogioco;
	private $venditore;
	private $compratore;

	public function __construct(){
	}

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

	public function getVideogioco(){
		return $this->videogioco;
	}
	public function setVideogioco(Videogioco $video){
		$this->videogioco = $video;
		return true;
	}

	public function getVenditore(){
		return $this->venditore;
	}
	public function setVenditore(Venditore $seller){
		$this->venditore = $seller;
		return true;
	}
	
	public function comprato(){
		if($this->compratore->getId() == 1){
			return false;
		}
		return true;
	}

	public function compra(Compratore $buyer){
		$this->compratore = $buyer;
		CopiaFactory::instance()->compratoreCopia($buyer, $this->id);
		if($this->compratore->getId() != 1){
			return true;
		}
		else{
			return false;
		}
	}

	public function getCompratore(){
		return $this->compratore;
	}

	public function equals(Copia $copy){
		if($this->id == $copy->getId())
			return true;
		else
			return false;
	}	
}

?>

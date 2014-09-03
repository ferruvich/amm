<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/CopiaFactory.php';
include_once basename(__DIR__) . '/../model/Videogioco.php';

class VenditoreController extends BaseController {

    const elenco = 'elenco';

    public function __construct() {
        parent::__construct();
    }

    public function handleInput(&$request) {

        // creo il descrittore della vista
        $vd = new ViewDescriptor();

        // imposto la pagina
        $vd->setPagina($request['page']);

        // imposto il token per impersonare un utente (nel lo stia facendo)
        $this->setImpToken($vd, $request);

        if (!$this->loggedIn()) {
            // utente non autenticato, rimando alla home
            $this->showLoginPage($vd);
        } else {
            // utente autenticato
            $user = UserFactory::instance()->cercaUtentePerId(
                    $_SESSION[BaseController::user], $_SESSION[BaseController::role]);

            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {

                    // modifica dei dati anagrafici
                    case 'anagrafica':
                        $vd->setSottoPagina('anagrafica');
                        break;

					case 'games':
						$pagina = 'games';
                        $copie = CopiaFactory::instance()->getCopiePerVenditore($user);
                        $vd->setSottoPagina('games');
                        break;

                    case 'games_sold':
						$pagina = 'games_sold';
                        $copie = CopiaFactory::instance()->getCopiePerVenditore($user);
                        $vd->setSottoPagina('games_sold');
                        break;

                    case 'vendi_copie':
						$videogiochi = VideogiocoFactory::instance()->getVideogiochi();
                        $vd->setSottoPagina('vendi_copie');
                        break;

                    case 'inserisci_gioco':
						$generi = GenereFactory::instance()->getGeneri();
						$console = ConsoleFactory::instance()->getConsole();
                        $vd->setSottoPagina('inserisci_gioco');
                        break;

					case 'trama':
						$vd->setSottoPagina('trama');
                        break;

                    default:
                        $vd->setSottoPagina('home');
                        break;
                }
            }


            // gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {

                switch ($request["cmd"]) {

                    // logout
                    case 'logout':
                        $this->logout($vd);
                        break;
                    // modifica delle informazioni di contatto
                    case 'contatti':
                        $msg = array();
                        $this->aggiornaEmail($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Contatti aggiornati");
                        $this->showHomeUtente($vd);
                        break;
					case 'indirizzo':
						$mgs = array();
						$this->aggiornaIndirizzo($user, $request, $msg);
						$this->creaFeedbackUtente($msg, $vd, "Indirizzo aggiornato");
						$this->showHomeUtente($vd);
						break;
                    // modifica della password
                    case 'password':
                        $msg = array();
                        $this->aggiornaPassword($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Password aggiornata");
                        $this->showHomeUtente($vd);
                        break;
					case 'v_gioco':
						$msg = array();
						$videogiochi = VideogiocoFactory::instance()->getVideogiochi();
                        $vd->setSottoPagina('vendi_copie');
						$this->showHomeUtente($vd);
                        break;
                    // vendita di una nuova copia
                    case 'c_nuova':
                        $msg = array();
                        $nuovo = new Copia();
                        $this->creaCopia($nuovo, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Copia venduta");
                        if (count($msg) == 0) {
                            $vd->setSottoPagina('games');
                        }
                        $copie = CopiaFactory::instance()->getCopieperVenditore($user);
                        $this->showHomeUtente($vd);
                        break;
					case 'v_nuovo':
						$msg = array();
						$generi = GenereFactory::instance()->getGeneri();
						$console = ConsoleFactory::instance()->getConsole();
                        $vd->setSottoPagina('inserisci_gioco');
						$this->showHomeUtente($vd);
                        break;
					case 'video_nuovo':
						$msg = array();
						$this->creaVideogioco($user, $request, $msg);
						$this->creaFeedbackUtente($msg, $vd, "Videogioco aggiunto");
						$this->showHomeUtente($vd);
						break;

					case 'trama':
						$msg = array();
						$copia = $this->getCopiaPerIndice($copie, $request, $msg);
						if(isset($copia)){
							$trama = $copia->getVideogioco()->getTrama();
						}
						$vd->setSottoPagina('trama');
                        $this->showHomeUtente($vd);
						break;

                    // default
                    default:
                        $this->showHomeUtente($vd);
                        break;
                }
            } else {
                // nessun comando, dobbiamo semplicemente visualizzare 
                // la vista
                $user = UserFactory::instance()->cercaUtentePerId(
                        $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }


        // richiamo la vista
        require basename(__DIR__) . '/../view/master.php';
    }

	private function getCopiaPerIndice(&$copie, &$request, &$msg) {
        if (isset($request['copia'])) {
            $intVal = filter_var($request['copia'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            if (isset($intVal) && $intVal > -1 && $intVal < count($copie)) {
                return $copie[$intVal];
            } else {
                $msg[] = "<li> Il videogioco specificato non ha copie in vendita </li>";
                return null;
            }
        } else {
            $msg[] = '<li>Videogioco non specificato<li>';
            return null;
        }
    }

    private function creaCopia($copia, &$request, &$msg) {
        if (isset($request['videogiochi'])) {
            $video = VideogiocoFactory::instance()->creaVideogiocoDaId($request['videogiochi']);
            if (isset($video)) {
                $copia->setVideogioco($video);
				$user  = UserFactory::instance()->cercaUtentePerId(
                    $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
				$copia->setVenditore($user);
				$salvato = CopiaFactory::instance()->salvaCopia($copia);
				if(!$salvato){
					$msg[] = "<li> Videogioco non messo in vendita </li>";
				}
            } else {
                $msg[] = "<li>Videogioco non trovato</li>";
            }
        }
    }

	private function creaVideogioco($user, &$request, &$msg){
		$video = new Videogioco();
		if (isset($request['titolo'])) {
			if(!$video->setTitolo($request['titolo'])){
				$msg[] = "Il titolo specificato non è corretto";
			}
		}
		if(isset($request['anno'])){
			if(!$video->setAnno($request['anno'])){
				$msg[] = "L'anno specificato non è corretto";
			}
		}
		if(isset($request['trama'])){
			if(!$video->setTrama($request['trama'])){
				$msg[] = "La trama specificata non va bene";
			}
		}
		if(isset($request['prezzo'])){
			if(!$video->setPrezzo($request['prezzo'])){
				$msg[] = "Il prezzo specificato non è corretto";
			}
		}
		if(isset($request['genere'])){
			if(!$video->setGenere(GenereFactory::instance()->getGenereDaId($request['genere']))){
				$msg[] = "Il genere specificato non è corretto";
			}
		}
		if(isset($request['console'])){
			if(!$video->setConsole(ConsoleFactory::instance()->getConsoleDaId($request['console']))){
				$msg[] = "La console specificata non è corretta";
			}
		}
		if (count($msg) == 0) {
            if (VideogiocoFactory::instance()->salvaVideogioco($video) == false) {
                $msg[] = '<li>Salvataggio non riuscito</li>';
            }
        }
	}
 }
?>

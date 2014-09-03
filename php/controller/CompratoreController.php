<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/CopiaFactory.php';

class CompratoreController extends BaseController {

    /**
     * Costruttore
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Metodo per gestire l'input dell'utente. 
     */
    public function handleInput(&$request) {

        $vd = new ViewDescriptor();

        $vd->setPagina($request['page']);

        $this->setImpToken($vd, $request);

        if (!$this->loggedIn()) {

            $this->showLoginPage($vd);
        } else {
            $user = UserFactory::instance()->cercaUtentePerId(
                            $_SESSION[BaseController::user], $_SESSION[BaseController::role]);


            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {

                    // modifica dei dati anagrafici
                    case 'anagrafica':
                        $vd->setSottoPagina('anagrafica');
                        break;

                    // comprare un videogioco
                    case 'acquisto':
                        // carichiamo le copie dei videogiochi dal db
                        $copie = CopiaFactory::instance()->getCopieNonComprate();
                        $vd->setSottoPagina('acquisto');
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
                // abbiamo ricevuto un comando
                switch ($request["cmd"]) {

                    // logout
                    case 'logout':
                        $this->logout($vd);
                        break;

                    // aggiornamento indirizzo
                    case 'indirizzo':

                        // in questo array inserisco i messaggi di 
                        // cio' che non viene validato
                        $msg = array();
                        $this->aggiornaIndirizzo($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Indirizzo aggiornato");
                        $this->showHomeUtente($vd);
                        break;

                    // cambio email
                    case 'email':
                        $msg = array();
                        $this->aggiornaEmail($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Email aggiornata");
                        $this->showHomeUtente($vd);
                        break;

                    // cambio password
                    case 'password':
                        $msg = array();
                        $this->aggiornaPassword($user, $request, $msg);
                        $this->creaFeedbackUtente($msg, $vd, "Password aggiornata");
                        $this->showHomeCompratore($vd);
                        break;

                    // comprare un videogioco
                    case 'acquisto':
                        // recuperiamo l'indice 
                        $msg = array();
                        $a = $this->getCopiaPerIndice($copie, $request, $msg);
						$isOk = false;
                        if (isset($a) && !$a->comprato()) {
                            $isOk = $a->compra($user);
						}
						if(!$isOk){
							$msg[] = "<li> Impossibile comprare la copia, potrebbe già essere stata venduta </li>";
						}
                        $this->creaFeedbackUtente($msg, $vd, "Hai comprato il videogioco!");
                        $this->showHomeCompratore($vd);
                        break;
				
					case 'trama':
						$msg = array();
						$copia = $this->getCopiaPerIndice($copie, $request, $msg);
						if(isset($copia)){
							$trama = $copia->getVideogioco()->getTrama();
						}
						$vd->setSottoPagina('trama');
                        $this->showHomeCompratore($vd);
						break;

                    default : $this->showLoginPage($vd);
                }
            } else {
                // nessun comando
                $user = UserFactory::instance()->cercaUtentePerId(
                                $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }

        // includo la vista
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

}

?>

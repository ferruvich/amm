<?php

/**
 * Classe che rappresenta un generico utente del sistema
 */
class User {

    /**
     * Costante che definisce il ruolo del venditore
     */
    const Venditore = 1; // Docente - CANCELLA
    
    /**
     * Costante che definisce il ruolo del compratore
     */
    const Compratore = 2; // Studente - CANCELLA

    
    /**
     * Username per l'autenticazione
	*/
    private $username;
    
    /**
     * Password per l'autenticazione
     */
    private $password;
    
    /**
     * Nome dell'utente
     */
    private $nome;
    
    /**
     * Cognome dell'utente
     */
    private $cognome;
    
    /** 
     * email dell'utente
     */
    private $email;
    
    /**
     * Il ruolo dell'utente nell'applicazione.
     */
    private $ruolo;
    /**
     * Via dell'abitazione dell'utente
     */
    private $via;
    
    /**
     * Numero civico dell'abitazione.
     */
    private $numeroCivico;
    
    /**
     * Citta di residenza dell'utente.
     */
    private $citta;
    
    /**
     * Provincia di residenza dell'utente
     */
    private $provincia;
    /**
     * Cap dell'utente. Lo vogliamo max di cinque cifre
     */
    private $cap;
    
    /**
     * Identificatore dell'utente
     */
    private $id;

    /**
     * Costruttore
     */
    public function __construct() {
        
    }

    /**
     * Verifica se l'utente esista per il sistema
     */
    public function esiste() {
        return isset($this->ruolo);
    }

    /**
     * Restituisce lo username dell'utente
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Imposta lo username per l'autenticazione dell'utente. 
     * I nomi che si ritengono validi contengono solo lettere maiuscole e minuscole.
     * La lunghezza del nome deve essere superiore a 5
     */
    public function setUsername($username) {
        if (!filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[a-zA-Z]{5,}/')))) {
            return false;
        }
        $this->username = $username;
        return true;
    }

    /**
     * Restituisce la password per l'utente corrente
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Imposta la password per l'utente correntei
     */
    public function setPassword($password) {
        $this->password = $password;
        return true;
    }

    /**
     * Restituisce il nome dell'utente
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Imposta il nome dell'utente 
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }

    /**
     * Restituisce il cognome dell'utente
     */
    public function getCognome() {
        return $this->cognome;
    }

    /**
     * Imposta il cognome dell'utente
     */
    public function setCognome($cognome) {
        $this->cognome = $cognome;
        return true;
    }

    /**
     * Restituisce un intero corrispondente al ruolo
     */
    public function getRuolo() {
        return $this->ruolo;
    }

    /**
     * Imposta un ruolo per un dato utente
     */
    public function setRuolo($ruolo) {
        switch ($ruolo) {
            case self::Venditore:
				$this->ruolo = $ruolo;
                return true;
            case self::Compratore:
                $this->ruolo = $ruolo;
                return true;
            default:
                return false;
        }
    }

    /**
     * Restituisce l'email dell'utente
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Imposta una nuova email per l'utente
     */
    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $this->email = $email;
        return true;
    }

    /**
     * Restituisce la via di abitazione dell'utente
     */
    public function getVia() {
        return $this->via;
    }

    /**
     * Imposta un nuovo valore per la via
     */
    public function setVia($via) {
        $this->via = $via;
        return true;
    }

    
    /**
     * Restituisce il valore del numero civico di abitazione dell'utente
     */
    public function getNumeroCivico() {
        return $this->numeroCivico;
    }

    /**
     * Imposta il valore del numero civico dell'utente
     */
    public function setNumeroCivico($civico) {
        $intVal = filter_var($civico, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            $this->numeroCivico = $intVal;
            return true;
        }
        return false;
    }

    /**
     * Imposta la citta di abitazione dell'utente
     */
    public function setCitta($citta) {
        $this->citta = $citta;
        return true;
    }

    /**
     * Restituisce la citta' di abitazione dell'utente
     */
    public function getCitta() {
        return $this->citta;
    }

    /**
     * Imposta la provincia di abitazione dell'utente
     */
    public function setProvincia($provincia) {
        $this->provincia = $provincia;
        return true;
    }

    /**
     * Restituisce la provincia di abitazione dell'utente
     */
    public function getProvincia() {
        return $this->provincia;
    }

    /**
     * Restituisce il cap di abitazione dell'utente
     */
    public function getCap() {
        return $this->cap;
    }

    /**
     * Imposta il cap di abitazione dell'utente
     */
    public function setCap($cap) {
        if (!filter_var($cap, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[0-9]{5}/')))) {
            return false;
        }
        $this->cap = $cap;
        return true;
    }

    
    /**
     * Restituisce un identificatore unico per l'utente
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * Imposta un identificatore unico per l'utente
     */
    public function setId($id){
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal)){
            return false;
        }
        $this->id = $intVal;
    }
    
    /**
     * Compara due utenti, verificandone l'uguaglianza logica
     */
    public function equals(User $user) {

        return  $this->id == $user->id &&
                $this->nome == $user->nome &&
                $this->cognome == $user->cognome &&
                $this->ruolo == $user->ruolo;
    }

}

?>

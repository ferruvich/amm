<?php

class ViewDescriptor {
    const get = 'get';
    const post = 'post';
    private $titolo;
    private $logo_file;
    private $menu_file;
    private $leftBar_file;
    private $rightBar_file;
    private $content_file;
    private $messaggioErrore;
    private $messaggioConferma;
    private $pagina;
    private $sottoPagina;
    private $impToken;
    private $js;
    private $json;
    
    public function __construct() {
        $this->js = array();
        $this->json = false;
    }

    public function getTitolo() {
        return $this->titolo;
    }

    public function setTitolo($titolo) {
        $this->titolo = $titolo;
    }

    public function setLogoFile($logoFile) {
        $this->logo_file = $logoFile;
    }

    public function getLogoFile() {
        return $this->logo_file;
    }

    public function getMenuFile() {
        return $this->menu_file;
    }

    public function setMenuFile($menuFile) {
        $this->menu_file = $menuFile;
    }

    public function getLeftBarFile() {
        return $this->leftBar_file;
    }

    public function setLeftBarFile($leftBar) {
        $this->leftBar_file = $leftBar;
    }

    public function getRightBarFile() {
        return $this->rightBar_file;
    }
    
    public function setRightBarFile($rightBar) {
        $this->rightBar_file = $rightBar;
    }

    public function setContentFile($contentFile) {
        $this->content_file = $contentFile;
    }

    public function getContentFile() {
        return $this->content_file;
    }
    
    public function getMessaggioErrore() {
        return $this->messaggioErrore;
    }

    public function setMessaggioErrore($msg) {
        $this->messaggioErrore = $msg;
    }

    public function getSottoPagina() {
        return $this->sottoPagina;
    }

    public function setSottoPagina($pag) {
        $this->sottoPagina = $pag;
    }

    public function getMessaggioConferma() {
        return $this->messaggioConferma;
    }

    public function setMessaggioConferma($msg) {
        $this->messaggioConferma = $msg;
    }

    public function getPagina() {
        return $this->pagina;
    }

    public function setPagina($pagina) {
        $this->pagina = $pagina;
    }

    public function addScript($nome){
        $this->js[] = $nome;
    }
    
    public function &getScripts(){
        return $this->js;
    }
    
    public function isJson(){
        return $this->json;
    }
    
    public function toggleJson(){
        $this->json = true;
    }

    public function setImpToken($token) {
        $this->impToken = $token;
    }

    public function scriviToken($pre = '', $method = self::get) {
        $imp = BaseController::impersonato;
        switch ($method) {
            case self::get:
                if (isset($this->impToken)) {
                    // nel caso della 
                    return $pre . "$imp=$this->impToken";
                }
                break;

            case self::post:
                if (isset($this->impToken)) {
                    return "<input type=\"hidden\" name=\"$imp\" value=\"$this->impToken\"/>";
                }
                break;
        }

        return '';
    }

}

?>

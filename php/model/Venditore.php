<?php

include_once 'User.php';

class Venditore extends User{
	 
	public function __construct() {
        parent::__construct();
        $this->setRuolo(User::Venditore);
    }
}

?>

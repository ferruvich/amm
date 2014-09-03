<?php

include_once 'User.php';

class Compratore extends User{
	
	 public function __construct() {
        parent::__construct();
        $this->setRuolo(User::Compratore);
    }
}

?>

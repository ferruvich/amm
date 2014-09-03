<?php

class Settings {

    // variabili di accesso per il database
    public static $db_host = 'localhost';
    public static $db_user = 'root';
    public static $db_password = 'davide';
    public static $db_name = 'amm14_ferruDanielestef';
    
    private static $appPath;

    public static function getApplicationPath() {
        if (!isset(self::$appPath)) {
            // restituisce il server corrente
            switch ($_SERVER['HTTP_HOST']) {
                case 'localhost':
                    // configurazione locale
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm/';
                    break;
                case 'spano.sc.unica.it':
                    // configurazione pubblica
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2014/ferruDanieleStef/amm/';
                    break;
                default:
                    self::$appPath = '';
                    break;
            }
        }
        
        return self::$appPath;
    }

}

?>

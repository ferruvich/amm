<?php

class Settings {

    // variabili di accesso per il database
    public static $db_host = 'localhost';
    public static $db_user = 'ferruvich';
    public static $db_password = 'upupa551';
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
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm2014/ferruDanieleStef/';
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

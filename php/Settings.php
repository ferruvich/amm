<?php

/**
 * Classe che contiene una lista di variabili di configurazione
 *
 * @author Davide Spano
 */
class Settings {

    // variabili di accesso per il database
    public static $db_host = 'localhost';
    public static $db_user = 'ferruDanielestef';
    public static $db_password = 'upupa551';
    public static $db_name='amm14_ferruDanielestef';
    
    private static $appPath;

    /**
     * Restituisce il path relativo nel server corrente dell'applicazione
     * Lo uso perche' la mia configurazione locale e' ovviamente diversa da quella 
     * pubblica. Gestisco il problema una volta per tutte in questo script
     */
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
<<<<<<< HEAD
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm/ferruDanielestef/esami2014';
=======
                    self::$appPath = 'http://' . $_SERVER['HTTP_HOST'] . '/amm/ferruDanielestef/amm14_ferruDanielestef/';
>>>>>>> afc96194e0ae66d5a6b0e0e5c4bc31788a6394b7
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

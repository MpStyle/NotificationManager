<?php            
session_save_path('/tmp');

require_once __DIR__ . '/vendor/autoload.php';

use MToolkit\Core\MApplication;
use MToolkit\Model\Sql\MDbConnection;
use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;

class Settings
{
    const DATABASE_USERNAME = "root";
    const DATABASE_PASSWORD = "123456";
    const DATABASE_HOST = "localhost";
    const DATABASE_NAME = "NotificationManager";
    
    const APP_NAME = "Notification Manager";
    const APP_VERSION = "2.0-alpha";

    public static function run()
    {
        MApplication::setApplicationDirPath( __DIR__ );
        MDbConnection::addDbConnection( new \PDO( 'mysql:host=' . Settings::DATABASE_HOST . ';dbname=' . Settings::DATABASE_NAME . '', Settings::DATABASE_USERNAME, Settings::DATABASE_PASSWORD ) );

        if( ConfigurationBook::getValue( Configuration::SHOW_PHP_ERRORS ) == "true" )
        {
            ini_set( 'display_errors', '1' );
            error_reporting( E_ALL & ~E_STRICT & ~E_NOTICE );
        }
        else
        {
            ini_set( 'display_errors', '0' );
            error_reporting( ~E_ALL );
        }
    }

    /**
     * Restituisce un array di stringhe contenenti gli user id (Google +) agli
     * aventi diritto di accesso al backoffice.
     * 
     * @return array
     */
    public static function authorizedGooglePlusUserIdArray()
    {
        return array( '109852933276518677904', '110935823365082203857', '109236344331804119938' );
    }

}

Settings::run();

<?php

require_once __DIR__ . './MToolkit/Core/MApplication.php';

use MToolkit\Core\MApplication;
use MToolkit\Model\Sql\MDbConnection;

class Settings
{
    const DATABASE_USERNAME = "";
    const DATABASE_PASSWORD = "";
    const DATABASE_HOST = "";
    const DATABASE_NAME = "";

    public static function run()
    {
        MApplication::setApplicationDirPath( __DIR__ );
        MDbConnection::addDbConnection( new \PDO( 'mysql:host=' . Settings::DATABASE_HOST . ';dbname=' . Settings::DATABASE_NAME . '', Settings::DATABASE_USERNAME, Settings::DATABASE_PASSWORD ) );
    }

}

Settings::run();

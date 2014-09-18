<?php
require_once __DIR__ . './MToolkit/Core/MApplication.php';

use MToolkit\Core\MApplication;

class Settings
{
    public static function run()
    {
        MApplication::setApplicationDirPath(__DIR__);
    }
}

Settings::run();

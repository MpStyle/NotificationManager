<?php

namespace BusinessLogic\Module;

use MToolkit\Core\MDir;
use MToolkit\Core\MApplication;
use MToolkit\Core\MDir\Filter;
use MToolkit\Core\MFileInfoList;
use MToolkit\Core\MFileInfo;
use BusinessLogic\Module\Module;
use MToolkit\Core\MList;

/**
 * This class provide a list of the available modules.
 */
class ModulesManager
{
    const MODULES_PATH = 'Modules';

    /**
     * @var ModulesManager
     */
    private static $instance = null;

    /**
     * @var MList<Module> 
     */
    private $moduleList = null;

    private function __construct()
    {
        $this->moduleList = new MList();

        $path = MApplication::getApplicationDirPath() . MDir::getSeparator() . self::MODULES_PATH;
        $dir = new MDir( $path );

        // Gets the sub folder of the Modules folder
        /* @var $fileInfoList MFileInfoList */ $fileInfoList = $dir->getEntryInfoList( null, Filter::DIRS );

        // Iterates for every sub folder
        foreach( $fileInfoList as /* @var $fileInfo MFileInfo */ $fileInfo )
        {
            $notificationFile = $fileInfo->getAbsoluteFilePath() . MDir::getSeparator() . 'Notification.php';
            $senderFile = $fileInfo->getAbsoluteFilePath() . MDir::getSeparator() . 'Engine.php';

            $notificationFileInfo = new MFileInfo( $notificationFile );
            $senderFileInfo = new MFileInfo( $senderFile );

            // If the sub folder has the Sender and the Notification php file, the module is valid
            if( $notificationFileInfo->exists() && $senderFileInfo->exists() )
            {
                $module = new Module();
                $module->Name = $fileInfo->getFileName();

                $this->moduleList->append( $module );
            }
        }
    }

    /**
     * @return ModulesManager
     */
    public static function getInstance()
    {
        if( self::$instance == null )
        {
            self::$instance = new ModulesManager();
        }

        return self::$instance;
    }

}

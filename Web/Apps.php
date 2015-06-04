<?php

namespace Web;

require_once '../Settings.php';

use DbAbstraction\Application\ApplicationAction;
use Web\MasterPages\LoggedMasterPage;

class Apps extends BasePage
{
    private $applicationCount=0;
    
    public function __construct()
    {
        parent::__construct( __DIR__ . '/Apps.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );

        $this->addJavascript( "Javascripts/Apps.js" );
        $this->addCss( "Styles/Apps.css" );
        
        /* @var $result MPDOResult */ $result = ApplicationAction::getCount( $id, $name );
        $this->applicationCount = $result->getData( 0, 'AppCount' );
    }

    protected function createNewApp()
    {
        $this->getHttpResponse()->redirect( "EditApp.php" );
    }

    protected function deleteApplication()
    {
        if( ApplicationAction::delete( (int)$this->getPost()->getValue( "ApplicationId" ) ) == null )
        {
            $this->getHttpResponse()->redirect( "Apps.php?error=01" );
        }
        else
        {
            $this->getHttpResponse()->redirect( "Apps.php?error=02" );
        }
    }

    public function getApplicationCount()
    {
        return $this->applicationCount;
    }


}

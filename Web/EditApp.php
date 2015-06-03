<?php

namespace Web;

require_once '../Settings.php';

use Web\MasterPages\LoggedMasterPage;
use BusinessLogic\Enum\Post;

class EditApp extends BasePage
{

    public function __construct()
    {
        parent::__construct( __DIR__ . '/EditApp.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );

        $this->addJavascript( "Javascripts/EditApp.js" );
        $this->addCss( "Styles/EditApp.css" );
    }

    protected function confirmEdit()
    {
        /* @var \MToolkit\Model\Sql\MPDOResult $result */

        if( $this->getGet()->getValue( "id" ) == null )
        {
            // Create app
            $result = \DbAbstraction\Application\ApplicationAction::insert(
                            $this->getPost()->getValue( "app_name" )
                            , $this->getPost()->getValue( "app_google_client_key" )
                            , $this->getPost()->getValue( "app_microsoft_client_key" )
                            , $this->getPost()->getValue( "client_id" )
            );
        }
        else
        {
            // Edit app
            $result = \DbAbstraction\Application\ApplicationAction::update(
                            (int)$this->getCurrentApp()->getId()
                            , $this->getPost()->getValue( "app_name" )
                            , $this->getPost()->getValue( "app_google_client_key" )
                            , $this->getPost()->getValue( "app_microsoft_client_key" )
            );
        }

        if( $result != null && $result->getNumRowsAffected() > 0 )
        {
            // ok
            $this->getHttpResponse()->redirect( "Apps.php?error=0" );
        }
        else
        {
            // ko
            $this->getHttpResponse()->redirect( "?error=1" );
        }
    }

    /**
     * @return Application
     */
    public function getCurrentApp( $id = null )
    {
        return parent::getCurrentApp( (int)$this->getGet()->getValue( "id" ) );
    }

}

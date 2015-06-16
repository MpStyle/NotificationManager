<?php

namespace Web;

require_once '../Settings.php';

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Application\ApplicationLink;
use DbAbstraction\Application\ApplicationAction;
use DbAbstraction\Link\LinkAction;
use Web\MasterPages\LoggedMasterPage;
use BusinessLogic\Link\LinkBook;

class EditApp extends BasePage
{
    private $internalLinks = array();

    public function __construct()
    {
        parent::__construct( __DIR__ . '/EditApp.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );

        $this->addJavascript( "Javascripts/EditApp.js" );
        $this->addCss( "Styles/EditApp.css" );

        $internalLinks = LinkBook::get( null, (int) $this->getCurrentApp()->getId() )->__toArray();
        foreach( $internalLinks as /* @var $internalLink ApplicationLink */ $internalLink )
        {
            $this->internalLinks[]=$internalLink->getName();
        }
    }

    protected function confirmEdit()
    {
        /* @var \MToolkit\Model\Sql\MPDOResult $result */

        if( $this->getCurrentApp()->getId() == null )
        {
            // Create app
            $result = ApplicationAction::insert(
                            $this->getPost()->getValue( "app_name" )
                            , $this->getPost()->getValue( "app_google_client_key" )
                            , $this->getPost()->getValue( "app_microsoft_client_key" )
                            , $this->getPost()->getValue( "client_id" )
            );
        }
        else
        {
            // Edit app
            $result = ApplicationAction::update(
                            (int) $this->getCurrentApp()->getId()
                            , $this->getPost()->getValue( "app_name" )
                            , $this->getPost()->getValue( "app_google_client_key" )
                            , $this->getPost()->getValue( "app_microsoft_client_key" )
            );
        }

        if( $result != null )
        {
            LinkAction::delete( (int) $this->getCurrentApp()->getId() );

            foreach( explode( ",", $this->getPost()->getValue( "links" ) ) as $link )
            {
                LinkAction::insert( trim( $link ), (int) $this->getCurrentApp()->getId() );
            }

            // ok
            $this->getHttpResponse()->redirect( "Apps.php?error=0" );
        }
        else
        {
            // ko
            $this->getHttpResponse()->redirect( "?error=1&id=" . $this->getCurrentApp()->getId() );
        }
    }

    /**
     * @return Application
     */
    public function getCurrentApp( $id = null )
    {
        return parent::getCurrentApp( (int) $this->getGet()->getValue( "id" ) );
    }

    public function getInternalLinks()
    {
        return implode( ", ", $this->internalLinks );
    }

}

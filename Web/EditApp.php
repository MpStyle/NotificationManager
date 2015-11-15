<?php

namespace Web;

/*
 * This file is part of MToolkit.
 *
 * MToolkit is free software: you can redistribute it and/or modify
 * it under the terms of the LGNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * MToolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * LGNU Lesser General Public License for more details.
 *
 * You should have received a copy of the LGNU Lesser General Public License
 * along with MToolkit.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @author  Michele Pagnin
 */

require_once '../Settings.php';

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationLink;
use BusinessLogic\ApplicationInternalLink\ApplicationInternalLinkBook;
use DbAbstraction\Application\ApplicationAction;
use DbAbstraction\ApplicationInternalLink\ApplicationInternalLinkAction;
use Web\MasterPages\LoggedMasterPage;

class EditApp extends BasePage
{
    private $internalLinks = array();

    public function __construct()
    {
        parent::__construct( __DIR__ . '/EditApp.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );
        $this->addMasterPagePart( 'top-toolbar', 'top-toolbar' );
        $this->addMasterPagePart( 'page-title', 'page-title' );

        $this->addJavascript( "Javascripts/EditApp.js" );
        $this->addCss( "Styles/EditApp.css" );

        $internalLinks = ApplicationInternalLinkBook::get( null, null, (int) $this->getCurrentApp()->getId() )->__toArray();
        foreach( $internalLinks as /* @var $internalLink ApplicationLink */ $internalLink )
        {
            $this->internalLinks[] = $internalLink->getName();
        }
    }

    protected function confirmEdit()
    {
        /* @var \MToolkit\Model\Sql\MPDOResult $result */

        $applicationId = (int) $this->getCurrentApp()->getId();

        if( $this->getCurrentApp()->getId() == null )
        {
            // Create app
            $result = ApplicationAction::insert(
                            $this->getPost()->getValue( "app_name" )
                            , $this->getPost()->getValue( "app_google_client_key" )
                            , $this->getPost()->getValue( "app_microsoft_client_key" )
                            , $this->getPost()->getValue( "client_id" )
                            , $this->getPost()->getValue( "secret_id" )
            );

            $applicationId = (int) $result->getData( 0, "ApplicationId" );
        }
        else
        {
            // Edit app
            $result = ApplicationAction::update(
                            (int) $this->getCurrentApp()->getId()
                            , $this->getPost()->getValue( "app_name" )
                            , $this->getPost()->getValue( "app_google_client_key" )
                            , $this->getPost()->getValue( "app_microsoft_client_key" )
                            , $this->getPost()->getValue( "secret_id" )
            );
        }

        if( $result != null )
        {
            ApplicationInternalLinkAction::delete( $applicationId );

            foreach( explode( ",", $this->getPost()->getValue( "links" ) ) as $link )
            {
                ApplicationInternalLinkAction::insert( trim( $link ), $applicationId );
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

    public function getPageTitle()
    {
        if( $this->getGet()->getValue( "id" ) == null )
        {
            return "Create app";
        }

        return "Edit app";
    }

}

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

use Web\MasterPages\LoggedMasterPage;

class WebServicesV100 extends BasePage
{

    public function __construct()
    {
        parent::__construct( __DIR__ . '/WebServicesV100.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );
        $this->addMasterPagePart( 'top-toolbar', 'top-toolbar' );
        $this->addMasterPagePart( 'page-title', 'page-title' );

        $this->addJavascript( "Javascripts/WebServicesV100.js" );
        $this->addCss( "Styles/WebServicesV100.css" );
    }

    public function getCurrentURL()
    {
        $pageURL = 'http';
        if( $_SERVER["HTTPS"] == "on" )
        {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if( $_SERVER["SERVER_PORT"] != "80" )
        {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }
        else
        {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        $pageURL = str_replace( basename(__FILE__), "WebServices/Version_1_0_0/", $pageURL );

        return $pageURL;
    }

}

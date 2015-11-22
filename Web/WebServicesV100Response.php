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

use MToolkit\Core\MMap;
use Web\MasterPages\LoggedMasterPage;

class WebServicesV100Response extends BasePage
{
    /**
     * @var MMap
     */
    private $parameters;
    private $url;
    private $response;

    public function __construct()
    {
        parent::__construct( __DIR__ . '/WebServicesV100Response.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );
        $this->addMasterPagePart( 'top-toolbar', 'top-toolbar' );
        $this->addMasterPagePart( 'page-title', 'page-title' );

        $this->addJavascript( "Javascripts/WebServicesV100Response.min.js" );
        $this->addCss( "Styles/WebServicesV100Response.css" );
        
        // init params
        $this->parameters = new MMap( $this->getPost()->__toArray() );
        $this->parameters->remove("methodUrl");
        $this->parameters->remove("methodName");
        
        // do the call
        $this->url = $this->getPost()->getValue( "methodUrl" );
        $data = $this->parameters->__toArray();

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded",
                'method' => 'POST',
                'content' => http_build_query( $data ),
            ),
        );
        
        $context = stream_context_create( $options );
        $response = file_get_contents( $this->url, false, $context );

        $this->response = $response;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Returns encoded response of the called web service.
     * 
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    /**
     * Returns decoded response of the called web service.
     * @return string
     */
    public function getDecodedResponse()
    {
        return base64_decode($this->getResponse());
    }
    
    public function getUrl()
    {
        return $this->url;
    }
}

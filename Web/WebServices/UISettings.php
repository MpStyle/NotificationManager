<?php

namespace Web\WebServices;

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

require_once __DIR__ . '/../../Settings.php';

use MToolkit\Network\MNetworkCookie;
use MToolkit\Network\RPC\Json\MRPCJsonResponse;

class UISettings extends AbstractBaseWebService
{

    public function get( $params )
    {
        if( !parent::validateToken() )
        {
            $rawResponse = array( "Result" => false );
            $response = new MRPCJsonResponse();
            $response->setResult( $rawResponse );
            $this->setResponse( $response );
            return;
        }

        $rawResponse = array( "Result" => true, "UISettings" => MNetworkCookie::get( "UISettings" ) );
        $response = new MRPCJsonResponse();
        $response->setResult( $rawResponse );
        $this->setResponse( $response );
    }

    public function set( $params )
    {
        if( !parent::validateToken() )
        {
            $rawResponse = array( "Result" => false );
            $response = new MRPCJsonResponse();
            $response->setResult( $rawResponse );
            $this->setResponse( $response );
            return;
        }
        
        $key=$params["key"];
        $value=$params["value"];
        $uiSettings=MNetworkCookie::get( "UISettings" );
        $uiSettings[$key]=$value;
        MNetworkCookie::set("UISettings", $uiSettings);
        
        $rawResponse = array( "Result" => true );
        $response = new MRPCJsonResponse();
        $response->setResult( $rawResponse );
        $this->setResponse( $response );
    }

}

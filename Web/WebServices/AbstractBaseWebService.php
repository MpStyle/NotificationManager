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

use BusinessLogic\Enum\Session;
use BusinessLogic\GoogleApiServices\GoogleApiServices;
use MToolkit\Network\MNetworkSession;
use MToolkit\Network\RPC\Json\MRPCJsonResponse;
use MToolkit\Network\RPC\Json\Server\MRPCJsonWebService;

abstract class AbstractBaseWebService extends MRPCJsonWebService
{
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function validateToken()
    {
        $this->googleService = new GoogleApiServices(
                MNetworkSession::get( Session::GOOGLE_ACCESS_TOKEN )
                , MNetworkSession::get( Session::GOOGLE_TOKEN_ID )
                , MNetworkSession::get( Session::GOOGLE_CREATED )
                , MNetworkSession::get( Session::GOOGLE_TOKEN_TYPE )
                , MNetworkSession::get( Session::GOOGLE_EXPIRES_IN )
        );

        // Controlla se il token di Google è valido
        if( $this->googleService->isValidToken() === false )
        {
            $rawResponse = array( "Result" => false );
            $response = new MRPCJsonResponse();
            $response->setResult( $rawResponse );
            $this->setResponse( $response );

            return false;
        }

        return true;
    }
}

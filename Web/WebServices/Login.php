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
use Settings;

class Login extends AbstractBaseWebService
{

    public function aaa( $params )
    {
        $tokenId = $params['token_id'];
        $accessToken = $params['access_token'];
        $tokenType = $params['token_type'];
        $created = $params['created'];
        $expiresIn = $params['expires_in'];

//        var_dump( array($accessToken, $tokenId, $created, $tokenType, $expiresIn) );

        $googleClient = new GoogleApiServices( $accessToken, $tokenId, $created, $tokenType, $expiresIn );

        if( $googleClient->isValidToken() )
        {
            $userInfo = $googleClient->userInfo();
            $isValidUser = ( in_array( $userInfo['id'], Settings::authorizedGooglePlusUserIdArray() )||in_array( "*", Settings::authorizedGooglePlusUserIdArray() ) );

            if( $isValidUser===false )
            {
                $googleClient->revokeToken();
                MNetworkSession::deleteAll();
            }
            else
            {
                MNetworkSession::set( Session::GOOGLE_TOKEN_ID, $tokenId );
                MNetworkSession::set( Session::GOOGLE_ACCESS_TOKEN, $accessToken );
                MNetworkSession::set( Session::GOOGLE_TOKEN_TYPE, $tokenType );
                MNetworkSession::set( Session::GOOGLE_CREATED, $created );
                MNetworkSession::set( Session::GOOGLE_EXPIRES_IN, $expiresIn );
            }

            $rawResponse = array( "Result" => $isValidUser );
            $response = new MRPCJsonResponse();
            $response->setResult( $rawResponse );
            $this->setResponse( $response );
            return;
        }

        $rawResponse = array( "Result" => false );
        $response = new MRPCJsonResponse();
        $response->setResult( $rawResponse );
        $this->setResponse( $response );
    }

}

<?php

namespace Web\WebServices;

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
            $isValidUser = ( in_array( $userInfo['id'], Settings::authorizedGooglePlusUserIdArray() ) || in_array( "*", Settings::authorizedGooglePlusUserIdArray() ) );

            if( $isValidUser === false )
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

            $rawResponse = array("Result" => $isValidUser);
            $response = new MRPCJsonResponse();
            $response->setResult( $rawResponse );
            $this->setResponse( $response );
            return;
        }

        $rawResponse = array("Result" => false);
        $response = new MRPCJsonResponse();
        $response->setResult( $rawResponse );
        $this->setResponse( $response );
    }

}

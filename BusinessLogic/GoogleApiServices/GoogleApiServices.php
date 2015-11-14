<?php
namespace BusinessLogic\GoogleApiServices;

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

use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;
use Exception;
use Google_Client;
use Google_Service_Plus;

class GoogleApiServices
{
    private $accessToken;
    private $tokenId;
    private $created;
    private $tokenType;
    private $expiresIn;
    private $googleClient;
    
    public function __construct($accessToken=null, $tokenId=null, $created=null, $tokenType=null, $expiresIn=null)
    {
        $this->accessToken=$accessToken;
        $this->tokenId=$tokenId;
        $this->created=$created;
        $this->tokenType=$tokenType;
        $this->expiresIn=$expiresIn;
        
        $this->googleClient = new Google_Client();
        $this->googleClient->setClientId( ConfigurationBook::getValue( Configuration::GOOGLE_CLIENT_ID ) );
        $this->googleClient->setClientSecret( Configuration::GOOGLE_CLIENT_SECRET );
        $this->googleClient->setRedirectUri( Configuration::GOOGLE_REDIRECT_URL );
    }
    
    public function revokeToken()
    {
        //$this->googleClient->revokeToken($this->accessToken);
    }
    
    public function userInfo()
    {
        $as = '
            {
                "access_token":"' . $this->accessToken . '"
                , "token_type":"' . $this->tokenType . '"
                , "expires_in":' . $this->expiresIn . '
                , "id_token":"' . $this->tokenId . '"
                , "created":' . $this->created . '
            }
        ';

        try
        {
            $this->googleClient->verifyIdToken( $this->tokenId );
            $this->googleClient->setAccessToken($as);
            $plus = new Google_Service_Plus( $this->googleClient );
            $me = $plus->people->get('me');
        }
        catch( Exception $ex )
        {
//            var_dump($ex);
            return null;
        }
        
        return $me;
    }
    
    public function isValidToken()
    {
        if( $this->tokenId==null )
        {
            return false;
        }
        
        $as = '
            {
                "access_token":"' . $this->accessToken . '"
                , "token_type":"' . $this->tokenType . '"
                , "expires_in":' . $this->expiresIn . '
                , "id_token":"' . $this->tokenId . '"
                , "created":' . $this->created . '
            }
        ';

        try
        {
            $this->googleClient->verifyIdToken( $this->tokenId );
            $this->googleClient->setAccessToken($as);
            $plus = new Google_Service_Plus( $this->googleClient );
            $me = $plus->people->get('me');
        }
        catch( Exception $ex )
        {
//            var_dump($ex);
            return false;
        }
        
        return true;
    }
}


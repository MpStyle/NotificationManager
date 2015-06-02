<?php
namespace BusinessLogic\GoogleApiServices;

require_once __DIR__ . '/../../GoogleAPIClient/Google_Client.php';
require_once __DIR__ . '/../../GoogleAPIClient/contrib/Google_PlusService.php';

use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;

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
        
        $this->googleClient = new \Google_Client();
        $this->googleClient->setClientId( ConfigurationBook::getValue( Configuration::GOOGLE_CLIENT_ID ) );
        $this->googleClient->setClientSecret( Configuration::GOOGLE_CLIENT_SECRET );
        $this->googleClient->setRedirectUri( Configuration::GOOGLE_REDIRECT_URL );
    }
    
    public function revokeToken()
    {
        $this->googleClient->revokeToken($this->accessToken);
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
            $plus = new \Google_PlusService( $this->googleClient );
            $me = $plus->people->get('me');
        }
        catch( \Exception $ex )
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
            $plus = new \Google_PlusService( $this->googleClient );
            $me = $plus->people->get('me');
        }
        catch( \Exception $ex )
        {
//            var_dump($ex);
            return false;
        }
        
        return true;
    }
}


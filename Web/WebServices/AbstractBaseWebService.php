<?php
namespace Web\WebServices;

require_once __DIR__ . '/../../Settings.php';

use BusinessLogic\GoogleApiServices\GoogleApiServices;
use BusinessLogic\Enums\Session;
use MToolkit\Network\MNetworkSession;
use MToolkit\Network\RPC\Json\Server\MRPCJsonWebService;
use MToolkit\Network\RPC\Json\MRPCJsonResponse;

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

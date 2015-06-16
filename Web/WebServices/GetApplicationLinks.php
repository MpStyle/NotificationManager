<?php

namespace Web\WebServices;

require_once __DIR__ . '/../../Settings.php';

use BusinessLogic\Application\ApplicationBook;
use MToolkit\Network\RPC\Json\MRPCJsonResponse;

class GetApplicationLinks extends AbstractBaseWebService
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

        $appId = $params['app_id'];
        $applicationlinks = ApplicationBook::getApplications( $appId );

        $rawResponse = array( "ApplicationLink" => $applicationlinks->__toArray() );
        $response = new MRPCJsonResponse();
        $response->setResult( $rawResponse );
        $this->setResponse( $response );
    }

}

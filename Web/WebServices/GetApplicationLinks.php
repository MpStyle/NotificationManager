<?php

namespace Web\WebServices;

require_once __DIR__ . '/../../Settings.php';

use BusinessLogic\ApplicationInternalLink\ApplicationInternalLinkBook;
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

        $appId = (int) $params['applicationId'];
        $applicationlinks = ApplicationInternalLinkBook::get( null, null, $appId );

        $links = array();

        foreach( $applicationlinks->__toArray() as /* @var $link \BusinessLogic\ApplicationInternalLink\ApplicationInternalLink */ $link )
        {
            $links[] = array( "id" => $link->getId(), "name" => $link->getName() );
        }

        $rawResponse = array( "Result" => true, "ApplicationLinks" => $links );
        $response = new MRPCJsonResponse();
        $response->setResult( $rawResponse );
        $this->setResponse( $response );
    }

}

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

use BusinessLogic\ApplicationInternalLink\ApplicationInternalLink;
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

        foreach( $applicationlinks->__toArray() as /* @var $link ApplicationInternalLink */ $link )
        {
            $links[] = array( "id" => $link->getId(), "name" => $link->getName() );
        }

        $rawResponse = array( "Result" => true, "ApplicationLinks" => $links );
        $response = new MRPCJsonResponse();
        $response->setResult( $rawResponse );
        $this->setResponse( $response );
    }

}

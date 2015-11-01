<?php

namespace Web\WebServices\Version_1_0_0;

/*
 * This file is part of Notification Manager.
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

require_once '../../../Settings.php';

use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\DeviceBook;
use DbAbstraction\Device\DeviceAction;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOResult;

class MobileRegistrationStatus extends AbstractWebService
{
    private $request = null;
    private $mobileId = null;
    private $type = null;
    private $localizationId = null;
    private $clientId = null;

    public function init()
    {
        parent::setWebServiceName( __CLASS__ );

        $this->request = $this->getPost()->getValue( "requestId" );
        $this->mobileId = $this->getPost()->getValue( "mobileId" );
        $this->type = $this->getPost()->getValue( "type" );
        $this->localizationId = $this->getPost()->getValue( "localizationId" );
        $this->clientId = $this->getPost()->getValue( "clientId" );
    }

    public function exec()
    {
        if( $this->request==null||$this->mobileId==null||$this->type==null||$this->localizationId==null||$this->clientId==null )
        {
            parent::setResult( false );
            parent::setResultDescription( "Invalid mandatory parameters (0)." );
            return;
        }

        try
        {
            /* @var $devices MList */ $devices = DeviceBook::getDevices( null, null, null, $this->type, null, $this->mobileId );
            if( $devices->count()<=0 )
            {
                parent::setResult( false );
                parent::setResultDescription( "Invalid mandatory parameters (1)." );
                return;
            }

            /* @var $applications MList */ $applications = ApplicationBook::getApplications( null, null, $this->clientId );
            if( $applications->count()<=0 )
            {
                parent::setResult( false );
                parent::setResultDescription( "Invalid mandatory parameters (2)." );
                return;
            }

            $applicationId = (int) $applications->at( 0 )->getId();
            $deviceId = (int) $devices->at( 0 )->getId();

            /* @var $devicesApplications MList */ $devicesApplications = DeviceBook::getDevices( $deviceId, 1, $applicationId, $this->type, null, $this->mobileId );

            parent::setResult( true );
            parent::setResponse( "isEnabled", $devicesApplications->count()>0 );
        }
        catch( OutOfBoundException $ex )
        {
            parent::setResult( false );
            parent::setResultDescription( "Device or application not found." );
        }
    }

}

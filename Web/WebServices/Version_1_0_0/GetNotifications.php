<?php

namespace Web\WebServices\Version_1_0_0;

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

require_once '../../../Settings.php';

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\Device;
use BusinessLogic\Device\DeviceBook;
use BusinessLogic\Notification\DeliveryStatus;
use DbAbstraction\Device\DeviceAction;
use QueryPath\Exception;

class GetNotifications extends AbstractWebService
{
    private $request;
    private $mobileId;
    private $clientId;
    private $type;

    public function init()
    {
        parent::setWebServiceName( __CLASS__ );

        $this->request = (int) $this->getPost()->getValue( "requestId" );
        $this->mobileId = $this->getPost()->getValue( "mobileId" );
        $this->clientId = $this->getPost()->getValue( "clientId" );
        $this->type = $this->getPost()->getValue( "type" );
        $this->notificationId = $this->getPost()->getValue( "notificationId" ) == null ? null : (int) $this->getPost()->getValue( "notificationId" );
    }

    public function exec()
    {
        if( $this->request == null || $this->mobileId == null || $this->clientId == null )
        {
            parent::setResult( false );
            parent::setResultDescription( "Invalid mandatory parameters (0)." );
            return;
        }

        try
        {
            /* @var $device Device */ $device = DeviceBook::getDevices( null, null, null, $this->type, null, $this->mobileId )->at( 0 );
            /* @var $application Application */ $application = ApplicationBook::getApplications( null, null, $this->clientId )->at( 0 );
            /* @var notifications MPDOResult */ $notifications = DeviceAction::getNotification( (int) $device->getId(), (int) $application->getId(), $this->notificationId, DeliveryStatus::SENT);

            parent::setResponse( "Notifications", $notifications->toArray() );
        }
        catch( Exception $ex )
        {
            parent::setResult( false );
            parent::setResultDescription( "Device or application not found." );
        }
    }

}

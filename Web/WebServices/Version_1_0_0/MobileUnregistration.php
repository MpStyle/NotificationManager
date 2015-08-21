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

use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\DeviceBook;
use DbAbstraction\Device\DeviceAction;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MDbConnection;

/**
 * <b>URL</b>: Web/WebServices/Version_1_0_0/MobileUnregistration.php<br />
 * <br />
 * Servizio per la deregistrazione del device nel sistema.<br />
 * Gli input da passare in POST sono:
 * <ul>
 *  <li>requestId: identificativo della richiesta</li>
 *  <li>mobileId: id del device</li>
 *  <li>clientId: codice identificativo dell'app, generata nel back-office</li>
 * </ul>
 */
class MobileUnregistration extends AbstractWebService
{

    public function exec()
    {
        parent::setWebServiceName(__CLASS__);

        $request = $this->getPost()->getValue( "requestId" );
        $mobileId = $this->getPost()->getValue("mobileId");
        $clientId = $this->getPost()->getValue("clientId");
        $type = $this->getPost()->getValue( "type" );
        
        if( $request == null || $mobileId == null || $clientId == null )
        {
            parent::setResult( false );
            parent::setResultDescription( "Invalid mandatory parameters (0)." );
            return;
        }

        MDbConnection::getDbConnection()->beginTransaction();

        try
        {
            /* @var $devices MList */ $devices = DeviceBook::getDevices(null, null, null, $type, null, $mobileId);
            if( $devices->count() <= 0 )
            {
                parent::setResult( false );
                parent::setResultDescription( "Invalid mandatory parameters (1)." );
                return;
            }
            
            /* @var $device \BusinessLogic\Device\Device */ $device=$devices->getValue( 0 );
            
            // Se il device è già disabilitato allora non devo fare nient'altro.
            if( $device->getEnabled()==0 || $device->getEnabled()==false )
            {
                parent::setResult( false );
                parent::setResultDescription( "Device already disabled." );
                return;
            }
            
            /* @var $applications MList */ $applications = ApplicationBook::getApplications( null, null, $clientId );
            if( $applications->count() <= 0 )
            {
                parent::setResult( false );
                parent::setResultDescription( "Invalid mandatory parameters (2)." );
                return;
            }

            $applicationId = $applications->at( 0 )->getId();
            $deviceId = $devices->at( 0 )->getId();
            
            DeviceAction::update( (int) $deviceId, (int) $applicationId, 0 );

            MDbConnection::getDbConnection()->commit();
            
            parent::setResult(true);
        }
        catch (OutOfBoundException $ex)
        {
            MDbConnection::getDbConnection()->rollBack();

            parent::setResult(false);
            parent::setResultDescription("Device or application not found.");
        }
    }

}

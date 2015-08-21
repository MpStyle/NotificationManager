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

/**
 * <b>URL</b>: Web/WebServices/Version_1_0_0/MobileRegistration.php<br />
 * <br />
 * Servizio per la registrazione del device nel sistema.<br />
 * Gli input da passare in POST sono:
 * <ul>
 *  <li>requestId: identificativo della richiesta (utile per chiamate concorrenti)</li>
 *  <li>mobileId: id del device</li>
 *  <li>type: valori possibili 'IOS', 'ANDROID', 'WINDOWS_PHONE'</li>
 *  <li>osVersion: versione del sistema operativo del device</li>
 *  <li>applicationVersion: </li>
 *  <li>brand: marca del device</li>
 *  <li>model: modello del device</li>
 *  <li>localizationId: lingua attiva nel device</li>
 *  <li>clientId: codice identificativo dell'app, generata nel back-office</li>
 * </ul>
 */
class MobileRegistration extends AbstractWebService
{
    private $request = null;
    private $mobileId = null;
    private $type = null;
    private $osVersion = null;
    private $applicationVersion = null;
    private $brand = null;
    private $model = null;
    private $localizationId = null;
    private $clientId = null;

    public function init()
    {
        parent::setWebServiceName( __CLASS__ );

        $this->request = $this->getPost()->getValue( "requestId" );
        $this->mobileId = $this->getPost()->getValue( "mobileId" );
        $this->type = $this->getPost()->getValue( "type" );
        $this->osVersion = $this->getPost()->getValue( "osVersion" );
        $this->applicationVersion = $this->getPost()->getValue( "applicationVersion" );
        $this->brand = $this->getPost()->getValue( "brand" );
        $this->model = $this->getPost()->getValue( "model" );
        $this->localizationId = $this->getPost()->getValue( "localizationId" );
        $this->clientId = $this->getPost()->getValue( "clientId" );
    }

    public function exec()
    {
        if( $this->request == null || $this->mobileId == null || $this->type == null || $this->localizationId == null || $this->clientId == null )
        {
            parent::setResult( false );
            parent::setResultDescription( "Invalid mandatory parameters (0)." );
            return;
        }

        MDbConnection::getDbConnection()->beginTransaction();

        try
        {
            DeviceAction::insert( $this->mobileId, $this->type, $this->osVersion, $this->applicationVersion, $this->brand, $this->model, $this->localizationId );

            /* @var $devices MList */ $devices = DeviceBook::getDevices( null, null, null, $this->type, null, $this->mobileId );
            if( $devices->count() <= 0 )
            {
                parent::setResult( false );
                parent::setResultDescription( "Invalid mandatory parameters (1)." );
                return;
            }

            /* @var $applications MList */ $applications = ApplicationBook::getApplications( null, null, $this->clientId );
            if( $applications->count() <= 0 )
            {
                parent::setResult( false );
                parent::setResultDescription( "Invalid mandatory parameters (2)." );
                return;
            }

            $applicationId = (int) $applications->at( 0 )->getId();
            $deviceId = (int) $devices->at( 0 )->getId();

            /* @var $devicesApplications MList */ $devicesApplications = DeviceBook::getDevices( $deviceId, null, $applicationId, $this->type, null, $this->mobileId );

            // Associa il device all'applicazione solo se non esiste già.
            if( $devicesApplications->count() <= 0 )
            {
                /* @var $deviceSetApplication MPDOResult */ $deviceSetApplication = DeviceAction::setApplication( $deviceId, $applicationId, true );
            }
            
            DeviceAction::update( $deviceId, $applicationId, 1 );

            MDbConnection::getDbConnection()->commit();

            parent::setResult( true );
        }
        catch( OutOfBoundException $ex )
        {
            MDbConnection::getDbConnection()->rollBack();

            parent::setResult( false );
            parent::setResultDescription( "Device or application not found." );
        }
    }

}

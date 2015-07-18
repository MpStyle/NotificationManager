<?php

namespace Web\WebServices\Version_1_0_0;

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
            /* @var $devices MList */ $devices = DeviceBook::getDevices(null, 1, null, $type, null, $mobileId);
            if( $devices->count() <= 0 )
            {
                parent::setResult( false );
                parent::setResultDescription( "Invalid mandatory parameters (1)." );
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

<?php

namespace Web\WebServices\Version_1_0_0;

use MToolkit\Controller\MAbstractHttpHandler;

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
        parent::setWebService(__CLASS__);

        $mobileId = $this->getPost()->getValue("mobileId");
        $clientId = $this->getPost()->getValue("clientId");

        MDbConnection::getDbConnection()->beginTransaction();

        try
        {
            /* @var $device Device */ $device = DeviceBook::getDevices(null, null, null, null, null, $mobileId)->at(0);
            /* @var $application Application */ $application = ApplicationBook::getApplications(null, null, $clientId)->at(0);
            DeviceAction::update($device->getId, false);

            MDbConnection::getDbConnection()->commit();
        }
        catch (OutOfBoundException $ex)
        {
            MDbConnection::getDbConnection()->rollBack();

            parent::setResult(false);
            parent::setResultDescription("Device or application not found.");
        }
    }

}

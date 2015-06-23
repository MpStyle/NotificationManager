<?php

namespace Web\WebServices\Version_1_0_0;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\Device;
use BusinessLogic\Device\DeviceBook;
use DbAbstraction\Device\DeviceAction;

/**
 * <b>URL</b>: Web/WebServices/Version_1_0_0/MobileRegistration.php<br />
 * <br />
 * Servizio per la registrazione del device nel sistema.<br />
 * Gli input da passare in POST sono:
 * <ul>
 *  <li>requestId: identificativo della richiesta</li>
 *  <li>mobileId: id del device</li>
 *  <li>type: valori possibili 'IOS', 'ANDROID', 'WINDOWS_PHONE'</li>
 *  <li>osVersion: versione del sistema operativo del device</li>
 *  <li>brand: marca del device</li>
 *  <li>model: modello del device</li>
 *  <li>localization: lingua attiva nel device</li>
 *  <li>clientId: codice identificativo dell'app, generata nel back-office</li>
 * </ul>
 */
class MobileRegistration extends AbstractWebService
{

    public function exec()
    {
        parent::setWebService(__CLASS__);

        $mobileId = $this->getPost()->getValue("mobileId");
        $type = $this->getPost()->getValue("type");
        $osVersion = $this->getPost()->getValue("osVersion");
        $brand = $this->getPost()->getValue("brand");
        $model = $this->getPost()->getValue("model");
        $localization = $this->getPost()->getValue("localization");
        $clientId = $this->getPost()->getValue("clientId");

        MDbConnection::getDbConnection()->beginTransaction();

        try
        {
            DeviceAction::insert($mobileId, $type, $osVersion, $brand, $model, $localization, true);
            /* @var $device Device */ $device = DeviceBook::getDevices(null, null, null, null, null, $mobileId)->at(0);
            /* @var $application Application */ $application = ApplicationBook::getApplications(null, null, $clientId)->at(0);
            DeviceAction::update($device->getId, true);
            DeviceAction::setApplication($device->getId(), $application->getId());

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

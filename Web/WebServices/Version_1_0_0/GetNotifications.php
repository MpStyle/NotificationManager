<?php

namespace Web\WebServices\Version_1_0_0;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\Device;
use BusinessLogic\Device\DeviceBook;
use MToolkit\Model\Sql\MDbConnection;

class GetNotifications extends AbstractWebService
{

    public function exec()
    {
        parent::setWebService(__CLASS__);

        $mobileId = $this->getPost()->getValue("mobileId");
        $clientId = $this->getPost()->getValue("clientId");

        try
        {
            /* @var $device Device */ $device = DeviceBook::getDevices(null, null, null, null, null, $mobileId)->at(0);
            /* @var $application Application */ $application = ApplicationBook::getApplications(null, null, $clientId)->at(0);
            /* @var notifications MList */ $notifications = DeviceBook::getNotification($device->getId(), $application->getId());

            parent::setResponse("Notifications", parent::objectToArray($notifications->__toArray()));
        }
        catch (OutOfBoundException $ex)
        {
            MDbConnection::getDbConnection()->rollBack();

            parent::setResult(false);
            parent::setResultDescription("Device or application not found.");
        }
    }

}

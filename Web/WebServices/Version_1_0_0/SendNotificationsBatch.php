<?php

namespace Web\WebServices\Version_1_0_0;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\Device;
use BusinessLogic\Device\DeviceBook;
use MToolkit\Model\Sql\MDbConnection;

class SendNotificationsBatch extends AbstractWebService
{

    public function exec()
    {
        parent::setWebService(__CLASS__);
		
		$username = $this->getPost()->getValue("username");
        $password = $this->getPost()->getValue("password");
		$maxNotificationToSend = $this->getPost()->getValue("maxNotificationToSend");

        // Seleziona le notifiche: 
		// - Che sono state approvate
		// - Che non sono state inviate
		// - Che hanno una data valida
		
		// SET @position := 0;
		//
		// CREATE TEMPORARY TABLE IF NOT EXISTS NotificationsToSend AS (
		// 		SELECT NotificationId, DeviceId
		// 		FROM (
		// 			SELECT (@position := @position + 1) AS Position
		//				, Notifications.Id AS NotificationId
		// 				, Devices.Id AS DeviceId
		// 			FROM Notifications
		// 				INNER JOIN Devices_Notifications ON Notifications.Id = Devices_Notifications.NotificationId
		// 				INNER JOIN Devices ON Devices.Id = Devices_Notifications.DeviceId
		// 			WHERE Notifications.StatusId = 1 -- PUBLISHED
		// 				AND Notifications.StartDateValidation >= ? -- NOW()
		// 				AND Notifications.EndDateValidation <= ? -- NOW()
		// 				AND Devices_Notifications.DeliveryStatusId = 1 -- NOT_SEND
		// 				AND Devices_Notifications.AttemptsToSend < ? -- Nella configuration ATTEMPTS_TO_SEND = 3
		// 		) AS PositionResult
		// 		WHERE PositionResult.Position >= 0 AND PositionResult.Position <= ? -- $maxNotificationToSend
		// );
		//
		// UPDATE FROM NotificationsToSend
		// 		INNER JOIN Devices_Notifications ON NotificationsToSend.NotificationId = Devices_Notifications.NotificationId 
		// 			AND NotificationsToSend.DeviceId = Devices_Notifications.DeviceId
		// SET Devices_Notifications.DeliveryStatusId = 2; -- SENDING
		// 
		// SELECT NotificationId, AS DeviceId FROM NotificationsToSend;
		
		// foreach( $notifications as /* @var $notification Notification */ $notification )
		// {
		// 		switch( DeviceType )
		// 		{
		// 			case DeviceType:ANDROID:
		//			case DeviceType:IOS:
		//				NotificationBook::sendNotificationUsingGCM($notificationId, $deviceId);
		//			break;
		//			case DeviceType:WINDOWS_PHONE:
		//				NotificationBook::sendNotificationUsingMPNS($notificationId, $deviceId);
		//			break;
		// 		}
		// }
		
		// Dovrà essere aggiornato lo stato di delivery a SENT nel caso in cui la notifica sia stata inviata
		// Altrimenti aumentare di uno il tentativo di invio (introdurre la gestione in Devices_Notifications).
    }

}

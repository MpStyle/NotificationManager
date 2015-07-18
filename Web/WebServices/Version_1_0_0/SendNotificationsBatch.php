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

use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;

class SendNotificationsBatch extends AbstractWebService
{

    public function exec()
    {
        parent::setWebServiceName( __CLASS__ );

        $username = $this->getPost()->getValue( "username" );
        $password = $this->getPost()->getValue( "password" );

        if( $username != ConfigurationBook::getValue( Configuration::SCRIPT_USERNAME ) || $password != ConfigurationBook::getValue( Configuration::SCRIPT_PASSWORD ) )
        {
            parent::setResult( false );
            parent::setResultDescription( "Invalid mandatory parameters (0)." );
            return;
        }
        
        set_time_limit( 0 );

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
        // 				AND Devices.Enabled = 1
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

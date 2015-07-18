<?php

namespace BusinessLogic\Notification;

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

use BusinessLogic\Notification\Notification;
use DbAbstraction\Notification\NotificationAction;
use MToolkit\Core\MDataType;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MPDOResult;

class NotificationBook
{
    /**
     * @param int $id
     * @param int $applicationId
     * @param string $status
     * @param int $perPage
     * @param int $page
     * @return MList
     */
    public static function getNotifications( $id = null, $applicationId=null, $status=null, $deviceType=null, $perPage=10, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        /* @var $notificationList MPDOResult */ $notificationList = NotificationAction::get( $id, $applicationId, $status, $deviceType, $perPage, $page );
        /* @var $notifications MList */ $notifications = new MList();

        if( $notificationList != null )
        {
            foreach( $notificationList as $currentNotification )
            {
                
                $notification = new Notification();

                foreach( $currentNotification as $key => $value )
                {                    
                    $codeKey = lcfirst( $key );
                    
                    $notification->$codeKey = $value;
                }

                $notifications->append( $notification );
            }
        }

        return $notifications;
    }

	/**
	public static function sendNotificationUsingGCM($notificationId, $deviceId)
	{
		
	}
	
	public static function sendNotificationUsingMPNS($notificationId, $deviceId)
	{
		
	}
	*/
}

<?php

namespace BusinessLogic\Notification;

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
    public static function getNotifications( $id = null, $applicationId=null, $status=null, $perPage=10, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        /* @var $notificationList MPDOResult */ $notificationList = NotificationAction::get( $id, $applicationId, $status, $perPage, $page );
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

}

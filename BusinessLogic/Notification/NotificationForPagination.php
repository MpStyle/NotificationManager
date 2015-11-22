<?php
namespace BusinessLogic\Notification;

use BusinessLogic\Pagination\AbstractObjectPagination;

class NotificationForPagination extends AbstractObjectPagination
{
    public function getNotificationList(){
        return parent::getList();
    }
}

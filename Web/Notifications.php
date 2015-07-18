<?php

namespace Web;

require_once '../Settings.php';

use BusinessLogic\Notification\NotificationBook;
use DbAbstraction\Notification\NotificationAction;
use MToolkit\Model\Sql\MPDOResult;
use Web\MasterPages\LoggedMasterPage;

class Notifications extends BasePage
{
    private $notifications = null;
    private $notificationCount=0;
    private $pages = 1;

    public function __construct()
    {
        parent::__construct( __DIR__ . '/Notifications.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );

        $this->addJavascript( "Javascripts/Notifications.js" );
        $this->addCss( "Styles/Notifications.css" );

        $notificationId = null;
        $applicationId = $this->getApplicationId();
        $status = $this->getPost()->getValue( "status" ) == "" ? null : $this->getPost()->getValue( "status" );
        $deviceType = $this->getPost()->getValue( "type" ) == "" ? null : $this->getPost()->getValue( "type" );
        $perPage = 10;
        $currentPage = $this->getCurrentPage();

        /* @var $result MPDOResult */ $result = NotificationAction::getPageCount( $notificationId, $applicationId, $status, $deviceType, $perPage );
        $this->pages = $result->getData( 0, 'PageCount' );
        
        $result = NotificationAction::getCount($notificationId, $applicationId, $status, $deviceType);
        $this->notificationCount = $result->getData( 0, 'NotificationCount' );

        $this->notifications = NotificationBook::getNotifications( $notificationId, $applicationId, $status, $deviceType, $perPage, $currentPage );
    }

    protected function deleteNotification()
    {
        if( NotificationAction::delete( (int) $this->getPost()->getValue( "NotificationId" ) ) == null )
        {
            $this->getHttpResponse()->redirect( "Notifications.php?error=01&applicationId=" . $this->getApplicationId() . "&page=" . $this->getPages() );
        }
        else
        {
            $this->getHttpResponse()->redirect( "Notifications.php?error=02&applicationId=" . $this->getApplicationId() . "&page=" . $this->getPages() );
        }
    }

    protected function createNewNotification()
    {
        $this->getHttpResponse()->redirect( "EditNotification.php" );
    }

    public function getCurrentPage()
    {
        return $this->getGet()->getValue( "page" ) == null ? 0 : (int) $this->getGet()->getValue( "page" );
    }

    public function getApplicationId()
    {
        return $this->getPost()->getValue( "applicationId" ) == null ? null : (int) $this->getPost()->getValue( "applicationId" );
    }

    public function getNotifications()
    {
        return $this->notifications;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function getNotificationCount()
    {
        return $this->notificationCount;
    }
}

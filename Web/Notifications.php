<?php

namespace Web;

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

require_once '../Settings.php';

use BusinessLogic\Notification\NotificationBook;
use BusinessLogic\Notification\NotificationStatus;
use DbAbstraction\Notification\NotificationAction;
use MToolkit\Model\Sql\MPDOResult;
use Web\MasterPages\LoggedMasterPage;
use Web\Views\Pagination;

class Notifications extends BasePage
{
    private $notifications = null;
    private $notificationCount = 0;
    private $pages = 1;
    private $pagination = null;

    public function __construct()
    {
        parent::__construct( __DIR__ . '/Notifications.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );
        $this->addMasterPagePart( 'top-toolbar', 'top-toolbar' );
        $this->addMasterPagePart( 'page-title', 'page-title' );

        $this->addJavascript( "Javascripts/Notifications.js" );
        $this->addCss( "Styles/Notifications.css" );

        $notificationId = null;
        $applicationId = $this->getApplicationId();
        $status = $this->getGet()->getValue( "status" ) == "" ? null : (int) $this->getGet()->getValue( "status" );
        $deviceType = $this->getGet()->getValue( "type" ) == "" ? null : $this->getGet()->getValue( "type" );
        $perPage = 10;
        $currentPage = $this->getCurrentPage();

        /* @var $result MPDOResult */ $result = NotificationAction::getPageCount( $notificationId, $applicationId, $status, $deviceType, $perPage );
        $this->pages = $result->getData( 0, 'PageCount' );

        $this->pagination = new Pagination( $this->pages, $this );

        $result = NotificationAction::getCount( $notificationId, $applicationId, $status, $deviceType );
        $this->notificationCount = $result->getData( 0, 'NotificationCount' );

        $this->notifications = NotificationBook::getNotifications( $notificationId, $applicationId, $status, $deviceType, $perPage, $currentPage );
    }

    protected function deleteNotification()
    {
        if( NotificationAction::delete( (int) $this->getPost()->getValue( "modal-notification-id" ) ) == null )
        {
            $this->getHttpResponse()->redirect( "Notifications.php?error=01&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
        }
        else
        {
            $this->getHttpResponse()->redirect( "Notifications.php?error=02&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
        }
    }

    public function getCurrentPage()
    {
        return $this->getGet()->getValue( "page" ) == null ? 0 : (int) $this->getGet()->getValue( "page" );
    }

    public function getApplicationId()
    {
        return $this->getGet()->getValue( "applicationId" ) == null ? null : (int) $this->getGet()->getValue( "applicationId" );
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

    public function getRowClass( $notificationId )
    {
        if( $this->getCurrentNotification( $notificationId )->getStatusId() == NotificationStatus::DRAFT )
        {
            return 'warning';
        }

        if( $this->getCurrentNotification( $notificationId )->getStatusId() == NotificationStatus::CLOSED )
        {
            return 'success';
        }

        return '';
    }

    /**
     * Returns the pagination view.
     * 
     * @return Pagination
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    public function showFilters()
    {
        $get = $_GET;
        unset( $get["page"] );
        unset( $get["error"] );
        foreach( $get as $key => $value )
        {
            if( $value == "" || $value == "All" )
            {
                unset( $get[$key] );
            }
        }

        return (count( $get ) > 0);
    }

    public function normalizeNotificationMessage( $message )
    {
        $maxLength = 100;
        $toReturn = substr( utf8_encode( $message ), 0, $maxLength );

        if( strlen( $message ) > $maxLength )
        {
            $toReturn.='...';
        }

        return $toReturn;
    }

}

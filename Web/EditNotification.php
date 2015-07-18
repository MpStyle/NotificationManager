<?php

namespace Web;

require_once '../Settings.php';

use BusinessLogic\Application\ApplicationLinkType;
use BusinessLogic\Date\DateBook;
use BusinessLogic\Notification\DeliveryStatus;
use BusinessLogic\Notification\Notification;
use BusinessLogic\Notification\NotificationStatus;
use DbAbstraction\Device\DeviceAction;
use DbAbstraction\Notification\NotificationAction;
use MToolkit\Model\Sql\MDbConnection;
use Web\MasterPages\LoggedMasterPage;

class EditNotification extends BasePage
{

    public function __construct()
    {
        parent::__construct( __DIR__ . '/EditNotification.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );

        $this->addJavascript( "Javascripts/EditNotification.js" );
        $this->addJavascript( "../vendor/moment/moment/min/moment.min.js" );
        $this->addJavascript( "../vendor/twbs/bootstrap/js/transition.js" );
        $this->addJavascript( "../vendor/twbs/bootstrap/js/collapse.js" );
        $this->addJavascript( "../vendor/eonasdan/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" );

        $this->addCss( "Styles/EditNotification.css" );
        $this->addCss( "../vendor/eonasdan/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" );
    }

    protected function saveDraft()
    {
        $this->confirmEdit( true );
    }

    protected function confirmEdit( $isDraft = false )
    {
        /* @var \MToolkit\Model\Sql\MPDOResult $result */

        $startDateForm = $this->getPost()->getValue( "start_date" );
        $endDateForm = $this->getPost()->getValue( "end_date" );

        $notificationId = (int) $this->getCurrentNotification()->getId();
        $startDate = ($startDateForm == null ? null : DateBook::fromDatePickerDateToDatabaseDate( $startDateForm ));
        $endDate = ($endDateForm == null ? null : DateBook::fromDatePickerDateToDatabaseDate( $endDateForm ));

        MDbConnection::getDbConnection()->beginTransaction();

        $localization = $this->getPost()->getValue( "localization_id" ) == "" ? null : (int) $this->getPost()->getValue( "localization_id" );

        // Sarà inserita una nuova notifica se non è stato passato un id o se la notifica è già stata inviata (per mantenere uno storico delle notifiche inviate).
        if( $this->getGet()->getValue( "id" ) == null || $this->getCurrentNotification()->getDeliveryStatusId() == DeliveryStatus::SENT )
        {
            // Create Notification
            $result = NotificationAction::insert(
                            $this->getPost()->getValue( "notification_title" )
                            , $this->getPost()->getValue( "notification_short_message" )
                            , $this->getPost()->getValue( "notification_message" )
                            , (int) ($isDraft ? NotificationStatus::DRAFT : NotificationStatus::APPROVED )
                            , $this->getPost()->getValue( "device_type" )
                            , $startDate
                            , $endDate
                            , (int) $this->getPost()->getValue( "application_id" )
                            , $this->getPost()->getValue( "link_type" ) == "" ? null : $this->getPost()->getValue( "link_type" )
                            , $this->getPost()->getValue( "link_type" ) == ApplicationLinkType::EXTERNAL ? $this->getPost()->getValue( "extenal_link" ) : null
                            , $this->getPost()->getValue( "link_type" ) == ApplicationLinkType::INTERNAL ? (int) $this->getPost()->getValue( "internal_link" ) : null
                            , null
                            , $localization
            );

            $notificationId = $result->getData( 0, "NotificationId" );
        }
        else
        {
            // Edit Notification
            $result = NotificationAction::update(
                            (int) $this->getCurrentNotification()->getId()
                            , $this->getPost()->getValue( "notification_title" )
                            , $this->getPost()->getValue( "notification_short_message" )
                            , $this->getPost()->getValue( "notification_message" )
                            , (int) ($isDraft ? NotificationStatus::DRAFT : NotificationStatus::APPROVED )
                            , $this->getPost()->getValue( "device_type" )
                            , $startDate
                            , $endDate
                            , (int) $this->getPost()->getValue( "application_id" )
                            , $this->getPost()->getValue( "link_type" ) == "" ? null : $this->getPost()->getValue( "link_type" )
                            , $this->getPost()->getValue( "link_type" ) == ApplicationLinkType::EXTERNAL ? $this->getPost()->getValue( "extenal_link" ) : null
                            , $this->getPost()->getValue( "link_type" ) == ApplicationLinkType::INTERNAL ? (int) $this->getPost()->getValue( "internal_link" ) : null
                            , null
                            , $localization
            );
        }

        if( !$isDraft )
        {
            // Remove all recipients of the current notification     
            DeviceAction::deleteNotification( (int) $notificationId );
            $deviceType = $this->getPost()->getValue( "device_type" ) == "" ? null : $this->getPost()->getValue( "device_type" );

            // Set the notification recipients
            DeviceAction::setNotification( (int) $notificationId, $localization, $deviceType );
        }

        if( $result != null )
        {
            // ok
            MDbConnection::getDbConnection()->commit();
            $this->getHttpResponse()->redirect( "Notifications.php?error=0" );
        }
        else
        {
            // ko
            MDbConnection::getDbConnection()->rollBack();
            $this->getHttpResponse()->redirect( "?error=1&id=" . $this->getGet()->getValue( "id" ) );
        }
    }

    /**
     * @return Notification
     */
    public function getCurrentNotification( $id = null )
    {
        return parent::getCurrentNotification( (int) $this->getGet()->getValue( "id" ) );
    }

}

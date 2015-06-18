<?php

namespace Web;

require_once '../Settings.php';

use BusinessLogic\Date\DateBook;
use BusinessLogic\Link\LinkType;
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
        parent::__construct(__DIR__ . '/EditNotification.view.php');

        parent::setMasterPage(new LoggedMasterPage($this));
        $this->addMasterPagePart('content', 'content');

        $this->addJavascript("Javascripts/EditNotification.js");
        $this->addJavascript("../vendor/moment/moment/min/moment.min.js");
        $this->addJavascript("../vendor/twbs/bootstrap/js/transition.js");
        $this->addJavascript("../vendor/twbs/bootstrap/js/collapse.js");
        $this->addJavascript("../vendor/eonasdan/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js");

        $this->addCss("Styles/EditNotification.css");
        $this->addCss("../vendor/eonasdan/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css");
    }

    protected function saveDraft()
    {
        $this->confirmEdit(true);
    }

    protected function confirmEdit($isDraft = false)
    {
        /* @var \MToolkit\Model\Sql\MPDOResult $result */

        $notificationId=(int) $this->getCurrentNotification()->getId();
        $startDate = DateBook::fromDatePickerDateToDatabaseDate($this->getPost()->getValue("start_date"));
        $endDate = DateBook::fromDatePickerDateToDatabaseDate($this->getPost()->getValue("end_date"));

        MDbConnection::getDbConnection()->startTransaction();
        
        // Sarà inserita una nuova notifica se non è stato passato un id o se la notifica è già stata inviata (per mantenere uno storico delle notifiche inviate).
        if ($this->getGet()->getValue("id") == null || $this->getCurrentNotification()->getDeliveryStatusId() == DeliveryStatus::SENT)
        {
            // Create Notification
            $result = NotificationAction::insert(
                            $this->getPost()->getValue("notification_title")
                            , $this->getPost()->getValue("notification_short_message")
                            , $this->getPost()->getValue("notification_message")
                            , ($isDraft ? NotificationStatus::DRAFT : NotificationStatus::APPROVED)
                            , $this->getPost()->getValue("device_type")
                            , $startDate
                            , $endDate
                            , (int) $this->getPost()->getValue("application_id")
                            , $this->getPost()->getValue("link_type")
                            , $this->getPost()->getValue("link_type") == LinkType::INTERNAL ? $this->getPost()->getValue("internal_link") : $this->getPost()->getValue("extenal_link")
                            , null
            );
            
            $notificationId=$result->getData(0, "NotificationId");
        }
        else
        {
            // Edit Notification
            $result = NotificationAction::update(
                            (int) $this->getCurrentNotification()->getId()
                            , $this->getPost()->getValue("notification_title")
                            , $this->getPost()->getValue("notification_short_message")
                            , $this->getPost()->getValue("notification_message")
                            , ($isDraft ? NotificationStatus::DRAFT : NotificationStatus::APPROVED)
                            , $this->getPost()->getValue("device_type")
                            , $startDate
                            , $endDate
                            , (int) $this->getPost()->getValue("application_id")
                            , $this->getPost()->getValue("link_type")
                            , $this->getPost()->getValue("link_type") == LinkType::INTERNAL ? $this->getPost()->getValue("internal_link") : $this->getPost()->getValue("extenal_link")
                            , null
            );
        }

        if (!$isDraft)
        {
            // Remove all recipients of the current notification     
            DeviceAction::deleteNotification($notificationId);
            
            // Set the notification recipients
            DeviceAction::setNotification($notificationId);
        }
        
        MDbConnection::getDbConnection()->commit();

        if ($result != null)
        {
            // ok
            $this->getHttpResponse()->redirect("Notifications.php?error=0");
        }
        else
        {
            // ko
            $this->getHttpResponse()->redirect("?error=1&id=" . $this->getGet()->getValue("id"));
        }
    }

    /**
     * @return Notification
     */
    public function getCurrentNotification($id = null)
    {
        return parent::getCurrentNotification((int) $this->getGet()->getValue("id"));
    }

}

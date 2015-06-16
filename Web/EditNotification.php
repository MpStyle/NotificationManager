<?php

namespace Web;

require_once '../Settings.php';

use BusinessLogic\Link\LinkType;
use BusinessLogic\Notification\Notification;
use DateTime;
use DbAbstraction\Notification\NotificationAction;
use Web\MasterPages\LoggedMasterPage;
use BusinessLogic\Date\DateBook;

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

    protected function confirmEdit()
    {
        /* @var \MToolkit\Model\Sql\MPDOResult $result */

        $startDate = DateBook::fromDatePickerDateToDatabaseDate( $this->getPost()->getValue( "start_date" ) );
        $endDate = DateBook::fromDatePickerDateToDatabaseDate( $this->getPost()->getValue( "end_date" ) );

        if( $this->getGet()->getValue( "id" ) == null )
        {
            // Create app
            $result = NotificationAction::insert(
                            $this->getPost()->getValue( "notification_title" )
                            , $this->getPost()->getValue( "notification_short_message" )
                            , $this->getPost()->getValue( "notification_message" )
                            , $this->getPost()->getValue( "notification_status" )
                            , $this->getPost()->getValue( "device_type" )
                            , $startDate
                            , $endDate
                            , (int) $this->getPost()->getValue( "application_id" )
                            , $this->getPost()->getValue( "link_type" )
                            , $this->getPost()->getValue( "link_type" ) == LinkType::INTERNAL ? $this->getPost()->getValue( "internal_link" ) : $this->getPost()->getValue( "extenal_link" )
                            , null
            );
        }
        else
        {
            // Edit app
            $result = NotificationAction::update(
                            (int) $this->getCurrentNotification()->getId()
                            , $this->getPost()->getValue( "notification_title" )
                            , $this->getPost()->getValue( "notification_short_message" )
                            , $this->getPost()->getValue( "notification_message" )
                            , $this->getPost()->getValue( "notification_status" )
                            , $this->getPost()->getValue( "device_type" )
                            , $startDate
                            , $endDate
                            , (int) $this->getPost()->getValue( "application_id" )
                            , $this->getPost()->getValue( "link_type" )
                            , $this->getPost()->getValue( "link_type" ) == LinkType::INTERNAL ? $this->getPost()->getValue( "internal_link" ) : $this->getPost()->getValue( "extenal_link" )
                            , null
            );
        }

        if( $result != null )
        {
            // ok
            $this->getHttpResponse()->redirect( "Notifications.php?error=0" );
        }
        else
        {
            // ko
            $this->getHttpResponse()->redirect( "?error=1&id=" . $this->getGet()->getValue( "id" ) );
        }
    }

    /**
     * @return Notification
     */
    public function getCurrentNotification( $id = null )
    {
//        var_dump(parent::getCurrentNotification( (int) $this->getGet()->getValue( "id" ) ));
        return parent::getCurrentNotification( (int) $this->getGet()->getValue( "id" ) );
    }

}

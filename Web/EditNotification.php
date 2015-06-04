<?php

namespace Web;

require_once '../Settings.php';

use BusinessLogic\Notification\Notification;
use DbAbstraction\Notification\NotificationAction;
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

    protected function confirmEdit()
    {
        /* @var \MToolkit\Model\Sql\MPDOResult $result */

        if( $this->getGet()->getValue( "id" ) == null )
        {
            // Create app
            $result = NotificationAction::insert(
                            $this->getPost()->getValue( "notification_title" )
                            , $this->getPost()->getValue( "notification_message" )
                            , $this->getPost()->getValue( "notification_status" )
                            , $this->getPost()->getValue( "device_type" )
                            , $this->getPost()->getValue( "start_date" )
                            , $this->getPost()->getValue( "end_date" )
            );
        }
        else
        {
            // Edit app
            $result = NotificationAction::update(
                            (int)$this->getCurrentApp()->getId()
                            , $this->getPost()->getValue( "notification_title" )
                            , $this->getPost()->getValue( "notification_message" )
                            , $this->getPost()->getValue( "notification_status" )
                            , $this->getPost()->getValue( "device_type" )
                            , $this->getPost()->getValue( "start_date" )
                            , $this->getPost()->getValue( "end_date" )
            );
        }

        if( $result != null && $result->getNumRowsAffected() > 0 )
        {
            // ok
            $this->getHttpResponse()->redirect( "Notifications.php?error=0" );
        }
        else
        {
            // ko
            $this->getHttpResponse()->redirect( "?error=1" );
        }
    }

    /**
     * @return Notification
     */
    public function getCurrentNotification( $id = null )
    {
        return parent::getCurrentNotification( (int)$this->getGet()->getValue( "id" ) );
    }
}

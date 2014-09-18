<?php

namespace Modules\WindowsMobile;

use BusinessLogic\Engine\AbstractEngine;
use Modules\WindowsMobile\Notification;

/**
 * Può mandare notifiche fino a 1000 destinatari al colpo.
 */
class Engine extends AbstractEngine
{

    /**
     * @param \MToolkit\Core\MObject $parent
     */
    public function __construct( \MToolkit\Core\MObject $parent = null )
    {
        parent::__construct( $parent );
    }

    public function send()
    {
        $toastMessage = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
                "<wp:Notification xmlns:wp=\"WPNotification\">" .
                "<wp:Toast>" .
                "<wp:Text1>" . $this->getNotification()->getTitle() . "</wp:Text1>" .
                "<wp:Text2>" . $this->getNotification()->getSubTitle() . "</wp:Text2>" .
                "<wp:Text2>" . $this->getNotification()->getMessage() . "</wp:Text2>" .
                "</wp:Toast> " .
                "</wp:Notification>";

        foreach( $this->getReceivers() as $receiver )
        {
            // Create request to send
            $r = curl_init();
            curl_setopt( $r, CURLOPT_URL, $receiver );
            curl_setopt( $r, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $r, CURLOPT_POST, true );
            curl_setopt( $r, CURLOPT_HEADER, true );

            // add headers
            $httpHeaders = array('Content-type: text/xml; charset=utf-8', 'X-WindowsPhone-Target: toast',
                'Accept: application/*', 'X-NotificationClass: 2', 'Content-Length:' . strlen( $toastMessage ));
            curl_setopt( $r, CURLOPT_HTTPHEADER, $httpHeaders );

            // add message
            curl_setopt( $r, CURLOPT_POSTFIELDS, $toastMessage );

            // execute request
            $output = curl_exec( $r );
            curl_close( $r );
        }
    }

    /**
     * @return Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param Notification $notification
     * @return \BusinessLogic\Sender\WindowsMobile\Sender
     */
    public function setNotification( Notification $notification )
    {
        $this->notification = $notification;

        return $this;
    }

    public static function getEngineName()
    {
        return 'windowsmobile';
    }

}

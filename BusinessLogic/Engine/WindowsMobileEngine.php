<?php

namespace BusinessLogic\Module\WindowsMobile;

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


use BusinessLogic\Engine\AbstractEngine;
use BusinessLogic\Module\WindowsMobile\Notification;

class WindowsMobileEngine extends AbstractEngine
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
            $httpHeaders = array(
                'Content-type: text/xml; charset=utf-8'
                , 'X-WindowsPhone-Target: toast'
                , 'Accept: application/*'
                , 'X-NotificationClass: 2'
                , 'Content-Length:' . strlen( $toastMessage )
            );
            curl_setopt( $r, CURLOPT_HTTPHEADER, $httpHeaders );

            // add message
            curl_setopt( $r, CURLOPT_POSTFIELDS, $toastMessage );

            // execute request
            $result = curl_exec( $r );
            curl_close( $r );
            
            $this->setResponse( $result );
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

    /**
     * Returns the name of the module.
     * 
     * @return string
     */
    public static function getEngineName()
    {
        return 'windowsmobile';
    }

}

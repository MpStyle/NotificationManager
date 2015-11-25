<?php

namespace BusinessLogic\Engine\GCM;

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
use BusinessLogic\Engine\ResponseEngine;
use BusinessLogic\Notification\Notification;
use MToolkit\Core\MDataType;
use MToolkit\Core\MObject;

/**
 * The max number of receivers for the Google Cloud Message is 1000.
 */
class GCMEngine extends AbstractEngine
{
    const GOOGLE_NOTIFICATION_WEB_SERVICE = "https://android.googleapis.com/gcm/send";
    const MAX_RECEIVERS = 1000;

    /**
     * @var string
     */
    private $accessKey = null;

    /**
     * @param string $accessKey
     * @param MObject $parent
     */
    public function __construct( $accessKey, MObject $parent = null )
    {
        MDataType::mustBeString( $accessKey );

        parent::__construct( $parent );

        $this->accessKey = $accessKey;
    }

    private function getMessage()
    {
        return array(
            'id' => $this->getNotification()->getId(),
            'message' => $this->getNotification()->getMessage(),
            'title' => $this->getNotification()->getTitle(),
            'subtitle' => $this->getNotification()->getShortMessage()
        );
    }

    private function getHeaders()
    {
        return array(
            'Authorization: key=' . $this->accessKey,
            'Content-Type: application/json'
        );
    }

    /**
     * Sends the notification.
     */
    public function send()
    {
        $countReceivers = $this->getReceivers()->count();

        if( $countReceivers <= 0 )
        {
            parent::setResponse( new ResponseEngine() );
            return;
        }

        $msg = $this->getMessage();
        $headers = $this->getHeaders();

        // Send the notification to the device in self::MAX_RECEIVERS at a time
        for( $index = 0; $index <= floor( $countReceivers / self::MAX_RECEIVERS ); $index++ )
        {
            $this->sendNotification( $msg, $headers );
        }
    }

    private function sendNotification( $msg, $headers )
    {
        $receivers = $this->getReceivers();
        $fields = array(
            'registration_ids' => $receivers->__toArray(),
            'data' => $msg
        );

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, self::GOOGLE_NOTIFICATION_WEB_SERVICE );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec( $ch );
        curl_close( $ch );

        $json = json_decode( $result, true );

        $response = new ResponseEngine();
        $response->setNotificationCount( parent::getReceivers() )
                ->setNotificationNotSentCount( $json['failure'] )
                ->setNotificationSentCount( $json['success'] )
                ->setRemoteId( $json['multicast_id'] );

        $this->setResponse( $response );
    }

    /**
     * Returns the notification to send.
     * 
     * @return Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * Sets the notification to send.
     * 
     * @param Notification $notification
     * @return \BusinessLogic\Sender\Android\Sender
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
        return 'android';
    }

}

<?php

namespace BusinessLogic\Module\Android;

use BusinessLogic\Engine\AbstractEngine;
use BusinessLogic\Module\Android\Notification;
use MToolkit\Core\MDataType;

/**
 * Può mandare notifiche fino a 1000 destinatari al colpo.
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
     * @param \MToolkit\Core\MObject $parent
     */
    public function __construct( $accessKey, \MToolkit\Core\MObject $parent = null )
    {
        MDataType::mustBeString( $accessKey );

        parent::__construct( $parent );

        $this->accessKey = $accessKey;
    }

    public function send()
    {
        $countReceivers = $this->getReceivers()->count();

        $msg = array(
            'message' => $this->getNotification()->getMessage(),
            'title' => $this->getNotification()->getTitle(),
            'subtitle' => $this->getNotification()->getSubTitle()
        );

        $headers = array(
            'Authorization: key=' . $this->accessKey,
            'Content-Type: application/json'
        );

        // Send the notification to the device in self::MAX_RECEIVERS at a time
        for( $index = 0; $index < floor( $countReceivers / self::MAX_RECEIVERS ); $index++ )
        {
            $endPosition = (($index + 1) * self::MAX_RECEIVERS) - 1;
            if( $endPosition >= $countReceivers )
            {
                $endPosition = $countReceivers - 1;
            }

            $receivers = $this->getReceivers()->slice( $index * self::MAX_RECEIVERS, $endPosition );

            $fields = array
                (
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

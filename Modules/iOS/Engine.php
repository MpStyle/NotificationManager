<?php

namespace Modules\iOS;

use BusinessLogic\Engine\AbstractEngine;
use Modules\iOS\Notification;
use MToolkit\Core\MDataType;

/**
 * Può mandare notifiche fino a 1000 destinatari al colpo.
 */
class Engine extends AbstractEngine
{
    const APNS_PORT = 2195;

    /**
     * @var string
     */
    private $apnsUrl;

    /**
     * @var string
     */
    private $apnsCertPath;

    /**
     * @param string $apnsUrl
     * @param string $apnsCertPath
     * @param \MToolkit\Core\MObject $parent
     */
    public function __construct( $apnsUrl, $apnsCertPath, \MToolkit\Core\MObject $parent = null )
    {
        MDataType::mustBeString( $apnsUrl );
        MDataType::mustBeString( $apnsCertPath );

        parent::__construct( $parent );

        $this->apnsUrl = $apnsUrl;
        $this->apnsCertPath = $apnsCertPath;
    }

    public function send()
    {
        $message = $this->getNotification()->getMessage();
        $badge = $this->getNotification()->getBadge();
        $sound = $this->getNotification()->getSound();

        $payload = array();
        $payload['aps'] = array('alert' => $message, 'badge' => intval( $badge ), 'sound' => $sound);
        $payload = json_encode( $payload );

        $stream_context = stream_context_create();
        stream_context_set_option( $stream_context, 'ssl', 'local_cert', $this->apnsCertPath );

        $apns = stream_socket_client( 'ssl://' . $this->apnsUrl . ':' . Sender::APNS_PORT, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $stream_context );

        // You will need to put your device tokens into the $device_tokens array yourself
        $deviceTokens = parent::getReceivers();

        foreach( $deviceTokens as $deviceToken )
        {
            $apnsMessage = chr( 0 ) . chr( 0 ) . chr( 32 ) . pack( 'H*', str_replace( ' ', '', $deviceToken ) ) . chr( 0 ) . chr( strlen( $payload ) ) . $payload;
            fwrite( $apns, $apnsMessage );
        }

        @socket_close( $apns );
        @fclose( $apns );
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
     * @return \BusinessLogic\Sender\iOS\Sender
     */
    public function setNotification( Notification $notification )
    {
        $this->notification = $notification;

        return $this;
    }

    public static function getEngineName()
    {
        return 'ios';
    }

}

<?php

namespace Modules\iOS;

use BusinessLogic\Engine\AbstractNotification;
use MToolkit\Core\MDataType;

class Notification extends AbstractNotification
{
    /**
     * @var int
     */
    private $badge = null;

    /**
     * @var string
     */
    private $sound = null;

    public function __construct( $badge )
    {
        MDataType::mustBeNullableString( $badge );

        parent::__construct();
        $this->setBadge( $badge );
    }

    /**
     * @return int
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param int $badge
     * @return \BusinessLogic\Sender\iOS\Notification
     */
    public function setBadge( $badge )
    {
        MDataType::mustBeInt( $badge );

        $this->badge = $badge;
        return $this;
    }

    /**
     * @return string
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * @param string $sound
     * @return \BusinessLogic\Sender\iOS\Notification
     */
    public function setSound( $sound )
    {
        MDataType::mustBeNullableString( $sound );

        $this->sound = $sound;

        if( $this->sound == null )
        {
            $this->sound = 'default';
        }

        return $this;
    }

}

<?php

namespace BusinessLogic\Notification;

final class DeliveryStatus
{
    const NOT_SEND = 1;
    const SENDING = 2;
    const SENT = 3;

    protected $id;
    Protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId( $id )
    {
        $this->id = $id;
        return $this;
    }

    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

}

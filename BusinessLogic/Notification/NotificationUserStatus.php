<?php

namespace BusinessLogic\Notification;

final class NotificationUserStatus
{
    const UNREADED = 1;
    const READED = 2;
	const DELETED = 2;
    
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

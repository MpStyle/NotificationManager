<?php

namespace BusinessLogic\Notification;

class Notification
{
    /**
     * @var int
     */
    private $id = null;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $message = null;

    /**
     * @var string
     */
    private $creationDate = null;

    /**
     * Could be: draft, approved
     * @var string
     */
    private $status = null;
    private $applicationId = null;
    private $iconId;

    public function getId()
    {
        return $this->id;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setId( $id )
    {
        $this->id = $id;
        return $this;
    }

    public function setMessage( $message )
    {
        $this->message = $message;
        return $this;
    }

    public function setStatus( $status )
    {
        $this->status = $status;
        return $this;
    }

    public function getApplicationId()
    {
        return $this->applicationId;
    }

    public function setApplicationId( $applicationId )
    {
        $this->applicationId = $applicationId;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle( $title )
    {
        $this->title = $title;
        return $this;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate( $creationDate )
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function getIconId()
    {
        return $this->iconId;
    }

    public function setIconId( $iconId )
    {
        $this->iconId = $iconId;
        return $this;
    }

}

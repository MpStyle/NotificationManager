<?php

namespace BusinessLogic\Notification;

use MToolkit\Core\MObject;

class Notification extends MObject
{

    /**
     * @var int
     */
    protected $id = null;

    /**
     * @var string
     */
    protected $title;
    protected $shortMessage;

    /**
     * @var string
     */
    protected $message = null;

    /**
     * @var string
     */
    protected $creationDate = null;
    protected $updateDate = null;

    /**
     * Could be: DRAFT, APPROVED
     * @var string
     */
    protected $status = null;
    protected $statusId = null;
    protected $applicationId = null;
    protected $applicationName = null;
    protected $iconId = null;
    protected $deviceType = null;
    protected $startDateValidation = null;
    protected $endDateValidation = null;
    protected $linkType = null;
    protected $link;

    /**
     * Could be: UNREADED, READED, REMOVED
     * @var string
     */
    protected $userStatus = null;
    protected $userStatusId = null;
    
    protected $deliveryStatus=null;
    protected $deliveryStatusId=null;

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

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getApplicationId()
    {
        return $this->applicationId;
    }

    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function getIconId()
    {
        return $this->iconId;
    }

    public function setIconId($iconId)
    {
        $this->iconId = $iconId;
        return $this;
    }

    public function getApplicationName()
    {
        return $this->applicationName;
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
        return $this;
    }

    public function getDeviceType()
    {
        return $this->deviceType;
    }

    public function getStartDateValidation()
    {
        return $this->startDateValidation;
    }

    public function getEndDateValidation()
    {
        return $this->endDateValidation;
    }

    public function setDeviceType($deviceType)
    {
        $this->deviceType = $deviceType;
        return $this;
    }

    public function setStartDateValidation($startDateValidation)
    {
        $this->startDateValidation = $startDateValidation;
        return $this;
    }

    public function setEndDateValidation($endDateValidation)
    {
        $this->endDateValidation = $endDateValidation;
        return $this;
    }

    public function getShortMessage()
    {
        return $this->shortMessage;
    }

    public function setShortMessage($shortMessage)
    {
        $this->shortMessage = $shortMessage;
        return $this;
    }

    public function getLinkType()
    {
        return $this->linkType;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLinkType($linkType)
    {
        $this->linkType = $linkType;
        return $this;
    }

    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    public function getUserStatus()
    {
        return $this->userStatus;
    }

    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
        return $this;
    }
    
    public function getStatusId()
    {
        return $this->statusId;
    }

    public function getUserStatusId()
    {
        return $this->userStatusId;
    }

    public function getDeliveryStatus()
    {
        return $this->deliveryStatus;
    }

    public function getDeliveryStatusId()
    {
        return $this->deliveryStatusId;
    }

    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
        return $this;
    }

    public function setUserStatusId($userStatusId)
    {
        $this->userStatusId = $userStatusId;
        return $this;
    }

    public function setDeliveryStatus($deliveryStatus)
    {
        $this->deliveryStatus = $deliveryStatus;
        return $this;
    }

    public function setDeliveryStatusId($deliveryStatusId)
    {
        $this->deliveryStatusId = $deliveryStatusId;
        return $this;
    }



}

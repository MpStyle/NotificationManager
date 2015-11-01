<?php

namespace BusinessLogic\Engine;

use MToolkit\Core\MDataType;
use MToolkit\Core\MList;

class ResponseEngine
{
    private $notificationNotSentCount=0;
    private $notificationSentCount=0;
    private $notificationCount=0;
    private $receivers=null;
    private $notReachedReceivers=null;
    private $errorDescription;
    private $remoteId=-1;
    
    public function __construct()
    {
        $this->receivers=new MList();
        $this->notReachedReceivers=new MList();
        $this->errorDescription="";
    }
    
    /**
     * @return int
     */
    public function getNotificationNotSentCount()
    {
        return $this->notificationNotSentCount;
    }

    /**
     * @return int
     */
    public function getNotificationSentCount()
    {
        return $this->notificationSentCount;
    }

    /**
     * @return int
     */
    public function getNotificationCount()
    {
        return $this->notificationCount;
    }

    /**
     * @return MList
     */
    public function getReceivers()
    {
        return $this->receivers;
    }

    /**
     * @return MList
     */
    public function getNotReachedReceivers()
    {
        return $this->notReachedReceivers;
    }

    /**
     * @param int $notificationNotSentCount
     * @return \BusinessLogic\Engine\ResponseEngine
     */
    public function setNotificationNotSentCount( $notificationNotSentCount )
    {
        $this->notificationNotSentCount = $notificationNotSentCount;
        return $this;
    }

    public function setNotificationSentCount( $notificationSentCount )
    {
        $this->notificationSentCount = $notificationSentCount;
        return $this;
    }

    /**
     * @param int $notificationCount
     * @return \BusinessLogic\Engine\ResponseEngine
     */
    public function setNotificationCount( $notificationCount )
    {
        $this->notificationCount = $notificationCount;
        return $this;
    }

    /**
     * @param MList $receivers
     * @return \BusinessLogic\Engine\ResponseEngine
     */
    public function setReceivers( MList $receivers )
    {
        $this->receivers = $receivers;
        return $this;
    }

    /**
     * @param MList $notReachedReceivers
     * @return \BusinessLogic\Engine\ResponseEngine
     */
    public function setNotReachedReceivers( MList $notReachedReceivers )
    {
        $this->notReachedReceivers = $notReachedReceivers;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    /**
     * @param string $errorDescription
     * @return ResponseEngine
     */
    public function setErrorDescription( $errorDescription )
    {
        MDataType::mustBeNullableString($errorDescription);
        
        $this->errorDescription = $errorDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemoteId()
    {
        return $this->remoteId;
    }

    /**
     * @param string $remoteId
     * @return \BusinessLogic\Engine\ResponseEngine
     */
    public function setRemoteId( $remoteId )
    {
        // MDataType::mustBeNullableString($remoteId);
        
        $this->remoteId = $remoteId;
        return $this;
    }
}

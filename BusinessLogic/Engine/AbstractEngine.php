<?php
namespace BusinessLogic\Engine;

use MToolkit\Core\MList;
use MToolkit\Core\MObject;

abstract class AbstractEngine extends MObject
{
    /**
     * @var MList
     */
    private $receivers;
    
    /**
     * @var Notification
     */
    private $notification;
    
    public function __construct(MObject $parent = null)
    {
        parent::__construct($parent);
        $this->receivers=new MList();
    }
    
    public abstract function send();

    public function &getReceivers()
    {
        return $this->receivers;
    }

    /**
     * @return AbstractNotification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param \BusinessLogic\Sender\AbstractNotification $notification
     * @return \BusinessLogic\Sender\AbstractSender
     */
    public function setNotification(AbstractNotification $notification)
    {
        $this->notification = $notification;
        
        return $this;
    }
    
    public abstract static function getEngineName();
}

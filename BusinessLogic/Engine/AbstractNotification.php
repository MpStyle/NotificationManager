<?php
namespace BusinessLogic\Engine;

use MToolkit\Core\MDataType;

abstract class AbstractNotification
{    
    /**
     * @var string
     */
    private $message=null;
    
    /**
     * @var string
     */
    private $title=null;
    
    /**
     * @var string
     */
    private $subTitle=null;
    
    public function __construct()
    {
    }
        
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * @param string $message
     * @return \BusinessLogic\Sender\Notification
     */
    public function setMessage($message)
    {
        MDataType::mustBeNullableString($message);
        
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $title
     * @return \BusinessLogic\Sender\Notification
     */
    public function setTitle($title)
    {
        MDataType::mustBeNullableString($title);
        
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $subTitle
     * @return \BusinessLogic\Sender\Notification
     */
    public function setSubTitle($subTitle)
    {
        MDataType::mustBeNullableString($subTitle);
        
        $this->subTitle = $subTitle;
        return $this;
    }
}

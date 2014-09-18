<?php
namespace DbAbstraction\Notification;

class Notification
{
    /**
     * @var string
     */
    public $Title=null;
    
    /**
     * @var string
     */
    public $Subtitle=null;
    
    /**
     * @var string
     */
    public $Message=null;
    
    /**
     * @var string
     */
    public $Created=null;
    
    /**
     * Could be: draft, sent
     * @var string
     */
    public $Status=null;
}

<?php
namespace Web;

require_once '../Settings.php';

use Web\MasterPages\LoggedMasterPage;

class Notifications extends BasePage
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/Notifications.view.php');
        
        parent::setMasterPage(new LoggedMasterPage($this));
        $this->addMasterPagePart('content', 'content');
        
        $this->addJavascript("Javascripts/Notifications.js");
        $this->addCss("Styles/Notifications.css");
    }
}

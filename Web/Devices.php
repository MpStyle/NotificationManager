<?php
namespace Web;

require_once '../Settings.php';

use Web\MasterPages\LoggedMasterPage;

class Devices extends BasePage
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/Devices.view.php');
        
        parent::setMasterPage(new LoggedMasterPage($this));
        $this->addMasterPagePart('content', 'content');
        
        $this->addJavascript("Javascripts/Devices.js");
        $this->addCss("Styles/Devices.css");
    }
}

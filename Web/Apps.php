<?php
namespace Web;

require_once '../Settings.php';

use Web\MasterPages\LoggedMasterPage;

class Apps extends BasePage
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/Apps.view.php');
        
        parent::setMasterPage(new LoggedMasterPage($this));
        $this->addMasterPagePart('content', 'content');
        
        $this->addJavascript("Javascripts/Apps.js");
        $this->addCss("Styles/Apps.css");
    }
    
    protected function createNewApp()
    {
        $this->getHttpResponse()->redirect("EditApp.php");
    }
}

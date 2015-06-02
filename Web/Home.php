<?php
namespace Web;

require_once '../Settings.php';

use Web\MasterPages\LoggedMasterPage;

class Home extends BasePage
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/Home.view.php');
        
        parent::setMasterPage(new LoggedMasterPage($this));
        $this->addMasterPagePart('content', 'content');
        
        $this->addJavascript("Javascripts/Home.js");
        $this->addCss("Styles/Home.css");
        
        $this->getHttpResponse()->redirect("Apps.php");
    }
}

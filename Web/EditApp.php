<?php
namespace Web;

require_once '../Settings.php';

use Web\MasterPages\LoggedMasterPage;

class EditApp extends BasePage
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/EditApp.view.php');
        
        parent::setMasterPage(new LoggedMasterPage($this));
        $this->addMasterPagePart('content', 'content');
        
        $this->addJavascript("Javascripts/EditApp.js");
        $this->addCss("Styles/EditApp.css");
    }
    
    protected function confirmEdit()
    {
        // @TODO:
    }
}

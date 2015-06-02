<?php
namespace Web;

require_once '../Settings.php';

Use Web\MasterPages\PublicMasterPage;

class Login extends BasePage
{
    public function __construct()
    {
        parent::__construct( __DIR__.'/Login.view.php' );
        
        parent::setMasterPage(new PublicMasterPage($this));
        $this->addMasterPagePart('content', 'content');
        
        $this->addJavascript("Javascripts/Login.js");
        $this->addCss("Styles/Login.css");
    }
}

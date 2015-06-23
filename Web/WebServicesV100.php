<?php

namespace Web;

require_once '../Settings.php';

use Web\MasterPages\LoggedMasterPage;

class WebServicesV100 extends BasePage
{

    public function __construct()
    {
        parent::__construct( __DIR__ . '/WebServicesV100.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );

        $this->addJavascript( "Javascripts/WebServicesV100.js" );
        $this->addCss( "Styles/WebServicesV100.css" );
    }

}

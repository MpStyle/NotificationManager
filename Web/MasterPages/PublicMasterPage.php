<?php

namespace Web\MasterPages;

use MToolkit\Controller\MAbstractMasterPageController;

class PublicMasterPage extends MAbstractMasterPageController
{
    public function __construct( $parent )
    {
        parent::__construct( __DIR__ . '/PublicMasterPage.view.php', $parent );
    }
}

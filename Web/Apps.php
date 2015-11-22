<?php

namespace Web; 

/*
 * This file is part of MToolkit.
 *
 * MToolkit is free software: you can redistribute it and/or modify
 * it under the terms of the LGNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * MToolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * LGNU Lesser General Public License for more details.
 *
 * You should have received a copy of the LGNU Lesser General Public License
 * along with MToolkit.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @author  Michele Pagnin
 */

require_once '../Settings.php';

use DbAbstraction\Application\ApplicationAction;
use MToolkit\Model\Sql\MPDOResult;
use Web\MasterPages\LoggedMasterPage;

class Apps extends BasePage
{
    private $applicationCount=0;
    
    public function __construct()
    {
        parent::__construct( __DIR__ . '/Apps.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );        
        $this->addMasterPagePart( 'content', 'content' );
        $this->addMasterPagePart( 'top-toolbar', 'top-toolbar' );
        $this->addMasterPagePart( 'page-title', 'page-title' );

        $this->addJavascript( "Javascripts/Apps.min.js" );
        $this->addCss( "Styles/Apps.css" );
        
        /* @var $result MPDOResult */ $result = ApplicationAction::getCount( null, null );
        $this->applicationCount = $result->getData( 0, 'AppCount' );
    }

    protected function deleteApplication()
    {
        if( ApplicationAction::delete( (int)$this->getPost()->getValue( "ApplicationId" ) ) == null )
        {
            $this->getHttpResponse()->redirect( "Apps.php?error=01" );
        }
        else
        {
            $this->getHttpResponse()->redirect( "Apps.php?error=02" );
        }
    }

    public function getApplicationCount()
    {
        return $this->applicationCount;
    }


}

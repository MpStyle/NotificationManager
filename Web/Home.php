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

use Web\MasterPages\LoggedMasterPage;

class Home extends BasePage
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/Home.view.php');
        
        parent::setMasterPage(new LoggedMasterPage($this));
        $this->addMasterPagePart('content', 'content');
        $this->addMasterPagePart( 'top-toolbar', 'top-toolbar' );
        $this->addMasterPagePart( 'page-title', 'page-title' );
        
        $this->addJavascript("Javascripts/Home.min.js");
        $this->addCss("Styles/Home.css");
        
        $page=$this->getGet()->getValue("currentPage");
        if( $page==null )
        {
            $page="Apps.php";
        }
        
        $this->getHttpResponse()->redirect($page);
    }
}

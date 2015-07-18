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

use Web\MasterPages\PublicMasterPage;

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

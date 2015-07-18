<?php

namespace BusinessLogic\ApplicationInternalLink;

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

use MToolkit\Core\MObject;

class ApplicationInternalLink extends MObject
{
    protected $id;
    protected $name;
    protected $applicaitonId;
    protected $applicaitonName;
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getApplicaitonId()
    {
        return $this->applicaitonId;
    }

    public function setId( $id )
    {
        $this->id = $id;
        return $this;
    }

    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

    public function setApplicaitonId( $applicaitonId )
    {
        $this->applicaitonId = $applicaitonId;
        return $this;
    }
    
    public function getApplicaitonName()
    {
        return $this->applicaitonName;
    }

    public function setApplicaitonName( $applicaitonName )
    {
        $this->applicaitonName = $applicaitonName;
        return $this;
    }
}

<?php

namespace BusinessLogic\Application;

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

class Application extends MObject
{
    protected $id = null;
    protected $name = null;
    protected $googleKey;
    protected $windowsPhoneKey;
    protected $clientId;
    protected $secretId;
    protected $updateDate;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
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

    public function getGoogleKey()
    {
        return $this->googleKey;
    }

    public function getWindowsPhoneKey()
    {
        return $this->windowsPhoneKey;
    }

    public function setGoogleKey( $googleKey )
    {
        $this->googleKey = $googleKey;
        return $this;
    }

    public function setWindowsPhoneKey( $windowsPhoneKey )
    {
        $this->windowsPhoneKey = $windowsPhoneKey;
        return $this;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientId( $clientId )
    {
        $this->clientId = $clientId;
        return $this;
    }

    public function getSecretId()
    {
        return $this->secretId;
    }

    public function setSecretId( $secretId )
    {
        $this->secretId = $secretId;
        return $this;
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function setUpdateDate( $updateDate )
    {
        $this->updateDate = $updateDate;
        return $this;
    }


}

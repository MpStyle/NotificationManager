<?php

namespace BusinessLogic\Device;

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

use BusinessLogic\Device\DeviceTypes;
use MToolkit\Core\MObject;

class Device extends MObject
{
    protected $id = null;
    protected $mobileId = null;
    protected $type = null;
    protected $oSVersion = null;
    protected $applicationVersion = null;
    protected $applicationName = null;
    protected $applicationId = null;
    protected $brand = null;
    protected $model = null;
    protected $enabled = null;
    protected $localizationId = null;
    protected $localizationName = null;
    protected $creationDate=null;
    protected $updateDate=null;
    protected $nickname=null;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMobileId()
    {
        return $this->mobileId;
    }

    /**
     * @return DeviceTypes
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $id
     * @return Device
     */
    public function setId( $id )
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $mobileId 
     * @return Device
     */
    public function setMobileId( $mobileId )
    {
        $this->mobileId = $mobileId;
        return $this;
    }

    /**
     * @param string $type
     * @return Device
     */
    public function setType( $type )
    {
        $this->type = $type;
        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setBrand( $brand )
    {
        $this->brand = $brand;
        return $this;
    }

    public function setModel( $model )
    {
        $this->model = $model;
        return $this;
    }

    public function getApplicationVersion()
    {
        return $this->applicationVersion;
    }

    public function getApplicationName()
    {
        return $this->applicationName;
    }

    public function setApplicationVersion( $applicationVersion )
    {
        $this->applicationVersion = $applicationVersion;
        return $this;
    }

    public function setApplicationName( $applicationName )
    {
        $this->applicationName = $applicationName;
        return $this;
    }

    public function getApplicationId()
    {
        return $this->applicationId;
    }

    public function setApplicationId( $applicationId )
    {
        $this->applicationId = $applicationId;
        return $this;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled( $enabled )
    {
        if( is_string( $enabled ) )
        {
            $enabled = (int) $enabled;
        }

        if( is_int( $enabled ) )
        {
            $enabled = ($enabled == 1 ? true : false);
        }

        $this->enabled = $enabled;
        return $this;
    }

    public function getOSVersion()
    {
        return $this->oSVersion;
    }

    public function setOSVersion( $oSVersion )
    {
        $this->oSVersion = $oSVersion;
        return $this;
    }
    
    public function getLocalizationId()
    {
        return $this->localizationId;
    }

    public function getLocalizationName()
    {
        return $this->localizationName;
    }

    public function setLocalizationId( $localizationId )
    {
        $this->localizationId = $localizationId;
        return $this;
    }

    public function setLocalizationName( $localizationName )
    {
        $this->localizationName = $localizationName;
        return $this;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function setCreationDate( $creationDate )
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function setUpdateDate( $updateDate )
    {
        $this->updateDate = $updateDate;
        return $this;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setNickname( $nickname )
    {
        $this->nickname = $nickname;
        return $this;
    }


}

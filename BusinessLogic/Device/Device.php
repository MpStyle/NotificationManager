<?php

namespace BusinessLogic\Device;

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
     * @return \BusinessLogic\Device\Device
     */
    public function setId( $id )
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $mobileId 
     * @return \BusinessLogic\Device\Device
     */
    public function setMobileId( $mobileId )
    {
        $this->mobileId = $mobileId;
        return $this;
    }

    /**
     * @param string $type
     * @return \BusinessLogic\Device\Device
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
            $enabled = ($enabled == '1' ? 1 : 0);
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

}

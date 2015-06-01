<?php

namespace BusinessLogic\Device;

use BusinessLogic\Device\Type;

class Device
{
    private $id;
    private $mobileId;
    private $type;
    private $clientAppVersion;
    private $brand;
    private $model;

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
     * @return Type
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
    
    public function getClientAppVersion()
    {
        return $this->clientAppVersion;
    }

    public function setClientAppVersion( $clientAppVersion )
    {
        $this->clientAppVersion = $clientAppVersion;
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

}

<?php

namespace BusinessLogic\Application;

use MToolkit\Core\MObject;

class Application extends MObject
{
    protected $id = null;
    protected $name = null;
    protected $googleKey;
    protected $windowsPhoneKey;
    protected $clientId;
    protected $secretId;

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


}

<?php

namespace BusinessLogic\Application;

use MToolkit\Core\MObject;

class Application extends MObject
{
    private $id = null;
    private $name = null;
    private $googleKey;
    private $windowsPhoneKey;

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

}

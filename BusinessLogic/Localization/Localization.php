<?php

namespace BusinessLogic\Link;

use MToolkit\Core\MObject;

class Localization extends MObject
{
    const IT=1;
    const EN=2;
    const ES=3;
    const DE=4;
    const FR=5;
    const RU=6;
    
    protected $id;
    Protected $name;
    
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
}

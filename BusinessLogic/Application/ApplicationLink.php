<?php

namespace BusinessLogic\Application;

use MToolkit\Core\MObject;

class ApplicationLink extends MObject
{
    protected $id;
    protected $name;
    protected $applicationId;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getApplicationId()
    {
        return $this->applicationId;
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

    public function setApplicationId( $applicationId )
    {
        $this->applicationId = $applicationId;
        return $this;
    }

}

<?php

namespace BusinessLogic\ApplicationInternalLink;

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

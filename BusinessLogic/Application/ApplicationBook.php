<?php

namespace BusinessLogic\Application;

use DbAbstraction\Application\ApplicationAction;
use MToolkit\Model\Sql\MPDOResult;
use MToolkit\Core\MDataType;

final class ApplicationBook
{
    /**
     * 
     * @param int $id
     * @param string $name
     * @return \MToolkit\Core\MList
     */
    public static function getApplications( $id = null, $name = null )
    {
        MDataType::mustBeNullableInt($id);
        MDataType::mustBeNullableString($name);
        
        /* @var $applicationList MPDOResult */ $applicationList = ApplicationAction::get( $id, $name );
        /* @var $applications MList */ $applications = new \MToolkit\Core\MList();

        foreach( $applicationList as $currentApplication )
        {
            $application = new Application();

            foreach( $currentApplication as $key => $value )
            {
                $application->lcfirst( $key ) = $value;
            }
            
            $applications->append($application);
        }
        
        return $applications;
    }

}

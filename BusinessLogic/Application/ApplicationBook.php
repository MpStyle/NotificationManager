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
    public static function getApplications( $id = null, $name = null, $perPage=10000000, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableString( $name );

        /* @var $applicationList MPDOResult */ $applicationList = ApplicationAction::get( $id, $name, $perPage, $page );
        /* @var $applications MList */ $applications = new \MToolkit\Core\MList();

        if( $applicationList != null )
        {
            foreach( $applicationList as $currentApplication )
            {
                
                $application = new Application();

                foreach( $currentApplication as $key => $value )
                {                    
                    $codeKey = lcfirst( $key );
                    
//                    var_dump($key);
//                    var_dump($codeKey);
                    
                    $application->$codeKey = $value;
                }
                
//                var_dump($application);

                $applications->append( $application );
            }
        }

        return $applications;
    }

}

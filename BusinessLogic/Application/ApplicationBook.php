<?php

namespace BusinessLogic\Application;

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

use DbAbstraction\Application\ApplicationAction;
use MToolkit\Core\MDataType;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MPDOResult;

final class ApplicationBook
{

    /**
     * 
     * @param int $id
     * @param string $name
     * @return MList
     */
    public static function getApplications( $id = null, $name = null, $clientId=null, $perPage=10000000, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableString( $name );
        MDataType::mustBeNullableString( $clientId );

        /* @var $applicationList MPDOResult */ $applicationList = ApplicationAction::get( $id, $name, $clientId, $perPage, $page );
        /* @var $applications MList */ $applications = new MList();

        if( $applicationList != null )
        {
            foreach( $applicationList as $currentApplication )
            {
                
                $application = new Application();

                foreach( $currentApplication as $key => $value )
                {                    
                    $codeKey = lcfirst( $key );
                    $application->$codeKey = $value;
                }
                
                $applications->append( $application );
            }
        }

        return $applications;
    }
    
    /**
     * 
     * @param int|null $id
     * @param int|null $name
     * @return int
     */
    public static function getCount( $id = null, $name = null )
    {
        /* @var $result MPDOResult */ $result = ApplicationAction::getCount( $id, $name );
        return $result->getData( 0, 'AppCount' );
    }

}

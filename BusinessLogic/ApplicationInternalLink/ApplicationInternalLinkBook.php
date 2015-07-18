<?php

namespace BusinessLogic\ApplicationInternalLink;

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

use BusinessLogic\Application\ApplicationLink;
use DbAbstraction\ApplicationInternalLink\ApplicationInternalLinkAction;
use MToolkit\Core\MDataType;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MPDOResult;

final class ApplicationInternalLinkBook
{
    /**
     * @param int|null $name
     * @param string|null $applicationId
     * @return MList
     */
    public static function get($id=null, $name=null, $applicationId=null)
    {
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $name );

        /* @var $linkList MPDOResult */ $linkList = ApplicationInternalLinkAction::get( $id, $name, $applicationId );
        /* @var $links MList */ $links = new MList();

        if( $linkList != null )
        {
            foreach( $linkList as $currentLink )
            {
                
                $link = new ApplicationLink();

                foreach( $currentLink as $key => $value )
                {                    
                    $codeKey = lcfirst( $key );
                    $link->$codeKey = $value;
                }
                
                $links->append( $link );
            }
        }

        return $links;
    }
}

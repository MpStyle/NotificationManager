<?php

namespace BusinessLogic\Localization;

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

use DbAbstraction\Link\LinkAction;
use MToolkit\Core\MDataType;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MPDOResult;
use ReflectionClass;

final class LocalizationBook
{

    /**
     * Returns all the supported localizations.
     * 
     * @return array Localization name in key, localization value in value.
     */
    public static function getLocalizations()
    {
        $localizationClass = new ReflectionClass( "BusinessLogic\Localization\Localization" );
        $constants = $localizationClass->getConstants();
        unset( $constants["SIGNALS"] );
        return $constants;
    }

    /**
     * @param int|null $name
     * @param string|null $applicationId
     * @return MList
     */
    public static function get( $id = null )
    {
        MDataType::mustBeNullableInt( $id );

        /* @var $linkList MPDOResult */ $linkList = LinkAction::get( $id );
        /* @var $links MList */ $links = new MList();

        if( $linkList != null )
        {
            foreach( $linkList as $currentLink )
            {

                $link = new Localization();

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

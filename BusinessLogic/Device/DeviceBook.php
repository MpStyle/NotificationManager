<?php

namespace BusinessLogic\Device;

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

use BusinessLogic\Device\Device;
use DbAbstraction\Device\DeviceAction;
use MToolkit\Core\MDataType;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MPDOResult;

final class DeviceBook
{

    /**
     * Returns a MList of Device filtered by parameters.
     * 
     * @param int|null $id
     * @param int|null $enabled
     * @param int|null $applicationId
     * @param string|null $type
     * @param string|null $freeSearch
     * @param int|null $mobileId
     * @param int $perPage
     * @param int $page
     * @return MList
     */
    public static function getDevices( $id = null
            , $enabled = null
            , $applicationId = null
            , $localizationId=null
            , $type = null
            , $freeSearch = null
            , $mobileId = null
            , $nickname = null
            , $perPage = 10000000
            , $page = 0 )
    {
        MDataType::mustBe(array(MDataType::INT|MDataType::NULL
                , MDataType::INT|MDataType::NULL
                , MDataType::INT|MDataType::NULL
                , MDataType::INT|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::INT
                , MDataType::INT));

        /* @var $deviceList MPDOResult */ $deviceList = DeviceAction::get( $id, $enabled, $applicationId, $localizationId, $type, $freeSearch, $mobileId, $nickname, $perPage, $page );
        /* @var $devices MList */ $devices = new MList();

        if( $deviceList==null )
        {
            return $devices;
        }
        
        foreach( $deviceList as $currentDevice )
        {

            $device = new Device();

            foreach( $currentDevice as $key => $value )
            {
                $codeKey = lcfirst( $key );

                $device->$codeKey = $value;
            }

            $devices->append( $device );
        }

        return $devices;
    }

    public static function getDeviceType()
    {
        /* @var $typeList MPDOResult */ $typeList = DeviceAction::getType();
        /* @var $types MList */ $types = new MList();

        if( $typeList!=null )
        {
            foreach( $typeList as $currentType )
            {
                $types->append( $currentType["Name"] );
            }
        }

        return $types;
    }

}

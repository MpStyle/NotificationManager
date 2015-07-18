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

    public static function getDevices( $id = null, $enabled = null, $applicationId = null, $type = null, $freeSearch = null, $mobileId = null, $perPage = 10000000, $page = 0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $enabled );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $type );
        MDataType::mustBeNullableString( $freeSearch );
        MDataType::mustBeNullableString( $mobileId );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        /* @var $deviceList MPDOResult */ $deviceList = DeviceAction::get( $id, $enabled, $applicationId, $type, $freeSearch, $mobileId, $perPage, $page );
        /* @var $devices MList */ $devices = new MList();

        if( $deviceList != null )
        {
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
        }

        return $devices;
    }
//
//    public static function getNotification( $deviceId, $applicationId )
//    {
//        MDataType::mustBeInt( $deviceId );
//        MDataType::mustBeInt( $applicationId );
//
//        /* @var $notificationList MPDOResult */ $notificationList = DeviceAction::getNotification( $deviceId, $applicationId );
//        /* @var $notifications MList */ $notifications = new MList();
//
//        if( $notificationList != null )
//        {
//            foreach( $notificationList as $currentNotification )
//            {
//
//                $notification = new Notification();
//
//                foreach( $currentNotification as $key => $value )
//                {
//                    $codeKey = lcfirst( $key );
//
//                    $notification->$codeKey = $value;
//                }
//
//                $notifications->append( $notification );
//            }
//        }
//
//        return $notifications;
//    }

    public static function getDeviceType()
    {
        /* @var $typeList MPDOResult */ $typeList = DeviceAction::getType();
        /* @var $types MList */ $types = new MList();

        if( $typeList != null )
        {
            foreach( $typeList as $currentType )
            {
                $types->append( $currentType["Name"] );
            }
        }

        return $types;
    }

}

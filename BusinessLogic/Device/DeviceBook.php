<?php

namespace BusinessLogic\Device;

use BusinessLogic\Device\Device;
use DbAbstraction\Device\DeviceAction;
use MToolkit\Core\MDataType;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MPDOResult;

final class DeviceBook
{
    /**
     * 
     * @param int $id
     * @param string $name
     * @return MList
     */
    public static function getDevices( $id = null, $enabled = null, $applicationId=null, $type=null, $freeSearch=null, $perPage=10000000, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $enabled );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $type );
        MDataType::mustBeNullableString( $freeSearch );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        /* @var $deviceList MPDOResult */ $deviceList = DeviceAction::get( $id, $enabled, $applicationId, $type, $freeSearch, $perPage, $page );
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

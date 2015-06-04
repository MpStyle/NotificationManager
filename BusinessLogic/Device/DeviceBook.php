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
    public static function getDevices( $id = null, $enabled = null, $applicationId=null, $perPage=10000000, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $enabled );

        /* @var $deviceList MPDOResult */ $deviceList = DeviceAction::get( $id, $enabled, $applicationId, $perPage, $page );
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

}

<?php

namespace DbAbstraction\Device;

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

use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOQuery;
use MToolkit\Model\Sql\MPDOResult;
use PDO;

class DeviceAction
{

    public static function deleteNotification( $notificationId )
    {
        MDataType::mustBeInt( $notificationId );

        $query = "CALL deviceDeleteNotification(?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $notificationId );

        $sql->exec();

        return $sql->getResult();
    }

    public static function setNotification( $notificationId, $localizationId, $deviceTypeId )
    {
        MDataType::mustBeInt( $notificationId );

        $query = "CALL deviceSetNotifications(?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $notificationId );
        $sql->bindValue( $localizationId );
        $sql->bindValue( $deviceTypeId );

        $sql->exec();

        return $sql->getResult();
    }

    public static function getNotification( $deviceId, $applicationId, $notificationId = null, $deliveryStatusId = null )
    {
        MDataType::mustBeInt( $deviceId );
        MDataType::mustBeInt( $applicationId );
        MDataType::mustBeNullableInt( $notificationId );
        MDataType::mustBeNullableInt( $deliveryStatusId );

        $query = "CALL deviceGetNotifications(?, ?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $deviceId );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $notificationId );
        $sql->bindValue( $deliveryStatusId );

        $sql->exec();

        return $sql->getResult();
    }

    public static function setApplication( $deviceId, $applicationId, $enabled )
    {
        MDataType::mustBeInt( $deviceId );
        MDataType::mustBeInt( $applicationId );
        MDataType::mustBeBoolean( $enabled );

        $query = "CALL deviceSetApplication(?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $deviceId );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $enabled );

        $sql->exec();

        return $sql->getResult();
    }

    public static function insert(
        $mobileId
        , $type
        , $osVersion
        , $applicationVersion
        , $brand
        , $model
        , $localizationId )
    {
        $query = "CALL deviceInsert(?, ?, ?, ?, ?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValues( array(
            $mobileId, $type, $osVersion, $applicationVersion, $brand, $model, $localizationId 
        ) );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * @param int $id
     * @param boolean $enabled
     * @return MPDOResult
     */
    public static function update( $deviceId, $applicationId, $enabled, $nickname )
    {
        MDataType::mustBe(array(MDataType::INT, MDataType::INT, MDataType::INT, MDataType::STRING|MDataType::NULL));

        $query = "CALL deviceUpdate(?, ?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $deviceId );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $enabled );
        $sql->bindValue( $nickname );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * @param int $id
     * @return MPDOResult
     */
    public static function delete( $id )
    {
        MDataType::mustBeInt( $id );

        $query = "CALL deviceDelete(?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );

        $sql->exec();

        return $sql->getResult();
    }

    public static function getDeviceType()
    {
        $query = "CALL deviceTypeGet()";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * @param int $id
     * @param int $enabled
     * @param int $applicationId
     * @param int $perPage
     * @param int $page
     * @return MPDOResult
     */
    public static function get( $id = null
            , $enabled = null
            , $applicationId = null
            , $localizationId=null
            , $type = null
            , $freeSearch = null
            , $mobileId = null
            , $nickname = null
            , $perPage = 10
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

        $query = "CALL deviceGet(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValues( array(
            $id, $enabled, $applicationId, $localizationId, $type, $freeSearch, $mobileId, $nickname, $perPage, $page 
        ) );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * @param int|null $id
     * @param int|null $enabled
     * @param int|null $applicationId
     * @param int|null $localizationId
     * @param string|null $type
     * @param string|null $freeSearch
     * @param string|null $mobileId
     * @param string|null $nickname
     * @param int $perPage
     * @return MPDOResult
     */
    public static function getPageCount( $id = null
            , $enabled = null
            , $applicationId = null
            , $localizationId=null
            , $type = null
            , $freeSearch = null
            , $mobileId = null
            , $nickname = null
            , $perPage = 10 )
    {
        MDataType::mustBe(array(MDataType::INT|MDataType::NULL
                , MDataType::INT|MDataType::NULL
                , MDataType::INT|MDataType::NULL
                , MDataType::INT|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::INT));

        $query = "CALL deviceGetPageCount(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValues( array( 
            $id, $enabled, $applicationId, $localizationId, $type, $freeSearch, $mobileId, $nickname, $perPage 
        ) );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * @param int $id
     * @param int $enabled
     * @param int $applicationId
     * @return MPDOResult
     */
    public static function getCount( $id = null
            , $enabled = null
            , $applicationId = null
            , $localizationId=null
            , $type = null
            , $freeSearch = null
            , $mobileId = null
            , $nickname = null )
    {
        MDataType::mustBe(array(MDataType::INT|MDataType::NULL
                , MDataType::INT|MDataType::NULL
                , MDataType::INT|MDataType::NULL
                , MDataType::INT|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::STRING|MDataType::NULL
                , MDataType::STRING|MDataType::NULL));

        $query = "CALL deviceGetCount(?, ?, ?, ?, ?, ?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValues( array(
            $id, $enabled, $applicationId, $localizationId, $type, $freeSearch, $mobileId, $nickname 
        ) );

        $sql->exec();

        return $sql->getResult();
    }

    public static function getType()
    {
        $query = "CALL deviceTypeGet()";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->exec();

        return $sql->getResult();
    }

}

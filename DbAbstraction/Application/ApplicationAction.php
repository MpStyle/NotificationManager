<?php

namespace DbAbstraction\Application;

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

/**
 * ApplicationAction class collects the call to the stored procedures of the database about the application.
 */
class ApplicationAction
{

    /**
     * Calls the store procedure to insert a new application in the database.<br>
     * MDataType is used for the type checking of the parameters.
     * 
     * @param string $name
     * @param string $googleKey
     * @param string $windowsPhoneKey
     * @param string $clientId
     * @param string $secretId
     * @return MPDOResult
     */
    public static function insert( $name, $googleKey, $windowsPhoneKey, $clientId, $secretId )
    {
        MDataType::mustBeString( $name );
        MDataType::mustBeNullableString( $googleKey );
        MDataType::mustBeNullableString( $windowsPhoneKey );
        MDataType::mustBeString( $clientId );
        MDataType::mustBeString( $secretId );

        $query = "CALL applicationInsert(?, ?, ?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $name );
        $sql->bindValue( $googleKey );
        $sql->bindValue( $windowsPhoneKey );
        $sql->bindValue( $clientId );
        $sql->bindValue( $secretId );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * Calls the store procedure to update an application in the database.<br>
     * MDataType is used for the type checking of the parameters.
     * 
     * @param int $id
     * @param string $name
     * @param string $googleKey
     * @param string $windowsPhoneKey
     * @param string $secretId
     * @return MPDOResult
     */
    public static function update( $id, $name, $googleKey, $windowsPhoneKey, $secretId )
    {
        MDataType::mustBeInt( $id );
        MDataType::mustBeString( $name );
        MDataType::mustBeNullableString( $googleKey );
        MDataType::mustBeNullableString( $windowsPhoneKey );
        MDataType::mustBeString( $secretId );

        $query = "CALL applicationUpdate(?, ?, ?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $name );
        $sql->bindValue( $googleKey );
        $sql->bindValue( $windowsPhoneKey );
        $sql->bindValue( $secretId );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * Calls the store procedure to delete an application in the database.<br>
     * MDataType is used for the type checking of the parameters.
     * 
     * @param int $id
     * @return MPDOResult
     */
    public static function delete( $id )
    {
        MDataType::mustBeInt( $id );

        $query = "CALL applicationDelete(?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * Calls the store procedure to retrieve the applications in the database.<br>
     * The parameters of the method are used to filter the resultset. Their are used in "AND" condition.<br>
     * MDataType is used for the type checking of the parameters.
     * 
     * @param int $id
     * @param string $name
     * @param int $perPage
     * @param int $page
     * @return MPDOResult
     */
    public static function get( $id = null, $name = null, $clientId=null, $perPage=10, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableString( $name );
        MDataType::mustBeNullableString( $clientId );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        $query = "CALL applicationGet(?, ?, ?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $name );
        $sql->bindValue( $clientId );
        $sql->bindValue( $perPage );
        $sql->bindValue( $page );

        $sql->exec();

        return $sql->getResult();
    }
    
    /**
     * Calls the store procedure to count the applications in the database.<br>
     * The parameters of the method are used to filter the resultset. Their are used in "AND" condition.<br>
     * MDataType is used for the type checking of the parameters.
     * 
     * @param int $id
     * @param string $name
     */
    public static function getCount($id = null, $name = null)
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableString( $name );

        $query = "CALL applicationGetCount(?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $name );

        $sql->exec();

        return $sql->getResult();
    }
}

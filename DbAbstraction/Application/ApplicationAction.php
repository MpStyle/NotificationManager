<?php

namespace DbAbstraction\Application;

use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOResult;
use MToolkit\Model\Sql\MPDOQuery;

class ApplicationAction
{

    /**
     * 
     * @param string $name
     * @param string $googleKey
     * @param string $windowsPhoneKey
     * @return MPDOResult
     */
    public static function insert( $name, $googleKey, $windowsPhoneKey, $clientId )
    {
        MDataType::mustBeString( $name );
        MDataType::mustBeNullableString( $googleKey );
        MDataType::mustBeNullableString( $windowsPhoneKey );
        MDataType::mustBeNullableString( $clientId );

        $query = "CALL applicationInsert(?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $name );
        $sql->bindValue( $googleKey );
        $sql->bindValue( $windowsPhoneKey );
        $sql->bindValue( $clientId );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * 
     * @param int $id
     * @param string $name
     * @param string $googleKey
     * @param string $windowsPhoneKey
     * @return MPDOResult
     */
    public static function update( $id, $name, $googleKey, $windowsPhoneKey )
    {
        MDataType::mustBeInt( $id );
        MDataType::mustBeString( $name );
        MDataType::mustBeNullableString( $googleKey );
        MDataType::mustBeNullableString( $windowsPhoneKey );

        $query = "CALL applicationUpdate(?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $name );
        $sql->bindValue( $googleKey );
        $sql->bindValue( $windowsPhoneKey );

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

        $query = "CALL applicationDelete(?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );

        $sql->exec();

        return $sql->getResult();
    }

    /**
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
        /* @var $connection \PDO */
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
    
    public static function getCount($id = null, $name = null)
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableString( $name );

        $query = "CALL applicationGetCount(?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $name );

        $sql->exec();

        return $sql->getResult();
    }
}

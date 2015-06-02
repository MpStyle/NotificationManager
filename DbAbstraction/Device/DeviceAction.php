<?php
namespace DbAbstraction\Device;

use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOResult;
use MToolkit\Model\Sql\MPDOQuery;

class DeviceAction
{
    /**
     * @param int $id
     * @param boolean $enabled
     * @return MPDOResult
     */
    public static function insert( $id, $enabled=true )
    {
        MDataType::mustBeInt( $id );
        MDataType::mustBeBoolean( $enabled );

        $query = "CALL deviceInsert(?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $enabled );

        $sql->exec();

        return $sql->getResult();
    }
    
    /**
     * @param int $id
     * @param boolean $enabled
     * @return MPDOResult
     */
    public static function update( $id, $enabled )
    {
        MDataType::mustBeInt( $id );
        MDataType::mustBeBoolean( $enabled );

        $query = "CALL deviceUpdate(?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $enabled );

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
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );

        $sql->exec();

        return $sql->getResult();
    }
    
    /**
     * @param int $id
     * @param boolean $enabled
     * @return MPDOResult
     */
    public static function get( $id=null, $enabled=null, $perPage=10, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableBoolean( $enabled );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        $query = "CALL deviceGet(?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection, $perPage, $page );

        $sql->bindValue( $id );
        $sql->bindValue( $enabled );

        $sql->exec();

        return $sql->getResult();
    }
}

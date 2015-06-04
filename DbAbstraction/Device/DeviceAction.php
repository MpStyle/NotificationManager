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
        MDataType::mustBeInt( $enabled );

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
     * @param int $enabled
     * @param int $applicationId
     * @param int $perPage
     * @param int $page
     * @return MPDOResult
     */
    public static function get( $id=null, $enabled=null, $applicationId=null,  $perPage=10, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $enabled );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        $query = "CALL deviceGet(?, ?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $enabled );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $perPage );
        $sql->bindValue( $page );

        $sql->exec();

        return $sql->getResult();
    }
    
    /**
     * @param int $id
     * @param int $enabled
     * @param int $applicationId
     * @return MPDOResult
     */
    public static function getPageCount( $id=null, $enabled=null, $applicationId=null, $perPage=10 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $enabled );
        MDataType::mustBeNullableInt( $applicationId );

        $query = "CALL deviceGetPageCount(?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $enabled );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $perPage );

        $sql->exec();

        return $sql->getResult();
    }
}

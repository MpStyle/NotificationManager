<?php

namespace DbAbstraction\Application;

use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MPDOResult;

class ApplicationAction
{

    /**
     * 
     * @param string $name
     * @return type
     */
    public static function insert( $name )
    {
        MDataType::mustBeString( $name );

        $query = "CALL applicationInsert(?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $name );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * 
     * @param int $id
     * @param string $anme
     * @return type
     */
    public static function update( $id, $name )
    {
        MDataType::mustBeInt( $id );
        MDataType::mustBeString( $name );

        $query = "CALL applicationUpdate(?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $name );

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
    public static function get( $id = null, $name = null, $perPage=10, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeString( $name );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        $query = "CALL applicationGet(?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $name );
        $sql->bindValue( $perPage );
        $sql->bindValue( $page );

        $sql->exec();

        return $sql->getResult();
    }

}

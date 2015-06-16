<?php

namespace DbAbstraction\Link;

use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOResult;
use MToolkit\Model\Sql\MPDOQuery;

class LinkAction
{
    public static function get( $name=null, $applicationId=null )
    {
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $name );

        $query = "CALL applicationLinkGet(?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $name );
        $sql->bindValue( $applicationId );

        $sql->exec();

        return $sql->getResult();
    }
    
    public static function insert( $name=null, $applicationId=null )
    {
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $name );

        $query = "CALL applicationLinkInsert(?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $name );
        $sql->bindValue( $applicationId );

        $sql->exec();

        return $sql->getResult();
    }
    
    public static function delete( $applicationId=null )
    {
        MDataType::mustBeNullableInt( $applicationId );

        $query = "CALL applicationLinkDelete(?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $applicationId );

        $sql->exec();

        return $sql->getResult();
    }
}

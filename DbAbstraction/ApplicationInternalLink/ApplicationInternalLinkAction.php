<?php

namespace DbAbstraction\ApplicationInternalLink;

use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOQuery;
use PDO;

class ApplicationInternalLinkAction
{
    public static function get( $id=null, $name=null, $applicationId=null )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $name );

        $query = "CALL applicationInternalLinkGet(?, ?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $name );
        $sql->bindValue( $applicationId );

        $sql->exec();

        return $sql->getResult();
    }
    
    public static function insert( $name=null, $applicationId=null )
    {
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $name );

        $query = "CALL applicationInternalLinkInsert(?, ?)";
        /* @var $connection PDO */
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

        $query = "CALL applicationInternalLinkDelete(?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $applicationId );

        $sql->exec();

        return $sql->getResult();
    }
}

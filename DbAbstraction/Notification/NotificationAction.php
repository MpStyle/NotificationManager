<?php

namespace DbAbstraction\Notification;

use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOResult;
use MToolkit\Model\Sql\MPDOQuery;
use MToolkit\Core\MDataType;

class NotificationAction
{

    /**
     * Insert a new notification.
     * 
     * @param string $title
     * @param string $subtitle
     * @param string $message
     * @return MPDOResult
     */
    public static function insert( $title, $subtitle, $message )
    {
        MDataType::mustBeNullableString( $title );
        MDataType::mustBeNullableString( $subtitle );
        MDataType::mustBeNullableString( $message );

        $query = "CALL notificationInsert(?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $title );
        $sql->bindValue( $subtitle );
        $sql->bindValue( $message );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * Update a notification with id <i>$id</i>.
     * 
     * @param int $id
     * @param string $title
     * @param string $subtitle
     * @param string $message
     * @return MPDOResult
     */
    public static function update( $id, $title, $subtitle, $message )
    {
        MDataType::mustBeInt( $id );
        MDataType::mustBeNullableString( $title );
        MDataType::mustBeNullableString( $subtitle );
        MDataType::mustBeNullableString( $message );

        $query = "CALL notificationUpdate(?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $title );
        $sql->bindValue( $subtitle );
        $sql->bindValue( $message );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * Delete the notification with id <i>$id</i>
     * 
     * @param int $id
     * @return MPDOResult
     */
    public static function delete( $id )
    {
        MDataType::mustBeInt( $id );

        $query = "CALL notificationDelete(?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );

        $sql->exec();

        return $sql->getResult();
    }

    /**
     * @param int $id
     * @return MPDOResult
     */
    public static function get( $id = null, $applicationId=null, $status=null, $perPage=10, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        $query = "CALL notificationGet(?, ?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $status );
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
    public static function getPageCount( $id = null, $applicationId=null, $status=null, $perPage=10 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeInt( $perPage );

        $query = "CALL notificationGetPageCount(?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $status );
        $sql->bindValue( $perPage );

        $sql->exec();

        return $sql->getResult();
    }
    
    /**
     * @param int $id
     * @param int $applicationId
     * @param int $status
     * @return MPDOResult
     */
    public static function getCount($id = null, $applicationId=null, $status=null)
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $applicationId );

        $query = "CALL notificationGetCount(?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $status );

        $sql->exec();

        return $sql->getResult();
    }
}

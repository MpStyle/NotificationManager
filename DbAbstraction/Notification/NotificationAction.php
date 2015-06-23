<?php

namespace DbAbstraction\Notification;

use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOResult;
use MToolkit\Model\Sql\MPDOQuery;
use MToolkit\Core\MDataType;

class NotificationAction
{

    /**
     * @param string $title
     * @param string $shortMessage
     * @param string $message
     * @param string $statusId
     * @param string $deviceType
     * @param string $startDate
     * @param string $endDate
     * @param int $applicationId
     * @param string $linkType
     * @param string $link
     * @param int $iconId
     * @return MPDOResult
     */
    public static function insert( 
            $title
            , $shortMessage
            , $message
            , $statusId
            , $deviceType
            , $startDate
            , $endDate
            , $applicationId
            , $linkType
            , $externalLink
            , $internalLinkId
            , $iconId
            , $localizationId)
    {
        MDataType::mustBeNullableString( $title );
        MDataType::mustBeNullableString( $shortMessage );
        MDataType::mustBeInt( $statusId );
        MDataType::mustBeNullableString( $deviceType );
        MDataType::mustBeNullableString( $startDate );
        MDataType::mustBeNullableString( $endDate );
        MDataType::mustBeInt( $applicationId );
        MDataType::mustBeNullableString( $linkType );
        MDataType::mustBeNullableInt( $internalLinkId );
        MDataType::mustBeNullableString( $externalLink );
        MDataType::mustBeNullableInt( $iconId );
        MDataType::mustBeNullableInt( $localizationId );

        $query = "CALL notificationInsert(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $title );
        $sql->bindValue( $shortMessage );
        $sql->bindValue( $message );
        $sql->bindValue( $statusId );
        $sql->bindValue( $deviceType );
        $sql->bindValue( $startDate );
        $sql->bindValue( $endDate );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $linkType );
        $sql->bindValue( $externalLink );
        $sql->bindValue( $internalLinkId );
        $sql->bindValue( $iconId );
        $sql->bindValue( $localizationId );

        $sql->exec();

        return $sql->getResult();
    }

    public static function update( 
		$id
		, $title
		, $shortMessage
		, $message
		, $statusId
		, $deviceType
		, $startDate
		, $endDate
		, $applicationId
		, $linkType
		, $externalLink
                , $internalLinkId
		, $iconId )
    {
        MDataType::mustBeInt( $id );
        MDataType::mustBeNullableString( $title );
        MDataType::mustBeNullableString( $shortMessage );
        MDataType::mustBeInt( $statusId );
        MDataType::mustBeNullableString( $deviceType );
        MDataType::mustBeNullableString( $startDate );
        MDataType::mustBeNullableString( $endDate );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $linkType );
        MDataType::mustBeNullableString( $externalLink );
        MDataType::mustBeNullableInt( $internalLinkId );
        MDataType::mustBeNullableInt( $iconId );

        $query = "CALL notificationUpdate(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $title );
        $sql->bindValue( $shortMessage );
        $sql->bindValue( $message );
        $sql->bindValue( $statusId );
        $sql->bindValue( $deviceType );
        $sql->bindValue( $startDate );
        $sql->bindValue( $endDate );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $linkType );
        $sql->bindValue( $externalLink );
        $sql->bindValue( $internalLinkId );
        $sql->bindValue( $iconId );

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
    public static function get( $id = null, $applicationId=null, $statusId=null, $deviceType=null, $perPage=10, $page=0 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableInt( $statusId );
        MDataType::mustBeNullableString( $deviceType );
        MDataType::mustBeInt( $perPage );
        MDataType::mustBeInt( $page );

        $query = "CALL notificationGet(?, ?, ?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $statusId );
        $sql->bindValue( $deviceType );
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
    public static function getPageCount( $id = null, $applicationId=null, $statusId=null, $deviceType=null, $perPage=10 )
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableInt( $statusId );
        MDataType::mustBeNullableString( $deviceType );
        MDataType::mustBeInt( $perPage );

        $query = "CALL notificationGetPageCount(?, ?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $statusId );
        $sql->bindValue( $deviceType );
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
    public static function getCount($id = null, $applicationId=null, $statusId=null, $deviceType=null)
    {
        MDataType::mustBeNullableInt( $id );
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableInt( $statusId );
        MDataType::mustBeNullableString( $deviceType );

        $query = "CALL notificationGetCount(?, ?, ?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );
        $sql->bindValue( $applicationId );
        $sql->bindValue( $statusId );
        $sql->bindValue( $deviceType );

        $sql->exec();

        return $sql->getResult();
    }
}

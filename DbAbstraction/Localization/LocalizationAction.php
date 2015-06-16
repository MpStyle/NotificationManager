<?php

namespace BusinessLogic\Localization;

class LocalizationAction
{
    public static function get( $id=null )
    {
        MDataType::mustBeNullableInt( $applicationId );

        $query = "CALL localizationGet(?, ?)";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $id );

        $sql->exec();

        return $sql->getResult();
    }
}

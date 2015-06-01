<?php

namespace DbAbstraction\Settings;

use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MPDOResult;

class SettingsAction
{

    /**
     * @param string $key
     * @return MPDOResult
     */
    public static function get( $key )
    {
        MDataType::mustBeString( $key );

        $query = "SELECT getSetting(?) AS `Value`";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $key );

        $sql->exec();

        return $sql->getResult();
    }

}

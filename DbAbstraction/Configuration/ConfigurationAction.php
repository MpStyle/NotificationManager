<?php

namespace DbAbstraction\Configuration;

use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOResult;
use MToolkit\Model\Sql\MPDOQuery;

class ConfigurationAction
{

    /**
     * @param string $key
     * @return MPDOResult
     */
    public static function get( $key )
    {
        MDataType::mustBeString( $key );

        $query = "SELECT getConfigurationValue(?) AS `Value`";
        /* @var $connection \PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $key );

        $sql->exec();

        return $sql->getResult();
    }

}

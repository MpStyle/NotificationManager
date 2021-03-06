<?php

namespace DbAbstraction\Configuration;

/*
 * This file is part of MToolkit.
 *
 * MToolkit is free software: you can redistribute it and/or modify
 * it under the terms of the LGNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * MToolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * LGNU Lesser General Public License for more details.
 *
 * You should have received a copy of the LGNU Lesser General Public License
 * along with MToolkit.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @author  Michele Pagnin
 */

use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOQuery;
use MToolkit\Model\Sql\MPDOResult;
use PDO;

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
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $key );

        $sql->exec();

        return $sql->getResult();
    }
    
    public static function update( $key, $value )
    {
        MDataType::mustBeString( $key );

        $query = "CALL configurationUpdate(?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );

        $sql->bindValue( $key );
        $sql->bindValue( $value );

        $sql->exec();

        return $sql->getResult();
    }

}

<?php

namespace BusinessLogic\Configuration;

use DbAbstraction\Configuration\ConfigurationAction;

class ConfigurationBook
{

    public static function getValue( $key )
    {
        $rows = ConfigurationAction::get( $key );

        if( count( $rows ) == 0 )
        {
            return null;
        }

        return $rows[0]['Value'];
    }

}

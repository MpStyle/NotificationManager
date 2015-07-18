<?php

namespace BusinessLogic\Json;

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


class JsonBook
{
    /**
     * Returns indent <i>$json</i>.
     * 
     * @param string $json
     * @return string
     */
    public static function indent( $json )
    {
        $tab = "  ";
        $new_json = "";
        $indent_level = 0;
        $in_string = false;

        $json_obj = json_decode( $json );

        if( $json_obj === false )
        {
            return "Error: invalid json.";
        }

        $json = json_encode( $json_obj );
        $len = strlen( $json );

        for( $c = 0; $c < $len; $c++ )
        {
            $char = $json[$c];
            switch( $char )
            {
                case '{':
                case '[':
                    if( !$in_string )
                    {
                        $new_json .= $char . "\n" . str_repeat( $tab, $indent_level + 1 );
                        $indent_level++;
                    }
                    else
                    {
                        $new_json .= $char;
                    }
                    break;
                case '}':
                case ']':
                    if( !$in_string )
                    {
                        $indent_level--;
                        $new_json .= "\n" . str_repeat( $tab, $indent_level ) . $char;
                    }
                    else
                    {
                        $new_json .= $char;
                    }
                    break;
                case ',':
                    if( !$in_string )
                    {
                        $new_json .= ",\n" . str_repeat( $tab, $indent_level );
                    }
                    else
                    {
                        $new_json .= $char;
                    }
                    break;
                case ':':
                    if( !$in_string )
                    {
                        $new_json .= ": ";
                    }
                    else
                    {
                        $new_json .= $char;
                    }
                    break;
                case '"':
                    if( $c > 0 && $json[$c - 1] != '\\' )
                    {
                        $in_string = !$in_string;
                    }
                default:
                    $new_json .= $char;
                    break;
            }
        }

        return $new_json;
    }

}
<?php
namespace BusinessLogic\Date;

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

use DateTime;


class DateBook
{
    /**
     * @param string $databaseDate
     * @return DateTime Format Y-m-d H:i:s
     */
    public static function fromDatabaseDateToPHPDateTime($databaseDate)
    {
        return DateTime::createFromFormat( 'Y-m-d H:i:s', $databaseDate );
    }
    
    /**
     * @param string $datePickerDate Format d/m/Y
     * @return string Format Y-m-d 00:00:00
     */
    public static function fromDatePickerDateToDatabaseDate($datePickerDate)
    {
        $date = DateTime::createFromFormat( 'd/m/Y', $datePickerDate );
        return $date->format( 'Y-m-d 00:00:00' );
    }
    
    /**
     * @param string $databaseDate Format Y-m-d H:i:s
     * @return string Format d/m/Y
     */
    public static function fromDatabaseDateToDatePickerDate($databaseDate)
    {
//        var_dump($databaseDate);
        
        $date=DateBook::fromDatabaseDateToPHPDateTime($databaseDate);
        
        if($date==null)
        {
            return "";
        }
        
        return $date->format("d/m/Y");
    }
}

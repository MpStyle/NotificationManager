<?php
namespace BusinessLogic\Date;

class DateBook
{
    /**
     * @param string $databaseDate
     * @return \DateTime Format Y-m-d H:i:s
     */
    public static function fromDatabaseDateToPHPDateTime($databaseDate)
    {
        return \DateTime::createFromFormat( 'Y-m-d H:i:s', $databaseDate );
    }
    
    /**
     * @param string $datePickerDate Format d/m/Y
     * @return string Format Y-m-d 00:00:00
     */
    public static function fromDatePickerDateToDatabaseDate($datePickerDate)
    {
        $date = \DateTime::createFromFormat( 'd/m/Y', $datePickerDate );
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

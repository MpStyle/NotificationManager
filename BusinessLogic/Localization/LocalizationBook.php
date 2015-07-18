<?php

namespace BusinessLogic\Localization;

use DbAbstraction\Link\LinkAction;
use MToolkit\Core\MDataType;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MPDOResult;
use ReflectionClass;

final class LocalizationBook
{

    /**
     * Returns all the supported localizations.
     * 
     * @return array Localization name in key, localization value in value.
     */
    public static function getLocalizations()
    {
        $localizationClass = new ReflectionClass( "BusinessLogic\Localization\Localization" );
        $constants = $localizationClass->getConstants();
        unset( $constants["SIGNALS"] );
        return $constants;
    }

    /**
     * @param int|null $name
     * @param string|null $applicationId
     * @return MList
     */
    public static function get( $id = null )
    {
        MDataType::mustBeNullableInt( $id );

        /* @var $linkList MPDOResult */ $linkList = LinkAction::get( $id );
        /* @var $links MList */ $links = new MList();

        if( $linkList != null )
        {
            foreach( $linkList as $currentLink )
            {

                $link = new Localization();

                foreach( $currentLink as $key => $value )
                {
                    $codeKey = lcfirst( $key );
                    $link->$codeKey = $value;
                }

                $links->append( $link );
            }
        }

        return $links;
    }

}

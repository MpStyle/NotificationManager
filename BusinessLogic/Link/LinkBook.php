<?php

namespace BusinessLogic\Link;

use DbAbstraction\Link\LinkAction;
use MToolkit\Core\MDataType;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MPDOResult;

final class LinkBook
{
    /**
     * @param int|null $name
     * @param string|null $applicationId
     * @return MList
     */
    public static function get($name=null, $applicationId=null)
    {
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $name );

        /* @var $linkList MPDOResult */ $linkList = LinkAction::get( $name, $applicationId );
        /* @var $links MList */ $links = new MList();

        if( $linkList != null )
        {
            foreach( $linkList as $currentLink )
            {
                
                $link = new Link();

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

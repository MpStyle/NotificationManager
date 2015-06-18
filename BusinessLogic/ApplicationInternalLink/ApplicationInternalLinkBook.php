<?php

namespace BusinessLogic\ApplicationInternalLink;

use BusinessLogic\Application\ApplicationLink;
use DbAbstraction\ApplicationInternalLink\ApplicationInternalLinkAction;
use MToolkit\Core\MDataType;
use MToolkit\Core\MList;
use MToolkit\Model\Sql\MPDOResult;

final class ApplicationInternalLinkBook
{
    /**
     * @param int|null $name
     * @param string|null $applicationId
     * @return MList
     */
    public static function get($id=null, $name=null, $applicationId=null)
    {
        MDataType::mustBeNullableInt( $applicationId );
        MDataType::mustBeNullableString( $name );

        /* @var $linkList MPDOResult */ $linkList = ApplicationInternalLinkAction::get( $id, $name, $applicationId );
        /* @var $links MList */ $links = new MList();

        if( $linkList != null )
        {
            foreach( $linkList as $currentLink )
            {
                
                $link = new ApplicationLink();

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

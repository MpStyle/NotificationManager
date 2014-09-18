<?php

namespace MToolkit\Controller;

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

require_once __DIR__ . '../Core/MList.php';
require_once __DIR__ . '../Core/MObject.php';

use MToolkit\Core\MList;
use MToolkit\Core\MObject;

class MControllerList extends MList
{
    /**
     * 
     * @param \MToolkit\Core\MObject $parent
     */
    public function __construct( MObject $parent = null )
    {
        parent::__construct( $parent );
    }

    /**
     * @param \MToolkit\Controller\MAbstractController $value
     */
    public function append( MAbstractController $value )
    {
        parent::append( $value );
    }
    
    /**
     * @param \MToolkit\Controller\MAbstractController $value
     * @return boolean
     */
    public function contains( MAbstractController $value )
    {
        return parent::contains( $value );
    }
    
    /**
     * @param int $i
     * @param MAbstractController $defaultValue
     * @return MAbstractController
     */
    public function getValue( $i, MAbstractController $defaultValue = null )
    {
        return parent::getValue( $i, $defaultValue );
    }
    
    /**
     * @param \MToolkit\Controller\MAbstractController $value
     * @param int $from
     * @return int
     */
    public function indexOf( MAbstractController $value, $from = 0 )
    {
        return parent::indexOf( $value, $from );
    }
    
    /**
     * @param \MToolkit\Controller\MAbstractController $value
     */
    public function endsWith( MAbstractController $value )
    {
        parent::endsWith( $value );
    }
    
    /**
     * @param int $i
     * @param \MToolkit\Controller\MAbstractController $value
     */
    public function insert( $i, MAbstractController $value )
    {
        parent::insert( $i, $value );
    }
    
    /**
     * @param \MToolkit\Controller\MAbstractController $value
     * @param int $from
     * @return int
     */
    public function lastIndexOf( MAbstractController $value, $from = -1 )
    {
        return parent::lastIndexOf( $value, $from );
    }
    
    /**
     * @param int $offset
     * @param \MToolkit\Controller\MAbstractController $value
     */
    public function offsetSet( $offset, MAbstractController $value )
    {
        parent::offsetSet( $offset, $value );
    }
    
    /**
     * @param \MToolkit\Controller\MAbstractController $value
     */
    public function prepend( MAbstractController $value )
    {
        parent::prepend( $value );
    }
    
    /**
     * @param \MToolkit\Controller\MAbstractController $value
     */
    public function push_back( MAbstractController $value )
    {
        parent::push_back( $value );
    }
    
    /**
     * @param \MToolkit\Controller\MAbstractController $value
     */
    public function push_front( MAbstractController $value )
    {
        parent::push_front( $value );
    }
    
    /**
     * @param \MToolkit\Controller\MAbstractController $value
     * @return boolean
     */
    public function removeOne( MAbstractController $value )
    {
        return parent::removeOne( $value );
    }
    
    /**
     * @param int $i
     * @param \MToolkit\Controller\MAbstractController $value
     */
    public function replace( $i, MAbstractController $value )
    {
        parent::replace( $i, $value );
    }
    
    /**
     * @param \MToolkit\Controller\MAbstractController $value
     * @return boolean
     */
    public function startsWith( MAbstractController $value )
    {
        return parent::startsWith( $value );
    }
}

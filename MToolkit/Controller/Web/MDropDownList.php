<?php

namespace MToolkit\Controller\Web;

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

require_once __DIR__ . '/../MAbstractWebController.php';
require_once __DIR__ . '/../../Core/MDataType.php';

use MToolkit\Core\MDataType;
use MToolkit\Controller\MAbstractWebController;

class MDropDownList extends MAbstractWebController
{

    public function __construct( MAbstractViewController $parent = null )
    {
        parent::__construct( "select", $parent );
    }

    /**
     * @param string $key
     * @param string $value
     * @param boolean $selected
     */
    public function addOption( $key, $value, $selected = false )
    {
        MDataType::mustBeString( $key );
        MDataType::mustBeString( $value );
        MDataType::mustBeBoolean( $selected );

        $option = new MDropDownListItem( $key, $value, $selected );
        $this->addControl( $option );
    }

}

class MDropDownListItem extends MAbstractWebController
{
    /**
     * @var string
     */
    private $key = null;

    /**
     * @var string
     */
    private $value = null;

    /**
     * @var boolean
     */
    private $selected = false;

    /**
     * @param string $key The lavel to show
     * @param string $value
     * @param boolean $selected
     */
    public function __construct( $key, $value, $selected = false )
    {
        MDataType::mustBeString( $key );
        MDataType::mustBeString( $value );
        MDataType::mustBeBoolean( $selected );

        parent::__construct( "option" );

        $this->setKey( $key );
        $this->setValue( $value );
        $this->setSelected( $selected );
        $this->setIsLiteralContent( true );
    }

    public function renderContents()
    {
        parent::appendToOutput( $this->key );
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getSelected()
    {
        return $this->selected;
    }

    public function setKey( $key )
    {
        MDataType::mustBeString( $key );

        $this->key = $key;
        return $this;
    }

    public function setValue( $value )
    {
        parent::setAttribute( "value", $value );
        return $this;
    }

    public function setSelected( $selected )
    {
        if( $selected )
        {
            parent::setAttribute( "selected", "selected" );
        }
        else
        {
            parent::removeAttribute( "selected" );
        }

        return $this;
    }

    public function __set( $name, $value )
    {
        switch( $name )
        {
            case 'key':
                $this->setKey($value);
                break;
            case 'value':
                $this->setValue($value);
                break;
            case 'selected':
                $this->setSelected($value=='true');
                break;
            default:
                parent::__set( $name, $value );
                break;
        }
    }

}

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

require_once __DIR__ . '/MAbstractViewController.php';
require_once __DIR__ . '/../Core/MDataType.php';
require_once __DIR__ . '/../Core/MMap.php';

use MToolkit\Controller\MAbstractViewController;
use MToolkit\Core\MDataType;
use MToolkit\Core\MMap;

class MAbstractWebController extends MAbstractViewController
{
    /**
     * @var MMap
     */
    private $attributes = null;

    /**
     * @var string
     */
    private $tagName = "";

    /**
     * @param string $tagName
     * @param string|null $template
     * @param \MToolkit\Controller\MAbstractViewController $parent
     */
    public function __construct( $tagName, MAbstractViewController $parent = null )
    {
        MDataType::mustBeString( $tagName );

        parent::__construct( null, $parent );
        $this->tagName = $tagName;
        $this->attributes = new MMap();
    }

    /**
     * Gets the name of the control tag.
     * 
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * Sets the text displayed when the mouse pointer hovers over the Web server control.
     * 
     * @param string $toolTip
     * @return \MToolkit\Controller\MAbstractWebController
     */
    public function setToolTip( $toolTip )
    {
        MDataType::mustBeString( $toolTip );

        parent::setAttribute( "title", $toolTip );
        return $this;
    }

    /**
     * Gets the text displayed when the mouse pointer hovers over the Web server control.
     * 
     * @return string
     */
    public function getToolTip()
    {
        return parent::getAttributeValue( "title" );
    }

    /**
     * Sets the access key that allows you to quickly navigate to the Web server control.
     * <b>Note</b>: The way of accessing the shortcut key is varying in different browsers: 
     * <table class="reference notranslate" id="table2">
     * <tr>
     * <th style="width:19%">Browser</th>
     * <th style="width:27%">Windows</th>
     * <th style="width:27%">Linux</th>
     * <th style="width:27%">Mac</th>
     * </tr>
     * <tr>
     * <td>Internet Explorer</td>
     * <td>[Alt] + <em>accesskey</em></td>
     * <td>N/A</td>
     * <td></td>
     * </tr>
     * <tr>
     * <td>Chrome</td>
     * <td>[Alt] + <em>accesskey</em></td>
     * <td>[Alt] + <em>accesskey</em></td>
     * <td>[Control] [Alt] + <em>accesskey</em></td>
     * </tr>
     * <tr>
     * <td>Firefox</td>
     * <td>[Alt] [Shift] + <em>accesskey</em></td>
     * <td>[Alt] [Shift] + <em>accesskey</em></td>
     * <td>[Control] [Alt] + <em>accesskey</em></td>
     * </tr>
     * <tr>
     * <td>Safari</td>
     * <td>[Alt] + <em>accesskey</em></td>
     * <td>N/A</td>
     * <td>[Control] [Alt] + <em>accesskey</em></td>
     * </tr>
     * <tr>
     * <td>Opera</td>
     * <td colspan="3">Opera 15 or newer: [Alt] + <em>accesskey<br></em>Opera 12.1 or older: [Shift] [Esc] + <em>accesskey</em></td>
     * </tr>
     * </table>
     * 
     * <p>However, in most browsers the shortcut can be set to another combination of keys.</p>
     * <p><strong>Tip:</strong> The behavior if more than one element has the same access key differs:</p>
     * <ul>
     * 	<li>IE, Firefox: The next element with the pressed access key will be activated</li>
     * 	<li>Chrome, Safari: The last element with the pressed access key will be activated</li>
     * 	<li>Opera: The first element with the pressed access key will be activated</li>
     * </ul>
     * 
     * @param string $accessKey
     * @return \MToolkit\Controller\MAbstractWebController
     */
    public function setAccessKey( $accessKey )
    {
        MDataType::mustBeString( $accessKey );

        parent::setAttribute( "accesskey", $accessKey );
        return $this;
    }

    /**
     * Gets the access key that allows you to quickly navigate to the Web server control.
     * 
     * @return string
     */
    public function getAccessKey()
    {
        return parent::getAttributeValue( "accesskey" );
    }

    protected function renderAttributes()
    {
        if( $this->getAttributes()->count() <= 0 )
        {
            return;
        }

        $input = iterator_to_array( $this->getAttributes() );
        $output = ' ' . implode( ' ', array_map( function ($v, $k)
                        {
                            return $k . '="' . $v . '"';
                        }, $input, array_keys( $input ) ) );

        $output .= ' id="' . $this->getClientId() . '"';

        $this->appendToOutput( $output );
    }

    protected function render()
    {
        $this->renderBeginTag();
        $this->renderContents();
        $this->renderEndTag();
    }

    /**
     * Renders the contents of the control to the specified writer. <br />
     * Override the RenderContents method to render the contents of the control between the begin and end tags. The default implementation of this method renders any child controls.     * 
     */
    protected function renderContents()
    {
        $this->renderControls();
    }

    /**
     * Renders the HTML opening tag of the control to the specified writer. This method is used primarily by control developers.
     */
    public function renderBeginTag()
    {
        $this->appendToOutput( "<" . $this->tagName . " " );
        $this->renderAttributes();
        $this->appendToOutput( ">" . PHP_EOL );
    }

    /**
     * Renders the HTML closing tag of the control into the specified writer. This method is used primarily by control developers.
     */
    public function renderEndTag()
    {
        $this->appendToOutput( "</" . $this->tagName . ">" . PHP_EOL );
    }

    protected function renderControls()
    {
        foreach( $this->getControls() as /* @var $control MAbstractWebController */ $controller )
        {
            $controller->render();
            $this->appendToOutput( $controller->getOutput() . PHP_EOL );
        }
    }

    public function __set( $name, $value )
    {
        switch( $name )
        {
            case 'cssClass':
                $this->setCssClass( $value );
                break;
            case 'style':
                $this->setStyle( $value );
                break;
            default:
                parent::__set( $name, $value );
                break;
        }
    }

    /**
     * Sets the Cascading Style Sheet (CSS) class rendered by the Web server control on the client.
     * 
     * @param string $cssClass
     * @return \MToolkit\Controller\MAbstractWebController
     */
    public function setCssClass( $cssClass )
    {
        MDataType::mustBeString( $cssClass );

        $this->setAttribute( "class", $cssClass );
        return $this;
    }

    /**
     * Gets the Cascading Style Sheet (CSS) class rendered by the Web server control on the client.
     * 
     * @return string
     */
    public function getCssClass()
    {
        return $this->getAttributeValue( "class" );
    }

    /**
     * @return string|null
     */
    public function getStyle()
    {
        return $this->getAttributeValue( "style" );
    }

    /**
     * @param string $style
     * @return \MToolkit\Controller\MAbstractViewController
     */
    public function setStyle( $style )
    {
        MDataType::mustBeString( $style );

        $this->setAttribute( "style", $style );
        return $this;
    }

    /**
     * Provides object-model access to all attributes declared in the opening tag of an control element.
     * 
     * @return MMap
     */
    public function &getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getAttributeValue( $name )
    {
        return $this->attributes->getValue( strtolower( $name ) );
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function setAttribute( $name, $value )
    {
        $this->attributes->insert( strtolower( $name ), $value );
    }

    public function removeAttribute( $name )
    {
        $this->attributes->remove( $name );
    }

}

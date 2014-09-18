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

require_once __DIR__ . '/../Core/Exception/MTemplateNotFoundException.php';
require_once __DIR__ . '/MAbstractController.php';
require_once __DIR__ . '/../Core/MDataType.php';

use MToolkit\Core\Exception\MTemplateNotFoundException;
use MToolkit\Controller\MAbstractController;
use MToolkit\Core\MDataType;

abstract class MAbstractViewController extends MAbstractController
{
    const POST_SIGNALS = 'MToolkit\Controller\MAbstractViewController\PostSignals';

    /**
     * @var boolean
     */
    private $isVisible = true;

    /**
     * @var boolean
     */
    private $isLiteralContent = false;

    /**
     * The path of the file containing the html of the controller.
     * @var string 
     */
    private $template = null;

    /**
     * It contains the controller rendered.
     * It's valorized after the call the method <i>render()<i>.
     * 
     * @var string|null 
     */
    private $output = "";

    private $charset = 'UTF-8';

    /**
     * @param string $template The path of the file containing the html of the controller.
     * @param MAbstractViewController $parent
     */
    public function __construct( $template, MAbstractViewController $parent = null )
    {
        parent::__construct( $parent );

        $this->template = $template;
    }

    public function init()
    {
        $this->initControls();
    }

    public function initControls()
    {
        if( $this->template == null )
        {
            return;
        }

        // Prints the view in a variable
        if( $this->template != null )
        {
            ob_start();
            include $this->template;
            $rawOutput = ob_get_clean();
        }
        // Get the output
        else
        {
            $rawOutput = $this->getOutput();
        }

        // Filters the control with namespace '<i>php</i>'
        $controls = qp( $rawOutput, ':root > php|*' );

        // For each control, creates an object and calls his methods
        foreach( $controls as $control )
        {
            $className = $control->tag();
            $attributes = $control->attr();
            $controlTemplate = '<?xml version="1.0"?><root>' . $control->innerHtml() . '</root>';

            /* @var $controlObj MAbstractViewController */ $controlObj = new $className( $this );

            // Sets template
            $controlObj->setOutput( $controlTemplate );

            $controlObj->init();

            // Calls the methods
            foreach( $attributes as $key => $value )
            {
                $controlObj->$key = $value;
            }

            $this->getControls()->append($controlObj);
        }
    }

    public function __set( $name, $value )
    {
        switch( $name )
        {
            case 'isLiteralContent':
                $this->setIsLiteralContent( $value == 'true' );
                break;
            case 'isVisible':
                $this->setIsVisible( $value == 'true' );
                break;
            default:
                parent::__set( $name, $value );
                break;
        }
    }

    public function load()
    {
        foreach( $this->getControls() as /* @var $control MAbstractViewController */ $control )
        {
            $control->load();
        }
    }

    /**
     * The method returns <i>$this->output</i>.
     * <i>$this->output</i> contains the controller rendered.
     * It's valorized after the call the method <i>render()<i>.
     * 
     * @return string|null
     */
    protected function getOutput()
    {
        return $this->output;
    }

    /**
     * The method sets <i>$this->output</i>.
     * <i>$this->output</i> contains the controller rendered.
     * 
     * @param string $output
     * @return \MToolkit\Controller\MAbstractViewController
     */
    protected function setOutput( $output )
    {
        MDataType::mustBeString( $output );

        $this->output = $output;

        return $this;
    }

    /**
     * @param string $text
     * @return \MToolkit\Controller\MAbstractViewController
     */
    protected function appendToOutput( $text )
    {
        MDataType::mustBeString( $text );

        $this->output .= $text;

        return $this;
    }

    /**
     * The method returns the path of the html of the controler.
     * 
     * @return string|null
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * The method sets the path of the html of the controler.
     * 
     * @param string $template
     * @return \MToolkit\Controller\AbstractController
     */
    protected function setTemplate( $template )
    {
        MDataType::mustBeString( $template );

        $this->template = $template;
        return $this;
    }

    /**
     * The method sets the visibility of the controller.
     * 
     * @return bool
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * The method returns the visibility of the controller.
     * 
     * @param bool $isVisible
     * @return \MToolkit\Controller\MAbstractViewController
     */
    public function setIsVisible( $isVisible )
    {
        MDataType::mustBeBoolean( $isVisible );

        $this->isVisible = $isVisible;
        return $this;
    }

    /**
     * Gets a value that indicates whether the page is being rendered for the first time or is being loaded in response to a postback.
     * 
     * @return bool
     */
    public static function isPostBack()
    {
        return ( $this->getPost()->count() > 0 );
    }

    /**
     * If template is setted (the path of the html of controller) and if controller is visible,
     * it renders the template.
     */
    protected function render()
    {
        // It's better if the path of the template file is assigned.
        if( $this->template == null || file_exists( $this->template ) == false )
        {
            throw new MTemplateNotFoundException( ( $this->template == null ? 'null' : $this->template ) );
        }

        if( $this->isVisible === false )
        {
            return;
        }

        ob_start();
        include $this->template;
        $this->output .= ob_get_clean();

        $this->renderControls();
    }

    /**
     * This method pre-renderize the controller.
     */
    protected function preRender()
    {
        foreach( $this->getControls() as /* @var $control MAbstractViewController */ $control )
        {
            $control->preRender();
        }
    }

    protected function renderControls()
    {
        foreach( $this->getControls() as /* @var $control MAbstractViewController */ $control )
        {
            $controlId = $control->getId();
            $currentOutput = $this->getOutput();

            ob_start();
            $control->show();
            $controlRendered = ob_get_clean();

            ob_start();
            $qp( $currentOutput, '#' . $controlId )
                    ->after( $controlRendered )
                    ->remove()
                    ->writeHTML();
            $viewRendered = ob_get_clean();

            $this->setOutput( $viewRendered );
        }
    }

    /**
     * This method post-renderize the controller.
     */
    protected function postRender()
    {
        foreach( $this->getControls() as /* @var $control MAbstractViewController */ $control )
        {
            $control->postRender();
        }
    }

    protected function unload()
    {
        foreach( $this->getControls() as /* @var $control MAbstractViewController */ $control )
        {
            $control->unload();
        }

        $this->output = "";
    }

    /**
     * The method calls the render methods (<i>preRender</i>,
     * <i>render</i> and <i>postRender</i>) and it prints to screen 
     * the html of the controller rendered if it is visible.
     */
    public function show()
    {
        if( $this->isVisible === false )
        {
            return;
        }

        $this->init();
        $this->load();
        $this->preRender();
        $this->render();
        $this->postRender();

        echo $this->output;

        $this->unload();
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function setCharset( $charset )
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * Returns the property that determines if the server control holds only literal content.
     * 
     * @return boolean
     */
    public function getIsLiteralContent()
    {
        return $this->isLiteralContent;
    }

    /**
     * Sets the property that determines if the server control holds only literal content.
     * 
     * @param boolean $isLiteralContent
     * @return \MToolkit\Controller\MAbstractController
     */
    public function setIsLiteralContent( $isLiteralContent )
    {
        MDataType::mustBeBoolean( $isLiteralContent );

        $this->isLiteralContent = $isLiteralContent;
        return $this;
    }

}

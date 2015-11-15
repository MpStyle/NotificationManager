<?php

namespace Web;

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

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;
use BusinessLogic\Notification\Notification;
use BusinessLogic\Notification\NotificationBook;
use MToolkit\Controller\CssMedia;
use MToolkit\Controller\CssRel;
use MToolkit\Controller\MAbstractPageController;
use MToolkit\Controller\MAbstractViewController;
use MToolkit\Core\MDataType;

abstract class BasePage extends MAbstractPageController
{
    /**
     * @var Application
     */
    private $currentApp = null;
    private $currentDevice = null;
    private $currentNotification = null;

    public function __construct( $template = null, MAbstractViewController $parent = null )
    {
        parent::__construct( $template, $parent );

        // Avvia il metodo indicato dal valore in post per la chiave action
        $action = $this->getPost()->getValue( "action" );
        if( $action != null )
        {
            $this->$action();
        }
    }

    /**
     * @param int $id
     * @return Application
     */
    public function getCurrentApp( $id )
    {
        if( $this->currentApp == null )
        {
            $applications = ApplicationBook::getApplications( $id );

            if( $applications->count() <= 0 )
            {
                $this->currentApp = new Application( $this );
            }
            else
            {
                $this->currentApp = $applications->at( 0 );
            }
        }

        return $this->currentApp;
    }

    /**
     * 
     * @param int $id
     * @return Notification
     */
    public function getCurrentNotification( $id )
    {
        $notifications = NotificationBook::getNotifications( $id );

        if( $notifications->count() <= 0 )
        {
            $this->currentNotification = new Notification( $this );
        }
        else
        {
            $this->currentNotification = $notifications->at( 0 );
        }
        return $this->currentNotification;
    }

    public function addCss( $href, $media = CssMedia::ALL, $rel = CssRel::STYLESHEET )
    {
        MDataType::mustBeString( $href );
        MDataType::mustBeString( $media );
        MDataType::mustBeString( $rel );

        if( file_exists( __DIR__ . '/' . $href ) === false )
        {
            return;
        }

        parent::addCss( $href, $media, $rel );
    }

    protected function postRender()
    {
        parent::postRender();

        if( ConfigurationBook::getValue( Configuration::MINIFY_HTML ) == "true" )
        {
            parent::setOutput( $this->minifyOutput( parent::getOutput() ) );
        }
    }

    private function minifyOutput( $buffer )
    {
        $re = '%# Collapse ws everywhere but in blacklisted elements.
        (?>             # Match all whitespans other than single space.
          [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
        | \s{2,}        # or two or more consecutive-any-whitespace.
        ) # Note: The remaining regex consumes no text at all...
        (?=             # Ensure we are not in a blacklist tag.
          (?:           # Begin (unnecessary) group.
            (?:         # Zero or more of...
              [^<]++    # Either one or more non-"<"
            | <         # or a < starting a non-blacklist tag.
              (?!/?(?:textarea|pre)\b)
            )*+         # (This could be "unroll-the-loop"ified.)
          )             # End (unnecessary) group.
          (?:           # Begin alternation group.
            <           # Either a blacklist start tag.
            (?>textarea|pre)\b
          | \z          # or end of file.
          )             # End alternation group.
        )  # If we made it here, we are not in a blacklist tag.
        %ix';
        $buffer = preg_replace( $re, " ", $buffer );

        // Rimuove i commenti HTML
        $buffer = preg_replace( '/<!--(.|\s)*?-->/', '', $buffer );

        return $buffer;
    }

}

<?php

namespace Web;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;
use BusinessLogic\Device\Device;
use BusinessLogic\Enum\Post;
use BusinessLogic\Notification\Notification;
use MToolkit\Controller\CssMedia;
use MToolkit\Controller\CssRel;
use MToolkit\Controller\MAbstractPageController;
use MToolkit\Controller\MAbstractViewController;
use MToolkit\Core\MDataType;

class BasePage extends MAbstractPageController
{

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
     * @return Application
     */
    protected function getCurrentApp()
    {
        $applications = ApplicationBook::getApplications( $this->getPost()->getValue( Post::APPS ) );

        if( $applications->count() <= 0 )
        {
            return null;
        }

        return $applications->at( 0 );
    }

    /**
     * @return Device
     */
    protected function getCurrentDevice()
    {
        
    }

    /**
     * @return Notification
     */
    protected function getCurrentNotification()
    {
        
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

<?php

namespace Web;

require_once '../Settings.php';

use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;
use MToolkit\Core\MMap;
use Web\MasterPages\LoggedMasterPage;

class WebServicesV100Response extends BasePage
{
    /**
     * @var MMap
     */
    private $parameters;
    
    private $response;

    public function __construct()
    {
        parent::__construct( __DIR__ . '/WebServicesV100Response.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );

        $this->addJavascript( "Javascripts/WebServicesV100Response.js" );
        $this->addCss( "Styles/WebServicesV100Response.css" );
        
        // init params
        $this->parameters = new MMap( $this->getPost()->__toArray() );
        $this->parameters->remove("methodUrl");
        $this->parameters->remove("methodName");
        
        // do the call
        $url = ConfigurationBook::getValue( Configuration::BACKEND_BASE_URL ) . "/Web/WebServices/" . $this->getPost()->getValue( "methodUrl" );
        $data = $this->parameters->__toArray();

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded",
                'method' => 'POST',
                'content' => http_build_query( $data ),
            ),
        );
        
        $context = stream_context_create( $options );
        $response = file_get_contents( $url, false, $context );

        $this->response = $response;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Returns encoded response of the called web service.
     * 
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    /**
     * Returns decoded response of the called web service.
     * @return string
     */
    public function getDecodedResponse()
    {
        return base64_decode($this->getResponse());
    }
}

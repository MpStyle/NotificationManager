<?php

namespace Web;

require_once '../Settings.php';

use BusinessLogic\Device\DeviceBook;
use DbAbstraction\Device\DeviceAction;
use MToolkit\Model\Sql\MPDOResult;
use Web\MasterPages\LoggedMasterPage;

class Devices extends BasePage
{
    private $devices = null;
    private $pages = 1;
    private $deviceCount=0;

    public function __construct()
    {
        parent::__construct( __DIR__ . '/Devices.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );

        $this->addJavascript( "Javascripts/Devices.js" );
        $this->addCss( "Styles/Devices.css" );

        $deviceId = null;
        $enabled = null;
        $applicationId = $this->getApplicationId();
        $perPage = 10;
        $currentPage = $this->getCurrentPage();

        /* @var $result MPDOResult */ $result = DeviceAction::getPageCount( $deviceId, $enabled, $applicationId, $perPage );
        $this->pages = $result->getData( 0, 'PageCount' );
        
        /* @var $result MPDOResult */ $result = DeviceAction::getCount( $deviceId, $enabled, $applicationId );
        $this->deviceCount = $result->getData( 0, 'DeviceCount' );

        $this->devices = DeviceBook::getDevices( $deviceId, $enabled, $applicationId, $perPage, $currentPage );
    }

    protected function disableDevice()
    {
        DeviceAction::update( (int) $this->getPost()->getValue( "DeviceId" ), 0 );
        $this->getHttpResponse()->redirect( "Devices.php?error=03&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
    }

    protected function enableDevice()
    {
        DeviceAction::update( (int) $this->getPost()->getValue( "DeviceId" ), 1 );
        $this->getHttpResponse()->redirect( "Devices.php?error=03&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
    }

    protected function deleteDevice()
    {
        if( DeviceAction::delete( (int) $this->getPost()->getValue( "DeleteDeviceId" ) ) == null )
        {
            $this->getHttpResponse()->redirect( "Devices.php?error=01&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
        }
        else
        {
            $this->getHttpResponse()->redirect( "Devices.php?error=02&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
        }
    }

    public function getCurrentPage()
    {
        return $this->getGet()->getValue( "page" ) == null ? 0 : (int) $this->getGet()->getValue( "page" );
    }

    public function getApplicationId()
    {
        return $this->getGet()->getValue( "applicationId" ) == null ? null : (int) $this->getGet()->getValue( "applicationId" );
    }

    public function getDevices()
    {
        return $this->devices;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function getDeviceCount()
    {
        return $this->deviceCount;
    }
}

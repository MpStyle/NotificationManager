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

require_once '../Settings.php';

use BusinessLogic\Device\DeviceBook;
use DbAbstraction\Device\DeviceAction;
use MToolkit\Core\MDataType;
use MToolkit\Model\Sql\MPDOResult;
use Web\MasterPages\LoggedMasterPage;

class Devices extends BasePage
{
    private $devices = null;
    private $pages = 1;
    private $deviceCount = 0;

    public function __construct()
    {
        parent::__construct( __DIR__ . '/Devices.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );

        $this->addJavascript( "Javascripts/Devices.js" );
        $this->addCss( "Styles/Devices.css" );

        $deviceId = null;
        $enabled = null;
        $applicationId = $this->getApplicationId() == null ? $this->getApplicationId() : $this->getPost()->getValueByType( "application_id", MDataType::INT );
        $type = $this->getPost()->getValue( "type" ) == "" ? null : $this->getPost()->getValue( "type" );
        $text = $this->getPost()->getValue( "free_search" ) == "" ? null : $this->getPost()->getValue( "free_search" );
        $perPage = 10;
        $currentPage = $this->getCurrentPage();

        $applicationId = $applicationId == null ? $applicationId : (int) $applicationId;

        /* @var $result MPDOResult */ $result = DeviceAction::getPageCount( $deviceId, $enabled, $applicationId, $type, $text, null, $perPage );
        $this->pages = $result->getData( 0, 'PageCount' );

        /* @var $result MPDOResult */ $result = DeviceAction::getCount( $deviceId, $enabled, $applicationId, $type, $text, null );
        $this->deviceCount = $result->getData( 0, 'DeviceCount' );

        $this->devices = DeviceBook::getDevices( $deviceId, $enabled, $applicationId, $type, $text, null, $perPage, $currentPage );
    }

    protected function disableDevice()
    {
        DeviceAction::update( (int) $this->getPost()->getValue( "DeviceId" ), (int) $this->getPost()->getValue( "ApplicationId" ), 0 );
        $this->getHttpResponse()->redirect( "Devices.php?error=03&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
    }

    protected function enableDevice()
    {
        DeviceAction::update( (int) $this->getPost()->getValue( "DeviceId" ), (int) $this->getPost()->getValue( "ApplicationId" ), 1 );
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

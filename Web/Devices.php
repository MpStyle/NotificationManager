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
    private $pagination = null;

    public function __construct()
    {
        parent::__construct( __DIR__ . '/Devices.view.php' );

        parent::setMasterPage( new LoggedMasterPage( $this ) );
        $this->addMasterPagePart( 'content', 'content' );
        $this->addMasterPagePart( 'top-toolbar', 'top-toolbar' );
        $this->addMasterPagePart( 'page-title', 'page-title' );

        $this->addJavascript( "Javascripts/Devices.js" );
        $this->addCss( "Styles/Devices.css" );

        $deviceId = null;
        $enabled = null;
        $applicationId = $this->getApplicationId();
        $type = $this->getGet()->getValue( "type" ) == "" ? null : $this->getGet()->getValue( "type" );
        $text = $this->getGet()->getValue( "free_search" ) == "" ? null : $this->getGet()->getValue( "free_search" );
        $localizationId = $this->getGet()->getValue( "localization-id" ) == "" ? null : (int) $this->getGet()->getValue( "localization-id" );
        $perPage = 10;

        /* @var $result MPDOResult */ $result = DeviceAction::getPageCount( $deviceId, $enabled, $applicationId, $localizationId, $type, $text, null, null, $perPage );
        $this->pages = $result->getData( 0, 'PageCount' );

        $this->pagination = new Views\Pagination( $this->pages, $this );

        /* @var $result MPDOResult */ $result = DeviceAction::getCount( $deviceId, $enabled, $applicationId, $localizationId, $type, $text, null, null );
        $this->deviceCount = $result->getData( 0, 'DeviceCount' );

        $this->devices = DeviceBook::getDevices( $deviceId, $enabled, $applicationId, $localizationId, $type, $text, null, null, $perPage, $this->pagination->getCurrentPage() );
    }

    protected function disableDevice()
    {
        DeviceAction::update( 
            (int) $this->getPost()->getValue( "DeviceId" )
            , (int) $this->getPost()->getValue( "ApplicationId" )
            , 0 
            , $this->getPost()->getValue( "Nickname" )
        );
        
        $this->getHttpResponse()->redirect( "Devices.php?error=03&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
    }

    protected function enableDevice()
    {
        DeviceAction::update( 
            (int) $this->getPost()->getValue( "DeviceId" )
            , (int) $this->getPost()->getValue( "ApplicationId" )
            , 1 
            , $this->getPost()->getValue( "Nickname" )
        );
        $this->getHttpResponse()->redirect( "Devices.php?error=03&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
    }
    
    protected function updateNickName()
    {
        $devices = DeviceBook::getDevices((int) $this->getPost()->getValue( "modal-device-id" ));
        
        if( $devices->count()<=0 )
        {
            $this->getHttpResponse()->redirect( "Devices.php?error=04&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
        }
        
        /* @var $device \BusinessLogic\Device\Device */ $device=$devices->getValue(0);
        
        DeviceAction::update( 
            (int) $device->getId()
            , (int) $device->getApplicationId()
            , (int) $device->getEnabled()
            , $this->getPost()->getValue( "modal-nickname" )
        );
        $this->getHttpResponse()->redirect( "Devices.php?error=03&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
    }

    protected function deleteDevice()
    {
        if( DeviceAction::delete( (int) $this->getPost()->getValue( "model-delete-device-id" ) ) == null )
        {
            $this->getHttpResponse()->redirect( "Devices.php?error=01&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
        }
        else
        {
            $this->getHttpResponse()->redirect( "Devices.php?error=02&applicationId=" . $this->getApplicationId() . "&page=" . $this->getCurrentPage() );
        }
    }

    public function getApplicationId()
    {
        return $this->getGet()->getValue( "applicationId" ) == null ? null : (int) $this->getGet()->getValue( "applicationId" );
    }

    public function getCurrentPage()
    {
        return $this->getGet()->getValue( "page" ) == null ? 0 : (int) $this->getGet()->getValue( "page" );
    }

    /**
     * Returns the list of the devices.
     * 
     * @return \MToolkit\Core\MList
     */
    public function getDevices()
    {
        return $this->devices;
    }

    /**
     * Returns the pagination view.
     * 
     * @return Views\Pagination
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * Returns the total count of pages.
     * 
     * @return int
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Returns the total count of the devices.
     * 
     * @return int
     */
    public function getDeviceCount()
    {
        return $this->deviceCount;
    }

    public function showFilters()
    {
        $get = $_GET;
        unset( $get["page"] );
        unset( $get["error"] );
        foreach( $get as $key => $value )
        {
            if( $value == "" || $value == "All" )
            {
                unset( $get[$key] );
            }
        }

        return (count( $get ) > 0);
    }

}

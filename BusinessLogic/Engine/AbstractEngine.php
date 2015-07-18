<?php

namespace BusinessLogic\Engine;

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


use MToolkit\Core\MList;
use MToolkit\Core\MObject;
use MToolkit\Core\MDataType;

abstract class AbstractEngine extends MObject
{
    /**
     * @var MList
     */
    private $receivers = null;

    /**
     * @var Notification
     */
    private $notification = null;

    /**
     * @var string
     */
    private $response = null;

    public function __construct( MObject $parent = null )
    {
        parent::__construct( $parent );
        $this->receivers = new MList();
    }

    /**
     * Sends the notification to the receivers.
     */
    public abstract function send();

    /**
     * Returns the receivers.
     * 
     * @return MList
     */
    public function &getReceivers()
    {
        return $this->receivers;
    }

    /**
     * Returns the notification to send.
     * 
     * @return AbstractNotification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * Sets the notification to send.
     * 
     * @param \BusinessLogic\Sender\AbstractNotification $notification
     * @return \BusinessLogic\Sender\AbstractSender
     */
    public function setNotification( AbstractNotification $notification )
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * Returns the name of the module.
     * 
     * @return string
     */
    public abstract static function getEngineName();

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param string $response
     * @return \BusinessLogic\Engine\AbstractEngine
     */
    protected function setResponse( $response )
    {
        MDataType::mustBeString( $response );

        $this->response = $response;
        return $this;
    }

}

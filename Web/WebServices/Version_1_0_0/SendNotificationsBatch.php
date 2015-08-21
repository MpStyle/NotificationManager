<?php

namespace Web\WebServices\Version_1_0_0;

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

require_once '../../../Settings.php';

use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;
use BusinessLogic\Engine\GCM\GCMEngine;
use BusinessLogic\Notification\Notification;
use BusinessLogic\Process\ProcessBook;
use MToolkit\Model\Sql\MDbConnection;
use MToolkit\Model\Sql\MPDOQuery;
use MToolkit\Model\Sql\MPDOResult;
use PDO;

class SendNotificationsBatch extends AbstractWebService
{
    private $applicationClientId = null;
    private $username = null;
    private $password = null;
    private $processId = null;

    public function init()
    {
        parent::init();

        $this->username = $this->getGet()->getValue( "username" );
        $this->password = $this->getGet()->getValue( "password" );
        $this->applicationClientId = $this->getPost()->getValue( "applicationClientId" );
        $this->processId = ProcessBook::getNewProcessId();
    }

    public function exec()
    {
        parent::setWebServiceName( __CLASS__ );

        if( $this->username != ConfigurationBook::getValue( Configuration::SCRIPT_USERNAME ) || $this->password != ConfigurationBook::getValue( Configuration::SCRIPT_PASSWORD ) )
        {
            parent::setResult( false );
            parent::setResultDescription( "Invalid mandatory parameters (0)." );
            return;
        }

        set_time_limit( 0 );

        // Mark the notifications to send
        $this->markNotificationToSend();

        // Send the notification of this process
        $this->sendNotification();
    }

    private function markNotificationToSend()
    {
        $query = "CALL processMarkNotificationsToSend(?, ?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );
        $sql->bindValue( $this->processId );
        $sql->bindValue( $this->applicationClientId );
        $sql->exec();
    }

    private function sendNotification()
    {
        $query = "CALL processGetNotifications(?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );
        $sql->bindValue( $this->processId );
        $sql->exec();
        /* @var $result MPDOResult */ $result = $sql->getResult();

        foreach( $result as $row )
        {
            $startRequest = new \DateTime();

            $notification = new Notification();
            $notification->setId($row['Id']);
            $notification->setTitle( $row['Title'] );
            $notification->setShortMessage( $row['ShortMessage'] );
            $notification->setMessage( $row['Message'] );

            $engine = new GCMEngine( $row['GoogleKey'], $this );
            $engine->setNotification( $notification );
            $engine->getReceivers()->appendArray( explode( ',', $row['Receivers'] ) );
            $engine->send();

            $this->markAsSent( $row['Id'] );

            $response = $engine->getResponse();
            $endRequest = new \DateTime();

            $query = "CALL processInsertLog(?, ?, ?, ?, ?)";
            /* @var $connection PDO */
            $connection = MDbConnection::getDbConnection();
            $sql = new MPDOQuery( $query, $connection );
            $sql->bindValue( json_encode( $response ) );
            $sql->bindValue( $startRequest->format( "Y-m-d H:i:s" ) );
            $sql->bindValue( $endRequest->format( "Y-m-d H:i:s" ) );
            $sql->bindValue( $this->processId );
            $sql->bindValue( $row['Id'] );
            $sql->exec();

            parent::setResponse( "ResultDescription", (array) $engine->getResponse() );
        }
    }

    private function markAsSent( $notifciationId )
    {
        $query = "CALL processMarkAsSent(?,?)";
        /* @var $connection PDO */
        $connection = MDbConnection::getDbConnection();
        $sql = new MPDOQuery( $query, $connection );
        $sql->bindValue( $this->processId );
        $sql->bindValue( $notifciationId );
        $sql->exec();
        
        
    }

}

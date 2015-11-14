<?php
namespace Web;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\DeviceBook;
use BusinessLogic\Notification\DeliveryStatus;
use BusinessLogic\Notification\Notification;
use BusinessLogic\Notification\NotificationStatus;

/* @var $this Notifications */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">
    <?php switch( $this->getGet()->getValue( "error" ) ): ?><?php case "00": ?>
            <div class="alert alert-success ErrorMessage-MarginBottom20" role="alert">The Notifications was successfully saved.</div>
            <?php break; ?><?php case "01": ?>
            <div class="alert alert-danger ErrorMessage-MarginBottom20" role="alert">The Notifications was not deleted.</div>
            <?php break; ?><?php case "02": ?>
            <div class="alert alert-success ErrorMessage-MarginBottom20" role="alert">The Notifications was successfully deleted.</div>    
            <?php break; ?>
    <?php endswitch; ?>

    <div id="sub-header">
        <span class="title">
            <span id="toggle_menu" class="glyphicon glyphicon-menu-hamburger hidden-sm hidden-md hidden-lg"></span> 
            Notification list
            <small> (<?php echo $this->getNotificationCount() ?>)</small>
        </span>

        <div class="btn-group" role="group" id="top-toolbar">
            <a href="" data-toggle="tooltip" data-placement="bottom" title="Refresh the page">
                <span class="glyphicon glyphicon-refresh"></span> 
            </a>
            <a href="#" class="ShowFilter" data-toggle="tooltip" data-placement="bottom" title="Show/hide the filters">
                <span class="glyphicon glyphicon-search"></span> 
            </a>
        </div>
    </div>

    <a href="EditNotification.php" 
       id="add-button" data-toggle="tooltip" data-placement="bottom" title="Create new notification">
        <span class="glyphicon glyphicon-plus"></span> 
    </a>

    <div id="SubContainer">
        <form method="post" class="form-horizontal FiltersForm">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Application:</label>
                        <div class="col-sm-10">
                            <select name="application_id" class="form-control">
                                <option></option>
                                <?php foreach( ApplicationBook::getApplications() as /* @var $application Application */ $application ): ?>
                                    <option value="<?php echo $application->getId() ?>" <?php echo ($this->getPost()->getValue( "application_id" )==$application->getId() ? "selected" : ""); ?>><?php echo $application->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Device type:</label>
                        <div class="col-sm-10">
                            <select name="type" class="form-control">
                                <option></option>
                                <?php foreach( DeviceBook::getDeviceType() as $deviceType ): ?>
                                    <option value="<?php echo $deviceType ?>" <?php echo ($this->getPost()->getValue( "type" )==$deviceType ? "selected" : ""); ?>><?php echo $deviceType ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Notification status:</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option></option>
                                <option value="<?php echo NotificationStatus::DRAFT ?>" <?php echo ($this->getPost()->getValue( "status" )==NotificationStatus::DRAFT ? "selected" : "") ?>>Draft</option>
                                <option value="<?php echo NotificationStatus::APPROVED ?>" <?php echo ($this->getPost()->getValue( "status" )==NotificationStatus::APPROVED ? "selected" : "") ?>>Approved</option>
                                <option value="<?php echo NotificationStatus::CLOSED ?>" <?php echo ($this->getPost()->getValue( "status" )==NotificationStatus::CLOSED ? "selected" : "") ?>>Closed</option>
                            </select>
                        </div>
                    </div>

                    <div class="pull-right">

                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-search"></span> 
                            Search
                        </button>

                        <a href="?page=<?php echo $this->getGet()->getKey( "page" ) ?>" class="btn btn-default">
                            <span class="glyphicon glyphicon-remove"></span>
                            Clear
                        </a>

                    </div>
                </div>
            </div>
        </form>



        <table class="EntityList" data-resizable-columns-id="notifications-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Application</th>
                    <th>Notification</th>
                    <th class="hidden-xs">Device type</th>
                    <th class="hidden-xs hidden-sm">Status</th>
                    <!--<th class="hidden-xs hidden-sm" data-resizable-column-id="ReachedDevices">Reached devices</th>-->
                    <th class="hidden-xs hidden-sm">Last update</th>
                    <th class="buttons-col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $this->getNotifications() as /* @var $notification Notification */ $notification ): ?>
                    <tr class="<?php echo $this->getRowClass( (int) $notification->getId() ) ?>">
                        <td><?php echo $notification->getId() ?></td>
                        <td><?php echo $notification->getApplicationName() ?></td>
                        <td>
                            <b><?php echo utf8_encode( $notification->getTitle() ) ?></b> - <?php echo utf8_encode( $notification->getMessage() ) ?>
                        </td>
                        <td class="hidden-xs"><?php echo $notification->getDeviceType()=='' ? 'All' : $notification->getDeviceType() ?></td>
                        <td class="hidden-xs hidden-sm">
                            <?php if( $notification->getStatusId()==NotificationStatus::APPROVED ): ?>
                                Approved
                            <?php elseif( $notification->getStatusId()==NotificationStatus::CLOSED ): ?>
                                Closed
                            <?php else: ?>
                                Draft
                            <?php endif; ?>
                        </td>
                        <!--<td class="hidden-xs hidden-sm"><?php echo $notification->getReachedDevices() ?></td>-->
                        <td class="hidden-xs hidden-sm"><?php echo $notification->getUpdateDate() ?></td>
                        <td>
                            <form method="post">
                                <div class="btn-group" role="group">
                                    <?php if( $notification->getStatusId()==NotificationStatus::CLOSED ): ?>
                                        <a href="EditNotification.php?id=<?php echo $notification->getId() ?>" class="btn btn-default" title="Show">
                                            <span class="glyphicon glyphicon-eye-open"></span> 
                                        </a>
                                    <?php else: ?>
                                        <a href="EditNotification.php?id=<?php echo $notification->getId() ?>" class="btn btn-default" title="Edit">
                                            <span class="glyphicon glyphicon-edit"></span> 
                                        </a>
                                    <?php endif; ?>
                                    <button id="DeleteNotificationButton" 
                                            type="button" 
                                            title="Delete"
                                            class="btn btn-danger" 
                                            <?php echo ($notification->getDeliveryStatus()==DeliveryStatus::SENDING ? "disabled" : ""); ?>
                                            data-toggle="modal" data-target=".delete-notification-modal">
                                        <span class="glyphicon glyphicon-remove"></span> 
                                    </button>
                                </div>

                                <input type="hidden" class="notification-id" name="NotificationId" value="<?php echo $notification->getId() ?>" />
                                <input type="hidden" class="notification-title" name="NotificationTitle" value="<?php echo $notification->getTitle() ?>" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <?php $this->getPagination()->show() ?>
    </div>

    <div class="modal fade delete-notification-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Do yuo want to delete notification "<span class="modal-notification-title"></span>"?
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="action" value="deleteNotification">Delete</button>

                        <input type="hidden" name="modal-notification-id" class="modal-notification-id" value="" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
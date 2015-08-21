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

    <div id="SubHeader">
        <h2 class="Title">
            <span id="toggle_menu" class="glyphicon glyphicon-menu-hamburger hidden-sm hidden-md hidden-lg"></span> 
            <span class="glyphicon glyphicon-envelope hidden-xs"></span> Notification list
            <small> (<?php echo $this->getNotificationCount() ?>)</small>
        </h2>

        <form method="post" class="pull-right AddEntityForm">
            <div class="btn-group" role="group" id="TopToolbar">
                <a href="" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Refresh the page">
                    <span class="glyphicon glyphicon-refresh"></span> 
                    <span class="hidden-xs hidden-sm">Refresh page</span>
                </a>
                <span class="btn btn-default ShowFilter" data-toggle="tooltip" data-placement="bottom" title="Show/hide the filters">
                    <span class="glyphicon glyphicon-search"></span> 
                    <span class="hidden-xs hidden-sm">Show/hide filter</span>
                </span>
                <button name="action" value="createNewNotification" class="btn btn-default AddButton" data-toggle="tooltip" data-placement="bottom" title="Create new notification">
                    <span class="glyphicon glyphicon-plus"></span> 
                    <span class="hidden-xs hidden-sm">Create new notification</span>
                </button>
            </div>
        </form>
    </div>

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
                                    <option value="<?php echo $application->getId() ?>" <?php echo ($this->getPost()->getValue( "application_id" ) == $application->getId() ? "selected" : ""); ?>><?php echo $application->getName() ?></option>
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
                                    <option value="<?php echo $deviceType ?>" <?php echo ($this->getPost()->getValue( "type" ) == $deviceType ? "selected" : ""); ?>><?php echo $deviceType ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Notification status:</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option></option>
                                <option value="<?php echo NotificationStatus::DRAFT ?>" <?php echo ($this->getPost()->getValue( "status" ) == NotificationStatus::DRAFT ? "selected" : "") ?>>Draft</option>
                                <option value="<?php echo NotificationStatus::APPROVED ?>" <?php echo ($this->getPost()->getValue( "status" ) == NotificationStatus::APPROVED ? "selected" : "") ?>>Approved</option>
                                <option value="<?php echo NotificationStatus::CLOSED ?>" <?php echo ($this->getPost()->getValue( "status" ) == NotificationStatus::CLOSED ? "selected" : "") ?>>Closed</option>
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



        <table class="table table-striped table-bordered EntityList" data-resizable-columns-id="notifications-table">
            <thead>
                <tr>
                    <th data-resizable-column-id="Application">Application</th>
                    <th data-resizable-column-id="Title">Title</th>
                    <th class="hidden-xs hidden-sm" data-resizable-column-id="Content">Content</th>
                    <th class="hidden-xs" data-resizable-column-id="DeviceType">Device type</th>
                    <th class="hidden-xs hidden-sm" data-resizable-column-id="Status">Status</th>
                    <th class="hidden-xs hidden-sm" data-resizable-column-id="ReachedDevices">Reached devices</th>
                    <th class="hidden-xs hidden-sm" data-resizable-column-id="LastUpdate">Last update</th>
                    <th data-resizable-column-id="NotificationOther"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $this->getNotifications() as /* @var $notification Notification */ $notification ): ?>
                    <tr class="<?php echo $this->getRowClass( (int) $notification->getId() ) ?>">
                        <td><?php echo $notification->getApplicationName() ?></td>
                        <td><?php echo $notification->getTitle() ?></td>
                        <td class="hidden-xs hidden-sm">
                            <p><strong>Short message: </strong><?php echo $notification->getShortMessage() ?></p>
                            <p><strong>Message: </strong><?php echo $notification->getMessage() ?></p>
                        </td>
                        <td class="hidden-xs"><?php echo $notification->getDeviceType() == '' ? 'All' : $notification->getDeviceType() ?></td>
                        <td class="hidden-xs hidden-sm">
                            <?php if( $notification->getStatusId() == NotificationStatus::APPROVED ): ?>
                                Approved
                            <?php elseif( $notification->getStatusId() == NotificationStatus::CLOSED ): ?>
                                Closed
                            <?php else: ?>
                                Draft
                            <?php endif; ?>
                        </td>
                        <td class="hidden-xs hidden-sm"><?php echo $notification->getReachedDevices() ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo $notification->getUpdateDate() ?></td>
                        <td>
                            <form method="post">
                                <div class="btn-group" role="group">
                                    <a href="EditNotification.php?id=<?php echo $notification->getId() ?>" class="btn btn-default">
                                        <?php if( $notification->getStatusId() == NotificationStatus::CLOSED ): ?>
                                            <span class="glyphicon glyphicon-eye-open"></span> 
                                            <span class="hidden-xs hidden-sm hidden-md">Show</span>
                                        <?php else: ?>
                                            <span class="glyphicon glyphicon-edit"></span> 
                                            <span class="hidden-xs hidden-sm hidden-md">Edit</span>
                                        <?php endif; ?>
                                    </a>
                                    <button id="DeleteNotificationButton" 
                                            type="button" 
                                            class="btn btn-danger" 
                                            <?php echo ($notification->getDeliveryStatus() == DeliveryStatus::SENDING ? "disabled" : ""); ?>
                                            data-toggle="modal" data-target=".DeleteNotificationModal">
                                        <span class="glyphicon glyphicon-remove"></span> 
                                        <span class="hidden-xs hidden-sm hidden-md">Delete</span>
                                    </button>
                                </div>

                                <input type="hidden" class="NotificationId" name="NotificationId" value="<?php echo $notification->getId() ?>" />
                                <input type="hidden" class="NotificationTitle" name="NotificationTitle" value="<?php echo $notification->getTitle() ?>" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <ul class="pagination">
            <?php for( $i = 0; $i < $this->getPages(); $i++ ): ?>
                <li class="<?php echo ($this->getCurrentPage() == $i ? "active" : "") ?>"><a href="?applicationId=<?php $this->getApplicationId() ?>&page=<?php echo $i ?>"><?php echo $i + 1 ?></a></li>
            <?php endfor; ?>
        </ul>
    </div>

    <div class="modal fade DeleteNotificationModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Do yuo want to delete notification "<span class="NotificationTitle"></span>"?
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="action" value="deleteNotification">Delete</button>

                        <input type="hidden" name="NotificationId" class="NotificationId" value="" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
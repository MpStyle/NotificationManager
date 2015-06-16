<?php
namespace Web;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\DeviceBook;
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

    <h2 class="col-md-6 Title">Notification list</h2>
    <span class="pull-right ShowFilter"><span class="glyphicon glyphicon-search"></span>Show filter</span>

    <form method="post" class="FiltersForm">
        <div class="form-group">
            <label>Application:</label>
            <select name="application_id" class="form-control">
                <option></option>
                <?php foreach( ApplicationBook::getApplications() as /* @var $application Application */ $application ): ?>
                    <option value="<?php echo $application->getId() ?>" <?php echo ($this->getPost()->getValue( "application_id" ) == $application->getId() ? "selected" : ""); ?>><?php echo $application->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Type:</label>
            <select name="type" class="form-control">
                <option></option>
                <?php foreach( DeviceBook::getDeviceType() as $deviceType ): ?>
                    <option value="<?php echo $deviceType ?>" <?php echo ($this->getPost()->getValue( "type" ) == $deviceType ? "selected" : ""); ?>><?php echo $deviceType ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="pull-right">

            <button type="submit" class="btn btn-primary">
                Search
            </button>

            <span class="btn btn-default">Clear</span>

        </div>
    </form>
    
    <form method="post" class="AddEntityForm">
        <button name="action" value="createNewNotification" class="btn btn-default AddButton">
            <span class="glyphicon glyphicon-plus"></span>
            Create new notification
        </button>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-bordered EntityList">
            <thead>
                <tr>
                    <td>Application</td>
                    <td>Title</td>
                    <td>Short message/Message</td>
                    <td>Device type</td>
                    <td>Status</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $this->getNotifications() as /* @var $notification Notification */ $notification ): ?>
                    <tr class="<?php echo ($notification->getStatus() == NotificationStatus::DRAFT? : 'warning'); ?>">
                        <td><?php echo $notification->getApplicationName() ?></td>
                        <td><?php echo $notification->getTitle() ?></td>
                        <td>
                            <p><?php echo $notification->getShortMessage() ?></p>
                            <p><?php echo $notification->getMessage() ?></p>
                        </td>
                        <td><?php echo $notification->getDeviceType() ?></td>
                        <td><?php echo $notification->getStatus() ?></td>
                        <td>
                            <form method="post">
                                <a href="EditNotification.php?id=<?php echo $notification->getId() ?>" class="btn btn-default">Edit</a>
                                <button id="DeleteNotificationButton" type="button" class="btn btn-danger" data-toggle="modal" data-target=".DeleteNotificationModal">Delete</button>

                                <input type="hidden" class="NotificationId" name="NotificationId" value="<?php echo $notification->getIconId() ?>" />
                                <input type="hidden" class="NotificationTitle" name="NotificationTitle" value="<?php echo $notification->getTitle() ?>" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <ul class="pagination">
        <?php for( $i = 0; $i < $this->getPages(); $i++ ): ?>
            <li class="<?php echo ($this->getCurrentPage() == $i ? "active" : "") ?>"><a href="?applicationId=<?php $this->getApplicationId() ?>&page=<?php echo $i ?>"><?php echo $i + 1 ?></a></li>
        <?php endfor; ?>
    </ul>

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
<?php
namespace Web;

use BusinessLogic\Notification\NotificationStatus;

/* @var $this EditNotification */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">

    <?php switch( $this->getGet()->getValue( "error" ) ): ?><?php case "01": ?>
            <div class="alert alert-danger ErrorMessage-MarginBottom20" role="alert">Error: the app was not saved correctly.</div>
    <?php endswitch; ?>

    <h2>
        <?php if( $this->getGet()->getValue( "id" ) == null ): ?>
            Create notification
        <?php else: ?>
            Edit notification
        <?php endif; ?>
    </h2>

    <div class="FormContainer">
        <form method="post">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="notification_title" value="<?php echo $this->getCurrentNotification()->getTitle() ?>" class="form-control" placeholder="Enter the notification title" maxlength="100" required="required" />
            </div>

            <div class="form-group">
                <label>Message:</label>
                <input type="text" name="notification_message" value="<?php echo $this->getCurrentNotification()->getMessage() ?>" class="form-control" placeholder="Enter the notification message" />
            </div>

            <div class="form-group">
                <label>Status (draft or approved):</label>
                <select name="notification_status" class="form-control" required="required">
                    <option></option>
                    <option value="<?php echo NotificationStatus::DRAFT ?>" <?php echo ($this->getCurrentNotification()->getStatus() == NotificationStatus::DRAFT ? "selected" : "") ?>><?php echo NotificationStatus::DRAFT ?></option>
                    <option value="<?php echo NotificationStatus::APPROVED ?>" <?php echo ($this->getCurrentNotification()->getStatus() == NotificationStatus::APPROVED ? "selected" : "") ?>><?php echo NotificationStatus::APPROVED ?></option>
                </select>
            </div>

            <div class="form-group">
                <label>Device type:</label>
                <select name="device_type" class="form-control">
                    <option>Everyone</option>
                    <?php foreach( \DbAbstraction\Device\DeviceAction::getDeviceType() as $deviceType ): ?>
                        <option value="<?php echo $deviceType["Name"] ?>" <?php echo ($deviceType["Name"] == $this->getCurrentNotification()->getDeviceType() ? "selected" : "") ?>><?php echo $deviceType["Name"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Validation dates:</label>
                <div class="row">
                    <div class='col-md-6'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' class="form-control" placeholder="Start date" name="start_date" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' class="form-control" placeholder="End date" name="end_date" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pull-right">

                <button type="submit" name="action" value="confirmEdit" class="btn btn-primary">
                    <?php if( $this->getGet()->getValue( "id" ) == null ): ?>
                        Create
                    <?php else: ?>
                        Save
                    <?php endif; ?>
                </button>

                <a href="Notifications.php" class="btn btn-default">Cancel</a>

            </div>
        </form>
    </div>
</div>
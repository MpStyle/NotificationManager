<?php
namespace Web;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Date\DateBook;
use BusinessLogic\Link\Link;
use BusinessLogic\Link\LinkBook;
use BusinessLogic\Link\LinkType;
use BusinessLogic\Notification\NotificationStatus;
use DbAbstraction\Device\DeviceAction;

/* @var $this EditNotification */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">

    <?php switch( $this->getGet()->getValue( "error" ) ): ?><?php case "01": ?>
            <div class="alert alert-danger ErrorMessage-MarginBottom20" role="alert">Error: the app was not saved correctly.</div>
    <?php endswitch; ?>

    <h2 class="Title">
        <?php if( $this->getGet()->getValue( "id" ) == null ): ?>
            Create notification
        <?php else: ?>
            Edit notification
        <?php endif; ?>
    </h2>

    <div class="FormContainer">
        <form method="post">
            <div class="form-group">
                <label>Application:</label>
                <select id="ApplicationId" name="application_id" class="form-control" required="required">
                    <option value="" disabled selected>Select an application</option>
                    <?php foreach( ApplicationBook::getApplications() as /* @var $application Application */ $application ): ?>
                        <option value="<?php echo $application->getId() ?>" <?php echo ($this->getCurrentNotification()->getApplicationId() == $application->getId() ? "selected" : "") ?>><?php echo $application->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="notification_title" value="<?php echo $this->getCurrentNotification()->getTitle() ?>" class="form-control" placeholder="Enter the notification title" maxlength="100" required="required" />
            </div>

            <div class="form-group">
                <label>Short message:</label>
                <input type="text" name="notification_short_message" value="<?php echo $this->getCurrentNotification()->getShortMessage() ?>" class="form-control" placeholder="Enter the notification short message" required="required" />
            </div>

            <div class="form-group">
                <label>Message:</label>
                <textarea name="notification_message" class="form-control" rows="10" placeholder="Enter the notification message"><?php echo $this->getCurrentNotification()->getMessage() ?></textarea>
            </div>

            <div class="form-group">
                <label>Link type:</label>
                <select id="LinkType" name="link_type" class="form-control" required="required">
                    <option value="" disabled></option>
                    <option value="<?php echo LinkType::INTERNAL ?>" <?php echo ($this->getCurrentNotification()->getLinkType() == LinkType::INTERNAL ? "selected" : "") ?>><?php echo LinkType::INTERNAL ?></option>
                    <option value="<?php echo LinkType::EXTERNAL ?>" <?php echo ($this->getCurrentNotification()->getLinkType() == LinkType::EXTERNAL ? "selected" : "") ?>><?php echo LinkType::EXTERNAL ?></option>
                </select>
            </div>

            <div id="InternalLinkGroup" class="form-group <?php echo ($this->getCurrentNotification()->getLinkType() == LinkType::INTERNAL ? "ShowLinkGroup" : "") ?>">
                <label>Internal link:</label>
                <select name="internal_link" class="form-control" id="InternalLinks">
                    <option value="" disabled selected></option>
                    <?php foreach( LinkBook::get( null, (int) $this->getCurrentNotification()->getApplicationId() ) as /* @var $link Link */ $link ): ?>
                        <option value="<?php echo $link->getName() ?>" <?php echo ($link->getName() == $this->getCurrentNotification()->getLink() ? "selected" : ""); ?>><?php echo $link->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="ExternalLinkGroup" class="form-group <?php echo ($this->getCurrentNotification()->getLinkType() == LinkType::EXTERNAL ? "ShowLinkGroup" : "") ?>">
                <label>External link:</label>
                <input type="text" name="extenal_link" value="<?php echo $this->getCurrentNotification()->getLink() ?>" class="form-control" placeholder="Enter the URL" />
            </div>

            <div class="form-group">
                <label>Status (draft or approved):</label>
                <select name="notification_status" class="form-control" required="required">
                    <option value="" disabled>Is a draft or an approved notification?</option>
                    <option value="<?php echo NotificationStatus::DRAFT ?>" <?php echo ($this->getCurrentNotification()->getStatus() == NotificationStatus::DRAFT ? "selected" : "") ?>>Draft</option>
                    <option value="<?php echo NotificationStatus::APPROVED ?>" <?php echo ($this->getCurrentNotification()->getStatus() == NotificationStatus::APPROVED ? "selected" : "") ?>>Approved</option>
                </select>
            </div>

            <div class="form-group">
                <label>Device type:</label>
                <select name="device_type" class="form-control">
                    <option>Everyone</option>
                    <?php foreach( DeviceAction::getDeviceType() as $deviceType ): ?>
                        <option value="<?php echo $deviceType["Name"] ?>" <?php echo ($deviceType["Name"] == $this->getCurrentNotification()->getDeviceType() ? "selected" : "") ?>><?php echo $deviceType["Name"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Validation dates:</label>
                <div class="row">
                    <div class='col-md-6'>
                        <div class="form-group">
                            <div class='input-group date' id='StartDate'>
                                <input type='text' class="form-control" placeholder="Start date" name="start_date" value="<?php echo DateBook::fromDatabaseDateToDatePickerDate( $this->getCurrentNotification()->getStartDateValidation() ) ?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class="form-group">
                            <div class='input-group date' id='EndDate'>
                                <input type='text' class="form-control" placeholder="End date" name="end_date" value="<?php echo DateBook::fromDatabaseDateToDatePickerDate( $this->getCurrentNotification()->getEndDateValidation() ) ?>" />
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
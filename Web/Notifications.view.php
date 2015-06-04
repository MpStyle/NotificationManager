<?php
namespace Web;

use BusinessLogic\Notification\Notification;

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

    <h2>Notification list</h2>
    
    <form method="post">
        <button name="action" value="createNewNotification" class="btn btn-default">
            <span class="glyphicon glyphicon-plus"></span>
            Create new notification
        </button>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-bordered EntityList">
            <thead>
                <tr>
                    <td>Title</td>
                    <td>CreationDate</td>
                    <td>UpdateDate</td>
                    <td>Status</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $this->getNotifications() as /* @var $notification Notification */ $notification ): ?>
                    <tr class="<?php echo ($notification->getStatus()? : 'warning'); ?>">
                        <td><?php echo $notification->getTitle() ?></td>
                        <td><?php echo $notification->getCreationDate() ?></td>
                        <td><?php echo $notification->getUpdateDate() ?></td>
                        <td><?php echo $notification->getStatus() ?></td>
                        <td>
                            <form method="post">
                                <button id="DeleteNotificationButton" type="button" class="btn btn-danger" data-toggle="modal" data-target=".DeleteNotificationModal">Delete</button>

                                <input type="hidden" class="NotificationId" name="NotificationId" value="<?php echo $notification->getMobileId() ?>" />
                                <input type="hidden" class="NotificationTitle" name="NotificationTitle" value="<?php echo $notification->getId() ?>" />
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
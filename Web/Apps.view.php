<?php
namespace Web;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;

/* @var $this Apps */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">
    <?php switch( $this->getGet()->getValue( "error" ) ): ?><?php case "00": ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The app was successfully saved.</div>
            <?php break; ?><?php case "01": ?>
            <div class="alert alert-danger ErrorMessage ErrorMessage-MarginBottom20" role="alert">The app was not deleted.</div>
            <?php break; ?><?php case "02": ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The app was successfully deleted.</div>    
            <?php break; ?>
    <?php endswitch; ?>

    <h2>App list <small>(<?php echo $this->getApplicationCount() ?>)</small></h2>

    <form method="post">
        <button name="action" value="createNewApp" class="btn btn-default AddButton">
            <span class="glyphicon glyphicon-plus"></span>
            Create new app
        </button>
    </form>


    <table class="table table-striped table-bordered EntityList">
        <thead>
            <tr>
                <td class="NoWrap">App name</td>
                <td class="hidden-xs">Client ID <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Use these codes as perameters in the web services"></span></td>
                <td class="hidden-xs hidden-sm">Last update</td>
                <td class="hidden-xs hidden-sm">Related to this app</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach( ApplicationBook::getApplications() as /* @var $application Application */ $application ): ?>
                <tr>
                    <td class="NoWrapEllipsis"><?php echo $application->getName() ?></td>
                    <td class="hidden-xs">
                        <div class="ClientIdContainer"><b>Client ID</b>: <?php echo $application->getClientId() ?></div>
                        <div class="SecretIdContainer"><b>Secret ID</b>: <?php echo $application->getSecretId() ?></div>
                    </td>
                    <td class="hidden-xs hidden-sm">
                        <?php echo $application->getUpdateDate() ?>
                    </td>
                    <td class="NoWrap hidden-xs hidden-sm">
                        <a href="Devices.php?applicationId=<?php echo $application->getId() ?>" class="btn btn-default">Devices</a>
                        <a href="Notifications.php?applicationId=<?php echo $application->getId() ?>" class="btn btn-default">Notifications</a>
                    </td>
                    <td class="NoWrap">
                        <form method="post">
                            <a href="EditApp.php?id=<?php echo $application->getId() ?>" class="btn btn-default">Edit</a>
                            <button id="DeleteApplicationButton" type="button" class="btn btn-danger" data-toggle="modal" data-target=".DeleteApplicationModal">Delete</button>

                            <input type="hidden" class="ApplicationName" value="<?php echo $application->getName() ?>" />
                            <input type="hidden" class="ApplicationId" value="<?php echo $application->getId() ?>" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="modal fade DeleteApplicationModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Do yuo want to delete app "<span class="ApplicationName"></span>"?
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="action" value="deleteApplication">Delete</button>

                        <input type="hidden" name="ApplicationId" class="ApplicationId" value="" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
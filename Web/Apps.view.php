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

    <div id="SubHeader">
        <h2 class="Title">
            <span id="toggle_menu" class="glyphicon glyphicon-menu-hamburger hidden-sm hidden-md hidden-lg"></span> 
            App list 
            <small>(<?php echo $this->getApplicationCount() ?>)</small>
        </h2>

        <form method="post" class="pull-right">
            <div class="btn-group" role="group" id="TopToolbar" data-toggle="tooltip" data-placement="top" title="Refresh the page">
                <a href="" class="btn btn-default">
                    <span class="glyphicon glyphicon-refresh"></span> 
                    <span class="hidden-xs hidden-sm">Refresh page</span>
                </a>
                <button name="action" value="createNewApp" class="btn btn-default AddButton" data-toggle="tooltip" data-placement="top" title="Create new application">
                    <span class="glyphicon glyphicon-plus"></span> 
                    <span class="hidden-xs hidden-sm">Create new app</span>
                </button>
            </div>
        </form>
    </div>

    <div id="SubContainer">
        <table class="table table-striped table-bordered EntityList" data-resizable-columns-id="apps-table">
            <thead>
                <tr>
                    <th class="NoWrap" data-resizable-column-id="AppName">App name</th>
                    <th class="hidden-xs" data-resizable-column-id="ClientId">Client ID <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Use these codes as perameters in the web services"></span></th>
                    <th class="hidden-xs hidden-sm" data-resizable-column-id="LastUpdate">Last update</th>
                    <th class="hidden-xs hidden-sm" data-resizable-column-id="RelatedToTheApp">Related to this app</th>
                    <th data-resizable-column-id="Other"></th>
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
                            <div class="btn-group" role="group">
                                <a href="Devices.php?applicationId=<?php echo $application->getId() ?>" class="btn btn-default">Devices</a>
                                <a href="Notifications.php?applicationId=<?php echo $application->getId() ?>" class="btn btn-default">Notifications</a>
                            </div>
                        </td>
                        <td class="NoWrap">
                            <form method="post">
                                <div class="btn-group" role="group">
                                    <a href="EditApp.php?id=<?php echo $application->getId() ?>" class="btn btn-default">Edit</a>
                                    <button id="DeleteApplicationButton" type="button" class="btn btn-danger" data-toggle="modal" data-target=".DeleteApplicationModal">Delete</button>
                                </div>

                                <input type="hidden" class="ApplicationName" value="<?php echo $application->getName() ?>" />
                                <input type="hidden" class="ApplicationId" value="<?php echo $application->getId() ?>" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


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
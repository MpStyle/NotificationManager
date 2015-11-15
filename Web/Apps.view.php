<?php
namespace Web;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;

/* @var $this Apps */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<span id="page-title">
    App list 
    <small>(<?php echo $this->getApplicationCount() ?>)</small>
</span>

<div class="btn-group" role="group" id="top-toolbar">
    <a href="" data-toggle="tooltip" data-placement="bottom" title="Refresh the page">
        <span class="glyphicon glyphicon-refresh"></span> 
    </a>            
</div>

<div id="content">
    <?php switch( $this->getGet()->getValue( "error" ) ): ?><?php case "00": ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The app was successfully saved.</div>
            <?php
            break;
        case "01":
            ?>
            <div class="alert alert-danger ErrorMessage ErrorMessage-MarginBottom20" role="alert">The app was not deleted.</div>
            <?php
            break;
        case "02":
            ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The app was successfully deleted.</div>    
            <?php break; ?>
    <?php endswitch; ?>

    <a href="EditApp.php" id="add-button" data-toggle="tooltip" 
       data-placement="bottom" title="Create new application">
        <span class="glyphicon glyphicon-plus"></span> 
    </a>

    <div id="SubContainer">
        <table class="EntityList">
            <thead>
                <tr>
                    <th class="NoWrap">App name</th>
                    <th class="hidden-xs">Client ID <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Use these codes as perameters in the web services"></span></th>
                    <th class="hidden-xs hidden-sm">Last update</th>
                    <th class="related-header hidden-xs hidden-sm">Related to this app</th>
                    <th class="edit-header"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( ApplicationBook::getApplications() as /* @var $application Application */ $application ): ?>
                    <tr>
                        <td class="NoWrapEllipsis"><?php echo $application->getName() ?></td>
                        <td class="hidden-xs">
                            <div class="client-id-container"><?php echo $application->getClientId() ?></div>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <?php echo $application->getUpdateDate() ?>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <div class="btn-group NoWrap related-group" role="group">
                                <a href="Devices.php?applicationId=<?php echo $application->getId() ?>" 
                                   class="btn btn-default" title="Devices">
                                    <span class="glyphicon glyphicon-phone"></span> 
                                </a>
                                <a href="Notifications.php?applicationId=<?php echo $application->getId() ?>" 
                                   class="btn btn-default" title="Notifications">
                                    <span class="glyphicon glyphicon-envelope"></span> 
                                </a>
                            </div>
                        </td>
                        <td>
                            <form method="post">
                                <div class="btn-group NoWrap edit-group" role="group">
                                    <a href="EditApp.php?id=<?php echo $application->getId() ?>" 
                                       class="btn btn-default" title="Edit">
                                        <span class="glyphicon glyphicon-edit"></span> 
                                    </a>
                                    <button id="DeleteApplicationButton" type="button" 
                                            class="btn btn-danger" data-toggle="modal" 
                                            data-target=".DeleteApplicationModal" title="Delete">
                                        <span class="glyphicon glyphicon-remove"></span> 
                                    </button>
                                </div>

                                <input type="hidden" class="application-name" value="<?php echo $application->getName() ?>" />
                                <input type="hidden" class="application-id" value="<?php echo $application->getId() ?>" />
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
                    Do yuo want to delete app "<span class="modal-application-name"></span>"?
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="action" value="deleteApplication">Delete</button>

                        <input type="hidden" name="ApplicationId" class="modal-application-id" value="" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
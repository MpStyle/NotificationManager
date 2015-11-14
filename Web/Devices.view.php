<?php
namespace Web;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\Device;
use BusinessLogic\Device\DeviceBook;

/* @var $this Devices */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">
    <?php switch( $this->getGet()->getValue( "error" ) ): ?><?php case "00": ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The device was successfully saved.</div>
            <?php break; ?><?php case "01": ?>
            <div class="alert alert-danger ErrorMessage ErrorMessage-MarginBottom20" role="alert">The device was not deleted.</div>
            <?php break; ?><?php case "02": ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The device was successfully deleted.</div>    
            <?php break; ?><?php case "03": ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The device was successfully updated.</div>    
            <?php break; ?>
    <?php endswitch; ?>

    <div id="sub-header">
        <span class="title">
            <span id="toggle_menu" class="glyphicon glyphicon-menu-hamburger hidden-sm hidden-md hidden-lg"></span> 
            Device list 
            <small>(<?php echo $this->getDeviceCount() ?>)</small>
        </span>

        <div class="pull-right btn-group" role="group" id="top-toolbar">
            <a href="" data-toggle="tooltip" data-placement="bottom" title="Refresh the page">
                <span class="glyphicon glyphicon-refresh"></span> 
            </a>
            <a href="#" class="ShowFilter" data-toggle="tooltip" data-placement="bottom" title="Show/hide the filters">
                <span class="glyphicon glyphicon-search"></span> 
            </a>
        </div>
    </div>

    <div id="SubContainer">
        <form method="post" class="form-horizontal FiltersForm">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Application:</label>
                        <div class="col-sm-10">
                            <select name="application_id" class="form-control">
                                <option>All</option>
                                <?php foreach( ApplicationBook::getApplications() as /* @var $application Application */ $application ): ?>
                                    <option value="<?php echo $application->getId() ?>" <?php echo ($this->getPost()->getValue( "application_id" ) == $application->getId() ? "selected" : ""); ?>><?php echo $application->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">OS:</label>
                        <div class="col-sm-10">
                            <select name="type" class="form-control">
                                <option>All</option>
                                <?php foreach( DeviceBook::getDeviceType() as $deviceType ): ?>
                                    <option value="<?php echo $deviceType ?>" <?php echo ($this->getPost()->getValue( "type" ) == $deviceType ? "selected" : ""); ?>><?php echo $deviceType ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Free text:</label>
                        <div class="col-sm-10">
                            <input type="text" name="free_search" class="form-control" value="<?php echo $this->getPost()->getValue( "free_search" ) ?>" placeholder="Mobile ID, brand, model, OS name, OS version, or app name and version..." />
                        </div>
                    </div>

                    <div class="pull-right btn-group" role="group">

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


        <table class="EntityList" data-resizable-columns-id="devices-table">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <th data-resizable-column-id="MobileId">
                        Device
                    </th>
                    <th class="hidden-xs hidden-sm" data-resizable-column-id="AppInfo">App info</th>
                    <th class="buttons-col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $this->getDevices() as /* @var $device Device */ $device ): ?>
                    <tr class="<?php echo ($device->getEnabled()? : 'warning'); ?>">
                        <td><?php echo $device->getId() ?></td>
                        <td>
                            <img class="DeviceFlag" src="Images/flags/<?php echo $device->getLocalizationName() ?>.png" />
                        </td>
                        <td>
                            <div class="mobile-info"><?php echo $device->getBrand() ?> - <?php echo $device->getModel() ?> | <?php echo $device->getType() ?> - <?php echo $device->getOsVersion() ?></div>
                            <div class="mobile-id" title="<?php echo $device->getMobileId() ?>"><?php echo $device->getMobileId() ?></div>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <?php echo $device->getApplicationName() ?> - <?php echo $device->getApplicationVersion() ?>
                        </td>
                        <td>
                            <form method="post">
                                <div class="btn-group" role="group">
                                    <?php if( $device->getEnabled() ): ?>
                                    <button id="DisableDeviceButton" type="submit" name="action" value="disableDevice" class="btn btn-warning" title="Disable">
                                            <span class="glyphicon glyphicon-thumbs-down"></span> 
                                        </button>
                                    <?php else: ?>
                                    <button id="EnableDeviceButton" type="submit" name="action" value="enableDevice" class="btn btn-success" title="Enable">
                                            <span class="glyphicon glyphicon-thumbs-up"></span> 
                                        </button>
                                    <?php endif; ?>
                                    <button id="DeleteDeviceButton" type="button" class="btn btn-danger" data-toggle="modal" data-target=".DeleteDeviceModal" title="Delete">
                                        <span class="glyphicon glyphicon-remove"></span> 
                                    </button>
                                </div>

                                <input type="hidden" class="MobileId" value="<?php echo $device->getMobileId() ?>" />
                                <input type="hidden" class="DeviceId" name="DeviceId" value="<?php echo $device->getId() ?>" />
                                <input type="hidden" class="ApplicationId" name="ApplicationId" value="<?php echo $device->getApplicationId() ?>" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php $this->getPagination()->show() ?>
    </div>

    <div class="modal fade DeleteDeviceModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Do yuo want to delete device with id <span class="modal-delete-device-id"></span>?
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="action" value="deleteDevice">Delete</button>

                        <input type="hidden" name="model-delete-device-id" class="modal-delete-device-id" value="" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
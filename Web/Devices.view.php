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

    <h2 class="col-xs-6 col-sm-6 col-md-6 col-lg-6 Title">Device list <small>(<?php echo $this->getDeviceCount() ?>)</small></h2>
    <span class="pull-right ShowFilter"><span class="glyphicon glyphicon-search"></span>Show filter</span>

    <form method="post" class="form-horizontal FiltersForm">
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
                <input type="text" name="free_search" class="form-control" value="<?php echo $this->getPost()->getValue( "free_search" ) ?>" placeholder="Mobile ID, brand, model, app name and version..." />
            </div>
        </div>

        <div class="pull-right">

            <button type="submit" class="btn btn-primary">
                Search
            </button>

            <span class="btn btn-default">Clear</span>

        </div>
    </form>


    <table class="table table-striped table-bordered EntityList">
        <thead>
            <tr>
                <td>Mobile ID</td>
                <td class="hidden-xs">OS</td>
                <td class="hidden-xs hidden-sm">App info</td>
                <td class="hidden-xs hidden-sm">Brand and model</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $this->getDevices() as /* @var $device Device */ $device ): ?>
                <tr class="<?php echo ($device->getEnabled()? : 'warning'); ?>">
                    <td class="MobileIdCell">
                        <span title="<?php echo $device->getMobileId() ?>"><?php echo $device->getMobileId() ?></span>
                    </td>
                    <td class="hidden-xs">
                        <?php echo $device->getType() ?> <br />
                        <?php echo $device->getOsVersion() ?>
                    </td>
                    <td class="hidden-xs hidden-sm">
                        <?php echo $device->getApplicationName() ?> <br />
                        <?php echo $device->getApplicationVersion() ?>
                    </td>
                    <td class="hidden-xs hidden-sm">
                        <?php echo $device->getBrand() ?> <br />
                        <?php echo $device->getModel() ?>
                    </td>
                    <td>
                        <form method="post">
                            <?php if( $device->getEnabled() ): ?>
                                <button id="DisableDeviceButton" type="submit" name="action" value="disableDevice" class="btn btn-warning">Disable</button>
                            <?php else: ?>
                                <button id="EnableDeviceButton" type="submit" name="action" value="enableDevice" class="btn btn-success">Enable</button>
                            <?php endif; ?>
                            <button id="DeleteDeviceButton" type="button" class="btn btn-danger" data-toggle="modal" data-target=".DeleteDeviceModal">Delete</button>

                            <input type="hidden" class="MobileId" value="<?php echo $device->getMobileId() ?>" />
                            <input type="hidden" class="DeviceId" name="DeviceId" value="<?php echo $device->getId() ?>" />
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

    <div class="modal fade DeleteDeviceModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Do yuo want to delete device "<span class="MobileId"></span>"?
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="action" value="deleteDevice">Delete</button>

                        <input type="hidden" name="DeleteDeviceId" class="DeleteDeviceId" value="" />
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
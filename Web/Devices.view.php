<?php
namespace Web;

use BusinessLogic\Device\Device;

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

    <h2>Device list (<?php echo $this->getDeviceCount() ?>)</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered EntityList">
            <thead>
                <tr>
                    <td>Mobile ID</td>
                    <td class="hidden-xs">OS</td>
                    <td class="hidden-xs hidden-sm">OS version</td>
                    <td class="hidden-xs hidden-sm">App name</td>
                    <td class="hidden-xs hidden-sm">App version</td>
                    <td class="hidden-xs hidden-sm">Brand</td>
                    <td class="hidden-xs hidden-sm">Model</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $this->getDevices() as /* @var $device Device */ $device ): ?>
                    <tr class="<?php echo ($device->getEnabled()? : 'warning'); ?>">
                        <td><?php echo $device->getMobileId() ?></td>
                        <td class="hidden-xs"><?php echo $device->getType() ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo $device->getOsVersion() ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo $device->getApplicationName() ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo $device->getApplicationVersion() ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo $device->getBrand() ?></td>
                        <td class="hidden-xs hidden-sm"><?php echo $device->getModel() ?></td>
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
    </div>

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
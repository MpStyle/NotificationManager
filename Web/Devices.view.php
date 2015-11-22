<?php
namespace Web;

use BusinessLogic\Application\Application;
use BusinessLogic\Application\ApplicationBook;
use BusinessLogic\Device\Device;
use BusinessLogic\Device\DeviceBook;
use BusinessLogic\Localization\Localization;

/* @var $this Devices */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<span id="page-title">
    Device list 
    <small>(<?php echo $this->getDeviceCount() ?>)</small>
</span>

<div class="btn-group" role="group" id="top-toolbar">
    <a href="" data-toggle="tooltip" data-placement="bottom" title="Refresh the page">
        <span class="glyphicon glyphicon-refresh"></span> 
    </a>
    <a href="#" class="ShowFilter" 
       role="button"
       data-toggle="collapse" 
       title="Show/hide the filters"
       data-target=".filters-form" 
       aria-expanded="false" aria-controls="filters-form">
        <span class="glyphicon glyphicon-search"></span> 
    </a>         
</div>

<div id="content">
    <?php switch( $this->getGet()->getValue( "error" ) ): case "00": ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The device was successfully saved.</div>
            <?php
            break;
        case "01":
            ?>
            <div class="alert alert-danger ErrorMessage ErrorMessage-MarginBottom20" role="alert">The device was not deleted.</div>
            <?php
            break;
        case "02":
            ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The device was successfully deleted.</div>    
            <?php
            break;
        case "03":
            ?>
            <div class="alert alert-success ErrorMessage ErrorMessage-MarginBottom20" role="alert">The device was successfully updated.</div>    
            <?php
            break;
        case "04":
            ?>
            <div class="alert alert-danger ErrorMessage ErrorMessage-MarginBottom20" role="alert">The nickname was not set.</div>    
            <?php
            break;
    endswitch;
    ?>

    <div id="SubContainer">
        <form method="get" class="form-horizontal filters-form <?php echo (!$this->showFilters() ? "collapse" : "collapse in") ?>">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Application:</label>
                        <div class="col-sm-10">
                            <select name="application_id" class="form-control">
                                <option>All</option>
                                <?php foreach( ApplicationBook::getApplications() as /* @var $application Application */ $application ): ?>
                                    <option value="<?php echo $application->getId() ?>" <?php echo ($this->getGet()->getValue( "application_id" ) == $application->getId() ? "selected" : ""); ?>><?php echo $application->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Localization:</label>
                        <div class="col-sm-10">
                            <select name="localization-id" class="form-control">
                                <option value="">All</option>
                                <option value="<?php echo Localization::EN ?>" <?php echo ($this->getGet()->getValue( "localization-id" ) == Localization::EN ? "selected" : ""); ?>>
                                    English
                                </option>
                                <option value="<?php echo Localization::DE ?>" <?php echo ($this->getGet()->getValue( "localization-id" ) == Localization::DE ? "selected" : ""); ?>>
                                    German
                                </option>
                                <option value="<?php echo Localization::ES ?>" <?php echo ($this->getGet()->getValue( "localization-id" ) == Localization::ES ? "selected" : ""); ?>>
                                    Spanish
                                </option>
                                <option value="<?php echo Localization::FR ?>" <?php echo ($this->getGet()->getValue( "localization-id" ) == Localization::FR ? "selected" : ""); ?>>
                                    France
                                </option>
                                <option value="<?php echo Localization::IT ?>" <?php echo ($this->getGet()->getValue( "localization-id" ) == Localization::IT ? "selected" : ""); ?>>
                                    Italy
                                </option>
                                <option value="<?php echo Localization::RU ?>" <?php echo ($this->getGet()->getValue( "localization-id" ) == Localization::RU ? "selected" : ""); ?>>
                                    Russia
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">OS:</label>
                        <div class="col-sm-10">
                            <select name="type" class="form-control">
                                <option value="">All</option>
                                <?php foreach( DeviceBook::getDeviceType() as $deviceType ): ?>
                                    <option value="<?php echo $deviceType ?>" <?php echo ($this->getGet()->getValue( "type" ) == $deviceType ? "selected" : ""); ?>><?php echo $deviceType ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Free text:</label>
                        <div class="col-sm-10">
                            <input type="text" name="free_search" class="form-control" value="<?php echo $this->getGet()->getValue( "free_search" ) ?>" placeholder="Mobile ID, brand, model, OS name, OS version, or app name and version..." />
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
                    <td class="hidden-xs"></td>
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
                        <td class="hidden-xs">
                            <img class="DeviceFlag" src="Images/flags/<?php echo $device->getLocalizationName() ?>.png" />
                        </td>
                        <td>
                            <?php if( $device->getNickname()!=null ): ?>
                                <div class="mobile-info"><?php echo $device->getNickname() ?></div>
                            <?php else: ?>
                                <div class="mobile-info"><?php echo $device->getBrand() ?> - <?php echo $device->getModel() ?> | <?php echo $device->getType() ?> - <?php echo $device->getOsVersion() ?></div>
                            <?php endif; ?>
                            <div class="mobile-id hidden-xs hidden-sm" title="Mobile id: <?php echo $device->getMobileId() ?>"><?php echo $device->getMobileId() ?></div>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <?php echo $device->getApplicationName() ?> - <?php echo $device->getApplicationVersion() ?>
                        </td>
                        <td>
                            <form method="post">
                                <div class="btn-group" role="group">
                                    <span id="set-nickname-button" class="btn btn-primary" title="Set a nickname for this device" data-toggle="modal" data-target=".set-nickname-modal">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </span>
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
                                <input type="hidden" class="Nickname" name="Nickname" value="<?php echo $device->getNickname() ?>" />
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
            
    <div class="modal fade set-nickname-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Choose a nickname for this device:</label>
                            <input type="text" name="modal-nickname" class="form-control modal-nickname" maxlength="100" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="action" value="updateNickName">Save</button>

                        <input type="hidden" name="modal-device-id" class="modal-device-id" value="" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
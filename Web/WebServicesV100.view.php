<?php
namespace Web;

use BusinessLogic\Device\DeviceTypes;

/* @var $this WebServicesV100 */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">
    <h2>Web services <small>version: 1.0.0</small></h2>

    <h3>Mobile registration</h3>
    <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
        <input type="hidden" name="methodUrl" value="Version_1_0_0/MobileRegistration.php" />
        <input type="hidden" name="methodName" value="Mobile registration" />

        <div class="form-group">
            <label class="col-sm-2 control-label">mobileId:</label>
            <div class="col-sm-10">
                <input type="text" name="mobileId" class="form-control" value="" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">type:</label>
            <div class="col-sm-10">
                <select name="type" class="form-control">
                    <option></option>
                    <option value="<?php echo DeviceTypes::ANDROID ?>">Android</option>
                    <option value="<?php echo DeviceTypes::IOS ?>">iOS</option>
                    <option value="<?php echo DeviceTypes::WINDOWS_PHONE ?>">Windows Phone</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">osVersion:</label>
            <div class="col-sm-10">
                <input type="text" name="osVersion" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">brand:</label>
            <div class="col-sm-10">
                <input type="text" name="brand" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">model:</label>
            <div class="col-sm-10">
                <input type="text" name="model" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">localization:</label>
            <div class="col-sm-10">
                <input type="text" name="localization" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">clientId:</label>
            <div class="col-sm-10">
                <input type="text" name="clientId" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Send</button>
            </div>
        </div>
    </form>

    <h3>Mobile unregistration</h3>
    <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
        <input type="hidden" name="methodUrl" value="Version_1_0_0/MobileUnregistration.php" />
        <input type="hidden" name="methodName" value="Mobile unregistration" />

        <div class="form-group">
            <label class="col-sm-2 control-label">mobileId:</label>
            <div class="col-sm-10">
                <input type="text" name="mobileId" class="form-control" value="" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">clientId:</label>
            <div class="col-sm-10">
                <input type="text" name="clientId" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Send</button>
            </div>
        </div>
    </form>

    <h3>Get notifications</h3>
    <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
        <input type="hidden" name="methodUrl" value="Version_1_0_0/GetNotifications.php" />
        <input type="hidden" name="methodName" value="Get notifications" />

        <div class="form-group">
            <label class="col-sm-2 control-label">mobileId:</label>
            <div class="col-sm-10">
                <input type="text" name="mobileId" class="form-control" value="" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">clientId:</label>
            <div class="col-sm-10">
                <input type="text" name="clientId" class="form-control" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Send</button>
            </div>
        </div>
    </form>
</div>
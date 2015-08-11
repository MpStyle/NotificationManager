<?php
namespace Web;

use BusinessLogic\Device\DeviceBook;
use BusinessLogic\Localization\LocalizationBook;

/* @var $this WebServicesV100 */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">
    <div id="SubHeader">
        <h2>
            <span id="toggle_menu" class="glyphicon glyphicon-menu-hamburger hidden-sm hidden-md hidden-lg"></span> 
            Web services 
            <small>version: 1.0.0</small>
        </h2>
    </div>

    <div id="SubContainer">

        <h3>Mobile registration</h3>

        <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
            <input type="hidden" name="methodUrl" value="Version_1_0_0/MobileRegistration.php" />
            <input type="hidden" name="methodName" value="Mobile registration" />

            <div class="form-group">
                <label class="col-sm-2 control-label">Url:</label>
                <div class="col-sm-10">
                    <input type="text" value="http://148.251.189.84:8087/Web/WebServices/Version_1_0_0/MobileRegistration.php" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">requestId:</label>
                <div class="col-sm-10">
                    <input type="number" name="requestId" class="form-control" value="" placeholder="A number to identify the request..." required />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">mobileId:</label>
                <div class="col-sm-10">
                    <input type="text" name="mobileId" class="form-control" value="" required />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">type:</label>
                <div class="col-sm-10">
                    <select name="type" class="form-control" required>
                        <option></option>
                        <?php foreach( DeviceBook::getDeviceType() as $value ): ?>
                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">applicationVersion:</label>
                <div class="col-sm-10">
                    <input type="text" name="applicationVersion" class="form-control" />
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
                <label class="col-sm-2 control-label">localizationId:</label>
                <div class="col-sm-10">
                    <select name="localizationId" class="form-control" required>
                        <option></option>
                        <?php foreach( LocalizationBook::getLocalizations() as $key => $value ): ?>
                            <option value="<?php echo $value ?>"><?php echo $key ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">clientId:</label>
                <div class="col-sm-10">
                    <input type="text" name="clientId" class="form-control" required />
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
                <label class="col-sm-2 control-label">Url:</label>
                <div class="col-sm-10">
                    <input type="text" value="http://148.251.189.84:8087/Web/WebServices/Version_1_0_0/MobileUnregistration.php" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" required>requestId:</label>
                <div class="col-sm-10">
                    <input type="number" name="requestId" class="form-control" value="" placeholder="A number to identify the request..." />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" required>mobileId:</label>
                <div class="col-sm-10">
                    <input type="text" name="mobileId" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" required>clientId:</label>
                <div class="col-sm-10">
                    <input type="text" name="clientId" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">type:</label>
                <div class="col-sm-10">
                    <select name="type" class="form-control" required>
                        <option></option>
                        <?php foreach( DeviceBook::getDeviceType() as $value ): ?>
                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
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
                <label class="col-sm-2 control-label">Url:</label>
                <div class="col-sm-10">
                    <input type="text" value="http://148.251.189.84:8087/Web/WebServices/Version_1_0_0/GetNotifications.php" class="form-control" value="" readonly />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">requestId:</label>
                <div class="col-sm-10">
                    <input type="number" name="requestId" class="form-control" value="" placeholder="A number to identify the request..." />
                </div>
            </div>

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
                <label class="col-sm-2 control-label">type:</label>
                <div class="col-sm-10">
                    <select name="type" class="form-control" required>
                        <option></option>
                        <?php foreach( DeviceBook::getDeviceType() as $value ): ?>
                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
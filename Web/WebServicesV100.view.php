<?php
namespace Web;

use BusinessLogic\Device\DeviceBook;
use BusinessLogic\Localization\LocalizationBook;

/* @var $this WebServicesV100 */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<span id="page-title">
    Web services 
    <small>version: 1.0.0</small>
</span>

<div class="btn-group" role="group" id="top-toolbar"></div>

<div id="content">
    <div id="SubContainer">

        <div class="panel-group" id="web_services_accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="mobile_registration_title">
                    <h3 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#web_services_accordion" href="#mobile_registration" aria-expanded="true" aria-controls="mobile_registration">
                            Mobile registration
                        </a>
                    </h3>
                </div>
                <div id="mobile_registration" class="panel-collapse collapse" role="tabpanel" aria-labelledby="mobile_registration_title">
                    <div class="panel-body">

                        <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
                            <input type="hidden" name="methodName" value="Mobile registration" />

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Url:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="methodUrl" value="<?php echo $this->getCurrentURL() ?>MobileRegistration.php" class="form-control" value="" readonly />
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
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="mobile_unregistration_title">
                    <h3 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#web_services_accordion" href="#mobile_unregistration" aria-expanded="true" aria-controls="mobile_unregistration">
                            Mobile unregistration
                        </a>
                    </h3>
                </div>
                <div id="mobile_unregistration" class="panel-collapse collapse" role="tabpanel" aria-labelledby="mobile_unregistration_title">
                    <div class="panel-body">
                        <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
                            <input type="hidden" name="methodName" value="Mobile unregistration" />

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Url:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="methodUrl" value="<?php echo $this->getCurrentURL() ?>MobileUnregistration.php" class="form-control" value="" readonly />
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
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="get_notification_title">
                    <h3 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#web_services_accordion" href="#get_notification" aria-expanded="true" aria-controls="get_notification">
                            Get notifications
                        </a>
                    </h3>
                </div>
                <div id="get_notification" class="panel-collapse collapse" role="tabpanel" aria-labelledby="get_notification_title">
                    <div class="panel-body">
                        <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
                            <input type="hidden" name="methodName" value="Get notifications" />

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Url:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="methodUrl" value="<?php echo $this->getCurrentURL() ?>GetNotifications.php" class="form-control" value="" readonly />
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
                                <label class="col-sm-2 control-label">notificationId:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="notificationId" class="form-control" placeholder="se valorizzato a null restituisce tutte le notifiche" />
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
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="get_registration_status_title">
                    <h3 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#web_services_accordion" href="#get_registration_status" aria-expanded="true" aria-controls="get_registration_status">
                            Get registration status
                        </a>
                    </h3>
                </div>
                <div id="get_registration_status" class="panel-collapse collapse" role="tabpanel" aria-labelledby="get_registration_status_title">
                    <div class="panel-body">
                        <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
                            <input type="hidden" name="methodName" value="Get registration status" />

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Url:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="methodUrl" value="<?php echo $this->getCurrentURL() ?>MobileRegistrationStatus.php" class="form-control" value="" readonly />
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
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
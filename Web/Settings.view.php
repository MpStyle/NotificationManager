<?php
namespace Web;

use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;

/* @var $this Settings */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">
    <div id="sub-header">
        <span class="Title">
            <span id="toggle_menu" class="glyphicon glyphicon-menu-hamburger hidden-sm hidden-md hidden-lg"></span> 
            Settings
        </span>
    </div>

    <div id="SubContainer">
        <form method="post" class="form-horizontal">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Google</h3>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Client ID:</label>
                        <div class="col-sm-10">
                            <input type="text" name="<?php echo Configuration::GOOGLE_CLIENT_ID ?>" class="form-control" value="<?php echo ConfigurationBook::getValue( Configuration::GOOGLE_CLIENT_ID ) ?>" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Secret ID:</label>
                        <div class="col-sm-10">
                            <input type="text" name="<?php echo Configuration::GOOGLE_CLIENT_SECRET ?>" class="form-control" value="<?php echo ConfigurationBook::getValue( Configuration::GOOGLE_CLIENT_SECRET ) ?>" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Redirect URL:</label>
                        <div class="col-sm-10">
                            <input type="text" name="<?php echo Configuration::GOOGLE_REDIRECT_URL ?>" class="form-control" value="<?php echo ConfigurationBook::getValue( Configuration::GOOGLE_REDIRECT_URL ) ?>" placeholder="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary">

                <div class="panel-heading">
                    <h3 class="panel-title">Send notification handler</h3>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username:</label>
                        <div class="col-sm-10">
                            <input type="text" name="<?php echo Configuration::SCRIPT_USERNAME ?>" class="form-control" value="<?php echo ConfigurationBook::getValue( Configuration::SCRIPT_USERNAME ) ?>" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password:</label>
                        <div class="col-sm-10">
                            <input type="text" name="<?php echo Configuration::SCRIPT_PASSWORD ?>" class="form-control" value="<?php echo ConfigurationBook::getValue( Configuration::SCRIPT_PASSWORD ) ?>" placeholder="" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="pull-right">

                <button type="submit" class="btn btn-primary">
                    <!--<span class="glyphicon glyphicon-search"></span>--> 
                    Save
                </button>

            </div>
        </form>
    </div>
</div>
<?php
namespace Web;

use BusinessLogic\Enum\Post;

/* @var $this EditApp */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">

    <?php switch( $this->getGet()->getValue( "error" ) ): ?><?php case "01": ?>
            <div class="alert alert-danger ErrorMessage-MarginBottom20" role="alert">Error: the app was not saved correctly.</div>
    <?php endswitch; ?>

    <h2>
        <?php if( $this->getGet()->getValue( "id" ) == null ): ?>
            Create app
        <?php else: ?>
            Edit app
        <?php endif; ?>
    </h2>

    <div class="FormContainer">
        <form method="post">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="app_name" value="<?php echo $this->getCurrentApp()->getName() ?>" class="form-control" placeholder="Enter the app name" maxlength="150" required="required" />
            </div>

            <div class="form-group">
                <label>Google client key</label>
                <input type="text" name="app_google_client_key" value="<?php echo $this->getCurrentApp()->getGoogleKey() ?>" class="form-control" placeholder="Enter the Google client key" maxlength="1024" />
            </div>

<!--            <div class="form-group">
                <label>Microsoft client key</label>
                <input type="text" name="app_microsoft_client_key" value="<?php echo $this->getCurrentApp()->getWindowsPhoneKey() ?>" class="form-control" placeholder="Enter the Microsoft client key" maxlength="1024" />
            </div>-->

            <div class="form-group">
                <label>Client ID <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Use this code as perameter in the web services"></span></label>
                <input type="text" name="client_id" value="<?php echo ($this->getGet()->getValue( "id" ) == null ? sha1( uniqid() ) : $this->getCurrentApp()->getClientId()) ?>" class="form-control" readonly="readonly" maxlength="1024" />
            </div>

            <div class="form-group">
                <label>Secret ID <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Use this code as perameter in the web services"></span></label>

                <div class="row">
                    <div class="col-sm-11">
                        <input id="SecretIdText" type="text" name="secret_id" value="<?php echo ($this->getGet()->getValue( "id" ) == null ? sha1( uniqid() ) : $this->getCurrentApp()->getSecretId()) ?>" 
                               class="form-control" readonly="readonly" maxlength="1024" />
                    </div>
                    <button type="button" id="RefreshSecretIdButton" class="btn btn-default col-sm-1" data-toggle="tooltip" data-placement="top" title="Refresh secret ID">
                        <span id="RefreshIcon" class="glyphicon glyphicon-refresh"></span>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label>Links <small>(use coma as separator)</small> <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Internal links used in the app"></span></label>
                <input type="text" name="links" value="<?php echo $this->getInternalLinks() ?>" class="form-control" placeholder="Enter the internal link of the app" />
            </div>

            <div class="pull-right">

                <button type="submit" name="action" value="confirmEdit" class="btn btn-primary">
                    <?php if( $this->getGet()->getValue( "id" ) == null ): ?>
                        Create
                    <?php else: ?>
                        Save
                    <?php endif; ?>
                </button>

                <a href="Apps.php" class="btn btn-default">Cancel</a>

            </div>
        </form>
    </div>
</div>
<?php
namespace Web;

use BusinessLogic\Json\JsonBook;

/* @var $this WebServicesV100Response */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">
    <div id="sub-header">
        <span class="title">
            <span id="toggle_menu" class="glyphicon glyphicon-menu-hamburger hidden-md hidden-lg"></span> 
            Web service response 
            <small>version: 1.0.0</small>
        </span>
    </div>

    <div id="SubContainer">
        <h3><?php echo $this->getPost()->getValue( "methodName" ) ?></h3>

        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">URL</h3></div>
            <div class="panel-body"><input type="text" name="methodUrl" value="<?php echo $this->getPost()->getValue( "methodUrl" ) ?>" class="form-control" value="" readonly /></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Raw Request</div>
            <div id="Request" class="panel-body">
                <textarea cols="100" rows="3" class="form-control" readonly="readonly"><?php echo str_replace( "&", "&amp;", http_build_query( $this->getParameters()->__toArray() ) ); ?></textarea>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Request</h3></div>
            <div class="panel-body">
                <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
                    <input type="hidden" name="methodName" value="<?php echo $this->getPost()->getValue( "methodName" ) ?>" />
                    <input type="hidden" name="methodUrl" value="<?php echo $this->getPost()->getValue( "methodUrl" ) ?>" />
                    
                    <?php foreach( $this->getParameters() as $key => $value ): ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?php echo $key ?>:</label>
                            <div class="col-sm-10">
                                <input type="text" name="<?php echo $key ?>" class="form-control" value="<?php echo $value ?>" />
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Raw Response:</h3></div>
            <div id="RawResponse" class="panel-body">
                <textarea cols="100" rows="8" class="form-control" readonly="readonly"><?php echo $this->getResponse(); ?></textarea>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Response:</h3></div>
            <div class="panel-body">
                <pre id="Response"><?php echo JsonBook::indent( $this->getDecodedResponse() ); ?></pre>
            </div>
        </div>
    </div>
</div>
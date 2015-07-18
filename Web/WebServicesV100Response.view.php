<?php
namespace Web;

use BusinessLogic\Json\JsonBook;

/* @var $this WebServicesV100Response */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">
    <h2>Web service response <small>version: 1.0.0</small></h2>

    <h3><?php echo $this->getPost()->getValue( "methodName" ) ?></h3>
    
    <h3>Raw Request</h3>
    <div id="Request">
        <textarea cols="100" rows="3" class="form-control" readonly="readonly"><?php echo str_replace( "&", "&amp;", http_build_query( $this->getParameters()->__toArray() ) ); ?></textarea>
    </div>
    
    <h3>Request</h3>
    <form method="post" action="WebServicesV100Response.php" class="form-horizontal">
        <input type="hidden" name="methodUrl" value="<?php echo $this->getPost()->getValue( "methodUrl" ) ?>" />
        <input type="hidden" name="methodName" value="<?php echo $this->getPost()->getValue( "methodName" ) ?>" />
        
        <?php foreach ($this->getParameters() as $key => $value): ?>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $key ?>:</label>
                <div class="col-sm-10">
                    <input type="text" name="<?php echo $key ?>" class="form-control" value="<?php echo $value ?>" />
                </div>
            </div>
        <?php endforeach; ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Send</button>
            </div>
        </div>
    </form>
    
    <h3>Raw Response:</h3>
    <div id="RawResponse">
        <textarea cols="100" rows="15" class="form-control" readonly="readonly"><?php echo $this->getResponse(); ?></textarea>
    </div>

    <h3>Response:</h3>
    <pre id="Response"><?php echo JsonBook::indent( $this->getDecodedResponse() ); ?></pre>
</div>
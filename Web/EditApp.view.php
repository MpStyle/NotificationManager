<?php
namespace Web;

use BusinessLogic\Enum\Post;

/* @var $this EditApp */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<div id="content">
    <h2>
        <?php if( $this->getPost()->getValue( Post::APPS ) == null ): ?>
            Create app
        <?php else: ?>
            Edit app
        <?php endif; ?>
    </h2>

    <div class="FormContainer">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="app_name" value="" class="form-control" placeholder="Enter the app name" maxlength="150" required="required" />
        </div>

        <div class="form-group">
            <label>Goolge client key</label>
            <input type="text" name="app_google_client_key" value="" class="form-control" placeholder="Enter the Google client key" maxlength="1024" />
        </div>

        <div class="form-group">
            <label>Microsoft client key</label>
            <input type="text" name="app_microsoft_client_key" value="" class="form-control" placeholder="Enter the Microsoft client key" maxlength="1024" />
        </div>

        <div class="pull-right">
            <button name="action" value="confirmEdit" class="btn btn-primary">
                <?php if( $this->getPost()->getValue( Post::APPS ) == null ): ?>
                    Create
                <?php else: ?>
                    Save
                <?php endif; ?>
            </button>
            
            <a href="Apps.php" class="btn btn-default">Cancel</a>
        </div>
    </div>
</div>
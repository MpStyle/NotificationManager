<?php
namespace Web;

use BusinessLogic\Configuration\Configuration;
use BusinessLogic\Configuration\ConfigurationBook;

/* @var $this Login */
?>

<div id="content">
    <h1><?php echo \Settings::APP_NAME ?> <?php echo \Settings::APP_VERSION ?></h1>

    <div id="gConnect">
        <button class="g-signin"
                data-scope="https://www.googleapis.com/auth/plus.login"
                data-requestvisibleactions="http://schemas.google.com/AddActivity"
                data-clientId="<?php echo ConfigurationBook::getValue( Configuration::GOOGLE_CLIENT_ID ) ?>"
                data-accesstype="offline"
                data-callback="onSignInCallback"
                data-theme="dark"
                data-cookiepolicy="single_host_origin">
        </button>
    </div>

</div>

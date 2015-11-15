<?php
namespace Web;

/* @var $this Home */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<span id="page-title">
    About
</span>

<div class="btn-group" role="group" id="top-toolbar"></div>

<div id="content">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#app" aria-controls="home" role="tab" data-toggle="tab">App</a></li>
        <li role="presentation"><a href="#changelog" aria-controls="profile" role="tab" data-toggle="tab">ChangeLog</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="app">
            <h2><?php echo \Settings::APP_NAME ?> <small>version <?php echo \Settings::APP_VERSION ?></small></h2>

            <p>
                Notification Manager is a web app to manage the push notification for all your apps. Right now the support is limited to the service Google Cloud Messaging, so you are be able to send notifications to Android and iOS devices and to Chrome web apps.
            </p>

            <p>GitHub: <b>https://github.com/MpStyle/NotificationManager</b></p>

            <p>Author: <b>Michele Pagnin</b></p>
        </div>

        <div role="tabpanel" class="tab-pane" id="changelog">

            <h3>2.0</h3>
            <ul>
                <li>Bug fixing</li>
                <li>Improved engine performance</li>
                <li>Improved UI & UX performance</li>
            </ul>
            
            <h3>1.0</h3>

        </div>
    </div>
</div>
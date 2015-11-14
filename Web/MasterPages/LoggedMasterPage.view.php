<?php

namespace Web\MasterPages;

/* @var $this LoggedMasterPage */
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Article" lang="en">
    <head>
        <title><?php echo \Settings::APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,400italic,500italic,700,700italic,900,900italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" />
        <!--<link type="text/css" rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css" />-->
        <link href="Styles/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- JSON RPC Client -->
        <script src="Javascripts/JsonRpcClient/jquery.jsonrpcclient.min.js"></script>

        <script src="Javascripts/LoggedMasterPage.js"></script>
    </head>
    <body>
        <div id="MenuDarkSide" class="hidden-sm hidden-md hidden-lg"></div>

        <div id="Wrapper" class="container-fluid">
            <div id="Container" class="row">
                <div id="left-column" class="hidden-xs col-sm-3 col-md-2 col-lg-2">
                    <div class="UserBar">
                        <div class="CoverContainer" style="background-image: url(<?php echo $this->getUserCoverPhoto() ?>)"></div>

                        <div class="UserDetails">
                            <div class="AvatarContainer">
                                <img class="UserAvatar" src="<?php echo $this->getUserAvatar() ?>" />
                            </div>

                            <form action="" method="post" class="LogoutForm">
                                <span class="UserName"><?php echo $this->getUserName() ?></span>
                                <button type="submit" value="logout" name="logout_button" id="logout_button" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-off"></span>
                                    Logout
                                </button>
                            </form>


                        </div>
                    </div>

                    <ul id="menu" role="navigation" class="nav nav-pills nav-stacked">
                        <li role="presentation">
                            <a href="Apps.php" data-toggle="tooltip" data-placement="right" title="List of the apps">
                                <span class="glyphicon glyphicon-th"></span>
                                <span class="MenuItemLabel">Apps</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="Devices.php" data-toggle="tooltip" data-placement="right" title="List of the devices">
                                <span class="glyphicon glyphicon-phone"></span>
                                <span class="MenuItemLabel">Devices</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="Notifications.php" data-toggle="tooltip" data-placement="right" title="List of the notifications">
                                <span class="glyphicon glyphicon-envelope"></span>
                                <span class="MenuItemLabel">Notifications</span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#">
                                <span class="glyphicon glyphicon-upload"></span>
                                <span class="MenuItemLabel">Web services</span>
                            </a>
                            <ul role="navigation" class="nav nav-pills nav-stacked">
                                <li role="presentation">
                                    <a href="WebServicesV100.php" data-toggle="tooltip" data-placement="right" title="Version 1.0">
                                        <span class="glyphicon glyphicon-stop"></span>
                                        <span class="MenuItemLabel">Version 1.0</span>
                                    </a>
                                </li>
                            </ul>
                        </li>   

                    </ul>

                    <ul id="BottomMenu" role="navigation" class="nav nav-pills nav-stacked ">
                        <li>
                            <a href="Settings.php">
                                <span class="glyphicon glyphicon-cog"></span>
                                <span class="MenuItemLabel">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div id="ContentWrapper" class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
                    <div id="content"></div>
                </div>
            </div>

        </div>


    </body>
</html>
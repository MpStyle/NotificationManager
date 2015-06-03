<?php
namespace Web\MasterPages;

/* @var $this LoggedMasterPage */

use BusinessLogic\Enum\Post;
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Article" lang="en">
    <head>
        <title><?php echo \Settings::APP_NAME ?> - <?php echo \Settings::APP_VERSION ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,400italic,500italic,700,700italic,900,900italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css" />
        <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- JSON RPC Client -->
        <script src="Javascripts/JsonRpcClient/jquery.jsonrpcclient.min.js"></script>
    </head>
    <body>

        <div id="Wrapper" class="container-fluid">

            <div id="header" class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div id="TitleLogoContainer" class="pull-left">
                    <a id="TitleLink" href="Home.php">
                        <h1 id="Title" class="hidden-xs"><?php echo \Settings::APP_NAME ?></h1>
                    </a>
                </div>

                <div id="UserContainer" class="pull-right row">
                    <span id="UserInfo" class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-right">                    
                        <span id="user_name"><?php echo $this->getUserName() ?></span>
                        <br />
                        <form action="" method="post" style="display: inline-block">
                            <button type="submit" value="logout" name="logout_button" id="logout_button" class="btn btn-info">Logout</button>
                        </form>
                    </span>

                    <span class="hidden-xs col-sm-4 col-md-4">
                        <img id="UserAvatar" src="<?php echo $this->getUserAvatar() ?>" />
                    </span>
                </div>
            </div>

            <div id="Container" class="row">
                <div id="LeftColumn" class="hidden-xs col-sm-3 col-md-2 col-lg-2">
                    <ul id="menu" role="navigation">
                        <li>
                            <a href="Apps.php">
                                <span class="glyphicon glyphicon-th" title="List of the apps"></span>
                                Apps
                            </a>
                            <a href="Devices.php">
                                <span class="glyphicon glyphicon-phone" title="List of the devices"></span>
                                Devices
                            </a>
                            <a href="Notifications.php">
                                <span class="glyphicon glyphicon-envelope" title="List of the notifications"></span>
                                Notifications
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
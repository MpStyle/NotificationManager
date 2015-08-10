<?php
namespace Web\MasterPages;

/* @var $this LoggedMasterPage */
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

        <script src="Javascripts/LoggedMasterPage.js"></script>
    </head>
    <body>

        <div id="Wrapper" class="container-fluid">

            <div id="Header" class="navbar navbar-default navbar-fixed-top" role="navigation">

                <h1 id="AppNameContainer">
                    <a href="Home.php">
                        <?php echo \Settings::APP_NAME ?>
                    </a>
                </h1>
                
                <div id="AvatarContainer" class="hidden-xs">
                    <img id="UserAvatar" src="<?php echo $this->getUserAvatar() ?>" />
                </div>

                <div id="UserInfo">                    
                    <div id="user_name"><?php echo $this->getUserName() ?></div>
                    <form action="" method="post" style="display: inline-block">
                        <button type="submit" value="logout" name="logout_button" id="logout_button" class="btn btn-default">Logout</button>
                    </form>
                </div>

            </div>

            <div id="Container" class="row">
                <div id="LeftColumn" class="hidden-xs col-sm-3 col-md-2 col-lg-2">
                    <ul id="menu" role="navigation">
                        <li>
                            <a href="Apps.php" data-toggle="tooltip" data-placement="right" title="List of the apps">
                                <span class="glyphicon glyphicon-th"></span>
                                Apps
                            </a>
                        </li>
                        <li>
                            <a href="Devices.php" data-toggle="tooltip" data-placement="right" title="List of the devices">
                                <span class="glyphicon glyphicon-phone"></span>
                                Devices
                            </a>
                        </li>
                        <li>
                            <a href="Notifications.php" data-toggle="tooltip" data-placement="right" title="List of the notifications">
                                <span class="glyphicon glyphicon-envelope"></span>
                                Notifications
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-upload"></span>
                                Web services
                            </a>
                            <ul>
                                <li>
                                    <a href="WebServicesV100.php" data-toggle="tooltip" data-placement="right" title="Version 1.0">
                                        <span class="glyphicon glyphicon-stop"></span>
                                        Version 1.0
                                    </a>
                                </li>
                            </ul>
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
<?php
namespace Web\MasterPages;

/* @var $this Web\MasterPages\PublicMasterPage */
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
        <!-- JSON RPC Client -->
        <script src="Javascripts/JsonRpcClient/jquery.jsonrpcclient.min.js"></script>
        
        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap-theme.min.css" />
        <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
        
        <script src="../../vendor/mpstyle/mtoolkit/View/Javascripts/MQueryString.min.js"></script>
        
        <title><?php echo \Settings::APP_NAME ?> - <?php echo \Settings::APP_VERSION ?></title>
    </head>
    <body>
        <div id="content">
        </div>
    </body>
</html>
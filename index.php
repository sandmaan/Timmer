<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/5/2017
 * Time: 11:24 AM
 */

if(!defined(__DIR__)){
    define(__DIR__, __FILE__);
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<head>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="images/ico/favicon.ico">

    <!--Style sheets-->
    <link rel="stylesheet" type="text/css" href="CSS/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <style>
        .ui-progressbar {
            position: relative;
            width: 50%;
            left: 20%;
        }
        .progress-label {
            position: absolute;
            left: 50%;
            top: 1px;
            font-weight: bold;
            font-size: small;
            text-shadow: 1px 1px 0 #fff;
        }
    </style>

    <!--JavaScripts-->
    <script language="JavaScript" type="text/javascript" src="jScripts/Libraries/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="jScripts/Libraries/jquery-ui.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="jScripts/lodingScreenFunctions.js"></script>

    <?php if(file_exists(__DIR__ . './bin/iConnect/node.php')) {?>
        <script language="JavaScript" type="text/javascript">
            $( function() {
                var progressbar = $( "#progressbar" ),
                    progressLabel = $( ".progress-label" );

                progressbar.progressbar({
                    value: false,
                    change: function() {
                        progressLabel.text( progressbar.progressbar( "value" ) + "%" );
                    },
                    complete: function() {
                        //progressLabel.text( "Complete!" );
                        window.location = "../TimSheetSystem/bin/index.php";
                    }
                });

            function progress() {
                var val = progressbar.progressbar( "value" ) || 0;

                    progressbar.progressbar( "value", val + 2 );

                    if ( val < 99 ) {
                        setTimeout( progress, 110 );
                    }
                }

                setTimeout( progress, 2500 );
            });
        </script>
    <?php }else{ ?>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function () {
            $('#bgDimmer').show();
            $('#divContent').show().load('bin/config/config.php');
        });
    </script>
    <?php } ?>
</head>
<body class="firstLoad">
<div class="main-container">
    <div id="popup-div" class="popup-container">
        <div id="bgDimmer"></div>
        <div id="divContent"></div>
    </div>
    <div id="dev-details-splash">
        <div id="branding-text-splash">
            Created by <a href="http://codemonsters.tk/" target="_blank">CodeMonsters</a>
        </div>
    </div>
    <div id="progressbar" class="ui-progressbar">
        <div class="progress-label" style="text-align: center">
<!--            Loading....-->
        </div>
    </div>
</div>
</body>

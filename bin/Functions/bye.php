<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/12/2017
 * Time: 1:27 PM
 */
session_start();
session_unset();
session_destroy();

header("location:../Functions/logOutSuccess.php");
exit();
<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/9/2017
 * Time: 2:02 PM
 */
session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

if (isset($_REQUEST["uid"])){

    $chkLeader = "SELECT tlName FROM teams WHERE tlName = :uid";
    $chkLeaderQuery = $dbConnect -> prepare($chkLeader);
    $chkLeaderQuery -> bindParam(':uid', $_REQUEST["uid"]);

    if ($chkLeaderQuery -> execute()){
        $resetLeader = "UPDATE teams SET tlName = NULL , tlSet = '' WHERE tlName = :uid";
        $resetLeaderQuery = $dbConnect -> prepare($resetLeader);
        $resetLeaderQuery -> bindParam(':uid', $_REQUEST["uid"]);

        if ($resetLeaderQuery -> execute()){
            $delUsr = "DELETE FROM userlogin WHERE uId = :uid";
            $delUsrQuery = $dbConnect -> prepare($delUsr);
            $delUsrQuery -> bindParam(':uid', $_REQUEST["uid"]);

            if ($delUsrQuery -> execute()){
                echo "16";
            }else{
                echo "17";
            }
        }
    }else{
        $delUsr = "DELETE FROM userlogin WHERE uId = :uid";
        $delUsrQuery = $dbConnect -> prepare($delUsr);
        $delUsrQuery -> bindParam(':uid', $_REQUEST["uid"]);

        if ($delUsrQuery -> execute()){
            echo "16";
        }else{
            echo "17";
        }
    }

}else{
    echo "17";
}
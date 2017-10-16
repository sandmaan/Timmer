<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 9/25/2017
 * Time: 4:22 PM
 */

include_once ("../iConnect/handShake.php");

if(!empty($_REQUEST["create"])){
    $error = array();
    $tableNames = array(
        'catdb', 'clientdb', 'qcerrors', 'searchterm', 'teams', 'tempdb', 'userlogin', 'userroles', 'usertimetrack'
    );

    for ($i = 0; $i < count($tableNames); $i++) {
        $tableCheck = $dbConnect->query("SHOW TABLES LIKE '".$tableNames[$i]."'");
        if ($tableCheck->rowCount() > 0){
            echo $tableNames[$i] . " .... Exists <br />";
        }else{
            $tblName = $tableNames[$i];

            switch ($tblName){
                case "catdb":
                    try{
                        $tblCreate = "CREATE TABLE IF NOT EXISTS `catdb` (
                            `catId` int(100) NOT NULL AUTO_INCREMENT,
                            `uId` int(100) NOT NULL,
                            `Catagory` varchar(100) NOT NULL,
                            `createDate` varchar(100) NOT NULL,
                            PRIMARY KEY (`catId`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                        $dbConnect -> exec($tblCreate);
                        echo $tblName ." .... Created OK <br />";
                    }catch (PDOException $e){
                        $error[] = $tblCreate .'-'. $e -> getMessage();
                    }
                    break;

                case "clientdb":
                    try{
                        $tblCreate = "CREATE TABLE IF NOT EXISTS `clientdb` (
                                `clientId` int(100) NOT NULL AUTO_INCREMENT,
                                `catId` varchar(100) NOT NULL,
                                `uId` int(100) NOT NULL,
                                `Client` varchar(100) NOT NULL,
                                `cDate` varchar(100) NOT NULL,
                                PRIMARY KEY (`clientId`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                        $dbConnect -> exec($tblCreate);
                        echo $tblName ." .... Created OK <br />";
                    }catch (PDOException $e){
                        $error[] = $tblCreate .'-'. $e -> getMessage();
                    }
                    break;

                case "qcerrors":
                    try{
                        $tblCreate = "CREATE TABLE IF NOT EXISTS `qcerrors` (
                                  `qcId` int(100) NOT NULL AUTO_INCREMENT,
                                  `qcError` varchar(100) NOT NULL,
                                  `createdBy` varchar(100) DEFAULT NULL,
                                  `createdOn` varchar(100) DEFAULT NULL,
                                  PRIMARY KEY (`qcId`)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                        $dbConnect -> exec($tblCreate);
                        echo $tblName ." .... Created OK <br />";
                    }catch (PDOException $e){
                        $error[] = $tblCreate .'-'. $e -> getMessage();
                    }
                    break;

                case "searchterm":
                    try{
                        $tblCreate = "CREATE TABLE IF NOT EXISTS `searchterm` (
                                  `sId` int(100) NOT NULL AUTO_INCREMENT,
                                  `sDate` varchar(100) NOT NULL,
                                  `sUid` int(100) NOT NULL,
                                  `searchedBy` int(100) NOT NULL,
                                  PRIMARY KEY (`sId`)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                        $dbConnect -> exec($tblCreate);
                        echo $tblName ." .... Created OK <br />";
                    }catch (PDOException $e){
                        $error[] = $tblCreate .'-'. $e -> getMessage();
                    }
                    break;

                case "teams":
                    try{
                        $tblCreate = "CREATE TABLE IF NOT EXISTS `teams` (
                                  `tId` int(100) NOT NULL AUTO_INCREMENT,
                                  `TeamName` varchar(100) NOT NULL,
                                  `tlName` varchar(100) DEFAULT NULL,
                                  `tlSet` varchar(100) NOT NULL,
                                  PRIMARY KEY (`tId`)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                        $dbConnect -> exec($tblCreate);
                        echo $tblName ." .... Created OK <br />";
                    }catch (PDOException $e){
                        $error[] = $tblCreate .'-'. $e -> getMessage();
                    }
                    break;

                case "tempdb":
                    try{
                        $tblCreate = "CREATE TABLE IF NOT EXISTS `tempdb` (
                                  `tempId` int(100) NOT NULL AUTO_INCREMENT,
                                  `uId` int(100) NOT NULL,
                                  `tId` int(100) NOT NULL,
                                  `catId` int(100) NOT NULL,
                                  `clientId` int(100) NOT NULL,
                                  `startTime` varchar(100) NOT NULL,
                                  `Status` varchar(100) NOT NULL,
                                  PRIMARY KEY (`tempId`)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                        $dbConnect -> exec($tblCreate);
                        echo $tblName ." .... Created OK <br />";
                    }catch (PDOException $e){
                        $error[] = $tblCreate .'-'. $e -> getMessage();
                    }
                    break;

                case "userlogin":
                    try{
                        $tblCreate = "CREATE TABLE IF NOT EXISTS `userlogin` (
                                  `uId` int(100) NOT NULL AUTO_INCREMENT,
                                  `uCreateDate` varchar(100) NOT NULL,
                                  `createdBy` int(100) NOT NULL,
                                  `fName` varchar(100) NOT NULL,
                                  `lName` varchar(100) NOT NULL,
                                  `uName` varchar(100) NOT NULL,
                                  `pWord` varchar(100) NOT NULL,
                                  `uTeam` int(100) NOT NULL,
                                  `uRole` varchar(100) NOT NULL,
                                  PRIMARY KEY (`uId`)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                        $dbConnect -> exec($tblCreate);
                        echo $tblName ." .... Created OK <br />";
                    }catch (PDOException $e){
                        $error[] = $tblCreate .'-'. $e -> getMessage();
                    }
                    break;

                case "userroles":
                    try{
                        $tblCreate = "CREATE TABLE IF NOT EXISTS `userroles` (
                                  `urId` int(100) NOT NULL AUTO_INCREMENT,
                                  `userRole` varchar(100) NOT NULL,
                                  PRIMARY KEY (`urId`)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                        $dbConnect -> exec($tblCreate);
                        echo $tblName ." .... Created OK <br />";
                    }catch (PDOException $e){
                        $error[] = $tblCreate .'-'. $e -> getMessage();
                    }
                    break;

                case "usertimetrack":
                    try{
                        $tblCreate = "CREATE TABLE IF NOT EXISTS `usertimetrack` (
                                  `utId` int(100) NOT NULL AUTO_INCREMENT,
                                  `jDate` varchar(100) NOT NULL,
                                  `usrId` int(100) NOT NULL,  
                                  `Category` varchar(100) NOT NULL,
                                  `utClient` varchar(100) NOT NULL,
                                  `jType` varchar(100) NOT NULL,
                                  `startTime` varchar(100) NOT NULL,
                                  `endTime` varchar(100) NOT NULL,
                                  `timeSpent` varchar(100) NOT NULL,
                                  `Volume` int(100) NOT NULL,
                                  `qcErrorId` varchar(100) NOT NULL,
                                  `noOfProductLines` int(100) DEFAULT NULL,
                                  `Remarks` varchar(1000) DEFAULT NULL,
                                  PRIMARY KEY (`utId`)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                        $dbConnect -> exec($tblCreate);
                        echo $tblName ." .... Created OK <br />";
                    }catch (PDOException $e){
                        $error[] = $tblCreate .'-'. $e -> getMessage();
                    }
                    break;

                default:
                    echo $tblName." this table is not part of this system.<br />";
                    echo "Tasks can't be created at this time.";
                    $error[] = 1;
            }
        }
    }

    if(count($error) == 0){
        $timeNow = date("Y-m-d H:i:s");//Set the current time

        //Check the status of the event scheduler
        $evesStatus = $dbConnect -> query("select @@event_scheduler");
        $evesStatus -> execute();
        $status = $evesStatus -> fetch(PDO::FETCH_ASSOC);

        if ($status["@@event_scheduler"] == "OFF"){
            $dbConnect -> exec("SET GLOBAL event_scheduler = ON");//Set the event scheduler to ON
        }

        //Check if the event's already in the database or not
        $flag = false;
        $eveStatus = $dbConnect -> query("SHOW EVENTS");
        $eveStatus -> execute();
        while($evenStatus = $eveStatus -> fetch(PDO::FETCH_ASSOC)){
            if ($evenStatus["Name"] = "EmptyData" || $evenStatus["Name"] = "searchTerm Table Clean"){
                $flag = true;
            }
        }

        if($flag){
            //If events are in the database
            echo "Events already exists <br>";
        }else{
            //Creates the event when they're not in the database
            $createTask1 = "CREATE DEFINER= '".$dbUser."'@`%` EVENT `searchTerm Table Clean` ON SCHEDULE EVERY 1 DAY STARTS '".$timeNow."' ON COMPLETION NOT PRESERVE ENABLE DO TRUNCATE TABLE searchterm";
            $dbConnect -> exec($createTask1);

            $createTask2 = "CREATE DEFINER= '".$dbUser."'@`%` EVENT `EmptyData` ON SCHEDULE EVERY 1 DAY STARTS '".$timeNow."' ON COMPLETION NOT PRESERVE ENABLE DO TRUNCATE TABLE tempdb";
            $dbConnect -> exec($createTask2);
        }

        $checkRoles = $dbConnect -> query("SELECT * FROM userroles");
        $checkRoles -> execute();
        if ($checkRoles -> rowCount() == 0){
            //Insert the user roles in to the useroles table
            $addUsroles = "INSERT INTO `userroles` (`urId`, `userRole`) VALUES (1, 'Admin'), (2, 'Manager'), (3, 'User');
";
            $dbConnect -> exec($addUsroles);
        }else{
            echo "Data already in roles table";
        }
    }
}else{
    echo "Empty variable";
}

if (!empty($_REQUEST["check"]) && $_REQUEST["check"] == "check"){
    $checkInitUser = $dbConnect -> prepare("SELECT uId FROM :dbName WHERE uId = `1`");
    $checkInitUser -> bindParam(':dbName', $dbName);
    $checkInitUser -> execute();

    if ($checkInitUser -> rowCount() > 0){
        echo "1";
    }
}
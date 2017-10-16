<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 9/21/2017
 * Time: 3:03 PM
 */

?>
<html>
<head>
</head>
<body>
<div class="popUpBox">
    <div id="dbConfig-details">
        <label for="dbUser">Database User:</label>
        <input class="dbDetails" id="dbUser" placeholder="Enter database admin user name">
        <label for="dbPass">Database Password:</label>
        <input type="password" class="dbDetails" id="dbPass" placeholder="Enter database password">
        <label for="dbName">Database Name:</label>
        <input class="dbDetails" id="dbName" placeholder="Enter database name">
        <label for="dbHost">Database Host:</label>
        <input class="dbDetails" id="dbHost" placeholder="Enter host server">
        <div id="dbMsg-container" style="height: 15px">
            <div id="dbConfig-msg" >
                <span>Only a-z, A-Z, 0-9, :, / and _ are allowed</span>
            </div>
        </div>
        <input type="button" id="dbSubmit" value="Save" class="dbConfig-buttons">
    </div>
    <div id="nextstep" hidden>
        <span id="success-text" hidden>It seems to be working sparky, Let's march on!</span><br/>
        <input type="button" id="next-step" value="Next" class="dbConfig-buttons" hidden>
    </div>
    <div id="table-gen" hidden>
        <h3>Populating database ....</h3>
        <div id="success-text-table-gen" hidden></div><br/>
        <input type="button" id="table-gen-next" value="Next" class="dbConfig-buttons" hidden>
    </div>
    <div id="admin-create" hidden>
        <h3>Creating the initial user ....</h3>
        <span style="font-size: small;">This user will be functioning as the initial account for this system.Please keep in mind
        all the spacial characters are not allowed including space</span><br><br>
        <div id="admin-create-form" hidden>
            <label for="uFname">User First Name:</label>
            <input class="initial-user" id="uFname" placeholder="Enter first name">
            <label for="uLname">User Last Name:</label>
            <input class="initial-user" id="uLname" placeholder="Enter last name">
            <label for="uName">User Name:</label>
            <input class="initial-user" id="uName" placeholder="Enter user name">
            <label for="uPass">Create a Password:</label>
            <input type="password" class="initial-user" id="uPass" placeholder="Enter a password">
            <label for="uPass2">Re-Enter Password:</label>
            <input type="password" class="initial-user" id="uPass2" placeholder="Enter password again">
        </div>
        <div id="success-text-user-gen" hidden></div>
        <input type="button" id="create-admin" value="Next" class="dbConfig-buttons" hidden>
    </div>
    <div id="setup-end" hidden>
        <h3>Timmer configuration finished successfully ....</h3>
        <span style="font-size: small;">
            All configurations of the system ended with out any errors now you're able to use this system as you wish.
        </span><br><br>
    </div><br/>
    <input type="button" id="finish" value="Close" class="dbConfig-buttons" hidden>
    <div id="response" style="height: 15px; text-align: center; color: #33df00;"></div>
</div>
</body>
</html>
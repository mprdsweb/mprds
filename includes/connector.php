<?php
    $db_user= "mprdsdataadmin";
    $db_pass = "MPRDS!Web1";
    //$db = mysqli_connect('localhost',$db_user,$db_pass,'mprds');
    $db = mysqli_connect('107.180.58.68',$db_user,$db_pass,'mprds');

    if (mysqli_connect_errno()){
    //    echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die("Could not connect.");
    }


?>

<?php
    date_default_timezone_set('Asia/Kolkata');
    $sname= "localhost";
    $uname= "root";
    $password = "";

    $db_name = "finalsem";

    $conn = mysqli_connect($sname, $uname, $password, $db_name);
    mysqli_set_charset($conn,"utf8");

    if (!$conn) {
        echo "Connection failed!";
    }
?>
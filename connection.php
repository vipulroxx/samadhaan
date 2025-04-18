<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set('Asia/Kolkata');
    $sname= "localhost";
    $uname= "root";
    $password = "";

    $db_name = "samadhaan";

    $conn = mysqli_connect($sname, $uname, $password, $db_name);
    mysqli_set_charset($conn,"utf8");

    if (!$conn) {
        echo "Connection failed!";
    }
?>
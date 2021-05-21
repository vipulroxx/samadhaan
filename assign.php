<?php
    session_start();
    include "connection.php";
    if (isset($_SESSION['concern-id'])) {
        $id = $_SESSION['concern-id'];
        $attendee_name = $_POST['attendee-name'];
        $agency_name = $_POST['agency'];
        $price = (int)$_POST['price'];
        $status = $_POST['status'];
        $update_concern = "UPDATE concern SET attendedby='$attendee_name', agency='$agency_name', price='$price', status='$status' WHERE id='$id'";
        $update_result = mysqli_query($conn, $update_concern);
        if ($update_result) {
            header("Location: admin.php?success=Concern has been attended successfully");
            exit();
        }else {
            header("Location: admin.php?error=unknown error occurred");
            exit();
        }
    }
?>
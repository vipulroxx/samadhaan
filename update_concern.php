<?php
session_start();
include "connection.php";

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['concern-id'])) {
    $id = $_POST['concern-id'];
    $attendedon = mysqli_real_escape_string($conn, $_POST['attendedon']);
    $attendedby = mysqli_real_escape_string($conn, $_POST['attendedby']);
    $agency = mysqli_real_escape_string($conn, $_POST['agency']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update the concern in the database
    $update_query = "UPDATE concern 
                     SET attendedon='$attendedon', attendedby='$attendedby', agency='$agency', price='$price', status='$status' 
                     WHERE id='$id'";

    if (mysqli_query($conn, $update_query)) {
        // Redirect to concern.php with the concern-id in the query string
        header("Location: admin.php?concern-id=$id&success=Concern updated successfully");
        exit();
    } else {
        die("Error updating concern: " . mysqli_error($conn));
    }
} else {
    die("Invalid request.");
}
?>
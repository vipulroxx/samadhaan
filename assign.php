<?php
    session_start();
    include "connection.php";
    if ((isset($_SESSION['concern-id'])) && (!empty($_POST['attendee-name'])) && (!empty($_POST['agency'])) &&  (!empty($_POST['price']))  && (!empty($_POST['status'])) && (isset($_FILES['file']['name']))) {
        $id = $_SESSION['concern-id'];
        $attendee_name = $_POST['attendee-name'];
        $agency_name = $_POST['agency'];
        $price = (int)$_POST['price'];
        $status = $_POST['status'];
        $mysqltime = date('Y-m-d H:i:s');
        $id = $_SESSION['concern-id'];
        $attendee_name = $_POST['attendee-name'];
        $agency_name = $_POST['agency'];
        $price = (int)$_POST['price'];
        $status = $_POST['status'];
        $mysqltime = date('Y-m-d H:i:s');
        $filename = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir.basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if (in_array($imageFileType,$extensions_arr)) {
            $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
            $update_concern = "UPDATE concern SET attendedon='$mysqltime', attendedby='$attendee_name', agency='$agency_name', price='$price', status='$status', completed='$image' WHERE id='$id'";
            $update_result = mysqli_query($conn, $update_concern);
            if ($update_result) {
                header("Location: admin.php?success=Concern has been attended successfully");
                exit();
            }else {
                header("Location: admin.php?error=unknown error occurred");
                exit();
            }
        }
    }else {
        if (empty($_POST['attendee-name'])) {
            header("Location: attend.php?error=Attendee name is required");
            exit();
        } else if (empty($_POST['agency'])) {
            header("Location: attend.php?error=Agency name is required");
            exit();
        } else if (empty($_POST['price'])) {
            header("Location: attend.php?error=Price is required");
            exit();
        } else if (empty($_FILES['file']['name'])) {
            header("Location: attend.php?error=Confirmation photo is required");
            exit();
        } else if (empty($_POST['status'])){
            header("Location: attend.php?error=Status is required");
            exit(0);
        } else {
            $c = 0;
        }
    }
?>
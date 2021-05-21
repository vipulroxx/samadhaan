<?php
    session_start();
    include "connection.php";
    $housetype = $_POST['house-type'];
    $housenumber = $_POST['house-number'];
    $houseid = $housetype.$housenumber;
    $category = $_POST['category'];
    $concern = htmlspecialchars($_POST['concern']);
    $userid = $_SESSION['id'];
    $name = $_SESSION['name'];
    $issuedon = date('Y-m-d H:i:s');

    $filename = $_FILES['file']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){
        // Convert to base64 
            $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
            // Insert record
            //$query = "insert into images(image) values('".$image."')";
            if (isset($category) && ($_POST['house-type'] != "Type") && ($_POST['house-number'] != "Number") && isset($concern)) {
                $query = "INSERT INTO concern(userid, name, houseid, category, concern, issuedon, image) VALUES('$userid', '$name','$houseid','$category','$concern', '$issuedon', '$image')";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    header("Location: home.php?error=unknown error occurred");
                    exit();
                }
            } else {
                header("Location: home.php?error=Form not completely filled");
            }
        
    }

    // if (isset($category) && ($_POST['house-type'] != "Type") && ($_POST['house-number'] != "Number") && isset($concern)) {
    //     $query = "INSERT INTO concern(userid, name, houseid, category, concern, issuedon, image) VALUES('$userid', '$name','$houseid','$category','$concern', '$issuedon', '$filename')";
    //     $result = mysqli_query($conn, $query);
    //     if (!$result) {
    //         header("Location: home.php?error=unknown error occurred");
    //         exit();
    //     }
    // } else {
    //     header("Location: home.php?error=Form not completely filled");
    // }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Samadhaan</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="greeting">
            <h1 style="font-size:30px;">Hello, <?php echo $_SESSION['name']; ?>!</h1>
            <a style="position:absolute; right: 0px;"href="logout.php">Logout</a>
        </div>
        <form>
            <h2>Your concern has been submitted!</h2>
            <p style="text-align:center"><b><u>CONCERN DETAILS</u></b></p>
            <label>HOUSE</label>
            <?php echo strtoupper($houseid) ?><br><br>
            <label>CATEGORY</label>
            <?php echo strtoupper($category) ?><br><br>
            <label>CONCERN</label>
            <?php echo $concern ?><br>
            <a style="text-decoration: none; color: #1690A7; float:left; margin-left: 24%; margin-top: 40px;" href="home.php">SUBMIT ANOTHER CONCERN</a>
        </form>
    </body>
</html>
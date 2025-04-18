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
    $concern_id = ($issuedon.$userid);
    $concern_id = str_replace(":", "", $concern_id);
    $concern_id = str_replace("-", "", $concern_id);
    $concern_id = str_replace(" ", "", $concern_id);
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif");
    if (in_array($imageFileType,$extensions_arr)) {
        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
        if (isset($category) && ($_POST['house-type'] != "Type") && ($_POST['house-number'] != "Number") && isset($concern) && isset($image)) {
            $query = "INSERT INTO concern(userid, concernid, name, houseid, category, concern, issuedon, image, status) VALUES('$userid', '$concern_id', '$name', '$houseid', '$category', '$concern', '$issuedon', '$image', 'NOT STARTED')";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                header("Location: home.php?error=unknown error occurred");
                exit();
            }
        } 
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Samadhaan</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="icon" href="./favicon.ico" type="image/ico">
    </head>
    <body>
        <div id="greeting">
            <h1 style="font-size:30px;">Hello, <?php echo $_SESSION['name']; ?>!</h1>
            <a style="position:absolute; right: 7%;"href="past.php">My Concerns</a>
            <a style="position:absolute; right: 0px;"href="logout.php">Logout</a>
        </div>
        <form>
            <h2>Your concern has been submitted!</h2>
            <p style="text-align:center"><b><u>CONCERN DETAILS</u></b></p>
            <label>HOUSE</label>
            <?php echo strtoupper($houseid) ?><br><br>
            <label>CONCERN ID</label>
            <?php echo ($concern_id) ?><br><br>
            <label>CATEGORY</label>
            <?php echo strtoupper($category) ?><br><br>
            <label>CONCERN</label>
            <?php echo $concern ?><br>
            <a style="text-decoration: none; color: #1690A7; float:left; margin-left: 24%; margin-top: 40px;" href="home.php">SUBMIT ANOTHER CONCERN</a>
        </form>
    </body>
</html>
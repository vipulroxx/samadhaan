<?php
    session_start();
    include "connection.php";
                $housetype = $_POST['house-type'];
                $housenumber = $_POST['house-number'];
                $houseid = $housetype.$housenumber;
                $category = $_POST['category'];
                $concern = htmlspecialchars($_POST['concern']);
                $photo = $_POST['concern-photo'];
                $userid = $_SESSION['id'];
                $name = $_SESSION['name'];
                $issuedon = date('Y-m-d H:i:s');
                $query = "INSERT INTO concern(userid, name, houseid, category, concern, issuedon, image) VALUES('$userid', '$name','$houseid','$category','$concern', '$issuedon', '$photo')";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    header("Location: home.php?error=unknown error occurred");
                    exit();
                }
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
            <a style="text-decoration: none; color: #1690A7; float:left; margin-left: 24%; margin-top: 40px;" href="admin.php">SUBMIT ANOTHER CONCERN</a>
        </form>
    </body>
</html>
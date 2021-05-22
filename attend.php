<?php
    session_start();
    include "connection.php";
?>
<html>
    <head>
        <title>Samadhaan</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php
              if (isset($_SESSION['concern-id'])) {
                  $id = $_SESSION['concern-id'];
                  $_SESSION['concern-id'] = $id;
                  $concern_query = "SELECT * FROM concern WHERE id='$id'";
                  $concern_result = mysqli_query($conn, $concern_query);
                  $row = mysqli_fetch_assoc($concern_result);
        ?>
        <div id="greeting">
            <h1>Hello, <?php echo $_SESSION['name']; ?>!</h1>
            <a href="logout.php">Logout</a>
        </div>
        <form class="attend-form" action="assign.php" method="POST" enctype="multipart/form-data">
            <label>ATTENDEE NAME</label>
            <input type="text" name="attendee-name">
            <label>AGENCY NAME</label>
            <input type="text" name="agency">
            <label>TOTAL PRICE</label>
            <input type="text" name="price">
            <label>UPLOAD SIGNATURE</label>
            <input type="file" name="file" />
            <div class="controls">
                <label>STATUS</label>
                <label style="color:black;" class="radio">
                    <input type="radio" name="status" <?php if (isset($status) && $status=="ONGOING") echo "ONGOING";?> value="ONGOING">
                    ONGOING
                </label>
                <label style="color:black;" class="radio">
                    <input type="radio" name="status" <?php if (isset($status) && $status=="COMPLETED") echo "COMPLETED";?> value="COMPLETED">
                    COMPLETED
                </label>
            </div>
            <input class="attend-submit" type="submit" value="Submit">   
            <br>
            <a href="admin.php">BACK TO CONCERN LIST</a>
    </body>
    <?php } ?>
</html>
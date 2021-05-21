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
        <form action="assign.php" method="POST">
            <label>ATTENDEE NAME</label>
            <input type="text" name="attendee-name">
            <label>AGENCY NAME</label>
            <input type="text" name="agency">
            <label>TOTAL PRICE</label>
            <input type="text" name="price">
            <label>UPLOAD SIGNATURE</label>
            <input type="file">
            <div class="status-button">
                <label>STATUS</label>
                <input type="radio" name="status" <?php if (isset($status) && $status=="YES") echo "checked";?> value="YES">YES
                <input type="radio" name="status" <?php if (isset($status) && $status=="NO") echo "checked";?> value="NO">NO
            </div>
            <input style="float: right; background: #1690A7; padding: 10px 15px; color: #fff; border-radius: 5px; width: 100%; border: none; margin-top: 1.3em; text-decoration: none;" type="submit" value="Submit">
    </body>
    <?php } ?>
</html>
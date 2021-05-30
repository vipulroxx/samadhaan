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
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <label>ATTENDEE NAME</label>
            <?php if (isset($_GET['attendee-name'])) { ?>
                <input type="text" name="attendee-name"
                value="<?php echo $_GET['attendee-name']; ?>"><br>>
            <?php } else { ?>
                <input type="text" 
                        name="attendee-name"><br>
            <?php }?>

            <label>AGENCY NAME</label>
            <?php if (isset($_GET['agency'])) { ?>
                <input type="text" name="agency"
                value="<?php echo $_GET['agency']; ?>"><br>>
            <?php } else { ?>
                <input type="text" 
                        name="agency"><br>
            <?php }?>

            <label>TOTAL PRICE</label>
            <?php if (isset($_GET['price'])) { ?>
                <input type="text" name="price"
                value="<?php echo $_GET['price']; ?>"><br>>
            <?php } else { ?>
                <input type="text" 
                        name="price"><br>
            <?php }?>

            <label>UPLOAD SIGNATURE</label>
            <?php if (isset($_FILES['file']['name'])) { ?>
                <input type="file" name="file"
                value="<?php echo $_FILES['file']['name']; ?>"><br>>
            <?php } else { ?>
                <input type="file" 
                        name="file"><br>
            <?php }?>

            <div class="controls">
                <label>STATUS</label>
                <label style="color:black;" class="radio">
                    <input type="radio" name="status" <?php if (isset($_GET['status']) && $_GET['status']=="ONGOING") echo "ONGOING";?> value="ONGOING">
                    ONGOING
                </label>
                <label style="color:black;" class="radio">
                    <input type="radio" name="status" <?php if (isset($_GET['status']) && $_GET['status']=="COMPLETED") echo "COMPLETED";?> value="COMPLETED">                    COMPLETED
                </label>
            </div>
            <input class="attend-submit" type="submit" value="Submit">   
            <br>
            <a href="admin.php">BACK TO CONCERN LIST</a>
    </body>
    <?php } ?>
</html>
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
              if (isset($_GET['concern-id'])) {
                  $id = $_GET['concern-id'];
                  $_SESSION['concern-id'] = $id;
                  $concern_query = "SELECT * FROM concern WHERE id='$id'";
                  $concern_result = mysqli_query($conn, $concern_query);
                  $row = mysqli_fetch_assoc($concern_result);
        ?>
        <div id="greeting">
            <h1>Hello, <?php echo $_SESSION['name']; ?>!</h1>
            <a href="logout.php">Logout</a>
        </div>
        <div class="concern-container" style="position:absolute; top: 15%; max-width: 800px;">
            <?php echo "<h2>Concern of ".strtoupper($row['name'])."</h2>"?>
            <form class="attend-concern" action="attend.php"><button type="submit">ATTEND</button></form>
            <?php echo "<h4>CATEGORY: <u>".strtoupper($row['category'])."</u></h4>"?>
            <?php echo "<h4>ISSUED ON: ".$row['issuedon']."</h4>"?>
            <?php echo "<h4>ATTENDED ON: ".$row['attendedon']." BY ".strtoupper($row['attendedby'])."</h4>"?>
            <?php echo "<h4>AGENCY: ".strtoupper($row['agency'])."</h4>"?>
            <?php echo "<h4>PRICE: ".$row['price']." Rupees</h4>"?>
            <?php echo "<h4>CONCERN: ".$row['concern']."</h4>"?>
            <img style="border: 1px solid black; border-radius: 5px; width: 300px; height: 300px;" src='<?php echo $row['image']; ?>' >
            <a style="text-decoration: none; color: #1690A7; float:right; margin-top: 38%;" href="admin.php">BACK TO CONCERN LIST</a>
        </div>
        <?php } ?>
    </body>
</html>
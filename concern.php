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
        <div class="concern-container">
            <?php echo "<h2>Concern of ".strtoupper($row['name'])."</h2>"?>
            <form class="attend-concern" action="attend.php"><button type="submit">ATTEND</button></form>
            <?php echo "<h4>CATEGORY: <u>".strtoupper($row['category'])."</u></h4>"?>
            <?php echo "<h4>CONCERN ID: <u>".strtoupper($row['concernid'])."</u></h4>"?> 
            <?php echo "<h4>ISSUED ON: <u>".$row['issuedon']."</u></h4>"?>
            <?php echo "<h4>ATTENDED ON: <u>".$row['attendedon']."</u> BY <u>".strtoupper($row['attendedby'])."</u></h4>"?>
            <?php echo "<h4>AGENCY: <u>".strtoupper($row['agency'])."</u></h4>"?>
            <?php echo "<h4>PRICE: ".$row['price']." Rupees</h4>"?>
            <?php echo "<h4>CONCERN: ".$row['concern']."</h4>"?>
            <figure>
                <img src='<?php echo $row['image']; ?>' >
                <figcaption><b>BEFORE</b></figcaption>
            </figure>
            <?php if (isset($row['completed'])) { ?>
            <figure>
                <img src='<?php echo $row['completed']; ?>' >
                <figcaption><b>AFTER</b></figcaption>
            </figure><br>
            <?php } ?>
            <a href="admin.php">BACK TO CONCERN LIST</a>
        </div>
        <?php } ?>
    </body>
</html>
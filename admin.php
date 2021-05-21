<?php 
    session_start();
    include "connection.php";
    
    if ($_SESSION['user_name'] == 'rootadmin1') {
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Samadhaan</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <?php
                $admin_query = "SELECT * FROM concern";
                $result = mysqli_query($conn, $admin_query);
            ?>
                <div id="greeting">
                    <h1>Hello, <?php echo $_SESSION['name']; ?>!</h1>
                    <a href="logout.php">Logout</a>
                </div>
                <div class="concern-container">
                    <table style="border-collapse: collapse;"> 
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Logged On</th>
                            <th>Attended On</th>
                            <th>Attended By</th>
                            <th>Agency</th>
                            <th>Cost</th>
                            <th>Concern</th>
                            <th>Status</th>
                        </tr>
                        <?php while($row=mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['category'] ?></td>
                            <td ><?php echo $row['issuedon'] ?></td>
                            <td><?php echo $row['attendedon'] ?></td>
                            <td ><?php echo $row['attendedby'] ?></td>
                            <td><?php echo $row['agency'] ?></td>
                            <td ><?php echo $row['price'] ?></td>
                            <td>
                                <form style="border:none; margin: none; padding:0px;" class="concern-container" action="concern.php" type="POST">
                                    <input type="hidden" name="concern-id" value="<?php echo $row['id']?>">
                                    <input style="float: right; background: #1690A7; padding: 10px 15px; color: #fff; border-radius: 5px; margin-right: 0px; border: none; margin-top: 1.3em; text-decoration: none;" type="submit" value="View">
                                </form>
                            </td>
                            <td style="color: #005869;"><b><?php echo $row['status'] ?></b></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
        </body>
    </html>
<?php 
    }else{
        header("Location: index.php");
        exit();
    }
?>
    
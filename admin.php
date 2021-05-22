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
            <script type="text/javascript" src="./filter.js"></script>
            
        </head>
        <body>
            <?php
                $admin_query = "SELECT * FROM concern";
                $result = mysqli_query($conn, $admin_query);
            ?>
            <div id="greeting">
                <h1>Hello, <?php echo $_SESSION['name']; ?>!</h1>
                <a href="logout.php">Logout</a>
            </div><br>
            <input type="text" id="search-input" onkeydown="filter()" placeholder="Search for something.." title="Type in a query">
            <div class="concern-table">
                <table id="concern-table"> 
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
                        <td><?php echo strtoupper($row['name']) ?></td>
                        <td><?php echo strtoupper($row['category']) ?></td>
                        <td ><?php echo $row['issuedon'] ?></td>
                        <td><?php echo $row['attendedon'] ?></td>
                        <td ><?php echo strtoupper($row['attendedby']) ?></td>
                        <td><?php echo strtoupper($row['agency']) ?></td>
                        <td ><?php echo $row['price'] ?></td>
                        <td>
                            <form action="concern.php" type="POST">
                                <input type="hidden" name="concern-id" value="<?php echo $row['id']?>">
                                <input type="submit" value="View">
                            </form>
                        </td>
                        <td style="color: #005869; 
                            <?php 
                                if ($row['status'] == "COMPLETED") 
                                    echo "background-color: lightblue;"
                            ?>
                            <?php 
                                if ($row['status'] == "ONGOING") 
                                    echo " background: repeating-linear-gradient(-55deg,lightblue,lightblue 10px,#fff 10px,#fff 20px);"
                            ?>
                            <?php
                                if ($row['status'] == "NOT STARTED")
                                    echo "background: linear-gradient(to bottom,#a8d6df,#a8d6df 50%,#75b8c5 50%,#75b8c5);"
                            ?>
                            "><b><?php echo $row['status'] ?></b></td>
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
    
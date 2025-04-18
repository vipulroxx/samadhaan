<?php 
    session_start();
    include "connection.php";
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Samadhaan</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <link rel="apple-touch-icon" sizes="57x57" href="./icon/apple-icon-57x57.png">
            <link rel="apple-touch-icon" sizes="60x60" href="./icon/apple-icon-60x60.png">
            <link rel="apple-touch-icon" sizes="72x72" href="./icon/apple-icon-72x72.png">
            <link rel="apple-touch-icon" sizes="76x76" href="./icon/apple-icon-76x76.png">
            <link rel="apple-touch-icon" sizes="114x114" href="./icon/apple-icon-114x114.png">
            <link rel="apple-touch-icon" sizes="120x120" href="./icon/apple-icon-120x120.png">
            <link rel="apple-touch-icon" sizes="144x144" href="./icon/apple-icon-144x144.png">
            <link rel="apple-touch-icon" sizes="152x152" href="./icon/apple-icon-152x152.png">
            <link rel="apple-touch-icon" sizes="180x180" href="./icon/apple-icon-180x180.png">
            <link rel="icon" type="image/png" sizes="192x192"  href="./icon/android-icon-192x192.png">
            <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="96x96" href="./favicon-96x96.png">
            <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
            <link rel="manifest" href="/manifest.json">
            <meta name="msapplication-TileColor" content="#ffffff">
            <meta name="msapplication-TileImage" content="./icon/ms-icon-144x144.png">
            <meta name="theme-color" content="#ffffff">
            <script type="text/javascript" src="./filter.js"></script>
            
        </head>
        <body>
            <?php
		$employeeid = $_SESSION['employee_id'];
		$name = $_SESSION['name'];
		$admin_query = "SELECT * FROM concern WHERE name='$name'";
                $result = mysqli_query($conn, $admin_query);
            ?>
            <div id="greeting">
                <h1>Hello, <?php echo $_SESSION['name']; ?>!</h1>
                <a href="logout.php">Logout</a>
		<a href="home.php">Home</a>
            </div><br>
            <input type="text" id="search-input" onkeydown="filter()" placeholder="Search for something.." title="Type in a query">
            <div class="concern-table">
                <table id="concern-table"> 
                    <tr>
                        <th>Name</th>
                        <th>Concern ID</th>
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
                        <td><?php echo strtoupper($row['concernid']) ?></td>
                        <td><?php echo strtoupper($row['category']) ?></td>
                        <td ><?php echo $row['issuedon'] ?></td>
                        <td><?php echo $row['attendedon'] ?></td>
                        <td ><?php echo strtoupper($row['attendedby']) ?></td>
                        <td><?php echo strtoupper($row['agency']) ?></td>
                        <td ><?php echo $row['price'] ?></td>
                        <td>
                            <form action="concernuser.php" type="POST">
                                <input type="hidden" name="concern-id" value="<?php echo $row['id']?>">
                                <input type="submit" value="View">
                            </form>
                        </td>
                        <td style="color: #005869; 
                            <?php 
                                if ($row['status'] == "COMPLETED") 
                                    echo "color: white; background-color: #f00;"
                            ?>
                            <?php 
                                if ($row['status'] == "ONGOING") 
                                    echo "color: #f00; background: repeating-linear-gradient(-55deg,#ffcccb,#ffcccb 10px,#fff 10px,#fff 20px);"
                            ?>
                            <?php
                                if ($row['status'] == "NOT STARTED")
                                    echo "color: black; background: linear-gradient(to bottom,#ffcccb,#ffcccb 50%,#ff726f 50%,#ff726f);"
                            ?>
                            "><b><?php echo $row['status'] ?></b></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </body>
    </html>
    
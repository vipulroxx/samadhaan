<?php 
    session_start();
    include "connection.php";

    // Check if the admin is logged in
    if (!isset($_SESSION['employee_id']) || $_SESSION['employee_id'] !== 'EMP99999') {
        header("Location: index.php");
        exit();
    }
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
        <link rel="icon" type="image/png" sizes="192x192" href="./icon/android-icon-192x192.png">
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
            // Fetch all concerns from the database
            $admin_query = "SELECT * FROM concern";
            $result = mysqli_query($conn, $admin_query);

            // Check if the query executed successfully
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            // Check if there are any concerns
            if (mysqli_num_rows($result) === 0) {
                echo "<p>No concerns found in the database.</p>";
            }
        ?>
        <div id="greeting">
            <h1>Hello, <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : "Admin"; ?>!</h1>
            <a href="logout.php">Logout</a>
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
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo isset($row['name']) && !empty($row['name']) ? strtoupper($row['name']) : "Unknown"; ?></td>
                    <td><?php echo isset($row['concernid']) && !empty($row['concernid']) ? strtoupper($row['concernid']) : "Unknown"; ?></td>
                    <td><?php echo isset($row['category']) && !empty($row['category']) ? strtoupper($row['category']) : "Unknown"; ?></td>
                    <td><?php echo isset($row['issuedon']) && !empty($row['issuedon']) ? $row['issuedon'] : "Unknown"; ?></td>
                    <td><?php echo isset($row['attendedon']) && !empty($row['attendedon']) ? $row['attendedon'] : "Unknown"; ?></td>
                    <td><?php echo isset($row['attendedby']) && !empty($row['attendedby']) ? strtoupper($row['attendedby']) : "Unknown"; ?></td>
                    <td><?php echo isset($row['agency']) && !empty($row['agency']) ? strtoupper($row['agency']) : "Unknown"; ?></td>
                    <td><?php echo isset($row['price']) && !empty($row['price']) ? $row['price'] : "Unknown"; ?></td>
                    <td>
                        <form action="concern.php" method="POST">
                            <input type="hidden" name="concern-id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="View">
                        </form>
                    </td>
                    <td style="color: #005869; 
                        <?php 
                            if (isset($row['status']) && $row['status'] == "COMPLETED") 
                                echo "color: white; background-color: #f00;";
                            elseif (isset($row['status']) && $row['status'] == "ONGOING") 
                                echo "color: #f00; background: repeating-linear-gradient(-55deg,#ffcccb,#ffcccb 10px,#fff 10px,#fff 20px);";
                            elseif (isset($row['status']) && $row['status'] == "NOT STARTED")
                                echo "color: black; background: linear-gradient(to bottom,#ffcccb,#ffcccb 50%,#ff726f 50%,#ff726f);";
                        ?>
                    ">
                        <b><?php echo isset($row['status']) && !empty($row['status']) ? $row['status'] : "Unknown"; ?></b>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </body>
</html>

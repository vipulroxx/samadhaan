<?php
session_start();
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['concern-id'])) {
    $id = $_POST['concern-id'];
} elseif (isset($_GET['concern-id'])) {
    $id = $_GET['concern-id'];
} else {
    die("Invalid request. Concern ID not provided.");
}

// Fetch the concern details from the database
$concern_query = "SELECT * FROM concern WHERE id='$id'";
$concern_result = mysqli_query($conn, $concern_query);

if (!$concern_result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($concern_result);

if (!$row) {
    die("No data found for concern ID: $id");
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
        <link rel="icon" type="image/png" sizes="192x192"  href="./icon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="./favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="./icon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <div id="greeting">
            <h1>Hello, <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : "Admin"; ?>!</h1>
            <a href="logout.php">Logout</a>
            <a href="admin.php">Home</a>
        </div>
        <div class="concern-container" style="width:80%;">
            <?php echo "<h2>Concern of ".strtoupper($row['name'])."</h2>"?>
            <form action="update_concern.php" method="POST">
                <input type="hidden" name="concern-id" value="<?php echo $row['id']; ?>">
                <h4>CATEGORY: <u><?php echo strtoupper($row['category']); ?></u></h4>
                <h4>CONCERN ID: <u><?php echo strtoupper($row['concernid']); ?></u></h4>
                <h4>ISSUED ON: <u><?php echo $row['issuedon']; ?></u></h4>
                <h4>
                    ATTENDED ON: 
                    <input type="text" name="attendedon" value="<?php echo isset($row['attendedon']) ? $row['attendedon'] : "Unknown"; ?>" placeholder="YYYY-MM-DD HH:MM:SS">
                </h4>
                <h4>
                    ATTENDED BY: 
                    <input type="text" name="attendedby" value="<?php echo isset($row['attendedby']) ? strtoupper($row['attendedby']) : "Unknown"; ?>" placeholder="Attended By">
                </h4>
                <h4>
                    AGENCY: 
                    <input type="text" name="agency" value="<?php echo isset($row['agency']) ? strtoupper($row['agency']) : "Unknown"; ?>" placeholder="Agency">
                </h4>
                <h4>
                    PRICE: 
                    <input type="number" name="price" value="<?php echo isset($row['price']) ? $row['price'] : ""; ?>" placeholder="Price">
                </h4>
                <h4>
                    STATUS: 
                    <select name="status">
                        <option value="COMPLETED" <?php echo ($row['status'] == "COMPLETED") ? "selected" : ""; ?>>COMPLETED</option>
                        <option value="ONGOING" <?php echo ($row['status'] == "ONGOING") ? "selected" : ""; ?>>ONGOING</option>
                        <option value="NOT STARTED" <?php echo ($row['status'] == "NOT STARTED") ? "selected" : ""; ?>>NOT STARTED</option>
                    </select>
                </h4>
                <button type="submit">Update</button>
            </form>
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
        </div>
    </body>
</html>
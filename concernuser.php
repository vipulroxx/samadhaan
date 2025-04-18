<?php
    session_start();
    include "connection.php";

    // Check if the form was submitted via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['concern-id'])) {
        $id = $_POST['concern-id']; // Get the concern ID from the form
        $_SESSION['concern-id'] = $id;

        // Fetch the concern details from the database
        $concern_query = "SELECT * FROM concern WHERE id='$id'";
        $concern_result = mysqli_query($conn, $concern_query);

        // Check if the query executed successfully
        if (!$concern_result) {
            die("Query failed: " . mysqli_error($conn));
        }

        // Fetch the concern data
        $row = mysqli_fetch_assoc($concern_result);

        // Check if data exists for the given concern ID
        if (!$row) {
            die("No data found for concern ID: $id");
        }
    } else {
        die("Invalid request. Concern ID not provided.");
    }
?>
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
            <h1>Hello, <?php echo isset($_SESSION['name']) && !empty($_SESSION['name']) ? $_SESSION['name'] : "User"; ?>!</h1>
            <a href="logout.php">Logout</a>
            <a href="home.php">Home</a>
        </div>
        <div class="concern-container" style="width:80%;">
            <?php echo "<h2>Concern of ".(isset($row['name']) && !empty($row['name']) ? strtoupper($row['name']) : "Unknown")."</h2>"?>
            <?php echo "<h4>CATEGORY: <u>".(isset($row['category']) && !empty($row['category']) ? strtoupper($row['category']) : "Unknown")."</u></h4>"?>
            <?php echo "<h4>CONCERN ID: <u>".(isset($row['concernid']) && !empty($row['concernid']) ? strtoupper($row['concernid']) : "Unknown")."</u></h4>"?> 
            <?php echo "<h4>ISSUED ON: <u>".(isset($row['issuedon']) && !empty($row['issuedon']) ? $row['issuedon'] : "Unknown")."</u></h4>"?>
            <?php echo "<h4>ATTENDED ON: <u>".(isset($row['attendedon']) && !empty($row['attendedon']) ? $row['attendedon'] : "Unknown")."</u> BY <u>".(isset($row['attendedby']) && !empty($row['attendedby']) ? strtoupper($row['attendedby']) : "Unknown")."</u></h4>"?>
            <?php echo "<h4>AGENCY: <u>".(isset($row['agency']) && !empty($row['agency']) ? strtoupper($row['agency']) : "Unknown")."</u></h4>"?>
            <?php echo "<h4>PRICE: ".(isset($row['price']) && !empty($row['price']) ? $row['price']." Rupees" : "Unknown")."</h4>"?>
            <?php echo "<h4>CONCERN: ".(isset($row['concern']) && !empty($row['concern']) ? $row['concern'] : "Unknown")."</h4>"?>
            
            <figure style="display: inline-block; margin: 10px;">
                <img src='<?php echo isset($row['image']) && !empty($row['image']) ? $row['image'] : "default-image.jpg"; ?>' >
                <figcaption><b>BEFORE</b></figcaption>
            </figure>
            <?php if (isset($row['completed']) && !empty($row['completed'])) { ?>
            <figure style="display: inline-block; margin: 10px;">
                <img src='<?php echo $row['completed']; ?>' >
                <figcaption><b>AFTER</b></figcaption>
            </figure><br>
            <?php } ?>
        </div>
    </body>
</html>
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
        <form action="signup-check.php" method="POST">
            <h2>SIGN UP</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <label>Name</label>
            <?php if (isset($_GET['name'])) { ?>
                <input type="text" 
                        name="name" 
                        placeholder="Full Name"
                        value="<?php echo $_GET['name']; ?>"><br>
            <?php }else{ ?>
                <input type="text" 
                        name="name" 
                        placeholder="Full Name"><br>
            <?php }?>

            <label>Employee ID</label>
            <?php if (isset($_GET['employeeid'])) { ?>
                <input type="text" 
                        name="employeeid" 
                        placeholder="Employee ID"
                        value="<?php echo $_GET['employeeid']; ?>"><br>
            <?php }else{ ?>
                <input type="text" 
                        name="employeeid" 
                        placeholder="Employee ID"><br>
            <?php }?>

            <label>Email</label>
            <?php if (isset($_GET['email'])) { ?>
                <input type="text" 
                        name="email" 
                        placeholder="Email Address"
                        value="<?php echo $_GET['email']; ?>"><br>
            <?php }else{ ?>
                <input type="text" 
                        name="email" 
                        placeholder="Email Address"><br>
            <?php }?>
            
            <label>Password</label>
            <input type="password" 
                    name="password" 
                    placeholder="Password"><br>

            <label>Re Password</label>
            <input type="password" 
                    name="re_password" 
                    placeholder="Re_Password"><br>

            <button type="submit">Sign Up</button>
            <a href="index.php" class="ca">Already have an account?</a>
        </form>
    </body>
</html>
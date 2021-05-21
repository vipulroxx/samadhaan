<?php 
    session_start();

    if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
        if ($_SESSION['user_name'] == 'rootadmin1') {
            header('Location:admin.php');
        }
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Samadhaan</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <div id="greeting">
                <h1 style="font-size:30px;">Hello, <?php echo $_SESSION['name']; ?>!</h1>
                <a style="position:absolute; right: 0px;"href="logout.php">Logout</a>
            </div>
            <form action="submit.php" style="position:relative; top: 6%;" method="POST" enctype="multipart/form-data">
                <h2>Log Your Concern</h2>
                <label for="housetype">House Type</label>
                <select name="house-type" id="house-type">
                    <option value="type">Type</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="JSQ">JSQ</option>
                </select>
                <label for="housenumber">House Number</label>
                <select name="house-number" id="house-number">
                    <option value="number">Number</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="1A">1A</option>
                    <option value="1B">1B</option>
                    <option value="2A">2A</option>
                    <option value="2B">2B</option>
                    <option value="3A">3A</option>
                    <option value="3B">3B</option>
                    <option value="4A">4A</option>
                    <option value="4B">4B</option>
                </select><br><br>
                <label for="category">Category</label>
                <select name="category" id="concern-category">
                    <option value="category">Category</option>
                    <option value="civil">Civil</option>
                    <option value="electrical">Electrical</option>
                    <option value="plumbing">Plumbing</option>
                    <option value="housekeeping">Housekeeping</option>
                    <option value="others">Others</option>
                    </optgroup>
                </select><br><br>
                <label>Explain Your Concern</label><br>
                <textarea name="concern" id="concern" rows="10" cols="50"></textarea><br>
                <label>Upload Photo</label>
                <input type='file' name='file' />
                <button type="submit" style="float: none; width: 100%;">Submit Concern</button>
            </form>
        </body>
    </html>
<?php 
    }else{
        header("Location: index.php");
        exit();
    }
?>
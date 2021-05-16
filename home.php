<?php 
    session_start();

    if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
<!DOCTYPE html>
    <html>
        <head>
            <title>HOME</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <div id="greeting">
                <h1>Hello, <?php echo $_SESSION['name']; ?>!</h1>
                <a href="logout.php">Logout</a>
            </div>
            <form id="concern-form">
                <h2>Log Your Concern</h2>
                <label for="housenumber">House Number</label>
                <select name="cars" id="cars">
                    <optgroup label="A">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </optgroup>
                    <optgroup label="B">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </optgroup>
                </select>
                <label for="category">Category</label>
                <select name="category" id="concern-category">
                    <option value="civil">Civil</option>
                    <option value="electrical">Electrical</option>
                    <option value="plumbing">Plumbing</option>
                    <option value="housekeeping">Housekeeping</option>
                    <option value="others">Others</option>
                    </optgroup>
                </select><br><br>
                <label>Explain Your Concern</label><br>
                <textarea id="concern" rows="10" cols="50"></textarea><br>
                <label>Upload Photo</label>
                <input type="file">
                <button type="submit" style="float: none; width: 100%;">Submit Concern</button
</form>
            </form>
        </body>
    </html>
<?php 
    }else{
        header("Location: index.php");
        exit();
    }
?>
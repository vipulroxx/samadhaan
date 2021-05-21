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
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="JSQ">JSQ</option>
                </select>
                <label for="housenumber">House Number</label>
                <select name="house-number" id="house-number">
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
                </select><br><br>
                <script>
                    const houseNumbers = {"A":[{value:1,desc:"1"},
                                            {value:2,desc:"2"},
                                            {value:3,desc:"3"},
                                            {value:4,desc:"4"},
                                            {value:5,desc:"5"},
                                            {value:6,desc:"6"},
                                            {value:7,desc:"7"},
                                            {value:8,desc:"8"},
                                            {value:9,desc:"9"},
                                            {value:10,desc:"10"},
                                            {value:11,desc:"11"},
                                            {value:12,desc:"12"}],
                                        "B":[{value:1,desc:"1"},
                                            {value:2,desc:"2"},
                                            {value:3,desc:"3"},
                                            {value:4,desc:"4"},
                                            {value:5,desc:"5"},
                                            {value:6,desc:"6"},
                                            {value:7,desc:"7"},
                                            {value:8,desc:"8"},
                                            {value:9,desc:"9"},
                                            {value:10,desc:"10"},
                                            {value:11,desc:"11"},
                                            {value:12,desc:"12"}],
                                        "C":[{value:1,desc:"1"},
                                            {value:2,desc:"2"},
                                            {value:3,desc:"3"},
                                            {value:4,desc:"4"},
                                            {value:5,desc:"5"},
                                            {value:6,desc:"6"},
                                            {value:7,desc:"7"},
                                            {value:8,desc:"8"},
                                            {value:9,desc:"9"},
                                            {value:10,desc:"10"},
                                            {value:11,desc:"11"},
                                            {value:12,desc:"12"}],
                                        "D":[{value:1,desc:"1"},
                                            {value:2,desc:"2"},
                                            {value:3,desc:"3"},
                                            {value:4,desc:"4"},
                                            {value:5,desc:"5"},
                                            {value:6,desc:"6"},
                                            {value:7,desc:"7"},
                                            {value:8,desc:"8"},
                                            {value:9,desc:"9"},
                                            {value:10,desc:"10"},
                                            {value:11,desc:"11"},
                                            {value:12,desc:"12"}],
                                        "JSQ":[{value:"1A",desc:"1A"},
                                            {value:"1B",desc:"1B"},
                                            {value:"2A",desc:"2A"},
                                            {value:"2B",desc:"2B"},
                                            {value:"3A",desc:"3A"},
                                            {value:"3B",desc:"3B"},
                                            {value:"4A",desc:"4A"},
                                            {value:"4B",desc:"4B"}]}

                    const houseNumber = document.querySelector('[name=house-number]');
                    document.querySelector('[name=house-type]').addEventListener('change', function(e) {
                        houseNumber.innerHTML = houseNumbers[this.value].reduce((acc, elem) => `${acc}<option value="${elem.value}">${elem.desc}</option>`, "");
                    });
                </script>
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
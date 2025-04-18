<?php 
	session_start(); 
	include "connection.php";
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	if (isset($_POST['employeeid']) && isset($_POST['password'])
		&& isset($_POST['name']) && isset($_POST['re_password'])) {

		function validate($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			$prefix = array("MR.", "MS.", "MRS.", "DR.", "MR", "MS", "MRS", "DR");
			for ($i = 0; $i < sizeof($prefix); $i++)
			{
				if (substr($data, 0, strlen($prefix[$i])) == $prefix[$i]) {
					$data = substr($data, strlen($prefix[$i]));
				}
			}
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		if (empty($_POST['name'])) {
			header("Location: signup.php?error=Name is required&$user_data");
			exit();
		}

		$employeeid = validate($_POST['employeeid']);
		$pass = validate($_POST['password']);
		$email = $_POST['email'];

		$re_pass = validate($_POST['re_password']);
		$name = validate(strtoupper($_POST['name']));

		$user_data = 'employeeid='. $employeeid. '&name='. $name;

		if (empty($employeeid)) {
			header("Location: signup.php?error=Employee ID is required&$user_data");
			exit();
		}
		else if (empty($email)) {
			header("Location: signup.php?error=Email is required&$user_data");
			exit();
		}
		else if(empty($pass)){
			header("Location: signup.php?error=Password is required&$user_data");
			exit();
		}
		else if(empty($re_pass)){
			header("Location: signup.php?error=Re Password is required&$user_data");
			exit();
		}
		else if($pass !== $re_pass){
			header("Location: signup.php?error=The confirmation password  does not match&$user_data");
			exit();
		}
		else{
			$pass = md5($pass);
			$emailchecksql = "SELECT * FROM users WHERE email='$email'";
			$checkemployeeid = "SELECT * FROM idtable WHERE employee_id='$employeeid' AND name='$name'";
			$result2 = mysqli_query($conn, $emailchecksql);
			$result3 = mysqli_query($conn, $checkemployeeid);
			if (mysqli_num_rows($result2) > 0) {
				header("Location: signup.php?error=The email is already taken, try another&$user_data");
				exit();
			}else if (mysqli_num_rows($result3) != 1) {
				header("Location: signup.php?error=Incorrect Employee ID or Name or Both&$user_data");
				exit();
			}else {
			$sql2 = "INSERT INTO users(employee_id, email, password, name, user_name) 
			         VALUES('$employeeid', '$email', '$pass', '$name', '$employeeid')";
			$result2 = mysqli_query($conn, $sql2);
			if ($result2) {
				header("Location: signup.php?success=Your account has been created successfully");
				exit();
			}else {
					header("Location: signup.php?error=Unknown error occurred&$user_data");
					exit();
			}
			}
		}
		
	}else{
		header("Location: signup.php");
		exit();
	}
?>
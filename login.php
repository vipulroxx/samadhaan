<?php 
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include "connection.php";

	if (isset($_POST['employeeid']) && isset($_POST['password'])) {

		function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}

		$employeeid = validate($_POST['employeeid']);
		$pass = validate($_POST['password']);

		if (empty($employeeid)) {
			header("Location: index.php?error=Employee ID is required");
			exit();
		}else if(empty($pass)){
			header("Location: index.php?error=Password is required");
			exit();
		}else{
			$pass = md5($pass);
			
			$sql = "SELECT * FROM users WHERE employee_id='$employeeid' AND password='$pass'";

			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) === 1) {
				$row = mysqli_fetch_assoc($result);
				if ($row['employee_id'] === $employeeid && $row['password'] === $pass) {
					$_SESSION['employee_id'] = $row['employee_id'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['email'] = $row['email'];
					header("Location: home.php");
					exit();
				}else{
					header("Location: index.php?error=Incorect Employee ID or Password");
					exit();
				}
			}else{
				header("Location: index.php?error=Incorect Employee ID or Password");
				exit();
			}
		}
		
	}else{
		header("Location: index.php");
		exit();
	}
?>
<?php ob_start();
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$captchaResult = $_POST["captchaResult"];
		$firstNumber = $_POST["firstNumber"];
		$secondNumber = $_POST["secondNumber"];
		$checkTotal = $firstNumber + $secondNumber;
		
		if ($captchaResult == $checkTotal) { 
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM admin WHERE username = '$username' AND status= '1'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot find account with the username';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				echo $_SESSION['admin'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
	  }
	  else{// Captcha verification is Correct. Final Code Execute here!	
		$_SESSION['error'] = 'Captcha verification is incorrect';
		}
	}
	else{
		$_SESSION['error'] = 'Input admin credentials first';
	}

	header('location: ../index.php');
	ob_end_flush();
?>
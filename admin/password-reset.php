<?php
	include 'includes/session.php';
	if(isset($_GET['return'])){
			$return = $_GET['return'];
			
		}
		else{
			$return = 'home.php';
		}
	if(isset($_POST['PasswordReset'])){
		$emp_id = $_POST['emp_id'];
		$emp_id = $_POST['emp_id'];
		$password = $_POST['password'];
		$password = password_hash($password, PASSWORD_DEFAULT);
		$sql = "UPDATE employees SET password = '$password' WHERE id = '$emp_id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Emplyee ('.$emp_id.') Password Reset successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to update Password first';
	}

	header('location:'.$return);
?>
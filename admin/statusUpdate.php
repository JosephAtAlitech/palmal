<?php
	include 'includes/session.php';
	if(isset($_GET['return'])){
			$return = $_GET['return'];
			
		}
		else{
			$return = 'employee.php';
		}
	if(isset($_POST['statusUpdate'])){
		$emp_id = $_POST['id'];
		$emp_status = $_POST['emp_status'];
		
		$sql = "UPDATE employees SET employee_status = '$emp_status',status_up_date = NOW() WHERE id = '$emp_id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Emplyee ('.$emp_id.') Status Reset successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to update  Status first';
	}

	header('location:'.$return);
?>
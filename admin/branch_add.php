<?php
	include 'includes/session.php';

	if(isset($_POST['addBranch'])){
		$loginID = $_SESSION['admin'];
		$branchName = $_POST['branchName'];
		$branchCode = $_POST['branchCode'];
		
		$sql = "INSERT INTO branch_master (branch_name,branch_code,create_date,status) 
				VALUES ('$branchName','$branchCode',Now(),'Active')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Branch added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: branch-master.php');

?>
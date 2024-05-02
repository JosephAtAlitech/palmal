<?php
	include 'includes/session.php';

	if(isset($_POST['EditBranch'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$branchName = $_POST['branchName'];
		$branchCode = $_POST['branchCode'];
		
		
		$sql = "UPDATE `branch_master` SET branch_name ='$branchName', branch_code ='$branchCode',update_date = Now() where id='$id'";
	//	echo $sql;
		if($conn->query($sql)){
			$_SESSION['success'] = 'Branch Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:branch-master.php');
	}	
	
	if(isset($_POST['deleteBranch'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		
		$sql = "UPDATE `branch_master` SET status='In-Active' , delete_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Branch Deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:branch-master.php');
	}
	
	if(isset($_POST['activatedBranch'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE `branch_master` SET status='$status' , delete_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Branch Activated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:branch-master.php');
	}	

?>
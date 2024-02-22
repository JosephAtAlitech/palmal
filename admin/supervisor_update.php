<?php
	include 'includes/session.php';
	
	if(isset($_POST['addSupervisor'])){
		$loginID = $_SESSION['admin'];
		$locationSupervisor = $_POST['locationSupervisor'];
		$PhoneNumber = $_POST['PhoneNumber'];
		$status = $_POST['status'];
		
		$sql = "INSERT INTO supervisor_master (supervisor_name,phone,status,create_date) 
				VALUES ('$locationSupervisor','$PhoneNumber','$status',Now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Supervisor added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:supervisor-master.php');
	}	
	
	if(isset($_POST['EditSupervisor'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$locationSupervisor = $_POST['locationSupervisor'];
		$PhoneNumber = $_POST['PhoneNumber'];
		$status = $_POST['status'];
		
		
		$sql = "UPDATE `supervisor_master` SET supervisor_name ='$locationSupervisor',phone='$PhoneNumber',status='$status',update_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Supervisor Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:supervisor-master.php');
	}	
	
	if(isset($_POST['deleteSupervisor'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		
		$sql = "UPDATE `supervisor_master` SET status='In-Active' , update_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Supervisor In-Active successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:supervisor-master.php');
	}
	
	if(isset($_POST['activatedSupervisor'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE `supervisor_master` SET status='$status' , update_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Supervisor Activated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:supervisor-master.php');
	}	

?>
<?php
	include 'includes/session.php';

	if(isset($_POST['EditLocation'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$editLocation_name = $_POST['editLocation_name'];
		
		
		$sql = "UPDATE `location_master` SET location_name ='$editLocation_name',update_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Location Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:location-master.php');
	}	
	
	if(isset($_POST['deleteLocation'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		
		$sql = "UPDATE `location_master` SET status='In-Active' , update_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Location In-Active successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:location-master.php');
	}
	
	if(isset($_POST['activatedLocation'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE `location_master` SET status='$status' , update_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Location Activated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:location-master.php');
	}	

?>
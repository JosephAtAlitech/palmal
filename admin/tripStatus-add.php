<?php
	include 'includes/session.php';
date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime($test))->format("Y-m-d H:i:s");
	if(isset($_POST['addTripStatus'])){
		$loginID = $_SESSION['admin'];
		$veId = $_POST['veId'];
		$VahecleName = $_POST['VahecleName'];
		$tripId = $_POST['tripId'];
		$tripLoadingStatus = $_POST['tripLoadingStatus'];
		$tripStatus = $_POST['tripStatus'];
		
		$sql = "INSERT INTO vehecle_status (trip_id,vehecle_id,trip_status,trip_loading_status,create_date) 
				VALUES ('$tripId','$veId','$tripStatus','$tripLoadingStatus','$toDay')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Trip added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	if(isset($_POST['addDriverStatus'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['veid12'];
		$driverId = $_POST['driverId'];
		$driverStatus = $_POST['driverStatus'];
		
		$sql = "Update vehecle_status set driver_id='$driverId',driver_status='$driverStatus',status='Warning' where vehecle_id='$id'"; 
				
		if($conn->query($sql)){
			$_SESSION['success'] = 'Driver Allocated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	if(isset($_POST['addHelperStatus'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['veid123'];
		$helperId = $_POST['helperId'];
		$helperStatus = $_POST['helperStatus'];
		
		$sql = "Update vehecle_status set helper_id='$helperId',helper_status='$helperStatus',status='Warning' where vehecle_id='$id'"; 
				
		if($conn->query($sql)){
			$_SESSION['success'] = 'Hleper Allocated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	if(isset($_POST['deleteVehicleStatus'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		
		$sql = "Update vehecle_status set delete_status='2',delete_date='$toDay',status='Complete' where vehecle_id='$id'"; 
				
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehecle Clear successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	if(isset($_POST['startVehicleStatus'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		
		$sql = "Update vehecle_status set status='Running',create_date='$toDay' where vehecle_id='$id'"; 
				
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehecle Start successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>
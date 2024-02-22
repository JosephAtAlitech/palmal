<?php
	include 'includes/session.php';

	if(isset($_POST['editTyre'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$tyreDate = $_POST['tyreDate'];
		$tyreVehicle = $_POST['tyreVehicle'];
		$tyreType = $_POST['tyreType'];
		$Tyreposition = $_POST['Tyreposition'];
		$tyreNumber = $_POST['tyreNumber'];
		$tyreCompany = $_POST['tyreCompany'];
		$tyreModel = $_POST['tyreModel'];
		$tyreCost = $_POST['tyreCost'];
		$tyreSupervisor = $_POST['tyreSupervisor'];
		$tyreStatus = $_POST['tyreStatus'];
		
		
		$sql = "UPDATE tyre_master SET date='$tyreDate',vehicle_no='$tyreVehicle',tyre_type='$tyreType',tyre_position='$Tyreposition',tyre_no='$tyreNumber',tyre_company='$tyreCompany',tyre_model='$tyreModel',tyre_cost='$tyreCost',supervisor='$tyreSupervisor',status='$tyreStatus' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Tyre updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:tyre-master.php');
	}
	
	if(isset($_POST['ActivationTyre'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE `tyre_master` SET status ='$status' , update_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Tyre Activated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:tyre-master.php');
	}
	
	if(isset($_POST['deleteDriver12'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE `driver_master` SET status='In-Active' , update_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Driver In-Activated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:driver-master.php');
	}	
	

?>
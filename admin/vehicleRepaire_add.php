<?php
	include 'includes/session.php';
	// add Vehicle Repaire expenses
	if(isset($_POST['addVeRepaire'])){
		$loginID = $_SESSION['admin'];
		$repaireDate = $_POST['repaireDate'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$lfNumber = $_POST['lfNumber'];
		$particulars = $_POST['particulars'];
		$RepaireType = $_POST['RepaireType'];
		$amount = $_POST['Repamount'];
		
		$sql = "INSERT INTO vehicle_repaire (repaire_date,vehicle_no,lf_number,particulars,repaire_type,amount,create_date) 
				VALUES ('$repaireDate','$vehicleNumber','$lfNumber','$particulars','$RepaireType','$amount',Now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle Repaire Added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: vehicle-repaire.php');
	}	
	
	// edit Vehicle Repaire expenses
	if(isset($_POST['editVeRepaire'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$repaireDate = $_POST['repaireDate'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$lfNumber = $_POST['lfNumber'];
		$particulars = $_POST['particulars'];
		$RepaireType = $_POST['RepaireType'];
		$amount = $_POST['Repamount'];
		
		$sql = "UPDATE vehicle_repaire SET repaire_date = '$repaireDate',vehicle_no ='$vehicleNumber',lf_number = '$lfNumber',particulars='$particulars',repaire_type='$RepaireType',amount='$amount',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle Repaire Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: vehicle-repaire.php');
	}	
	
	// Delete Vehicle Repaire expenses
	if(isset($_POST['deleteVehicleRepaire'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		
		
		$sql = "UPDATE vehicle_repaire SET delete_status = 'In-Active',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle Repaire Deleteed successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: vehicle-repaire.php');
	}	
	

?>
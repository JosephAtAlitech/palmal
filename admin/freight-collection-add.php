<?php
	include 'includes/session.php';
	// add ledger
	if(isset($_POST['addFreight'])){
		$loginID = $_SESSION['admin'];
		$tripNumber = $_POST['tripNumber'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$partyName = $_POST['partyName'];
		$partyPhone = $_POST['partyPhone'];
		$tripAdance = $_POST['tripAdance'];
		$TripAdvanceBy = $_POST['TripAdvanceBy'];
		$accountType = $_POST['accountType'];
		$freightDate = $_POST['freightDate'];
		$tripDetails = $_POST['tripDetails'];
		
		$sql = "INSERT INTO freight_collection (trip_no,vehicle_no,party_name,party_phone,trip_advance,trip_advance_by,acc_type,freight_date,trip_details,create_date) 
				VALUES ('$tripNumber','$vehicleNumber','$partyName','$partyPhone','$tripAdance','$TripAdvanceBy','$accountType','$freightDate','$tripDetails',Now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Freight Collection added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: freight-collection.php');
	}	
	// Edit ledger
	if(isset($_POST['editFreight'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$tripNumber = $_POST['tripNumber'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$partyName = $_POST['partyName'];
		$partyPhone = $_POST['partyPhone'];
		$tripAdance = $_POST['tripAdance'];
		$TripAdvanceBy = $_POST['TripAdvanceBy'];
		$accountType = $_POST['accountType'];
		$freightDate = $_POST['freightDate'];
		$tripDetails = $_POST['tripDetails'];
		
		$sql = "Update freight_collection set trip_no='$tripNumber',vehicle_no='$vehicleNumber',party_name='$partyName',party_phone='$partyPhone',trip_advance='$tripAdance',trip_advance_by='$TripAdvanceBy',acc_type='$accountType',freight_date='$freightDate',trip_details='$tripDetails' where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Freight Collection Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: freight-collection.php');
	}	
	
	// Delete ledger
	if(isset($_POST['deleteFreight'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$tripNumber = $_POST['tripNumber'];
		
		
		$sql = "Update freight_collection set status='In-Active',update_date=Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Freight Collection Deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: freight-collection.php');
	}	
	

?>
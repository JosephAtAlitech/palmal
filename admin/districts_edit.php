<?php
	include 'includes/session.php';

	if(isset($_POST['EditDistricts'])){
		$id = $_POST['id'];
		$division = $_POST['division'];
		$Districtname = $_POST['Districtname'];
		$Address = $_POST['Address'];

		$sql = "UPDATE districts SET division = '$division',districts ='$Districtname',address = '$Address',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Districts updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:districts.php');

?>
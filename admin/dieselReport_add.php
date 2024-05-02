<?php
	include 'includes/session.php';
	// add Diesel Reports
	if(isset($_POST['addDieselReports'])){
		$loginID = $_SESSION['admin'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$dieselDate = $_POST['dieselDate'];
		$fuelType = $_POST['fuelTypeText'];
		$SlipNumber = $_POST['SlipNumber'];
		$PumpName = $_POST['PumpName'];
		$EnterAmount = $_POST['EnterAmount'];
		$DieselInLitre = $_POST['DieselInLitre'];
		$RatePerlitre = $_POST['fuelRate'];
		
	$sql = "INSERT INTO diesel_reports (diesel_date,vehicle_no,diesel_type,diesel_litre,litre_price,total_amount,pump_name,slip_number,create_date) 
				VALUES ('$dieselDate','$vehicleNumber','$fuelType','$DieselInLitre','$RatePerlitre','$EnterAmount','$PumpName','$SlipNumber',Now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Fuel sheet added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: dieselReport.php');
	}	
	
	// edit Diesel Reports
	if(isset($_POST['updateDieselReports'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$dieselDate = $_POST['dieselDate'];
		$fuelType = $_POST['fuelTypeText'];
		$SlipNumber = $_POST['SlipNumber'];
		$PumpName = $_POST['PumpName'];
		$EnterAmount = $_POST['EnterAmount'];
		$DieselInLitre = $_POST['DieselInLitre'];
		$RatePerlitre = $_POST['fuelRate'];
		
		$sql = "UPDATE diesel_reports SET diesel_date='$dieselDate',vehicle_no='$vehicleNumber',diesel_litre='$DieselInLitre',litre_price='$RatePerlitre',total_amount='$EnterAmount',pump_name='$PumpName',slip_number='$SlipNumber',delete_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Fuel Sheet Updated Successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: dieselReport.php');
	}	
	
	// Delete Diesel Repaire expenses
	if(isset($_POST['deleteDieselRep'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		
		
		$sql = "UPDATE diesel_reports SET delete_status = 'In-Active',delete_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Fuel Sheet Deleteed Successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: dieselReport.php');
	}	
	

?>
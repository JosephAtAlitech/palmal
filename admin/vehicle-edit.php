<?php
	include 'includes/session.php';

	if(isset($_POST['editVehicle'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$oilTankCapacity = $_POST['oilTankCapacity'];
		$RegistrationDate = $_POST['RegistrationDate'];
		$MakersName = $_POST['MakersName'];
		$YearOfManufacture = $_POST['YearOfManufacture'];
		$ChesisNumber = $_POST['ChesisNumber'];
		$EnginNumber = $_POST['EnginNumber'];
		
		//$RegistrationCirtificate = $_POST['RegistrationCirtificate'];
		$regfilename = $_FILES['RegistrationCirtificate']['name'];
		if(!empty($regfilename)){
			move_uploaded_file($_FILES['RegistrationCirtificate']['tmp_name'], '../images/registration/'.$regfilename);	
			$sql = "UPDATE vehicle_master SET registration_cirtificate='$regfilename'";
			$conn->query($sql);
		}
		else {
			
		}
		
		$RegistrationStartDate = $_POST['RegistrationStartDate'];
		$RegistrationEndDate = $_POST['RegistrationEndDate'];
		
		//$Insurancecertificate = $_POST['Insurancecertificate'];
		$Insfilename = $_FILES['Insurancecertificate']['name'];
		if(!empty($Insfilename)){
			move_uploaded_file($_FILES['Insurancecertificate']['tmp_name'], '../images/insurance/'.$Insfilename);
			$sql = "UPDATE vehicle_master SET insurance_cirtificate='$Insfilename'";
			$conn->query($sql);			
		}
		else{
			
		}
		
		$InsuranceStartDate = $_POST['InsuranceStartDate'];
		$InsuranceEndDate = $_POST['InsuranceEndDate'];
		
		//$Pollution = $_POST['Pollution'];
		$Pollutionfilename = $_FILES['PollutionCirtificate']['name'];
		if(!empty($Pollutionfilename)){
			move_uploaded_file($_FILES['PollutionCirtificate']['tmp_name'], '../images/pollution/'.$Pollutionfilename);	
			$sql = "UPDATE vehicle_master SET pollution_cirtificate='$Pollutionfilename'";
			$conn->query($sql);	
		}
		else{
			
		}
		
		$PollutionStartDate = $_POST['PollutionStartDate'];
		$PollutionEndDate = $_POST['PollutionEndDate'];
		$Permit = $_POST['Permit'];
		$PermitStartDate = $_POST['PermitStartDate'];
		$PermitEndDate = $_POST['PermitEndDate'];
		
		//$PermitCirtificate = $_POST['PermitCirtificate'];
		$Permitfilename = $_FILES['PermitCirtificate']['name'];
		if(!empty($Permitfilename)){
			move_uploaded_file($_FILES['PermitCirtificate']['tmp_name'], '../images/permit/'.$Permitfilename);
			$sql = "UPDATE vehicle_master SET permit_cirtificate='$Permitfilename'";
			$conn->query($sql);
		}
		else{
			
		}
		
		$BranchStatus = $_POST['BranchStatus'];
		

		$sql = "UPDATE vehicle_master SET  oil_tank_capacity='$oilTankCapacity',vehicle_number='$vehicleNumber',registration_date='$RegistrationDate',makers_name='$MakersName',year_of_manufacture='$YearOfManufacture',chasis_number='$ChesisNumber',engin_number='$EnginNumber',reg_start_date='$RegistrationStartDate',reg_end_date='$RegistrationEndDate',insu_start_date='$InsuranceStartDate',insu_end_date='$InsuranceEndDate',pollu_start_date='$PollutionStartDate',pollu_end_date='$PollutionEndDate',permits='$Permit',per_start_date='$PermitStartDate',per_end_date='$PermitEndDate',branch_status='$BranchStatus' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:vehicle-master.php');
	}
	
	if(isset($_POST['deleteVehicle'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		
		$sql = "UPDATE `vehicle_master` SET delete_status ='In-Active' , delete_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle Deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:vehicle-master.php');
	}
	
	if(isset($_POST['activatedVehicle'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE `vehicle_master` SET delete_status='$status' , delete_date = Now() where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle Activated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:vehicle-master.php');
	}	
	

?>
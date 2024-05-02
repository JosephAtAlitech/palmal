<?php include 'includes/session.php';

	if(isset($_POST['addDricver'])){
		$loginID = $_SESSION['admin'];
		$DriverName = $_POST['DriverName'];
		$PhoneNumber = $_POST['PhoneNumber'];
		$AlternateNumber = $_POST['AlternateNumber'];
		$DriverLicenceNumber = $_POST['DriverLicenceNumber'];
		$DriverLicenceExpireDate = $_POST['DriverLicenceExpireDate'];
		$driverSalaries = $_POST['driverSalaries'];
		$DriverPhoneLimit = $_POST['DriverPhoneLimit'];
		
		//$UploadDriverLicence = $_POST['UploadDriverLicence'];
		$Licencefilename = $_FILES['UploadDriverLicence']['name'];
		if(!empty($Licencefilename)){
			move_uploaded_file($_FILES['UploadDriverLicence']['tmp_name'], '../images/driver/'.$Licencefilename);	
		}
		
		//$driverImage = $_POST['driverImage'];
		$driverImagefilename = $_FILES['driverImage']['name'];
		if(!empty($driverImagefilename)){
			move_uploaded_file($_FILES['driverImage']['tmp_name'], '../images/driver/'.$driverImagefilename);	
		}
		
		//$AadharCard = $_POST['AadharCard'];
		$AadharCardfilename = $_FILES['AadharCard']['name'];
		if(!empty($AadharCardfilename)){
			move_uploaded_file($_FILES['AadharCard']['tmp_name'], '../images/driver/'.$AadharCardfilename);	
		}
		
		//$BankAccounts = $_POST['BankAccounts'];
		$BankAccountsfilename = $_FILES['BankAccounts']['name'];
		if(!empty($BankAccountsfilename)){
			move_uploaded_file($_FILES['BankAccounts']['tmp_name'], '../images/driver/'.$BankAccountsfilename);	
		}
		
		
		$sql = "INSERT INTO driver_master (driver_name,phone,alter_phone,licence_number,licence_exp_date,dri_licence_image,dri_image,drice_aadhar_card,drive_bank_accounts,driver_salaries,driver_phone_limit,create_date,status) 
		VALUES ('$DriverName','$PhoneNumber','$AlternateNumber','$DriverLicenceNumber','$DriverLicenceExpireDate','$Licencefilename','$driverImagefilename','$AadharCardfilename','$BankAccountsfilename','$driverSalaries','$DriverPhoneLimit',Now(),'Active')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Driver added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: driver-master.php');

?>
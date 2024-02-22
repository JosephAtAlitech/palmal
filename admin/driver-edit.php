<?php
	include 'includes/session.php';
	
	date_default_timezone_set('Asia/Dhaka');
    $toDay = (new DateTime($test))->format("Y-m-d H:i:s");

	if(isset($_POST['editDricver'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
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
			$sql = "UPDATE driver_master SET  dri_licence_image='$Licencefilename' where id='$id'";
			$conn->query($sql);
		}
		else{}
		
		//$driverImage = $_POST['driverImage'];
		$driverImagefilename = $_FILES['driverImage']['name'];
		if(!empty($driverImagefilename)){
			move_uploaded_file($_FILES['driverImage']['tmp_name'], '../images/driver/'.$driverImagefilename);	
			$sql = "UPDATE driver_master SET dri_image='$driverImagefilename' where id='$id'";
			$conn->query($sql);
		}
		else{}
		
		//$AadharCard = $_POST['AadharCard'];
		$AadharCardfilename = $_FILES['AadharCard']['name'];
		if(!empty($AadharCardfilename)){
			move_uploaded_file($_FILES['AadharCard']['tmp_name'], '../images/driver/'.$AadharCardfilename);	
			$sql = "UPDATE driver_master SET drice_aadhar_card='$AadharCardfilename' where id='$id'";
			$conn->query($sql);
		}
		else{}
		
		//$BankAccounts = $_POST['BankAccounts'];
		$BankAccountsfilename = $_FILES['BankAccounts']['name'];
		if(!empty($BankAccountsfilename)){
			move_uploaded_file($_FILES['BankAccounts']['tmp_name'], '../images/driver/'.$BankAccountsfilename);
			$sql = "UPDATE driver_master SET drive_bank_accounts='$BankAccountsfilename' where id='$id'";
			$conn->query($sql);
		}
		else{}
		

		$sql = "UPDATE driver_master SET driver_name='$DriverName',phone='$PhoneNumber',alter_phone='$AlternateNumber',licence_number='$DriverLicenceNumber',licence_exp_date='$DriverLicenceExpireDate',driver_salaries='$driverSalaries',driver_phone_limit='$DriverPhoneLimit' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:driver-master.php');
	}
	
	if(isset($_POST['activatedDriver'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE `driver_master` SET status ='$status' , update_date = '$toDay' where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle Deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:driver-master.php');
	}
	
	if(isset($_POST['deleteDriver12'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE `driver_master` SET status='In-Active' , update_date = '$toDay' where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Driver In-Activated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:driver-master.php');
	}	
	

?>
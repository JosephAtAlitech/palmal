<?php
	include 'includes/session.php';

	if(isset($_POST['addCustomer'])){
		$loginID = $_SESSION['admin'];
		$fCustomerName = $_POST['fCustomerName'];
		$lContactPerson = $_POST['lContactPerson'];
		$userName = $_POST['userName'];
		
		$EmailAddress = $_POST['EmailAddress'];
		$PhoneNumber = $_POST['PhoneNumber'];
		$branceNumber = $_POST['branceNumber'];
		$department = $_POST['department'];
		$position = $_POST['position'];
		$addPassword = $_POST['addPassword'];
		$password = password_hash($addPassword, PASSWORD_DEFAULT);
		
		$regfilename = $_FILES['userImage']['name'];
		if(!empty($regfilename)){
			move_uploaded_file($_FILES['userImage']['tmp_name'], '../images/'.$regfilename);	
		}
		
		
		$sql = "INSERT INTO admin (username,department,position,branch_id,password,firstname,lastname,photo,created_on,status,mobile,email) 
				VALUES ('$userName','$department','$position','$branceNumber','$password','$fCustomerName','$lContactPerson','$regfilename',Now(),'1',$PhoneNumber,'$EmailAddress')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'User added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: user-add.php');
	}	
	


if(isset($_POST['updateCustomer'])){
		$loginID = $_SESSION['admin'];
		$uid = $_POST['uid'];
		$fCustomerName = $_POST['fCustomerName'];
		$lContactPerson = $_POST['lContactPerson'];
		$userName = $_POST['userName'];
		$department = $_POST['department'];
		$position = $_POST['position'];
		$EmailAddress = $_POST['EmailAddress'];
		$PhoneNumber = $_POST['PhoneNumber'];
		$branceNumber = $_POST['branceNumber'];
		
		$sql = "update admin set username='$userName', department='$department' ,position='$position' ,branch_id='$branceNumber',firstname='$fCustomerName',lastname='$lContactPerson',mobile='$PhoneNumber',email='$EmailAddress' where id='$uid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'User Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: user-add.php');
	}	
	
	if(isset($_POST['deleteUser'])){
		$loginID = $_SESSION['admin'];
		
		$uid = $_POST['id'];
		$sql = "update admin set status='2',deleted='Off',deleted_by='$loginID',delted_date=Now() where id='$uid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'User Deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: user-add.php');
	}	
	
	
	if(isset($_POST['ChangePassword12'])){
		$loginID = $_SESSION['admin'];
		
		$uid = $_POST['id'];
		$addPassword = $_POST['addPassword'];
		$password = password_hash($addPassword, PASSWORD_DEFAULT);
		
		$sql = "update admin set password='$password' where id='$uid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Password Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: user-add.php');
	}	
	
		
	
	

?>
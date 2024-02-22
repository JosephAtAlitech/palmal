<?php
	include 'includes/session.php';

	if(isset($_POST['addparty'])){
		$loginID = $_SESSION['admin'];
		$companyName = $_POST['companyName'];
		$contactPerson = $_POST['contactPerson'];
		$phoneNumber = $_POST['phoneNumber'];
		$Address = $_POST['Address'];
		
		$sql = "INSERT INTO party_name (company_name,contact_person,phone,address,create_date,status) 
				VALUES ('$companyName','$contactPerson','$phoneNumber','$Address',Now(),'Active')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Party added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	if(isset($_POST['Editparty'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$companyName = $_POST['companyName'];
		$contactPerson = $_POST['contactPerson'];
		$phoneNumber = $_POST['phoneNumber'];
		$Address = $_POST['Address'];
		
		$sql = "Update party_name set company_name='$companyName',contact_person='$contactPerson',phone='$phoneNumber',address='$Address' where id='$id'"; 
				
		if($conn->query($sql)){
			$_SESSION['success'] = 'Party Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	if(isset($_POST['deleteParty'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$companyName = $_POST['companyName'];
		
		
		$sql = "Update party_name set status='In-active' where id='$id'"; 
				
		if($conn->query($sql)){
			$_SESSION['success'] = 'Party Deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

?>
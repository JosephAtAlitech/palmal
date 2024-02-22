<?php
	include 'includes/session.php';

	if(isset($_POST['addCategory'])){
		$loginID = $_SESSION['admin'];
		$Categoryname = $_POST['Categoryname'];
		$Categorytype = $_POST['Categorytype'];
		$CategoryStatus = $_POST['CategoryStatus'];
		$comments = $_POST['comments'];
		
		$sql = "INSERT INTO categories (categories_type,categories_name,status,comments,login,create_date,update_date,categories_active,categories_status) 
				VALUES ('$Categorytype','$Categoryname','$CategoryStatus','$comments','$loginID',Now(),'','1','1')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Categories added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: categories.php');

?>
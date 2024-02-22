<?php
	include 'includes/session.php';

	if(isset($_POST['addBrands'])){
		$loginID = $_SESSION['admin'];
		$brandtype = $_POST['brandtype'];
		$brandname = $_POST['brandname'];
		$country = $_POST['country'];
		$comments = $_POST['comments'];
		$brandStatus = $_POST['brandStatus'];
		
		$sql = "INSERT INTO brands (brand_type,brand_name,country,comments,status,logid,create_date,update_date,brand_active,brand_status) 
				VALUES ('$brandtype','$brandname','$country','$comments','$brandStatus','$loginID',Now(),'','1','1')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Brand added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: brands.php');

?>
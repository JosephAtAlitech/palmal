<?php
	include 'includes/session.php';

	if(isset($_POST['addBrands'])){
		$id = $_POST['id'];
		$brandname = $_POST['brandname'];
		$brandtype = $_POST['brandtype'];
		$country = $_POST['country'];
		$brandStatus = $_POST['brandStatus'];
		$comments = $_POST['comments'];

		$sql = "UPDATE brands SET brand_type = '$brandtype',brand_name ='$brandname',country = '$country',comments='$comments',status='$brandStatus',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Brands updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:brands.php');

?>
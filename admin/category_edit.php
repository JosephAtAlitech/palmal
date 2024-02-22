<?php
	include 'includes/session.php';

	if(isset($_POST['EditCategory'])){
		$id = $_POST['id'];
		$Categoryname = $_POST['Categoryname'];
		$Categorytype = $_POST['Categorytype'];
		$country = $_POST['country'];
		$CategoryStatus = $_POST['CategoryStatus'];
		$comments = $_POST['comments'];

		$sql = "UPDATE categories SET  	categories_type = '$Categorytype',categories_name ='$Categoryname',status ='$CategoryStatus',comments ='$comments',update_date =Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Categories updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:categories.php');

?>
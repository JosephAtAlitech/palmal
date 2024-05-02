<?php
	include 'includes/session.php';

	if(isset($_POST['editProduct'])){
		$id = $_POST['id'];
		$type = $_POST['type'];
		$ranks = $_POST['ranks'];
		$CategoryName = $_POST['CategoryName'];
		$weaponsName = $_POST['weaponsName'];
		$BrandName = $_POST['BrandName'];
		$bodyNo = $_POST['bodyNo'];
		

		echo $sql = "UPDATE product SET type = '$type',ranks ='$ranks',brand_id = '$BrandName',categories_id = '$CategoryName',we_name = '$weaponsName',body_no = '$bodyNo',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Weapons updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
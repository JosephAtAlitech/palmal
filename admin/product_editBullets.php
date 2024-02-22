<?php
	include 'includes/session.php';

	if(isset($_POST['editProductBullets'])){
		$id = $_POST['id'];
		$type = $_POST['type'];
		$ranks = $_POST['ranks'];
		$CategoryName = $_POST['CategoryName'];
		$bulletsName = $_POST['bulletsName'];
		$BrandName = $_POST['BrandName'];
		$quantityBox = $_POST['quantityBox'];
		

		echo $sql = "UPDATE product SET type = '$type',brand_id = '$BrandName',categories_id = '$CategoryName',bu_name = '$bulletsName',quantity ='$quantityBox',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Bullets updated successfully';
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
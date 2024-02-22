<?php
	include 'includes/session.php';

	if(isset($_POST['addProductBullets'])){
		$loginID = $_SESSION['admin'];
		$type = $_POST['type'];
		$categoryid = $_POST['CategoryName'];
		$bulletsName = $_POST['bulletsName'];
		$BrandName = $_POST['BrandName'];
		
		$quantityBox = $_POST['quantityBox'];
		
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/stock/'.$filename);	
		}
		
		$sql = "INSERT INTO product (type,product_image,brand_id,categories_id,bu_name,quantity,active,status,logid,create_date,update_date) 
				VALUES ('$type','$filename','$BrandName','$categoryid','$bulletsName','$quantityBox','1','1','$loginID',Now(),'')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Bullets added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: bulletAdd.php');

?>
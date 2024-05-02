<?php
	include 'includes/session.php';
date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime($test))->format("Y-m-d H:i:s");

	if(isset($_POST['editHelper'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$helperName = $_POST['helperName'];
		$address = $_POST['address'];
		$PhonreNumber = $_POST['PhonreNumber'];
		$status = $_POST['status'];
		
		
		//$helperPhoto = $_POST['helperPhoto'];
		$helperPhotofilename = $_FILES['helperPhoto']['name'];
		if(!empty($helperPhotofilename)){
			move_uploaded_file($_FILES['helperPhoto']['tmp_name'], '../images/helper/'.$helperPhotofilename);
			$sql = "UPDATE helper_master SET helper_photo='$helperPhotofilename' WHERE id = '$id'";
			$conn->query($sql);			
		}
		else{}
		//$idPhoto = $_POST['idPhoto'];
		$idPhotofilename = $_FILES['idPhoto']['name'];
		if(!empty($idPhotofilename)){
			move_uploaded_file($_FILES['idPhoto']['tmp_name'], '../images/helper/'.$idPhotofilename);
			$sql = "UPDATE helper_master SET helper_id_copy='$idPhotofilename' WHERE id = '$id'";
			$conn->query($sql);	
		}
		else{}
		
		$sql = "UPDATE helper_master SET helper_name='$helperName',address='$address',phone='$PhonreNumber',v_type='$status',update_date='$toDay' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Helper updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:helper-master.php');
	}
	
	if(isset($_POST['ActiveHelper12'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		$sql = "UPDATE `helper_master` SET status ='$status' , update_date = '$toDay' where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Helpre Deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location:helper-master.php');
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
<?php include 'includes/session.php';
date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime($test))->format("Y-m-d H:i:s");	
	$PhoneNumber = $_POST['PhonreNumber'];
	$sql = "SELECT phone FROM helper_master WHERE phone = '$PhoneNumber' ";
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
			$phone=$row['phone'];
	}
	if($phone !=$PhoneNumber){
	if(isset($_POST['addHelper'])){
		$loginID = $_SESSION['admin'];
		$helperName = $_POST['helperName'];
		$address = $_POST['address'];
		$PhonreNumber = $_POST['PhonreNumber'];
		$status = $_POST['status'];
		
		
		//$helperPhoto = $_POST['helperPhoto'];
		$helperPhotofilename = $_FILES['helperPhoto']['name'];
		if(!empty($helperPhotofilename)){
			move_uploaded_file($_FILES['helperPhoto']['tmp_name'], '../images/helper/'.$helperPhotofilename);	
		}
		
		//$idPhoto = $_POST['idPhoto'];
		$idPhotofilename = $_FILES['idPhoto']['name'];
		if(!empty($idPhotofilename)){
			move_uploaded_file($_FILES['idPhoto']['tmp_name'], '../images/helper/'.$idPhotofilename);	
		}
		
		
		$sql = "INSERT INTO helper_master (helper_name,address,phone,v_type,helper_photo,helper_id_copy,create_date) 
		VALUES ('$helperName','$address','$PhonreNumber','$status','$helperPhotofilename','$idPhotofilename','$toDay')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Helper added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: helper-master.php');
	
	}else{
		$_SESSION['error'] = 'Duplicate Phone Number please try another one!';
		header('location: helper-master.php');
	}

?>
<?php include 'includes/session.php';
	if(isset($_POST['addVehicleDocuments'])){
		$loginID = $_SESSION['admin'];
		$vehicleId = $_POST['vehicleNumber'];
		$type = $_POST['type'];
		$StartDate = $_POST['startDate'];
		$EndDate = $_POST['endDate'];
		$OfficeFee = $_POST['officeFee'];
		$TokenFee = $_POST['tokenFee'];
		$filename = $_FILES['certificate']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['certificate']['tmp_name'], '../images/registration/'.$filename);	
		}
		$sql = "UPDATE vehicle_documents_info set status='Inactive' where vehicle_id='$vehicleId' AND type = '$type' AND deleted = 'No'";
		$conn->query($sql);
		$sql = "INSERT INTO vehicle_documents_info (vehicle_id,certificate,start_date,end_date,office_fee,token_fee,type)
			VALUES ('$vehicleId','$filename','$StartDate','$EndDate','$OfficeFee','$TokenFee','$type')";
		if($conn->query($sql)){
			
			
			$_SESSION['success'] = 'Vehicle document added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else if(isset($_POST['action'])){
	    	$action = $_POST['action'];
		if($action == "deleteVfDocument"){
			$id = $_POST['id'];
			$sql = "UPDATE vehicle_documents_info SET deleted='Yes',deleted_date=Now() WHERE id = '$id'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Vehicle Document Deleted Successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	/*	$sql = "UPDATE vehicle_documents_info SET deleted='Yes',deleted_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle document added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}*/
	}	
	else if(isset($_POST['updateVehicleDocuments'])){
		$loginID = $_SESSION['admin'];
		$vehicleId = $_POST['vehicleNumber'];
		$type = $_POST['type'];
		$StartDate = $_POST['startDate'];
		$EndDate = $_POST['endDate'];
		$OfficeFee = $_POST['officeFee'];
		$TokenFee = $_POST['tokenFee'];
		$filename = $_FILES['certificate']['name'];
		
		if(!empty($filename)){
			move_uploaded_file($_FILES['certificate']['tmp_name'], '../images/registration/'.$filename);
			$sql = "UPDATE vehicle_documents_info SET certificate='$filename' WHERE id = '$vehicleId'";
			$conn->query($sql);			
		}
		else{
			
		}
		
		$sql = "Update vehicle_documents_info set vehicle_id='$vehicleId',start_date='$StartDate',end_date='$EndDate',office_fee='$OfficeFee',token_fee='$TokenFee',type='$type' where id='$vehicleId'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle document added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: document-master.php');

?>
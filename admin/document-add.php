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
		$sql_save_document_info = "INSERT INTO vehicle_documents_info (vehicle_id,certificate,start_date,end_date,office_fee,token_fee,type)
			VALUES ('$vehicleId','$filename','$StartDate','$EndDate','$OfficeFee','$TokenFee','$type')";
 		$conn->query($sql_save_document_info);


		
		if($type=='regType'){
			$sql_update_vehical_master_reg_date="UPDATE vehicle_master set reg_start_date='$StartDate',reg_end_date='$EndDate'  where  id='$vehicleId' ";
			$conn->query($sql_update_vehical_master_reg_date);
		}
		elseif($type=='taxType'){
			$sql_update_vehical_master_tax_date="UPDATE vehicle_master set tax_start_date='$StartDate',tax_end_date='$EndDate'  where  id='$vehicleId' ";
			$conn->query($sql_update_vehical_master_tax_date);
		}
		elseif($type=='insuType'){
			$sql_update_vehical_master_insu_date="UPDATE vehicle_master set insu_start_date='$StartDate',insu_end_date='$EndDate'  where  id='$vehicleId' ";
			$conn->query($sql_update_vehical_master_insu_date);
		}
		elseif($type=='RouteType'){
			$sql_update_vehical_master_permit_date="UPDATE vehicle_master set per_start_date='$StartDate',	per_end_date='$EndDate'  where  id='$vehicleId' ";
			$conn->query($sql_update_vehical_master_permit_date);
		}

		
			

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
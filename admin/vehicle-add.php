<?php include 'includes/session.php';

	if(isset($_POST['addVehicle'])){
		$loginID = $_SESSION['admin'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$wUnitId = $_POST['wUnitId'];
		$oilTankCapacity = $_POST['oilTankCapacity'];
		$PurchaseDate = $_POST['PurchaseDate'];
		$MakersName = $_POST['MakersName'];
		$YearOfManufacture = $_POST['YearOfManufacture'];
		$ChesisNumber = $_POST['ChesisNumber'];
		$EnginNumber = $_POST['EnginNumber'];
		$BranchStatus = $_POST['BranchStatus'];
		$vtype = $_POST['vtype'];
		
		
		$sql = "INSERT INTO vehicle_master (wUnitID,v_type,oil_tank_capacity,vehicle_number,purchase_date,makers_name,year_of_manufacture,chasis_number,engin_number,branch_status,create_date,delete_status) 
		VALUES ('$wUnitId','$vtype','$oilTankCapacity','$vehicleNumber','$PurchaseDate','$MakersName','$YearOfManufacture','$ChesisNumber','$EnginNumber','$BranchStatus',Now(),'Active')";
		//echo $sql;
		 
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: vehicle-master.php');
	}	
	

	
	
	/*Edit Vehicle DB portion*/
	
	if(isset($_POST['editVehicle'])){
		$loginID = $_SESSION['admin'];
		$vid = $_POST['vid'];
		$wVFTID = $_POST['wVFTID'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$wUnitId = $_POST['wUnitId'];
		$oilTankCapacity = $_POST['oilTankCapacity'];
		$PurchaseDate = $_POST['PurchaseDate'];
		$MakersName = $_POST['MakersName'];
		$YearOfManufacture = $_POST['YearOfManufacture'];
		$ChesisNumber = $_POST['ChesisNumber'];
		$EnginNumber = $_POST['EnginNumber'];
		$BranchStatus = $_POST['BranchStatus'];
		$vtype = $_POST['vtype'];
		
		
		$sql = "Update vehicle_master set oil_tank_capacity='$oilTankCapacity',wUnitID='$wVFTID', v_type ='$vtype',vehicle_number='$vehicleNumber',purchase_date='$PurchaseDate',makers_name='$MakersName',year_of_manufacture='$YearOfManufacture',chasis_number='$ChesisNumber',engin_number='$EnginNumber',branch_status='$BranchStatus' where id='".$vid."'";
		//echo $sql;
		 
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle Updated Successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: vehicle-master.php');
	}	

?>
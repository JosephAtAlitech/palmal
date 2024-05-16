<?php
include 'includes/session.php';



if (isset($_POST['addVehicle'])) {
	$loginID = $_SESSION['admin'];
	$vehicleNumber = $_POST['vehicleNumber'];
	$wUnitId = $_POST['wUnitId'];
	$vtype = $_POST['vtype'];
	$oilTankCapacity = $_POST['oilTankCapacity'];
	$PurchaseDate = $_POST['PurchaseDate'];
	$MakersName = $_POST['MakersName'];
	$YearOfManufacture = $_POST['YearOfManufacture'];
	$ChesisNumber = $_POST['ChesisNumber'];
	$EnginNumber = $_POST['EnginNumber'];
	$BranchStatus = $_POST['BranchStatus'];
	$driver = $_POST['driver'];
	$engineer = $_POST['engineer'];
	// $reg_start_date = $_POST['reg_start_date'];
	// $reg_end_date = $_POST['reg_end_date'];
	// $tax_start_date = $_POST['tax_start_date'];
	// $tax_end_date = $_POST['tax_end_date'];
	// $insu_start_date = $_POST['insu_start_date'];
	// $insu_end_date = $_POST['insu_end_date'];
	// $per_start_date = $_POST['per_start_date'];
	// $per_end_date = $_POST['per_end_date'];
	$registrationDate = $_POST['registrationDate'];
	$makerBrand = $_POST['makerBrand'];
	$ccBrand = $_POST['ccBrand'];
	$fueltype = $_POST['fuelType'];
	$wingsName = $_POST['wingsName'];
	$employeeName = $_POST['employeeName'];
	$location = $_POST['location'];


	$sql = "INSERT INTO vehicle_master (wUnitID,v_type,driver_id,engineer_id,oil_tank_capacity,vehicle_number,purchase_date,registration_date,makers_name,year_of_manufacture,chasis_number,engin_number,branch_status,create_date,delete_status,maker_brand,cc_brand,fuel_type,wings_name,employee_name,location) 
		VALUES ('$wUnitId','$vtype','$driver','$engineer','$oilTankCapacity','$vehicleNumber','$PurchaseDate','$registrationDate','$MakersName','$YearOfManufacture','$ChesisNumber','$EnginNumber','$BranchStatus',Now(),'Active','$makerBrand','$ccBrand','$fueltype','$wingsName','$employeeName','$location')";
	//echo $sql;

	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Vehicle added successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
	header('location: vehicle-master.php');
}




/*Edit Vehicle DB portion*/

if (isset($_POST['editVehicle'])) {

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

	$driver = $_POST['editDriver'];
	$engineer = $_POST['editEngineer'];

	$registrationDate = $_POST['registrationDate'];
	$makerBrand = $_POST['makerBrand'];
	$ccBrand = $_POST['ccBrand'];
	$fueltype = $_POST['fuelType'];
	$wingsName = $_POST['wingsName'];
	$employeeName = $_POST['employeeName'];
	$location = $_POST['location'];
	$remarks = $_POST['EditRemarks'];
	//	echo $makerBrand.'<br>'.$ccBrand.'<br>'.$fueltype.'<br>'.$wingsName.'<br>'.$employeeName.'<br>'.$location;

	$sql = "UPDATE vehicle_master set oil_tank_capacity='$oilTankCapacity',wUnitID='$wVFTID', v_type ='$vtype', driver_id ='$driver',engineer_id ='$engineer',vehicle_number='$vehicleNumber',
		    purchase_date='$PurchaseDate',registration_date='$registrationDate',makers_name='$MakersName',year_of_manufacture='$YearOfManufacture',
		    chasis_number='$ChesisNumber',engin_number='$EnginNumber',branch_status='$BranchStatus', maker_brand='$makerBrand',cc_brand='$ccBrand',
		    fuel_type='$fueltype',wings_name='$wingsName',employee_name='$employeeName',location='$location' where id='" . $vid . "'";
	//echo $sql;

	if ($conn->query($sql)) {

		$sql = "INSERT INTO driver_log (driver_id, vehicle_id, edit_info, created_date, created_by) 
	              	VALUES ('$driver','$vid','$remarks', Now() ,'$loginID')";

        $conn->query($sql);
		$_SESSION['success'] = 'Vehicle Updated Successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
	header('location: vehicle-master.php');
}

?>
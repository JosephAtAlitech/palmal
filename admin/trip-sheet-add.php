<?php include 'includes/session.php';

	if(isset($_POST['addTripSheet'])){
		$loginID = $_SESSION['admin'];
		$TripNumber = $_POST['TripNumber'];
		$vftVehicleNumber = $_POST['vehicleNumber'];
		$vId = $_POST['vId'];
		//$toLocation = $_POST['toLocation'];
		//$TCNumber = $_POST['TCNumber'];
		//$tripAdvanceAmount = $_POST['tripAdvanceAmount'];
		//$SupervisorName = $_POST['SupervisorName'];
		$tripStartDate = $_POST['tripStartDate'];
		$tripEndDate = $_POST['tripEndDate'];
		//$othersExpenses = $_POST['othersExpenses'];
		$travelDistance = $_POST['travelDistance'];
		$fuelIssue = $_POST['fuelIssue'];
		//$actualConsumptions = $_POST['actualConsumptions'];
		$vftFuel = $_POST['vftFuel'];
		$vftKm = $_POST['vftKm'];
		//$vftConsumptions = $_POST['vftConsumptions'];
		if($_POST['modeStatus'] == "Edit"){
		    $id = $_POST['tripId'];
		    $sql = "UPDATE trip_sheets 
		                set travel_distance='$travelDistance',fuel_issue='$fuelIssue',vft_fuel='$vftFuel',vft_km='$vftKm',trip_start_date='$tripStartDate',trip_end_date='$tripEndDate',update_date =Now()
		                WHERE id='$id'";
            if($conn->query($sql)){
    			$_SESSION['success'] = 'Trip Expense added successfully';
    		}
    		else{
    			$_SESSION['error'] = $conn->error;
    		}    		
		}else if($_POST['modeStatus'] == "Add"){
		    
		    $sql = "SELECT branch_id FROM `admin` WHERE id='$loginID'";
		    $result = $conn->query($sql);
		    while ($row = $result->fetch_array()) {
                $locationID = $row['branch_id'];
            
		    
    		   $sql = "INSERT INTO trip_sheets (trip_number,vehicle_no,vft_vehicle_no,from_location,to_location,tc_number,bags,weight,rate_per_ton,freight_amount,party_id,driver_id,helper_id,trip_advance,supervisor_id,trip_start_date,trip_end_date,loading_expenses,unloading_expenses,driver_salary,helper_salary,others_expenses,travel_distance,fuel_issue,actual_consumption,vft_fuel,vft_km,vft_consumption,create_date,created_by) 
                		VALUES ('$TripNumber','$vId','$vftVehicleNumber','$locationID','','','','','','','','','','','','$tripStartDate','$tripEndDate','','','','','','$travelDistance','$fuelIssue','','$vftFuel','$vftKm','',Now(),'$loginID')";
        		if($conn->query($sql)){
        			$_SESSION['success'] = 'Trip Expense added successfully';
        		}
        		else{
        			$_SESSION['error'] = $conn->error;
        		}    
		    }
		}
		$id = $_POST['tripId'];
		
		
		header('location: trip-sheets.php');
	}	
	
	if(isset($_POST['deleteTrip'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$TripNumber = $_POST['TripNumber'];
		
		$sql = "Update trip_sheets set status='In-Active',update_date=Now() where id='$id'"; 
		
		if($conn->query($sql)){
			$_SESSION['success'] = 'Trip Deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: trip-sheets.php');
	}	
    
?>
<?php
	include 'includes/session.php';
	// add Trip expenses
	if(isset($_POST['addTripExpenses'])){
		$loginID = $_SESSION['admin'];
		$tripNumber = $_POST['tripNumber'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$PoliceExpenses = $_POST['PoliceExpenses'];
		$TollExpenses = $_POST['TollExpenses'];
		$ParkingExpenses = $_POST['ParkingExpenses'];
		$Entertainment = $_POST['Entertainment'];
		$OthersExpenses = $_POST['OthersExpenses'];
		
		$ExpensesDate = $_POST['ExpensesDate'];
		
		$sql = "INSERT INTO trip_expenses (trip_no,vehicle_id,police_exp,toll_exp,parking_exp,entertainment,others_exp,expenses_date,create_date) 
				VALUES ('$tripNumber','$vehicleNumber','$PoliceExpenses','$TollExpenses','$ParkingExpenses','$Entertainment','$OthersExpenses','$ExpensesDate',Now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Trip Expenses added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: trip-expenses.php');
	}	
	
	// edit Trip expenses
	if(isset($_POST['EditTripExpenses'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$tripNumber = $_POST['tripNumber'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$expensesName = $_POST['expensesName'];
		$PoliceExpenses = $_POST['PoliceExpenses'];
		$TollExpenses = $_POST['TollExpenses'];
		$ParkingExpenses = $_POST['ParkingExpenses'];
		$Entertainment = $_POST['Entertainment'];
		$OthersExpenses = $_POST['OthersExpenses'];
		$ExpensesDate = $_POST['ExpensesDate'];
		
		$sql = "UPDATE trip_expenses SET trip_no = '$tripNumber',vehicle_id ='$vehicleNumber',police_exp='$PoliceExpenses',toll_exp='$TollExpenses',parking_exp='$ParkingExpenses',entertainment='$Entertainment',others_exp='$OthersExpenses',expenses_date='$ExpensesDate',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Trip Expenses Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: trip-expenses.php');
	}	

	

?>
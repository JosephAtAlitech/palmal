<?php include 'includes/session.php';
	// Add Driver Salries
	if(isset($_POST['addDriverSalaries'])){
		$loginID = $_SESSION['admin'];
		$SalaryMonth = $_POST['SalaryMonth'];
		$DriverName = $_POST['DriverName'];
		$TotalAdvances = $_POST['TotalAdvances'];
		$TripExpenses = $_POST['TripExpenses'];
		$Salaries = $_POST['Salaries'];
		$salaryDate = $_POST['salaryDate'];
		$phoneBill = $_POST['phoneBill'];
		$RemainingSalaries = $_POST['RemainingSalaries'];
		
		$sql = "INSERT INTO driver_salaries (salary_month,driver_name,driver_advance,trip_expense,salary,date,phone_bill,reamailning_salary,create_date) 
		VALUES ('$SalaryMonth','$DriverName','$TotalAdvances','$TripExpenses','$Salaries','$salaryDate','$phoneBill','$RemainingSalaries',Now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Driver Salaries successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: driver-salaries.php');
	}	
	// edit Driver Salries
	if(isset($_POST['EditDriverSalaries'])){
		$loginID = $_SESSION['admin'];
		$SalaryMonth = $_POST['SalaryMonth'];
		$DriverName = $_POST['DriverName'];
		$TotalAdvances = $_POST['TotalAdvances'];
		$TripExpenses = $_POST['TripExpenses'];
		$Salaries = $_POST['Salaries'];
		$salaryDate = $_POST['salaryDate'];
		$phoneBill = $_POST['phoneBill'];
		$RemainingSalaries = $_POST['RemainingSalaries'];
		
		$sql = "Update driver_salaries set salary_month='',driver_name='',driver_advance='',trip_expense='',salary='',date,phone_bill='',reamailning_salary='',create_date='') 
		VALUES ('$SalaryMonth','$DriverName','$TotalAdvances','$TripExpenses','$Salaries','$salaryDate','$phoneBill','$RemainingSalaries',Now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Driver Salaries successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: driver-salaries.php');
	}	

	

?>
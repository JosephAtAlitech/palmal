<?php
	include 'includes/session.php';
	// add Office expenses
	if(isset($_POST['addOfficeExpense'])){
		$loginID = $_SESSION['admin'];
		$AccountHead = $_POST['AccountHead'];
		$Amount = $_POST['OfficeAmount'];
		$ExpenditureType = $_POST['ExpenditureType'];
		$ExpensesDate = $_POST['ExpensesDate'];
		
		$sql = "INSERT INTO office_expenses (acc_head,amount,acc_head_type,exp_date,create_date) 
				VALUES ('$AccountHead','$Amount','$ExpenditureType','$ExpensesDate',Now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Office Expenses added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: office-expenses.php');
	}	
	
	// edit Office expenses
	if(isset($_POST['EditOfficeExpense'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$AccountHead = $_POST['AccountHead'];
		$Amount = $_POST['OfficeAmount'];
		$ExpenditureType = $_POST['ExpenditureType'];
		$ExpensesDate = $_POST['ExpensesDate'];
		
		$sql = "UPDATE office_expenses SET acc_head = '$AccountHead',amount ='$Amount',acc_head_type = '$ExpenditureType',exp_date='$ExpensesDate',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Office Expenses Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: office-expenses.php');
	}	

	

?>
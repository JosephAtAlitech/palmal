<?php
	include 'includes/session.php';
	// add ledger
	if(isset($_POST['addLedger'])){
		$loginID = $_SESSION['admin'];
		$Particulars = $_POST['Particulars'];
		$RepairAmount = $_POST['RepairAmount'];
		$PaidAmount = $_POST['PaidAmount'];
		$accountType = $_POST['accountType'];
		$paidDate = $_POST['paidDate'];
		
		$sql = "INSERT INTO ledger_list (particulars,repair_amount,paid_amount,acc_type,acc_paid_date,create_date) 
				VALUES ('$Particulars','$RepairAmount','$PaidAmount','$accountType','$paidDate',Now())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Ledger added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: ledger-list.php');
	}	
	// Edit ledger
	if(isset($_POST['editLedger'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$Particulars = $_POST['Particulars'];
		$RepairAmount = $_POST['RepairAmount'];
		$PaidAmount = $_POST['PaidAmount'];
		$accountType = $_POST['accountType'];
		$paidDate = $_POST['paidDate'];
		
		$sql = "Update ledger_list set particulars='$Particulars',repair_amount='$RepairAmount',paid_amount='$PaidAmount',acc_type='$accountType',acc_paid_date='$paidDate' where id='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Ledger Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: ledger-list.php');
	}	
	

	

?>
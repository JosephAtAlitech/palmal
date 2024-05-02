<?php
	include 'includes/session.php';
	
    	if(isset($_POST['addPumpName'])){
    		$loginID = $_SESSION['admin'];
    		$pumpName = $_POST['pumpName'];
    		$pumpAddress = $_POST['pumpAddress'];
    		$contactPerson = $_POST['contactPerson'];
    		$phoneNumber = $_POST['phoneNumber'];
    		
    		$sql="INSERT INTO `oil_pump_name`(`pump_name`, `address`, `contact_person`, `phone`, `inset_date`, `inserted_by`) 
    		 VALUES ('$pumpName','$pumpAddress','$contactPerson','$phoneNumber',Now(),'$loginID')";
    		
    		
    		if($conn->query($sql)){
    			$_SESSION['success'] = 'Pump name added successfully';
    		}
    		else{
    			$_SESSION['error'] = $conn->error;
    		}
    		header('location: pump-name-master.php');
    	}	
    	if(isset($_POST['editPumpNmae'])){
    	    $loginID = $_SESSION['admin'];
    		$id = $_POST['id'];
    		$pumpName = $_POST['pumpName'];
    		$pumpAddress = $_POST['pumpAddress'];
    		$contactPerson = $_POST['contactPerson'];
    		$phoneNumber = $_POST['phoneNumber'];
    		
    		$sql="UPDATE `oil_pump_name` SET `pump_name`='$pumpName',`address`='$pumpAddress',`contact_person`='$contactPerson',`phone`='$phoneNumber',`update_date`=Now(),`updated_by`='$loginID' WHERE id='$id'";
    		
    		
    		if($conn->query($sql)){
    			$_SESSION['success'] = 'Pump name Updated successfully';
    		}
    		else{
    			$_SESSION['error'] = $conn->error;
    		}
    		header('location: pump-name-master.php');
    	}
    	if(isset($_POST['deletePump'])){
    	    $loginID = $_SESSION['admin'];
    		$id = $_POST['id'];
    		
    		$sql="UPDATE `oil_pump_name` SET `update_date`=Now(),`updated_by`='$loginID',status='Inactive' WHERE id='$id'";
    		
    		
    		if($conn->query($sql)){
    			$_SESSION['success'] = 'Pump name Deleted successfully';
    		}
    		else{
    			$_SESSION['error'] = $conn->error;
    		}
    		header('location: pump-name-master.php');
    	}
    
    
?>
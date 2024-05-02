<?php
	include 'includes/session.php';
	$locationName = $_POST['locationName'];
	$sql = "SELECT location_name FROM location_master WHERE location_name = '$locationName' ";
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
			echo $locaName=$row['location_name'];
	}
	if($locaName != $locationName){
    	if(isset($_POST['addLocation'])){
    		$loginID = $_SESSION['admin'];
    		$locationName = $_POST['locationName'];
    		$branchCode = $_POST['branchCode'];
    		
    		$sql = "INSERT INTO location_master (location_name,creation_date,status) 
    				VALUES ('$locationName',Now(),'Active')";
    		if($conn->query($sql)){
    			$_SESSION['success'] = 'Location added successfully';
    		}
    		else{
    			$_SESSION['error'] = $conn->error;
    		}
    	}	
    	else{
    		$_SESSION['error'] = 'Fill up add form first';
    	}
    
    	header('location: location-master.php');
	}
	else{
		$_SESSION['error'] = 'Duplicate branch name pls try another one';
		header('location: location-master.php');
	}

?>
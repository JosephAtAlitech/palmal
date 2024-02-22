<?php include 'includes/session.php';
	
	$Tyreposition = $_POST['Tyreposition'];
	$tyreVehicle = $_POST['tyreVehicle'];
	$sql = "SELECT tyre_position FROM tyre_master WHERE vehicle_no = '$tyreVehicle' ";
	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
			$tyrePos=$row['tyre_position'];
	}
	if($tyrePos !=$Tyreposition){
	if(isset($_POST['addTyre'])){
		$loginID = $_SESSION['admin'];
		$tyreDate = $_POST['tyreDate'];
		$tyreVehicle = $_POST['tyreVehicle'];
		$tyreType = $_POST['tyreType'];
		$Tyreposition = $_POST['Tyreposition'];
		$tyreNumber = $_POST['tyreNumber'];
		$tyreCompany = $_POST['tyreCompany'];
		$tyreModel = $_POST['tyreModel'];
		$tyreCost = $_POST['tyreCost'];
		$tyreSupervisor = $_POST['tyreSupervisor'];
		
		$sql = "INSERT INTO tyre_master (date,vehicle_no,tyre_type,tyre_position,tyre_no,tyre_company,tyre_model,tyre_cost,supervisor,create_date,status) 
		VALUES ('$tyreDate','$tyreVehicle','$tyreType','$Tyreposition','$tyreNumber','$tyreCompany','$tyreModel','$tyreCost','$tyreSupervisor',Now(),'Active')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Tyre added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: tyre-master.php');
	}
	else{
		$_SESSION['error'] = 'Duplicate Tyre Position pls try another one';
		header('location: tyre-master.php');
	}

?>
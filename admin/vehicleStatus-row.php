<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		/*$sql = "SELECT vehicle_master.id,vehicle_master.vehicle_number FROM `vehicle_master` WHERE vehicle_master.id = '$id'";*/
		$sql ="SELECT trip_sheets.id,trip_sheets.trip_number,trip_sheets.vehicle_no,vehicle_master.id as veId,vehicle_master.vehicle_number,trip_sheets.driver_id,trip_sheets.helper_id 
				FROM `trip_sheets`
				LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
				LEFT JOIN driver_master ON driver_master.id=trip_sheets.driver_id
				WHERE trip_sheets.vehicle_no='$id'
				ORDER BY `vehicle_no` ASC";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>
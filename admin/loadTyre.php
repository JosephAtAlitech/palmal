<?php 
	include 'includes/session.php';

	if(isset($_GET['loadPurchaseByPurchaseCode'])) {
	$tyreVehicle = $_GET['tyreVehicle'];
	/*$sql = "SELECT id,vehicle_no FROM `tyre_master` WHERE id='".$tyreVehicle."'";
	$res = $conn->query($sql);
	$vehicle_no = '';
	while($row = $res->fetch_assoc()){
		$vehicle_no = $row['vehicle_no'];
	}*/
	/*$sql = "SELECT tyre_position.id,tyre_position.position_name 
			FROM `tyre_master`
			LEFT OUTER JOIN tyre_position ON tyre_position.id=tyre_master.tyre_position
			WHERE tyre_master.vehicle_no='".$tyreVehicle."' AND (tyre_position.id not in ())";*/
	$sql="select tyre_position.id, tyre_position.position_name
			from tyre_position
			where tyre_position.id not in (select tyre_master.id from tyre_master where tyre_master.vehicle_no='".$tyreVehicle."')";						
	$query = $conn->query($sql);
    while($row = $query->fetch_assoc()){
		$rows[] = $row;
	}
    echo json_encode($rows);
}
?>
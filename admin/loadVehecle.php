<?php 
	include 'includes/session.php';

	if(isset($_GET['loadPurchaseByPurchaseCode'])) {
	$tripNumber = $_GET['tripNumber'];
	$sql = "SELECT id,vehicle_no FROM `trip_sheets` WHERE status!='Active' and id='$tripNumber'";
	$res = $conn->query($sql);
	$vehicle_no = '';
	while($row = $res->fetch_assoc()){
		$vehicle_no = $row['vehicle_no'];
	}
	$sql = "SELECT id,vehicle_number FROM `vehicle_master` WHERE delete_status='Active' AND id='".$vehicle_no."'";
							
	$query = $conn->query($sql);
    while($row = $query->fetch_assoc()){
		$rows[] = $row;
	}
    echo json_encode($rows);
}
?>
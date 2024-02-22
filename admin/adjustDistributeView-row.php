<?php 
	include 'includes/session.php';
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT wepons_wepons.id,wepons_wepons.thana_id,wepons_wepons.name,wepons_wepons.quantity,wepons_wepons.body_number,wepons_wepons.reamrks 
				FROM `wepons_wepons` WHERE wepons_wepons.id='".$id."'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
	
?>
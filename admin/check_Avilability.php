<?php
include 'includes/session.php';

	if(!empty($_POST["PhoneCheck"])) {
	  $sql = "SELECT * FROM driver_master WHERE phone='" . $_POST["PhoneCheck"] . "'";
	  $user_count = $conn->query($sql);
	  $row = $user_count->fetch_assoc();
	  if($row>0) {
		  echo "<span class='status-not-available' style='color: red;'> Number already used.</span>";
	  }else{
		  echo "<span class='status-available' style='color: green;'> Number Available.</span>";
	  }
	}
	
	if(!empty($_POST["UnitValue"])) {
		$sql = "SELECT vehicle_master.id FROM vehicle_master WHERE vehicle_master.wUnitID='" . $_POST["UnitValue"] . "' AND vehicle_master.delete_status='Active'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
	
	if(!empty($_POST["LicenceCheck"])) {
	  $sql = "SELECT * FROM driver_master WHERE licence_number='" . $_POST["LicenceCheck"] . "'";
	  $user_count = $conn->query($sql);
	  $row = $user_count->fetch_assoc();
	  if($row>0) {
		  echo "<span class='status-not-available' style='color: red;'> Number already used.</span>";
	  }else{
		  echo "<span class='status-available' style='color: green;'> Number Available.</span>";
	  }
	}
?>
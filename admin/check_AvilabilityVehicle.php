<?php
include 'includes/session.php';
    
    if(!empty($_POST["vehicleNumber"])) {
	  $sql = "SELECT * FROM vehicle_master WHERE vehicle_number ='" . $_POST["vehicleNumber"] . "'";
	  $user_count = $conn->query($sql);
	  $row = $user_count->fetch_assoc();
	  if($row>0) {
		  echo "<span class='status-not-available' style='color: red;'>Vehicle Number already used.</span>";
	  }else{
		  echo "<span class='status-available' style='color: green;'>Vehicle Number Available.</span>";
	  }
	}
	if(!empty($_POST["chasisNumberCheck"])) {
	  $sql = "SELECT * FROM vehicle_master WHERE chasis_number ='" . $_POST["chasisNumberCheck"] . "'";
	  $user_count = $conn->query($sql);
	  $row = $user_count->fetch_assoc();
	  if($row>0) {
		  echo "<span class='status-not-available' style='color: red;'> Number already used.</span>";
	  }else{
		  echo "<span class='status-available' style='color: green;'> Number Available.</span>";
	  }
	}
	
	
	if(!empty($_POST["EnginNumberCheck"])) {
	  $sql = "SELECT * FROM vehicle_master WHERE engin_number='" . $_POST["EnginNumberCheck"] . "'";
	  $user_count = $conn->query($sql);
	  $row = $user_count->fetch_assoc();
	  if($row>0) {
		  echo "<span class='status-not-available' style='color: red;'> Number already used.</span>";
	  }else{
		  echo "<span class='status-available' style='color: green;'> Number Available.</span>";
	  }
	}
?>
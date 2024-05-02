<?php
include 'includes/session.php';

	if(!empty($_POST["PhoneCheck"])) {
	  $sql = "SELECT * FROM helper_master WHERE phone='" . $_POST["PhoneCheck"] . "'";
	  $user_count = $conn->query($sql);
	  $row = $user_count->fetch_assoc();
	  if($row>0) {
		  echo "<span class='status-not-available' style='color: red;'> Number already used.</span>";
	  }else{
		  echo "<span class='status-available' style='color: green;'> Number Available.</span>";
	  }
	}
	
	
?>
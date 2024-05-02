<?php
	$conn = new mysqli('localhost', 'root', '', 'vftracke_demo');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>
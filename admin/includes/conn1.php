<?php
	$conn = new mysqli('localhost', 'salman21_shoaib165', 'sh@aib165', 'salman21_vftrackerpalmalgroup');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>
<?php
	$conn = new mysqli('localhost', 'root', '', 'vftracke_vftrackerpalmalgroup');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	

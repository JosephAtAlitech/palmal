<?php include 'includes/session.php';
	
	$unit_id = $_GET['unit_id'];
	$unit_name = $_GET['unit_name'];
	$geofence = $_GET['geofence'];
	$time = $_GET['time'];
	$speed = $_GET['speed'];
	$location = $_GET['location'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$notification = $_GET['notification'];
	
	$sql = "INSERT INTO geo_notification (unit_id,unit_name,geofence,time,speed,location,lat,lon,notification,create_date_time,type) 
		VALUES ('$unit_id','$unit_name','$geofence','$time','$speed','$location','$lat','$lon','$notification',Now(),'In')";
	
	$conn->query($sql);
	header('location: vfunit_departure.php');			
	
 ?>

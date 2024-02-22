<?php include 'conn.php';
	
	$unit_id=0;
	$unit_name=0;
	$geofence=0;
	$time=0;
	$speed=0;
	$location=0;
	$lat=0;
	$lon=0;
	$notification=0;
	
	$unit_id = $_POST['unit_id'];
	$unit_name = $_POST['unit_name'];
	$geofence = $_POST['geofence'];
	$time = $_POST['time'];
	$speed = $_POST['speed'];
	$location = $_POST['location'];
	$lat = $_POST['lat'];
	$lon = $_POST['lon'];
	$notification = $_POST['notification'];
	
	$sql = "INSERT INTO geo_notification (unit_id,unit_name,geofence,time,speed,location,lat,lon,notification,create_date_time) 
		VALUES ('$unit_id','$unit_name','$geofence','$time','$speed','$location','$lat','$lon','$notification',Now(),'Out')";
	
	$conn->query($sql);
	//header('location: vfunit_arrival.php');			
	
 ?>

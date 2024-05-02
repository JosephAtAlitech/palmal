<?php	session_start();
	//if($conPrefix != ''){
	//    include $conPrefix.'includes/conn.php';
	//}else{
	 //   include 'includes/conn.php';
	//}
include 'conn.php';
	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: ../index.php');
	}

	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
	
?>
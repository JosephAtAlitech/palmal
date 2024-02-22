<?php
	include 'includes/session.php';

	if(isset($_POST['EditWeaponsDistributeAdd'])){
		$id = $_POST['id'];
		$choosethana = $_POST['choosethana'];
		$name = $_POST['name'];
		$quantity = $_POST['quantity'];
		$bodyNo = $_POST['bodyNo'];
		$remarks = $_POST['remarks'];

		$sql = "UPDATE wepons_wepons SET adj_quantity = '$quantity',adj_body_number ='$bodyNo',adj_remarks ='$remarks',adj_date =Now(),adj_flag='Adjust' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Weapons Adjustment successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
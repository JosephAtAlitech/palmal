<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT admin.id, admin.department, admin.position,admin.username,admin.firstname,admin.lastname,admin.email,admin.photo,admin.created_on,admin.status,admin.mobile,admin.deleted,
                branch_master.branch_name,branch_master.id as branchId 
                FROM `admin` 
                LEFT JOIN branch_master ON admin.branch_id=branch_master.id
                WHERE admin.username != 'Admin' AND deleted='On' AND admin.id = '$id'";
		$query = $conn->query($sql);
		

		if($query){
			$row = $query->fetch_assoc();
			echo json_encode($row);
		}else{
			echo json_encode($conn->error);
		}
		
	}

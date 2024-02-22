<?php
include 'includes/session.php';

if(isset($_POST['action'])){
	$action = $_POST["action"];
	
	$id = $_POST["id"];
	//echo json_encode($action);
	if($action == "editDocument"){
		$sql = "SELECT * from vehicle_documents_info where id='$id'";
		//echo json_encode($sql);
		//return json_encode($sql);
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		echo json_encode($row);
	}else{
		echo json_encode("Error");
	}
	
	
}
else if(isset($_POST['type'])){
	$type = $_POST['type'];
	$vid = $_POST['vid']; //Vid is the vehicle number
	
	$sql = "SELECT * from vehicle_documents_info where type='$type' and vehicle_id='$vid' and deleted='No'";
	$query = $conn->query($sql);
	$idNo = 1;
	$dataString = "";
	if($query){
		while($row = $query->fetch_assoc()){
			$dataString.= "<tr>
					<td>".$idNo++."</td>
					<td>".$row["certificate"]."</td>
					<td>".$row['start_date']."</td>
					<td>".$row['end_date']."</td>
					<td>".$row['office_fee']."</td>
					<td>".$row['token_fee']."</td>
					<td>".$row['status']."</td>
					<td style='width: 9%;'>
						<a href='#' onclick='EditDocuments(".$row['id'].")' class='btn btn-success btn-sm btn-flat' style='margin-bottom: 5px;'><i class='fa fa-edit'></i></a>
						<a href='#' onclick='deleteDocument(".$row['id'].")' class='btn btn-danger btn-sm btn-flat' style='margin-bottom: 5px;'><i class='fa fa-trash'></i></a>
					</td>
				</tr>";
		}
	}else{
		$dataString = "";
	}
	echo $dataString;
}
?>
<?php 
include 'includes/session.php'; 
date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime())->format("Y-m-d H:i:s");
$paymentDateTo = date("Y-m-d");
//$loginID = $_SESSION['user'];
if(isset($_POST['action'])){
	$action = $_POST['action'];
    if($action == "loadCompletedProducts"){
		$factoryId = $_POST['id'];
        $sql = "SELECT vehicle_master.id,vehicle_master.vehicle_number,vehicle_master.branch_status,vehicle_master.chasis_number, vehicle_documents_info.certificate, vehicle_documents_info.start_date, vehicle_documents_info.end_date, vehicle_documents_info.type, vehicle_documents_info.id as infoId
		FROM vehicle_master
		INNER JOIN vehicle_documents_info ON vehicle_master.id = vehicle_documents_info.vehicle_id
		WHERE vehicle_master.delete_status='Active' AND vehicle_documents_info.status='Active' AND vehicle_documents_info.deleted='No' 
		AND vehicle_documents_info.end_date <= DATE_ADD(NOW(), INTERVAL 30 DAY) AND vehicle_master.branch_status ='".$factoryId."'";
		//$sql .= " AND vehicle_master.branch_status='".$factoryId."'";
		$query = $conn->query($sql);
        $riderOrderList = "";
        $i=0;
        while ($prow = $query->fetch_assoc()) {
           $i++; 
          $riderOrderList .= "<tr>
        	        <td><input type='checkbox' class='form-check-input tab1_chk cb-element' id='".$prow['infoId']."' name='".$prow['infoId']."' value='".$prow['infoId']."' onchange='checkedStatus(this)' />
					<input type='hidden' id='vehicle_".$prow['infoId']."' name='vehicle_".$prow['infoId']."' value='".$prow['id']."' />
					<input type='hidden' id='type_".$prow['infoId']."' name='type_".$prow['infoId']."' value='".$prow['type']."' />
					</td>
        	        <td>".$prow['vehicle_number']."</td>
        	        <td>".$prow['start_date']."<br>".$prow['end_date']."</td>
        	        <td>".$prow['type']."</td>
        	        <td><input type='number' class='cb-element' id='officeCbx_".$prow['infoId']."' name='officeCbx_".$prow['infoId']."' placeholder='Office Cost' value='' Disabled required/></td>
        	        <td><input type='number' class='cb-element' id='tokenCbx_".$prow['infoId']."' name='tokenCbx_".$prow['infoId']."' placeholder='Token Cost' value='' Disabled required/></td>
        	        <td><input type='number' class='cb-element' id='othersCbx_".$prow['infoId']."' name='othersCbx_".$prow['infoId']."' placeholder='Others Cost' value='' Disabled required/></td>
	        </tr>";
        }
        echo json_encode($riderOrderList);
    }
	else if($action == "saveVehicleRequisition"){
		
		$vehicle_info_idList = $_POST['vehicle_info_id'];
        $vehicle_idList = $_POST['vehicle_id'];
        $officeCostList = $_POST['officeCost'];
        $tokenCostList = $_POST['tokenCost'];
        $othersCostList = $_POST['othersCost'];
        $typeList = $_POST['type'];
        $vehicle_info_idArray = explode("@!@,",$vehicle_info_idList);
        $vehicle_idArray = explode("@!@,",$vehicle_idList);
        $officeCostArray = explode("@!@,",$officeCostList);
        $tokenCostArray = explode("@!@,",$tokenCostList);
        $othersCostArray = explode("@!@,",$othersCostList);
        $typeArray = explode("@!@,",$typeList);
		
		
		$sql="SELECT max(req_id) AS req_id FROM `vehicle_documents_proposal`";
			$query = $conn->query($sql);
			$lastID=0;
			while ($prow = $query->fetch_assoc()) {
				$lastID=$prow['req_id'] +1;
			}
		
		
        for($i = 0; $i < count($vehicle_info_idArray); $i++) {
			$vehicle_info_id = $vehicle_info_idArray[$i]; 
			if($i == count($vehicle_info_idArray)-1){
                $vehicle_info_id = substr($vehicle_info_id, 0, strlen($vehicle_info_id)-3);
            }
			$vehicle_id = $vehicle_idArray[$i]; 
			if($i == count($vehicle_idArray)-1){
                $vehicle_id = substr($vehicle_id, 0, strlen($vehicle_id)-3);
            }
			$officeCost = $officeCostArray[$i]; 
			if($i == count($officeCostArray)-1){
                $officeCost = substr($officeCost, 0, strlen($officeCost)-3);
            }
			$tokenCost = $tokenCostArray[$i]; 
			if($i == count($tokenCostArray)-1){
                $tokenCost = substr($tokenCost, 0, strlen($tokenCost)-3);
            }
			$othersCost = $othersCostArray[$i]; 
			if($i == count($othersCostArray)-1){
                $othersCost = substr($othersCost, 0, strlen($othersCost)-3);
            }
			$type = $typeArray[$i]; 
			if($i == count($typeArray)-1){
                $type = substr($type, 0, strlen($type)-3);
            }
			
                    
    		$sql = "INSERT INTO vehicle_documents_proposal(req_id,vehicle_id, office_fee, token_fee, others_fee, type, entry_date, insertedBy) 
					VALUES ('$lastID','$vehicle_id','$officeCost','$tokenCost','$othersCost','$type','$toDay',0)";
            $conn->query($sql);
            
    	}
    	echo json_encode("Success");
    	
	
	}
}

?>
<?php
include 'includes/session.php';
if(isset($_POST['action'])){
    if($_POST['action'] == "fetchFactory"){
        $facatoryId = $_POST['facatoryId'];
        $sql = "SELECT vehicle_master.id,branch_master.id as bID,vehicle_master.vehicle_number,branch_master.branch_name 
			FROM `vehicle_master`
			LEFT JOIN branch_master ON branch_master.id=vehicle_master.branch_status
			WHERE branch_master.id='".$facatoryId."' AND vehicle_master.delete_status='Active'";
        $result = $conn->query($sql);
        
        while ($row = $result->fetch_array()) {
            $rows[] = $row;    
        }
        echo json_encode($rows);
    }
}
?>    
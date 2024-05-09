<?php
$conPrefix = '../';
include $conPrefix . 'includes/session.php';
$Date = (new DateTime())->format("Y-m-d H:i:s");
$loginID = $_SESSION['admin'];
$toDay = (new DateTime())->format("Y-m-d H:i:s");

if (isset($_POST['Action'])) {
    $action = $_POST['Action'];
    if ($action == 'deleteRequisitionSheet') {
        $id = $_POST['id'];
        $sql_delete_vehical_proposal = "UPDATE  vehicle_documents_proposal set deleted = 'Yes', status = 'Inactive', deleted_by='$loginID',deleted_date=date('Y-m-d') WHERE id = $id";
        $query = $conn->query($sql_delete_vehical_proposal);


        $sql_payment_delete = "UPDATE  tbl_paymentvoucher set deleted = 'Yes', status = 'Inactive', deletedBy='$loginID' WHERE tbl_paymentvoucher.tbl_proposal_id = $id";
        $query_del = $conn->query($sql_payment_delete);
        if ($query) {
            echo json_encode('success');
        } else {
            echo json_encode($conn->error);
        }
    }
    // echo json_encode($row);  
}



//ADJUST VEHICAL REQUISITION 

if (isset($_POST['Action'])) {
    $action = $_POST['Action'];
    if ($action == 'adjustRequisitionSheet') {
        $id = $_POST['id'];
       
        try {
            $dataArr =[];
            $total = 0;
             $sql_adjust_req = "SELECT vehicle_master.vehicle_number,vehicle_documents_proposal.id,vehicle_documents_proposal.req_id,vehicle_documents_proposal.start_date,vehicle_documents_proposal.end_date,vehicle_documents_proposal.entry_date, SUM(vehicle_documents_proposal.office_fee) AS TotalOfficeFee ,SUM(vehicle_documents_proposal.token_fee)as TotalTokenFee,SUM(vehicle_documents_proposal.others_fee) AS TotalOthersFee 
                                FROM `vehicle_documents_proposal` 
                                INNER JOIN vehicle_master on vehicle_master.id = vehicle_documents_proposal.vehicle_id
                                Where vehicle_documents_proposal.id = $id limit 1";
            $query = $conn->query($sql_adjust_req);
            if ($query) {
    
               
                while ($row = $query->fetch_assoc()) {
                    $total += $row['TotalOfficeFee'] + $row['TotalTokenFee'] + $row['TotalOthersFee'];
                    array_push($dataArr, $row);
                }
                $array = [
                    'row' => $dataArr,
                    'total' => $total
                ];
                echo print_r($array);
            } else {
                throw new Exception($conn->error);
            }
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }
}
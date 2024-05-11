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

        $sql_paid = "UPDATE vehicle_documents_info SET payment_staus='Pending' WHERE id=(Select vehicle_documents_info_id FROM vehicle_documents_proposal WHERE id=$id)";
        $conn->query($sql_paid);
        if ($query) {
            echo json_encode('success');
        } else {
            echo json_encode($conn->error);
        }
    }
    // echo json_encode($row);  
    //ADJUST VEHICAL REQUISITION 
    else if ($action == 'adjustRequisitionSheet') {
        $id = $_POST['id'];

        try {
            $dataArr = [];
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
} else {
    $sql = "SELECT vehicle_master.vehicle_number ,vehicle_documents_proposal.id,vehicle_documents_proposal.req_id,vehicle_documents_proposal.entry_date,
            SUM(vehicle_documents_proposal.office_fee) AS TotalOfficeFee ,SUM(vehicle_documents_proposal.token_fee)as  TotalTokenFee,SUM(vehicle_documents_proposal.others_fee) AS TotalOthersFee 
            FROM `vehicle_documents_proposal`
            INNER JOIN vehicle_master on vehicle_master.id = vehicle_documents_proposal.vehicle_id
            Where vehicle_documents_proposal.deleted= 'No'
            GROUP BY vehicle_documents_proposal.req_id ORDER BY `vehicle_documents_proposal`.`req_id`  DESC";
    $result = $conn->query($sql);

       $output = array('data' => array());
    if ($result->num_rows > 0) {
        $idNo = 0;
        while ($row = $result->fetch_array()) {

            $buttons = "<a href='vehicleRequsition-viewpdf.php?reqId=" . $row['req_id'] . "' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i> Print </a>
            <button type = 'button' class='btn btn-danger btn-sm  btn-flat' id='deleteVehicleRequisition' style='margin-bottom: 5px;'  onclick='deleteRow(". $row['id'] .")'><i class='fa fa-trash'> Delete</i></button>
            <button type = 'button' class='btn btn-warning btn-sm  btn-flat' id='adjustVehicleRequisition'  style='margin-bottom: 5px;'  onclick='adjustrow(". $row['id'] .")' ><i class='fa fa-edit'> Adjust</i> </button>";
        
    
            $total = $row['TotalOfficeFee'] + $row['TotalTokenFee'] + $row['TotalOthersFee'];
            $output['data'][] = array(
                $idNo++,
                $row['vehicle_number'],
                $row['entry_date'],
                $row['TotalOfficeFee'],
                $row['TotalTokenFee'],
                $row['TotalOthersFee'],
                $total,
                $buttons
            );
        }
    }

    $conn->close();

    echo json_encode($output);
}

// AD TO ADJUSTED Amount Table
/*if (isset($_POST['savepaymentadjust'])) {
	$loginID = $_SESSION['admin'];
	$editamount = $_POST['adjusted_amount'];
             $sql_fetch_req_id = "SELECT vehicle_documents_proposal.req_id,
                                FROM `vehicle_documents_proposal` 
                                Where vehicle_documents_proposal.id = id";
              $query_req_id = $conn->query($sql_fetch_req_id);
              $row = $query_req_id->fetch_assoc();
	$sql = "INSERT INTO requisition_adjustment (reqisition_id,adjusted_amount,created_at,created_by) 
		VALUES ('$row','$editamount',Now(),$loginID)";
	//echo $sql;

	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Payment adjusted successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
	//header('location: vehicle-master.php');
}*/
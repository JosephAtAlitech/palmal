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
    else if ($action == 'adjustVehicleRequisition') {
        $id = $_POST['id'];

        try {

            $sql_adjust_req = "SELECT vehicle_master.vehicle_number,vehicle_documents_proposal.id,vehicle_documents_proposal.req_id,vehicle_documents_proposal.start_date,vehicle_documents_proposal.end_date,
            vehicle_documents_proposal.office_fee,vehicle_documents_proposal.token_fee,vehicle_documents_proposal.others_fee,vehicle_documents_proposal.entry_date, SUM(vehicle_documents_proposal.office_fee) AS TotalOfficeFee ,
            SUM(vehicle_documents_proposal.token_fee)as TotalTokenFee,SUM(vehicle_documents_proposal.others_fee) AS TotalOthersFee 
            FROM vehicle_documents_proposal 
            INNER JOIN vehicle_master on vehicle_master.id = vehicle_documents_proposal.vehicle_id
            Where vehicle_documents_proposal.id = $id limit 1";
            $query = $conn->query($sql_adjust_req);
            
            $dataArr = [];
            $total = 0;
            $sql_check_adjustment = "SELECT id 
                                        FROM proposal_adjustment 
                                        WHERE proposal_adjustment.document_proposal_id='$id'
                                        ORDER BY `id` DESC";
            $query1 = $conn->query($sql_check_adjustment);
            $numNO = $query1->num_rows;
            if($numNO == 0){
                if ($query) {
                    while ($row = $query->fetch_assoc()) {
                        $total += $row['TotalOfficeFee'] + $row['TotalTokenFee'] + $row['TotalOthersFee'];
                        array_push($dataArr, $row);
                    }
                    echo json_encode(array(
                        'row'=>$dataArr,
                        'total'=>$total,
                        'status'=>'Success'
                    ));
                }
            } else {
                echo json_encode(array(
                    'message'=>'This proposal is already adjusted',
                    'status'=>'Information'
                ));
            }
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }
    // AD TO ADJUSTED Amount Table
    elseif(($action == 'adjustRequisitionAmount')){
        $loginID = $_SESSION['admin'];
        $paymenttype = $_POST['payment_type'];
        $editamount = $_POST['editamount'];
        $document_proposal_id = $_POST['document_proposal_id'];
        if($document_proposal_id > 0){
            $sql_fetch_req_id = "SELECT vehicle_id
                                        FROM vehicle_documents_proposal 
                                        Where vehicle_documents_proposal.id = '$document_proposal_id'";
            $query_req_id = $conn->query($sql_fetch_req_id);
            $row_requisition = $query_req_id->fetch_assoc();
            $vehicle_id = $row_requisition['vehicle_id'];
            $sql_save_adjust = "INSERT INTO proposal_adjustment(document_proposal_id,vehicle_id,adjusted_amount,type,created_at,created_by) 
                VALUES ('$document_proposal_id','$vehicle_id','$editamount','$paymenttype','$toDay','$loginID')";
            $conn->query($sql_save_adjust);
            $proposal_adjust_id = $conn->insert_id;
            if($proposal_adjust_id > 0){
                $sql = "SELECT LPAD(IFNULL(max(voucherNo),0)+1, 6, 0) as voucherCode FROM tbl_paymentVoucher WHERE vehicle_id='$vehicle_id'";
                $query = $conn->query($sql);
                while ($prow = $query->fetch_assoc()) {
                    $voucherNo = $prow['voucherCode'];
                }
                if ($voucherNo == "") {
                    $voucherNo = "000001";
                }
                
                $sql_payment_voucher = "INSERT INTO tbl_paymentvoucher(vehicle_id, amount, entryBy, paymentMethod, paymentDate, proposal_adjust_id, type, remarks, entryDate, voucherType, customerType, voucherNo) 
                                        VALUES ('$vehicle_id', '$editamount', '$loginID', 'Cash', '$toDay','$proposal_adjust_id','$paymenttype','Payment Adjusted for requisition id $proposal_adjust_id','$toDay', 'document', 'Party', '$voucherNo')";
            
                //echo $sql;
            
                if ($conn->query($sql_payment_voucher)) {
                    echo "Success";
                } else {
                    echo "Error";
                }
            }  else{
                echo "Error: Error to save ajustment entry ".$sql_save_adjust;
            } 
        } else {
            echo 'Not a valid entry';
        }
    }
} else {
    /*Proposal id and req_id should be same*/
    $sql = "SELECT vehicle_master.vehicle_number ,vehicle_documents_proposal.id,vehicle_documents_proposal.req_id,vehicle_documents_proposal.entry_date,
    SUM(vehicle_documents_proposal.office_fee) AS TotalOfficeFee ,SUM(vehicle_documents_proposal.token_fee)as  TotalTokenFee,SUM(vehicle_documents_proposal.others_fee) AS TotalOthersFee, proposal_adjustment.adjusted_amount 
    FROM vehicle_documents_proposal
    INNER JOIN vehicle_master on vehicle_master.id = vehicle_documents_proposal.vehicle_id
    LEFT OUTER JOIN proposal_adjustment ON vehicle_documents_proposal.id = proposal_adjustment.document_proposal_id AND proposal_adjustment.deleted='No'
    Where vehicle_documents_proposal.deleted= 'No'
    GROUP BY vehicle_documents_proposal.req_id ORDER BY vehicle_documents_proposal.req_id  DESC;";
    $result = $conn->query($sql);

    $output = array('data' => array());
    if ($result->num_rows > 0) {
        $idNo = 1;
        while ($row = $result->fetch_array()) {
            $adjusted_amount = "<span color:red>Not Set</span>";
            if($row['adjusted_amount'] != ""){
                $adjusted_amount = $row['adjusted_amount'];
            }
            $buttons = "<a href='vehicleRequsition-viewpdf.php?reqId=" . $row['req_id'] . "' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i> Print </a>
            <button type = 'button' class='btn btn-danger btn-sm  btn-flat'  style='margin-bottom: 5px;'  onclick='deleteRow(" . $row['id'] . ")'><i class='fa fa-trash'> Delete</i></button>
            <button type = 'button' class='btn btn-warning btn-sm  btn-flat'  style='margin-bottom: 5px;'  onclick='adjustrow(" . $row['id'] . ")' ><i class='fa fa-edit'> Adjust</i> </button>";


            $total = $row['TotalOfficeFee'] + $row['TotalTokenFee'] + $row['TotalOthersFee'];
            $output['data'][] = array(
                $idNo++,
                $row['vehicle_number'],
                $row['entry_date'],
                $row['TotalOfficeFee'],
                $row['TotalTokenFee'],
                $row['TotalOthersFee'],
                $total,
                $adjusted_amount,
                $buttons
            );
        }
    }

    $conn->close();

    echo json_encode($output);
}




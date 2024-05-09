<?php 
$conPrefix = '../';
include $conPrefix . 'includes/session.php';
$Date = (new DateTime())->format("Y-m-d H:i:s");
$loginID = $_SESSION['admin'];
echo $loginID ;
$toDay = (new DateTime())->format("Y-m-d H:i:s");

if(isset($_POST['Action'])){
    $action = $_POST['Action'];
    if($action == 'deleteRequisitionSheet'){
        $id=$_POST['id'];
        $sql_delete_vehical_proposal = "UPDATE  vehicle_documents_proposal set deleted = 'Yes', status = 'Inactive', deleted_by='$loginID',deleted_date=date('Y-m-d') WHERE id = $id";
        $query = $conn->query($sql_delete_vehical_proposal);


        $sql_payment_delete = "UPDATE  tbl_paymentvoucher set deleted = 'Yes', status = 'Inactive', deletedBy='$loginID' WHERE tbl_paymentvoucher.tbl_proposal_id = $id";
        $query_del = $conn->query($sql_payment_delete);
        if($query){
            echo json_encode('success');
        }else{
            echo json_encode($conn->error);
        }
    }
   // echo json_encode($row);  
}
 

    //ADJUST VEHICAL REQUISITION 

     if(isset($_POST['adjustvehicalreq'])){
		$loginID = $_SESSION['admin'];
		$id = $_POST['id'];
		$vehicleNumber = $_POST['vehicleNumber'];
		$lfNumber = $_POST['lfNumber'];
		$particulars = $_POST['particulars'];
		$RepaireType = $_POST['RepaireType'];
		$amount = $_POST['Repamount'];
		
		$sql = "UPDATE vehicle_repaire SET repaire_date = '$repaireDate',vehicle_no ='$vehicleNumber',lf_number = '$lfNumber',particulars='$particulars',repaire_type='$RepaireType',amount='$amount',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vehicle Repaire Updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		header('location: vehicle-repaire.php');
	}	
?>
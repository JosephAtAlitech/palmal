<?php
$conPrefix = '../';
include $conPrefix . 'includes/session.php';
$Date = (new DateTime())->format("Y-m-d H:i:s");
$loginID = $_SESSION['admin'];
if (isset($_POST["Action"])) {
    if ($_POST["Action"] == "addToken") {
        $tokenTitle = $_POST["tokenTitle"];
        $tokenDetails = $_POST["tokenDetails"];
        $mechanic = $_POST["mechanic"];
        $engineer = $_POST["engineer"];
        $tokenDate = $_POST["tokenDate"];
        $vehicle = $_POST["vehicle"];
        $driver = $_POST["driver"];
        $workshop = $_POST["workshop"];
        $currentMileage = $_POST["currentMileage"];

        try {
            $conn->begin_transaction();
            $sql = "SELECT LPAD(max(token_no)+1, 6, 0) as tokenCode from tbl_token";
            $query = $conn->query($sql);
            while ($prow = $query->fetch_assoc()) {
                $tokenNo = $prow['tokenCode'];
            }
            if ($tokenNo == "") {
                $tokenNo = "000001";
            }
            $sql = "INSERT INTO tbl_token (token_no, department_status, vehicle_id, current_mileage, driver_id, warehouse_id, token_title, token_details, mechanic_id, engineer_id,token_date, status, created_by, created_date ) 
                    VALUES( '$tokenNo', 'Workshop','$vehicle','$currentMileage','$driver','$workshop','$tokenTitle','$tokenDetails','$mechanic','$engineer','$tokenDate','Pending','$loginID','$Date' )";
            if ($query = $conn->query($sql)) {
                //$tokenID = $conn->insert_id;


                $conn->commit();
                echo 'success';
            } else {
                $conn->rollback();
                echo json_encode($conn->error . $sql);
            }
        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
    } else if ($_POST["Action"] == "addRequisitions") {
        $tokenId = $_POST["id"];
        $products = $_POST["products"];
        $productsArr = explode(",", $products);
        $requisition_ids = explode(",", $_POST["requisition_ids"]);
        $specs = explode(",", $_POST["specs"]);
        $group = explode(",", $_POST["group"]);
        $qty = explode(",", $_POST["qty"]);
        $units = explode(",", $_POST["units"]);
        $remarks = explode(",", $_POST["remarks"]);
        $engineerRequisitionDate = $_POST["engineerRequisitionDate"];
        $engineerComment = $_POST["engineerComment"];
        $estimatedPrice = $_POST["estimatedPrice"];
        try {
            $conn->begin_transaction();

            $sql0 = "UPDATE tbl_token SET engr_req_details = '$engineerComment' , engr_requisition_date = '$engineerRequisitionDate' , estimated_price ='$estimatedPrice', status = 'Gen_Requsition' WHERE tbl_token.id = $tokenId";
            $query = $conn->query($sql0);

            for ($i = 0; $i < count($productsArr); $i++) {
                if ($requisition_ids[$i] < 0) {
                    $sql = "INSERT INTO tbl_token_requisition ( tbl_token_id,  req_product, req_group_name, spec, qty, unit , remarks, created_by, created_date ) 
                    VALUES( '$tokenId', '$productsArr[$i]','$group[$i]', '$specs[$i]', '$qty[$i]','$units[$i]', '$remarks[$i]',  '$loginID',  '$Date' )";
                    $query = $conn->query($sql);
                    
                    $sql1 = "UPDATE tbl_token SET  department_status = 'Workshop' WHERE tbl_token.id = $tokenId";
                    $query = $conn->query($sql1);
                } else {
                    $sql = "UPDATE tbl_token_requisition SET req_product = '$productsArr[$i]' , spec = '$specs[$i]',qty = '$qty[$i]',unit = '$units[$i]',remarks = '$remarks[$i]' where tbl_token_requisition.id = $requisition_ids[$i]";
                    $query = $conn->query($sql);
                }
            }
            $sql2 = "SELECT id from quotation_log where step = '1' AND token_id ='$tokenId' and deleted='No'";
            $query2 = $conn->query($sql2);
            $num_rows = $query2->num_rows;
            if ($num_rows < 1) {
                $sql = "INSERT INTO quotation_log (step, step_head, token_id, remarks, token_status,department, created_by, created_date ) 
                VALUES( '1', 'Manual Requisition','$tokenId','Engineer created requisition and entired the details into the system.','Gen_Requsition','Workshop','$loginID','$Date')";
                $query = $conn->query($sql);
            }

            $conn->commit();
            echo 'success';

        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
        $conn->close();
    } else if ($_POST["Action"] == "getTokenRequisition") {

        $id = $_POST["id"];
        $requisitionArr = [];
        $sql = "SELECT tbl_token_requisition.* from tbl_token_requisition 
                where tbl_token_requisition.deleted ='No' and tbl_token_requisition.tbl_token_id = $id";
        $query1 = $conn->query($sql);

        $unites = [];
        $sql = "SELECT unitName, id from tbl_units where deleted = 'no' ORDER BY id desc";
        $query2 = $conn->query($sql);

        if ($query1 && $query2) {
            while ($row1 = $query1->fetch_assoc()) {
                array_push($requisitionArr, $row1);
            }
            while ($row2 = $query2->fetch_assoc()) {
                array_push($unites, $row2);
            }

            echo json_encode(['requisitions' => $requisitionArr, 'units' => $unites]);
        } else {
            echo json_encode($conn->error . $sql);
        }
    } else if ($_POST["Action"] == "getDriverAndEngr") {
        $vehicle = $_POST["vehicle"];
        $sql = "SELECT driver_id, engineer_id from vehicle_master where delete_status = 'Active' and vehicle_master.id = $vehicle limit 1";
        $query = $conn->query($sql);
        // echo json_encode($sql);
        // return;
        if ($query) {
            $row = $query->fetch_assoc();
            $driver = $row['driver_id'];
            $engineer = $row['engineer_id'];

            echo json_encode(['driver' => $driver, 'engineer' => $engineer]);
        } else {
            echo json_encode($conn->error . $sql);
        }
    } else if ($_POST["Action"] == "getUnit") {
        $unites = [];
        $sql = "SELECT unitName, id from tbl_units where deleted = 'no' ORDER BY id desc";
        $query = $conn->query($sql);

        if ($query) {
            while ($row = $query->fetch_assoc()) {
                array_push($unites, $row);
            }

            echo json_encode($unites);
        } else {
            echo json_encode($conn->error . $sql);
        }
    } else if ($_POST["Action"] == "deleteToken") {
        $id = $_POST["id"];
        $sql = "SELECT id from tbl_quotation where tbl_quotation.tbl_token_id  =$id AND deleted = 'No'";
        $query = $conn->query($sql);

        if ($query->num_rows > 0) {
            $sql = "UPDATE  tbl_token set deleted = 'Yes'
            where tbl_token.id = $id";
            $query = $conn->query($sql);

            if ($query) {
                $sql = "UPDATE  tbl_token_requisition set deleted = 'Yes'
                        where tbl_token_requisition.tbl_token_id = $id";
                $query = $conn->query($sql);
                if ($query) {
                    echo 'success';
                }
            } else {
                echo json_encode($conn->error . $sql);
            }
        } else {
            echo 'reject';
        }


    } else if ($_POST["Action"] == "deleteRequisition") {

        $id = $_POST["id"];
        $sql = "UPDATE  tbl_token_requisition set deleted = 'Yes'
                where tbl_token_requisition.id = $id";
        $query = $conn->query($sql);
        if ($query) {
            echo json_encode("success");
        } else {
            echo json_encode($conn->error . $sql);
        }

    } else if ($_POST["Action"] == "getMechanicAndEngineer") {

        $id = $_POST["id"];
        $sql = "SELECT tbl_token.* , m.firstname m_name, e.firstname e_name , tbl_warehouse.wareHouseName, tbl_warehouse.position_type from tbl_token 
               left outer join tbl_warehouse  on tbl_token.warehouse_id = tbl_warehouse.id
                left outer join admin as m on tbl_token.mechanic_id = m.id
                inner join admin as e on tbl_token.engineer_id = e.id
                where tbl_token.id = $id AND tbl_token.deleted ='No'";
        $query = $conn->query($sql);

        if ($query) {
            $row = $query->fetch_array();
            echo json_encode($row);
        } else {
            echo json_encode($conn->error . $sql);
        }

    } else if ($_POST["Action"] == "allocateMechanic") {

        $id = $_POST["id"];
        $mechanic = $_POST["mechanic_for_allocate"];
        $sql = "UPDATE tbl_token
                SET mechanic_id = " . $mechanic . "
                WHERE tbl_token.id = " . $id . "";

        if ($conn->query($sql)) {
            echo "success";
        } else {
            echo json_encode($conn->error . $sql);
        }

    } else if ($_POST["Action"] == "mechanicComment") {

        $id = $_POST["id"];
        $problems = $_POST["problems"];
        $sql = "UPDATE tbl_token SET `problems` = '" . $problems . "', status ='Running'  WHERE id = " . $id . "";
        if ($conn->query($sql)) {
            echo "success";
        } else {
            echo json_encode($conn->error . $sql);
        }

    } else if ($_POST["Action"] == "getdDetailInfo") {
        $id = $_POST["id"];
        $log = [];
        $sql = "SELECT * from quotation_log  WHERE token_id = $id AND deleted = 'No'";
        $query = $conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_assoc()) {
                array_push($log, $row);
            }
            echo json_encode($log);
        } else {
            echo json_encode($conn->error . $sql);
        }
    } else if ($_POST["Action"] == "getFinalApprovalInfo") {

        $id = $_POST["id"];

        $sql = "SELECT tbl_token.is_delivered  ,vehicle_master.vehicle_number,e.firstname e_name, driver_master.driver_name FROM tbl_token
                left outer join vehicle_master  on tbl_token.vehicle_id = vehicle_master.id
                left outer join driver_master  on tbl_token.driver_id = driver_master.id
                inner join admin as e on tbl_token.engineer_id = e.id
                Where tbl_token.id = $id AND tbl_token.deleted = 'No'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        if ($row['is_delivered'] != '') {
            echo json_encode('delivered');
        } else {
            echo json_encode($row);
        }

    } else if ($_POST["Action"] == "setFinalConfirmation") {

        $tokenId = $_POST["id"];
        $date = $_POST["approvalDate"];
        $comment = $_POST["comment"];
        $approvalStatus = $_POST["approvalStatus"];

        $sql1 = "UPDATE tbl_token SET  is_delivered = '1', delivered_date = '$date' , delivered_comment = '$comment' ,delivered_by = '$loginID'  WHERE tbl_token.id = $tokenId";
        $query = $conn->query($sql1);

        if ($query) {
            echo 'success';
        } else {
            echo json_encode($conn->error . $sql1);
        }
    }
} else {
    $sql = "SELECT tbl_token.*,vehicle_master.vehicle_number, vehicle_master.employee_name,m.firstname m_name, e.firstname e_name, driver_master.driver_name FROM `tbl_token`
    		left outer join vehicle_master  on tbl_token.vehicle_id = vehicle_master.id
            left outer join driver_master  on tbl_token.driver_id = driver_master.id
            inner join admin as e on tbl_token.engineer_id = e.id
            left outer join admin as m on tbl_token.mechanic_id = m.id
     where tbl_token.deleted = 'No' ORDER BY id  DESC";
    $query = $conn->query($sql);
    $i = 1;
    $output = array('data' => array());

    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];
        if($row['is_delivered']!=''){
                $deliStataus = '<div class="label label-success" style="font-size:14px; margin-right:2px"><i class="fa fa-view" style="width: 80%;"Delivered</i></div>';
            }else{
                $deliStataus = '<div class="label label-danger" style="font-size:14px; margin-right:2px"><i class="fa fa-view" style="width: 80%;">Not_delivered<i></span>'; 
            }
        if ($row['problems'] != '') {
            $mc_comments = "Comments  : " . $row['problems'];
        } else {
            $mc_comments = '';
        }
        if ($row['engr_req_details'] != '') {
            $eng_comments = "Comments  : " . $row['engr_req_details'];
        } else {
            $eng_comments = '';
        }

        $status = $row['status'];
        $sql2 = "SELECT tbl_token_requisition.id , tbl_token_requisition.req_product, req_group_name FROM `tbl_token_requisition`
                WHERE tbl_token_requisition.tbl_token_id =  $id AND tbl_token_requisition.deleted ='No'";

        $query1 = $conn->query($sql2);
        $rows = $query1->num_rows;
        $products = '';
        $products .= '<table >';

        while ($row2 = $query1->fetch_assoc()) {
            $products .= '<li>' . $row2['req_product'] . '  <small>( ' . $row2['req_group_name'] . ')</small></li> ';
        }
        $products .= '</table>';
        //  $row1 = $query1->fetch_array();


        $sql3 = "SELECT tbl_quotation.id , tbl_party.partyName,tbl_quotation.po_date, tbl_quotation.is_accepted
            FROM `tbl_quotation`
                 join tbl_party on tbl_quotation.supplier_id = tbl_party.id
                 WHERE tbl_quotation.tbl_token_id = $id AND tbl_quotation.deleted ='No' ";
        $query2 = $conn->query($sql3);
        $qRows = $query2->num_rows;
        $quote_vendors = '';
        $po_date = '';
        $billButtons = '';
        while ($qRowsData = $query2->fetch_assoc()) {

            $qouteId = $qRowsData['id'];
            $po_date = $qRowsData['po_date'];
            $is_accepted = $qRowsData['is_accepted'];
            $accepted_label = '';
            
            if ($is_accepted != '') {
                $accepted_label = '<b>(Accepted)</b>';
            }
            $quote_vendors .= '<li>' . $qRowsData['partyName'] . ' ' . $accepted_label . '</li>';

            if ($po_date != '') {
                $billButtons = '<li><a href="quatationDetails.php?id=' . $id . '&quote_id=' . $qouteId . '"  target="_blank"><i class="fa fa-edit"></i> Challan Bill</a></li>';
            } else {
                $billButtons = '';
            }
        }
        $approveButtons = '';
        if ($status == 'Pending') {
            $badge = '<div class="label label-info" style="font-size:14px; margin-right:2px"><i class="fa fa-view" style="width: 80%;">' . $status . '</i></div>';
        } else if ($status == 'Running') {
            $badge = '<div class="label label-info" style="font-size:14px; margin-right:2px"><i class="fa fa-view" style="width: 80%;">' . $status . '</i></div>';
        } else if ($status == 'Job Completed') {
            $approveButtons = '<li><a href="#" onclick="engrConfimation(' . $id . ')"><i class="fa fa-edit" ></i>Delivery Confimation</a></li>';
            $badge = '<div class="label label-info" style="font-size:14px; margin-right:2px"><i class="fa fa-view" style="width: 80%;">' . $status . '</i></div>';
        } else if ($status == 'Cancel') {
            $badge = '<div class="label label-info" style="font-size:14px; margin-right:2px"><i class="fa fa-view" style="width: 80%;">' . $status . '</i></div>';
        } else {
            $badge = '<div class="label label-info" style="font-size:14px; margin-right:2px"><i class="fa fa-view" style="width: 80%;">' . $status . '</i></div>';
        }

        $button = ' <div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-gear tiny-icon"></i>  <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                    <li><a href="#" onclick="allocateMechanic(' . $id . ')"><i class="fa fa-edit"></i> Reallocate Mechanic </a></li>
                    <li><a href="#" onclick="mechanicComment(' . $id . ')"><i class="fa fa-edit"></i> Diagnosis by Mechanic</a></li>
                     <li><a href="maintenanceDemand.php?id=' . $id . '"  target="_blank"><i class="fa fa-file-pdf-o"></i> Demand Letter PDF</a></li>
                    <li><a href="#" onclick="addEgineerRequisition(' . $id . ')"><i class="fa fa-edit"></i> Generate Egr. Requisition</a></li>
                    <li><a href="quotationList.php?id=' . $id . '" target="_blank" ><i class="fa fa-edit"></i> Quotations </a></li>
                    <li><a href="tokenReport.php?id=' . $id . '"  target="_blank"><i class="fa fa-file-pdf-o"></i> CS Report PDF</a></li>
                   
                    <li>' . $billButtons . '</li>'
            . $approveButtons .
            '<li><a href="#" onclick="confirmDelete(' . $id . ')"><i class="fa fa-trash"></i> Delete</a></li>
                </ul>
            </div>';

        $department_status = '<div class="label label-primary" style="font-size:14px; margin-right:2px"><i class="fa fa-exchange" style="width: 80%;"  aria-hidden="true" onclick = "getFullView(' . $id . ')"> Status</i> </div><br><br><div class="label label-default" style="font-size:14px; margin-right:2px"><i class="fa fa-view" style="width: 80%;">' . $row['department_status'] . '</i></div>';
        $output['data'][] = array(
            $i++,
            $row['token_no'] . '<br>Vehicle No:  ' . $row['vehicle_number'] . '<br>Service title: ' . $row['token_title'],
            'User : ' . $row['employee_name'].'<br>Driver : ' . $row['driver_name'].'<br>Mechanics : '.$row['m_name'] . '<br>Engineer : ' . $row['e_name'],
            '<a href="#" onclick="addEgineerRequisition(' . $id . ')"><b>Products(' . $rows . ')</b></a><br>' . $products,
            '<a href="quotationList.php?id=' . $id . '" target="_blank" ><b>Quotations (' . $qRows . ')</b></a><br>' . $quote_vendors,
            $department_status.'<br><br>'.$badge.'<br><br>'.$deliStataus,
            $button
        );
    }
    echo json_encode($output);
}

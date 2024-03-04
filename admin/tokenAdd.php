<?php
include 'includes/session.php';
$Date = (new DateTime())->format("Y-m-d H:i:s");

if (isset($_POST["Action"])) {
    if ($_POST["Action"] == "addToken") {
        $tokenTitle = $_POST["tokenTitle"];
        $tokenDetails = $_POST["tokenDetails"];
        $mechanic = $_POST["mechanic"];
        $engineer = $_POST["engineer"];
        $tokenDate = $_POST["tokenDate"];

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
            $sql = "INSERT INTO tbl_token (token_no, token_title,  token_details, mechanic_id, engineer_id,token_date , status, created_by, created_date ) 
            VALUES( '$tokenNo','$tokenTitle', '$tokenDetails', '$mechanic', '$engineer','$tokenDate', 'Pending',  '$loginID',  '$Date' )";
            if ($query = $conn->query($sql)) {
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
        $qty = explode(",", $_POST["qty"]);
        $units = explode(",", $_POST["units"]);
        $remarks = explode(",", $_POST["remarks"]);
        $engineerRequisitionDate = $_POST["engineerRequisitionDate"];
        $engineerComment = $_POST["engineerComment"];
        try {
            $conn->begin_transaction();
            
            $sql = "UPDATE tbl_token SET engr_req_details = $engineerComment , engr_requisition_date = $engineerRequisitionDate , status = 'Running' WHERE tbl_token.id = $tokenId";
            $query = $conn->query($sql);

            for ($i = 0; $i < count($productsArr); $i++) {
                if ($requisition_ids[$i] < 0) {
                    $sql = "INSERT INTO tbl_token_requisition ( tbl_token_id,  req_product, spec, qty, unit , remarks, created_by, created_date ) 
                    VALUES( '$tokenId', '$productsArr[$i]', '$specs[$i]', '$qty[$i]','$units[$i]', '$remarks[$i]',  '$loginID',  '$Date' )";
                    $query = $conn->query($sql);
                } else {
                    $sql = "UPDATE tbl_token_requisition SET req_product = '$productsArr[$i]' , spec = '$specs[$i]',qty = '$qty[$i]',unit = '$units[$i]',remarks = '$remarks[$i]' where tbl_token_requisition.id = $requisition_ids[$i]";
                    $query = $conn->query($sql);
                }

            }

            $conn->commit();
            echo "success";

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
        $sql = "UPDATE  tbl_token set deleted = 'Yes'
                where tbl_token.id = $id";
        $query = $conn->query($sql);
        if ($query) {
            echo 'success';
        } else {
            echo json_encode($conn->error . $sql);
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
        $sql = "SELECT tbl_token.* , m.firstname m_name, e.firstname e_name from tbl_token 
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
        $sql = "UPDATE tbl_token
                SET `problems` = '" . $problems . "'
                WHERE id = " . $id . "";
        if ($conn->query($sql)) {
            echo "success";
        } else {
            echo json_encode($conn->error . $sql);
        }

    }
} else {
    $sql = "SELECT tbl_token.*, m.firstname m_name, e.firstname e_name FROM `tbl_token`
            inner join admin as e on tbl_token.engineer_id = e.id
            left outer join admin as m on tbl_token.mechanic_id = m.id
     where tbl_token.deleted = 'No' ORDER BY id  DESC";
    $query = $conn->query($sql);
    $i = 1;
    $output = array('data' => array());

    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $status = $row['status'];
        $sql2 = "SELECT tbl_token_requisition.id FROM `tbl_token_requisition`
                WHERE tbl_token_requisition.tbl_token_id =  $id AND tbl_token_requisition.deleted ='No'";

        $query1 = $conn->query($sql2);
      //  $row1 = $query1->fetch_array();
        $rows = $query1->num_rows;

        $sql3 = "SELECT tbl_quotation.id FROM `tbl_quotation`
              WHERE tbl_quotation.tbl_token_id =  $id AND tbl_quotation.deleted ='No'";
        $query2 = $conn->query($sql3);
        $qRows = $query2->num_rows;

        $button = ' <div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-gear tiny-icon"></i>  <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                    <li><a href="#" onclick="allocateMechanic(' . $id . ')"><i class="fa fa-edit"></i> Allocate Mechanic</a></li>
                    <li><a href="#" onclick="mechanicComment(' . $id . ')"><i class="fa fa-edit"></i> Mechanic Comment</a></li>
                    <li><a href="#" onclick="addEgineerRequisition(' . $id . ')"><i class="fa fa-edit"></i> Add Egineer Requisition</a></li>
                    <li><a href="quotationList.php?id=' . $id . '" ><i class="fa fa-edit"></i> Quotation List</a></li>
                    <li><a href="tokenReport.php?id=' . $id . '" ><i class="fa fa-edit"></i> View Details</a></li>
                    <li><a href="#" onclick="confirmDelete(' . $id . ')"><i class="fa fa-trash"></i> Delete</a></li>
                </ul>
                </div>';
        if ($status == 'Pending') {
            $badge = '<span class="label label-info">' . $status . '</span>';
        } else if ($status == 'Running') {
            $badge = '<span class="label label-primary">' . $status . '</span>';
        } else if ($status == 'Completed') {
            $badge = '<span class="label label-success">' . $status . '</span>';
        } else if ($status == 'Cancel') {
            $badge = '<span class="label label-danger">' . $status . '</span>';
        } else {
            $badge = '<span class="label label-default">' . $status . '</span>';
        }
        $output['data'][] = array(
            $i++,
            $row['token_no'],
            $row['token_title'],
            $row['m_name'],
            $row['e_name'],
            '<b>No of Request Product(' . $rows . ')</b>',
            '<b>No of Quatation (' . $qRows . ')</b>',
            $badge,
            $button
        );
    }
    echo json_encode($output);
}

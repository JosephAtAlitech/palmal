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
                echo json_encode('success');
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
        $specs = explode(",", $_POST["specs"]);
        $qty = explode(",", $_POST["qty"]);
        $units = explode(",", $_POST["units"]);
        $remarks = explode(",", $_POST["remarks"]);

        try {
            $conn->begin_transaction();
            for ($i = 0; $i < count($productsArr); $i++) {
                $sql = "INSERT INTO tbl_token_requisition ( tbl_token_id,  req_product, spec, qty, unit , remarks, created_by, created_date ) 
                 VALUES( '$tokenId', '$productsArr[$i]', '$specs[$i]', '$qty[$i]','$units[$i]', '$remarks[$i]',  '$loginID',  '$Date' )";
                $query = $conn->query($sql);
            }


            $conn->commit();
            echo json_encode('success');

        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
    } else if ($_POST["Action"] == "getTokenRequisition") {

        $id = $_POST["id"];
        $requisitionArr = [];
        $sql = "SELECT tbl_token_requisition.* from tbl_token_requisition 
                where tbl_token_requisition.deleted ='No' and tbl_token_requisition.tbl_token_id = $id";
        $query = $conn->query($sql);
        if ($query) {
            while ($row = $query->fetch_assoc()) {
                array_push($requisitionArr, $row);
            }
            echo json_encode($requisitionArr);
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
            echo json_encode('success');
        } else {
            echo json_encode($conn->error . $sql);
        }

    } else if ($_POST["Action"] == "deleteRequisition") {

        $id = $_POST["id"];
        $sql = "UPDATE  tbl_token_requisition set deleted = 'Yes'
                where tbl_token_requisition.id = $id";
        $query = $conn->query($sql);
        if ($query) {
            echo json_encode('success');
        } else {
            echo json_encode($conn->error . $sql);
        }

    } else if ($_POST["Action"] == "getMechanicAndEngineer") {

        $id = $_POST["id"];
        $sql = "SELECT tbl_token.* , m.firstname m_name, e.firstname e_name from tbl_token 
                join admin as m on tbl_token.mechanic_id = m.id
                join admin as e on tbl_token.engineer_id = e.id
                where tbl_token.id = $id";
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
            echo json_encode(['status' => 'success']);
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
            echo json_encode('success');
        } else {
            echo json_encode($conn->error . $sql);
        }

    }
} else {
    $sql = "SELECT tbl_token.*, m.firstname m_name, e.firstname e_name FROM `tbl_token`
    join admin as m on tbl_token.mechanic_id = m.id
    join admin as e on tbl_token.engineer_id = e.id
     where tbl_token.deleted = 'No' ORDER BY id  DESC";
    $query = $conn->query($sql);
    $i = 1;

    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];

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
        // if ($row['delete_status'] == 'Active') {
        //     $status = '<b style="color:green">' . $row['delete_status'] . '</b>';
        // } else {
        //     $status = '<b style="color:red">' . $row['delete_status'] . '</b>';
        // }
        $output['data'][] = array(
            $i++,
            '<b>No</b> : ',
            '<b>Title</b> : ' . $row['token_title'],
            '<b>Mechanic</b> : ' . $row['m_name'],
            '<b>Engineer</b> : ' . $row['e_name'],
            $button
        );
    }
    echo json_encode($output);
}

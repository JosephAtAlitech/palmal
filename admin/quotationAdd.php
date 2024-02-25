<?php
include 'includes/session.php';
$Date = (new DateTime())->format("Y-m-d H:i:s");

if (isset($_POST["Action"])) {
    if ($_POST["Action"] == "saveQuotation") {
        $tokenId = $_POST["tokenId"];
        $quoteBy = $_POST["quoteBy"];
        $vat = $_POST["vat"];
        $ait = $_POST["ait"];
        $discount = $_POST["discount"];
        $quoteAmount = $_POST["quoteAmount"];
        $quoteDate = $_POST["quoteDate"];
        $grandTotal = $_POST["grandTotal"];

        $productsArr = explode(",",  $_POST["products"]);
        $specs = explode(",", $_POST["specs"]);
        $qty = explode(",", $_POST["qty"]);
        $units = explode(",", $_POST["units"]);
        $requisitionIds = explode(",", $_POST["requisitionIds"]);
        $unitPrice = explode(",", $_POST["unitPrice"]);
        $totalPrice = explode(",", $_POST["totalPrice"]);

        try {
            $conn->begin_transaction();
            $sql = "INSERT INTO tbl_quotation (tbl_token_id, quote_by_id, total_amount, discount, quote_date, Vat, Ait, grand_total, deleted, created_by, created_date ) 
            VALUES( '$tokenId', '$quoteBy', '$quoteAmount', '$discount','$quoteDate', '$vat','$ait','$grandTotal', 'No', '$loginID',  '$Date' )";

            if ($query = $conn->query($sql)) {
                $quotation_id = $conn->insert_id;
                for ($i = 0; $i < count($productsArr); $i++) {
                    $sql = "INSERT INTO tbl_quotation_details (tbl_quotation_id, tbl_token_requisition_id, Product_name, qty, unit, unit_price,total_amount, wing_head_unit_price,  wing_head_total_amount , audit_unit_price,  audit_total_amount , created_by, created_date ) 
                            VALUES( '$quotation_id', '$requisitionIds[$i]', '$productsArr[$i]', '$qty[$i]', '$units[$i]', '$unitPrice[$i]', '$totalPrice[$i]', '$unitPrice[$i]', '$totalPrice[$i]', '$unitPrice[$i]','$totalPrice[$i]', '$loginID', '$Date' )";
                    $query = $conn->query($sql);
                }
                $conn->commit();
                echo json_encode($sql);
            } else {
                $conn->rollback();
                echo json_encode($conn->error . $sql);
            }
        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
    }
    else if ($_POST["Action"] == "deleteQuotation") {

        $id = $_POST["id"];
        $sql = "UPDATE  tbl_quotation set deleted = 'Yes'
                where tbl_quotation.id = $id";
        $query = $conn->query($sql);
        if ($query) {
            echo json_encode('success');
        } else {
            echo json_encode($conn->error . $sql);
        }

    }  
} else {
    $sql = "SELECT tbl_quotation.*, tbl_token.token_title ,tbl_token.id  as token_id , admin.firstname FROM `tbl_quotation` 
            JOIN tbl_token on tbl_quotation.tbl_token_id = tbl_token.id
            LEFT JOIN admin on tbl_quotation.quote_by_id = admin.id
            WHERE tbl_quotation.deleted = 'No' ORDER BY tbl_quotation.id  DESC";
    $query = $conn->query($sql);
    $i = 1;
    $output = array();
    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];

        $button = '<div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-gear tiny-icon"></i>  <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                            <li><a href="addQuotationView.php?id=' . $row['token_id'] . '&type=wing_head" ><i class="fa fa-edit"></i> Wing Head Quotation</a></li>
                            <li><a href="addQuotationView.php?id=' . $row['token_id'] . '&type=audit" ><i class="fa fa-edit"></i> Audit Quotation</a></li>
                            <li><a href="tokenReport.php?id=' . $row['token_id'] . '" ><i class="fa fa-edit"></i> View Details</a></li>
                            <li><a href="#" onclick="confirmDelete(' . $id . ')"><i class="fa fa-trash"></i> Delete</a></li>
                        </ul>
                    </div>';
        $output['data'][] = array(
            $i++,
            '<b>Quotaion Date</b> : ' . $row['quote_date'],
            '<b>Quotaion By</b> : ' . $row['firstname'],
            '<b>Token Title</b> : ' . $row['token_title'],
            $button
        );
    }
    echo json_encode($output);
}

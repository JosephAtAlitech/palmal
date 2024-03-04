<?php
include 'includes/session.php';
$Date = (new DateTime())->format("Y-m-d H:i:s");

if (isset($_POST["Action"])) {
    if ($_POST["Action"] == "saveQuotation") {
        $tokenId = $_POST["tokenId"];
        $supplier = $_POST["supplier"];
        $quoteBy = $_POST["quoteBy"];
        $vat = $_POST["vat"];
        $ait = $_POST["ait"];
        $discount = $_POST["discount"];
        $quoteAmount = $_POST["quoteAmount"];
        $quoteDate = $_POST["quoteDate"];
        $grandTotal = $_POST["grandTotal"];

        $productsArr = explode(",", $_POST["products"]);
        $specs = explode(",", $_POST["specs"]);
        $qty = explode(",", $_POST["qty"]);
        $units = explode(",", $_POST["units"]);
        $requisitionIds = explode(",", $_POST["requisitionIds"]);

        $unitPrice = explode(",", $_POST["unitPrice"]);
        $totalPrice = explode(",", $_POST["totalPrice"]);
        if ($_POST['type'] == 'wing_head') {
            $wing_head_uPrice = explode(",", $_POST["wing_head_uPrice"]);
            $wing_head_tPrice = explode(",", $_POST["wing_head_tPrice"]);
            $quoteDetailsIds = explode(",", $_POST["quoteDetailsIds"]);
            $quotation_id = $_POST["quotation_id"];
        }
        if ($_POST['type'] == 'audit') {
            $audit_uPrice = explode(",", $_POST["audit_uPrice"]);
            $audit_tPrice = explode(",", $_POST["audit_tPrice"]);
            $quotation_id = $_POST["quotation_id"];
        }

        try {
            $conn->begin_transaction();
            if ($_POST['type'] == 'procurement') {
                $sql = "INSERT INTO tbl_quotation (tbl_token_id, quote_by_id, total_amount, discount, quote_date,supplier_id , Vat, Ait, grand_total, deleted, created_by, created_date ) 
                VALUES( '$tokenId', '$quoteBy', '$quoteAmount', '$discount','$quoteDate','$supplier', '$vat','$ait','$grandTotal', 'No', '$loginID',  '$Date' )";
            } else {
                if ($_POST['type'] == 'wing_head') {
                    $sql = "UPDATE tbl_quotation SET total_amount = '$quoteAmount', discount = '$discount',  Vat = '$vat', Ait = '$ait', wing_head_grand_total = '$grandTotal', updated_by ='$loginID', updated_date ='$Date' WHERE tbl_quotation.id = $quotation_id";
                }else{
                    $sql = "UPDATE tbl_quotation SET total_amount = '$quoteAmount', discount = '$discount',  Vat = '$vat', Ait = '$ait', audit_grand_total = '$grandTotal', updated_by ='$loginID', updated_date ='$Date' WHERE tbl_quotation.id = $quotation_id";
                }
               
            }

            if ($query = $conn->query($sql)) {
                $quotation_id = $_POST['type'] == 'procurement' ? $conn->insert_id : $quotation_id;
                for ($i = 0; $i < count($productsArr); $i++) {
                    if($_POST['type'] == 'wing_head') {
                        $ad_uPrice = $wing_head_uPrice[$i];
                        $ad_tPrice = $wing_head_tPrice[$i];

                        $sql1 = "UPDATE tbl_quotation_details set wing_head_unit_price = $wing_head_uPrice[$i], wing_head_total_amount = $wing_head_tPrice[$i], audit_unit_price =  $ad_uPrice,  audit_total_amount =$ad_tPrice, updated_by = $loginID , updated_date = $Date Where id= $quoteDetailsIds[$i] ";
                        $query = $conn->query($sql1);

                    } else if ($_POST['type'] == 'audit') {
                        $quoteDetailsIds = explode(",", $_POST["quoteDetailsIds"]);
                        $sql2 = "UPDATE tbl_quotation_details set audit_unit_price =   $audit_uPrice[$i] ,  audit_total_amount =$audit_tPrice[$i], updated_by = $loginID , updated_date = $Date Where id= $quoteDetailsIds[$i]";
                        $query = $conn->query($sql2);
                    } else {
                        $sql3 = "INSERT INTO tbl_quotation_details (tbl_quotation_id, tbl_token_requisition_id, Product_name, qty, unit, unit_price,total_amount, wing_head_unit_price,  wing_head_total_amount , audit_unit_price,  audit_total_amount , created_by, created_date ) 
                        VALUES( '$quotation_id', '$requisitionIds[$i]', '$productsArr[$i]', '$qty[$i]', '$units[$i]', '$unitPrice[$i]', '$totalPrice[$i]', '$unitPrice[$i]', '$totalPrice[$i]', '$unitPrice[$i]','$totalPrice[$i]', '$loginID', '$Date' )";
                        $query = $conn->query($sql3);
                    }
                }
                $conn->commit();
                echo json_encode($sql1);
            } else {
                $conn->rollback();
                echo json_encode($conn->error . $sql);
            }
        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
        $conn->close();
    } else if ($_POST["Action"] == "deleteQuotation") {

        $id = $_POST["id"];
        $sql = "UPDATE  tbl_quotation set deleted = 'Yes'
                where tbl_quotation.id = $id";
        $query = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $sql = "UPDATE  tbl_quotation_details set deleted = 'Yes'
            where tbl_quotation_details.tbl_quotation_id = $id";
            $query = $conn->query($sql);
            if ($query) {
                echo json_encode('success');
            } else {
                echo json_encode($conn->error . $sql);
            }
        } else {
            echo json_encode($conn->error . $sql);
        }

    }
} else {
    $getId = $_GET['id'];
    $sql = "SELECT tbl_quotation.*, tbl_token.token_title ,tbl_token.id  as token_id , admin.firstname FROM `tbl_quotation` 
            JOIN tbl_token on tbl_quotation.tbl_token_id = tbl_token.id
            LEFT JOIN admin on tbl_quotation.quote_by_id = admin.id
            WHERE tbl_quotation.deleted = 'No' and tbl_token.id = $getId ORDER BY tbl_quotation.id  DESC";
    $query = $conn->query($sql);
    $i = 1;
    $output = array('data' => array());
    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $products ='';
        $sql2 = "SELECT tbl_quotation_details.Product_name FROM `tbl_quotation_details`
        WHERE tbl_quotation_details.tbl_quotation_id =  $id AND tbl_quotation_details.deleted ='No'";
        $query2 = $conn->query($sql2);
        $products .='<table>';
        while ($row2 = $query2->fetch_assoc()) {
            $products .='<tr><td>'.$row2['Product_name'].'</td></tr>';
        }
        $products .='</table>';
        $query1 = $conn->query($sql2);
//  $row1 = $query1->fetch_array();
        $button = '<div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-gear tiny-icon"></i>  <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                            <li><a href="addQuotationView.php?Token_id=' . $row['token_id'] . '&id=' . $row['id'] . '&type=wing_head" ><i class="fa fa-edit"></i> Wing Head Quotation</a></li>
                            <li><a href="addQuotationView.php?Token_id=' . $row['token_id'] . '&id=' . $row['id'] . '&type=audit" ><i class="fa fa-edit"></i> Audit Quotation</a></li>
                            <li><a href="tokenReport.php?id=' . $row['token_id'] . '" ><i class="fa fa-edit"></i> View Details</a></li>
                            <li><a href="#" onclick="confirmDelete(' . $id . ')"><i class="fa fa-trash"></i> Delete</a></li>
                        </ul>
                    </div>';
        $output['data'][] = array(
            $i++,
            '<b>Quotaion Date</b> : ' . $row['quote_date'],
            '<b>Quotaion By</b> : ' . $row['firstname'],
             $row['token_title'],
             $products ,
             $row['grand_total'],
            $button
        );
    }
    echo json_encode($output);
}

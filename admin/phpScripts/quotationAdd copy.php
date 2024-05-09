<?php
$conPrefix = '../';
include $conPrefix . 'includes/session.php';
$todayDate = (new DateTime())->format("Y-m-d H:i:s");
$Date = date('Y-m-d', strtotime($todayDate));
$loginID = $_SESSION['admin'];
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
        $target_dir = "../../images/quotation/";
        $path = '';
        if (isset($_FILES["file"]["name"])) {
            if ($_FILES["file"]["name"] != '') {
                $base = basename($_FILES["file"]["name"]);
                $target_file = $target_dir . $supplier . '_' . basename(str_replace(' ', '_', $_FILES["file"]["name"]));
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                $path = str_replace(' ', '_', $supplier . '_' . $_FILES["file"]["name"]);
            } else {
                $target_file = '';
            }
        }

        $grandTotal = $_POST["grandTotal"];

        $productsArr = explode(",", $_POST["products"]);
        $specs = explode(",", $_POST["specs"]);
        $qty = explode(",", $_POST["qty"]);
        $units = explode(",", $_POST["units"]);
        $group = explode(",", $_POST["group"]);

        $requisitionIds = explode(",", $_POST["requisitionIds"]);

        $unitPrice = explode(",", $_POST["unitPrice"]);
        $totalPrice = explode(",", $_POST["totalPrice"]);

        if ($_POST['type'] == 'wing_head') {
            $wing_head_uPrice = explode(",", $_POST["wing_head_uPrice"]);
            $wing_head_tPrice = explode(",", $_POST["wing_head_tPrice"]);
            $quoteDetailsIds = explode(",", $_POST["quoteDetailsIds"]);
            $quotation_id = $_POST["quotation_id"];
            $wing_head_approval_date = $_POST["wing_head_approval_date"];
            $wing_head_comment = $_POST["wing_head_comment"];
        } else if ($_POST['type'] == 'audit') {
            $audit_uPrice = explode(",", $_POST["audit_uPrice"]);
            $audit_tPrice = explode(",", $_POST["audit_tPrice"]);
            $quotation_id = $_POST["quotation_id"];
            $audit_approval_date = $_POST["audit_approval_date"];
            $audit_comment = $_POST["audit_comment"];
        }

        try {
            $conn->begin_transaction();

            if ($_POST['type'] == 'wing_head') {
                $sql = "UPDATE tbl_quotation SET total_amount = '$quoteAmount', discount = '$discount',  Vat = '$vat', Ait = '$ait', wing_head_grand_total = '$grandTotal', wing_head_approved_date = '$wing_head_approval_date' , wing_head_comments = '$wing_head_comment', quotation_status = 'Wing Head Approved', updated_by ='$loginID', updated_date ='$Date' WHERE tbl_quotation.id = $quotation_id";
                $query = $conn->query($sql);

                $sql2 = "SELECT id from quotation_log where step = '3' AND token_id ='$tokenId' and deleted='No'";
                $query2 = $conn->query($sql2);
                $num_rows = $query2->num_rows;
                if ($num_rows < 1) {
                    $sql = "INSERT INTO quotation_log (step, step_head, token_id, remarks, token_status,department, created_by, created_date ) 
                            VALUES( '3', 'Wing Head','$tokenId','Approved And edited by Wing Head.','Running','Wing Head','$loginID','$Date')";
                    $query = $conn->query($sql);
                }
                $sql1 = "UPDATE tbl_token SET  department_status = 'Wing Head' WHERE tbl_token.id = $tokenId";
                $query = $conn->query($sql1);

            } else if ($_POST['type'] == 'audit') {
                $sql = "UPDATE tbl_quotation SET total_amount = '$quoteAmount', discount = '$discount',  Vat = '$vat', Ait = '$ait', audit_grand_total = '$grandTotal', audit_approved_date = '$audit_approval_date' , audit_comments = '$audit_comment', quotation_status= 'Audit Approved', updated_by ='$loginID', updated_date ='$Date' WHERE tbl_quotation.id = $quotation_id";
                $query = $conn->query($sql);
                $sql2 = "SELECT id from quotation_log where step = '4' AND token_id ='$tokenId' and deleted='No'";
                $query2 = $conn->query($sql2);
                $num_rows = $query2->num_rows;
                if ($num_rows < 1) {
                    $sql = "INSERT INTO quotation_log (step, step_head, token_id, remarks, token_status,department, created_by, created_date) 
                            VALUES( '4', 'Audit','$tokenId','Approved And edited by audit department.','Running','Audit','$loginID','$Date')";
                    $query = $conn->query($sql);
                }
                $sql1 = "UPDATE tbl_token SET  department_status = 'Audit' WHERE tbl_token.id = $tokenId";
                $query = $conn->query($sql1);
            } else {

                $sql1 = "UPDATE tbl_token SET  department_status = 'Procurement', status = 'Running'  WHERE tbl_token.id = $tokenId";
                $query = $conn->query($sql1);

                $sql2 = "SELECT id from quotation_log where step = '2' AND token_id ='$tokenId' and deleted='No'";
                $query2 = $conn->query($sql2);
                $num_rows = $query2->num_rows;
                if ($num_rows < 1) {
                    $sql3 = "INSERT INTO quotation_log (step, step_head, token_id, remarks, token_status,department, created_by, created_date ) 
                    VALUES( '2', 'Procurement','$tokenId','Manually sent the requisition to vendor and received quotations from vendors.','Running','Procurement','$loginID','$Date')";
                    $query3 = $conn->query($sql3);
                }


                $sql = "INSERT INTO tbl_quotation (tbl_token_id, quote_by_id, total_amount, discount, quote_date,supplier_id , Vat, Ait, grand_total,quotation_status, deleted, created_by, created_date,tbl_file_name ) 
                    VALUES( '$tokenId', '$quoteBy', '$quoteAmount', '$discount','$quoteDate','$supplier', '$vat','$ait','$grandTotal','Procurement Approved', 'No', '$loginID',  '$Date','$path' )";
                $query = $conn->query($sql);

            }


            if ($query) {
                $quotation_id = $_POST['type'] == 'procurement' ? $conn->insert_id : $quotation_id;
                for ($i = 0; $i < count($productsArr); $i++) {
                    if ($_POST['type'] == 'wing_head') {
                        $ad_uPrice = $wing_head_uPrice[$i];
                        $ad_tPrice = $wing_head_tPrice[$i];

                        $sql1 = "UPDATE tbl_quotation_details set wing_head_unit_price = $wing_head_uPrice[$i], wing_head_total_amount = $wing_head_tPrice[$i], audit_unit_price =  $ad_uPrice,  audit_total_amount =$ad_tPrice, updated_by = '$loginID' , updated_date = '$Date' Where id= $quoteDetailsIds[$i] ";
                        $query = $conn->query($sql1);

                    } else if ($_POST['type'] == 'audit') {
                        $quoteDetailsIds = explode(",", $_POST["quoteDetailsIds"]);
                        $sql2 = "UPDATE tbl_quotation_details set audit_unit_price =   $audit_uPrice[$i] ,  audit_total_amount =$audit_tPrice[$i], updated_by = 1 , updated_date = $Date Where id= $quoteDetailsIds[$i]";
                        $query = $conn->query($sql2);
                    } else {
                        $sql3 = "INSERT INTO tbl_quotation_details (tbl_quotation_id, tbl_token_requisition_id, Product_name, qty, unit, quotation_group_name, unit_price,total_amount, wing_head_unit_price,  wing_head_total_amount , audit_unit_price,  audit_total_amount , created_by, created_date ) 
                        VALUES( '$quotation_id', '$requisitionIds[$i]', '$productsArr[$i]', '$qty[$i]', '$units[$i]', '$group[$i]', '$unitPrice[$i]', '$totalPrice[$i]', '$unitPrice[$i]', '$totalPrice[$i]', '$unitPrice[$i]','$totalPrice[$i]', '$loginID', '$Date' )";
                        $query = $conn->query($sql3);
                    }
                }
                $conn->commit();
                $data = ['msg' => 'success', 'tokenId' => $tokenId, 'quotationId' => $quotation_id];
                echo json_encode($data, JSON_UNESCAPED_SLASHES);

            } else {
                $conn->rollback();
                echo json_encode($conn->error . $sql);
            }
        } catch (FFI\Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
        $conn->close();
    } else if ($_POST["Action"] == "deleteQuotation") {

        $id = $_POST["id"];
        $token_id = $_POST["token_id"];
        $sql = "UPDATE  tbl_quotation set deleted = 'Yes'
                where tbl_quotation.id = $id";
        $query = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $sql = "UPDATE  tbl_quotation_details set deleted = 'Yes'
            where tbl_quotation_details.tbl_quotation_id = $id";
            $query = $conn->query($sql);
            if ($query) {
                $sql = "UPDATE tbl_token set status  = 'Cancel'  Where id = $token_id AND deleted = 'No'";
                $query = $conn->query($sql);
                echo json_encode('success');
            } else {
                echo json_encode($conn->error . $sql);
            }
        } else {
            echo json_encode($conn->error . $sql);
        }

    } else if ($_POST["Action"] == "checkAppovalStatus") {

        $id = $_POST["id"];
        $token_id = $_POST["token_id"];
        $userType = $_POST["userType"];
        $sql = "SELECT  auditor_approverd_date,auditor_approval_status, mngmnt_approved_date, md_approved_date ,md_approval_status,pr_generate_date ,mngmnt_approval_status, ed_approved_date,auditor_rejected_date, mngmnt_rejected_date, md_rejected_date, ed_rejected_date FROM tbl_quotation Where id = $id AND deleted = 'No'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        $auditor_approved_date = $row['auditor_approverd_date'];
        $auditor_rejected_date = $row['auditor_rejected_date'];
        $auditor_approval_status = $row['auditor_approval_status'];

        $mngmnt_approved_date = $row['mngmnt_approved_date'];
        $mngmnt_rejected_date = $row['mngmnt_rejected_date'];
        $mngmnt_approval_status = $row['mngmnt_approval_status'];

        $md_approved_date = $row['md_approved_date'];
        $md_rejected_date = $row['md_rejected_date'];
        $md_approval_status = $row['md_approval_status'];

        $pr_generate_date = $row['pr_generate_date'];

        $ed_approved_date = $row['ed_approved_date'];
        $ed_rejected_date = $row['ed_rejected_date'];



        if ($userType == "auditor") {
            if ($auditor_approved_date != '') {
                echo json_encode('have_approval');
            } else {
                echo json_encode('dont_have_approval');
            }
        }

        if ($userType == "mngmnt") {
            if ($auditor_approval_status == '') {
                echo json_encode('revious_step_not_approved');
            } else {
                if ($mngmnt_approved_date != '' || $mngmnt_rejected_date != '') {
                    echo json_encode('have_approval');
                } else {
                    echo json_encode('dont_have_approval');
                }
            }

        }

        if ($userType == "md") {
            if ($mngmnt_approval_status == '') {
                echo json_encode('revious_step_not_approved');
            } else {
                if ($md_approved_date != '' | $md_rejected_date != '') {
                    echo json_encode('have_approval');
                } else {
                    echo json_encode('dont_have_approval');
                }
            }
        }

        if ($userType == "ed") {
            if ($pr_generate_date == '') {
                echo json_encode('revious_step_not_approved');
            } else {
                if ($ed_approved_date != '' || $ed_rejected_date != '') {
                    echo json_encode('have_approval');
                } else {
                    echo json_encode('dont_have_approval');
                }
            }
        }




    } else if ($_POST["Action"] == "approval") {

        $tokenId = $_POST["token_id_for_approval"];
        $quote_id = $_POST["id"];
        $approvalDate = $_POST["approvalDate"];
        $comment = $_POST["comment"];
        $userType = $_POST["userType"];
        $approvalStatus = $_POST["approvalStatus"];

        $sql1 = "UPDATE tbl_token SET  department_status = 'Management' WHERE tbl_token.id = $tokenId";
        $query = $conn->query($sql1);

        if ($userType == "mngmnt") {

            if ($approvalStatus == 'Yes') {
                $approvalChain = 'Management (approved)';

                $sql = "UPDATE  tbl_quotation set mngmnt_approval_status ='$approvalStatus', mngmnt_approved_date = '$approvalDate', mngmnt_comments = '$comment'  , quotation_status='Management Approved'    
                where tbl_quotation.id = $quote_id";
            } else {
                $approvalChain = 'Management(not approved)';
                $sql = "UPDATE  tbl_quotation set mngmnt_approval_status ='$approvalStatus', mngmnt_rejected_date = '$approvalDate', mngmnt_comments = '$comment'  , quotation_status='Management Not Approved'    
                where tbl_quotation.id = $quote_id";
            }
            $sql02 = "INSERT INTO quotation_log (step, step_head, token_id, remarks, token_status,department, created_by, created_date ) 
            VALUES( '5', 'Management','$tokenId','Management Approval<br>Approval Chain<br> $approvalChain ','Running','Management','$loginID','$Date')";
            $query02 = $conn->query($sql02);

        } else if ($userType == "md") {

            if ($approvalStatus == 'Yes') {
                $approvalChain = 'MD (approved)';
                $sql = "UPDATE  tbl_quotation set md_approval_status ='$approvalStatus', md_approved_date = '$approvalDate', md_comments = '$comment', quotation_status='MD Approved'  
                where tbl_quotation.id = $quote_id";
            } else {
                $approvalChain = 'MD (not approved)';
                $sql = "UPDATE  tbl_quotation set md_approval_status ='$approvalStatus', md_rejected_date = '$approvalDate', md_comments = '$comment', quotation_status='MD Not Approved'  
                where tbl_quotation.id = $quote_id";
            }
            $sql02 = "UPDATE quotation_log set  remarks = 'Management Approval<br>Approval Chain<br> Manager -> $approvalChain' WHERE step = '5'  AND token_id = $tokenId AND deleted = 'No'";
            $query02 = $conn->query($sql02);

        } else if ($userType == "ed") {
            $imageFileType = '';
            $path = '';
            $target_dir = "../images/quotation/";
            if (isset($_FILES["file"]["name"])) {
                if ($_FILES["file"]["name"] != '') {
                    $base = basename($_FILES["file"]["name"]);
                    $target_dir = "../../images/quotation/";
                    $target_file = $target_dir . '_' . basename(str_replace(' ', '_', $_FILES["file"]["name"]));
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                    $path = str_replace(' ', '_', '_' . $_FILES["file"]["name"]);
                } else {
                    $target_file = '';
                }
            }

            if ($approvalStatus == 'Yes') {
                $approvalChain = 'ED (approved)';
                $sql = "UPDATE  tbl_quotation set ed_approval_status ='$approvalStatus', ed_approved_date = '$approvalDate', ed_comments = '$comment', quotation_status='ED Approved'  , ed_uplead_file ='$path'    
                where tbl_quotation.id = $quote_id";
            } else {
                $approvalChain = 'ED (not approved)';
                $sql = "UPDATE  tbl_quotation set  ed_approval_status ='$approvalStatus', ed_rejected_date = '$approvalDate', ed_comments = '$comment', quotation_status='ED Not Approved'     
                where tbl_quotation.id = $quote_id";
            }
            $sql02 = "UPDATE quotation_log set  remarks = 'Management Approval<br>Approval Chain<br> Management -> PR Generated -> Ed' WHERE step = '5'  AND token_id = $tokenId AND deleted = 'No'";
            $query02 = $conn->query($sql02);

        } else {

            if ($approvalStatus == 'Yes') {
                $approvalChain = 'Auditor (approved)';
                $sql = "UPDATE  tbl_quotation set auditor_approval_status ='$approvalStatus', auditor_approverd_date = '$approvalDate', auditor_comments = '$comment'  , quotation_status='Auditor Approved'   
                where tbl_quotation.id = $quote_id";
            } else {
                $approvalChain = 'Auditor (not approved)';
                $sql = "UPDATE  tbl_quotation set auditor_approval_status ='$approvalStatus', auditor_rejected_date = '$approvalDate', auditor_comments = '$comment'  , quotation_status='Auditor Not Approved'   
                where tbl_quotation.id = $quote_id";
            }
            $sql02 = "UPDATE quotation_log set  remarks = 'Approved And edited by Wing Head.<br>Appoval Chain<br> $approvalChain <br>Comment: $comment' WHERE step = '4'  AND token_id = $tokenId AND deleted = 'No'";
            $query02 = $conn->query($sql02);

        }

        $query = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            echo 'success';
        } else {
            echo json_encode($conn->error . $sql);
        }
    } else if ($_POST["Action"] == "getPrInfo") {

        $id = $_POST["id"];
        $token_id = $_POST["token_id"];
        $sql = "SELECT pr_generate_date, mngmnt_approved_date FROM tbl_quotation Where id = $id AND deleted = 'No'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        if ($row['mngmnt_approved_date'] == '') {
            echo json_encode('mngmnt_not_approverd');
        } else {
            if ($row['pr_generate_date'] != '') {
                echo json_encode('have_pr');
            } else {
                echo json_encode('dont_have_pr');
            }
        }
    } else if ($_POST["Action"] == "poApprovalGet") {

        $id = $_POST["id"];
        $token_id = $_POST["token_id"];
        $sql = "SELECT po_date, ed_approved_date, ed_approval_status FROM tbl_quotation Where id = $id AND deleted = 'No'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        if ($row['ed_approval_status'] == '') {
            echo json_encode('ed_not_approved');
        } else {
            if ($row['po_date'] != '') {
                echo json_encode('have_po');
            } else {
                echo json_encode('dont_have_po');
            }
        }

    } else if ($_POST["Action"] == "setPrGenerateDate") {

        $id = $_POST["id"];
        $token_id = $_POST["token_id"];
        $toquote_id_fr_po = $_POST["id"];
        $pr_date = $_POST["pr_date"];
        $sql = "UPDATE tbl_quotation set pr_generate_date  = '$pr_date' , pr_generated_by = '$loginID', updated_by = '$loginID' , quotation_status='PR Generated'   Where id = $id AND deleted = 'No'";
        $query = $conn->query($sql);
        if ($query) {

            $sql1 = "UPDATE tbl_token SET  department_status = 'Management' , quotation_status ='PR Generated'  WHERE tbl_token.id = $token_id";
            $query01 = $conn->query($sql1);
            if ($query01) {
                $sql02 = "UPDATE quotation_log set  remarks = 'Management Approval<br>Approval Chain<br> Management -> PR Generated' WHERE step = '5'  AND token_id = $token_id AND deleted = 'No'";
                $query02 = $conn->query($sql02);
                if ($query02) {
                    echo json_encode('success');
                } else {
                    echo json_encode($conn->error . $sql1);
                }
            } else {
                echo json_encode($conn->error . $sql1);
            }


        } else {
            echo json_encode($conn->error . $sql1);
        }
    } else if ($_POST["Action"] == "setPoApprovalDate") {

        $id = $_POST["id"];
        $token_id = $_POST["token_id"];
        $toquote_id_fr_po = $_POST["id"];
        $po_date = $_POST["po_date"];
        $sql = "UPDATE tbl_quotation set po_date  = '$po_date' , updated_by = '$loginID' , quotation_status='PO Generated'   Where id = $id AND deleted = 'No'";
        $query = $conn->query($sql);
        if ($query) {
            $sql02 = "INSERT INTO quotation_log (step, step_head, token_id, remarks, token_status,department, created_by, created_date ) 
                     VALUES( '6', 'Procurement','$token_id','Generated PO to lowest bidder','Running','Procurement','$loginID','$Date')";
            $query02 = $conn->query($sql02);

            $sql1 = "UPDATE tbl_token SET  department_status = 'Procurement (PO)' , quotation_status='PO Generated'   WHERE tbl_token.id = '.$token_id.'";
            $query = $conn->query($sql1);

            echo json_encode('success');
        } else {
            echo json_encode($conn->error . $sql1);
        }
    } else if ($_POST["Action"] == "productsAsPerPo") {
        $id = $_POST["id"];
        $token_id = $_POST["token_id"];
        $sql = "SELECT store_approved_date, po_date from tbl_quotation where deleted = 'No'  AND tbl_quotation.id = $id Limit 1";
        $query = $conn->query($sql);
        $data = $query->fetch_assoc();
        $date = $data['store_approved_date'];
        $po_date = $data['po_date'];
        $status = '';
        if ($po_date == '') {
            $status = 'po_not_generated';
        } else {
            $status = 'po_generated';
        }
        $products = [];

        $sql = "SELECT * from tbl_quotation_details where deleted = 'No' AND tbl_quotation_details.tbl_quotation_id = $id  ORDER BY id desc";
        $query = $conn->query($sql);

        if ($query) {
            while ($row = $query->fetch_assoc()) {
                array_push($products, $row);
            }
            echo json_encode(['products' => $products, 'date' => $date, 'msg' => 'success', 'status' => $status]);
        } else {
            echo json_encode($conn->error . $sql);
        }
    } else if ($_POST["Action"] == "setStoreApprovalInfo") {

        $quoteId = $_POST["quoteId"];
        $tokenId = $_POST["tokenId"];
        $store_date = $_POST["store_date"];
        $store_comment = $_POST["storeComment"];
        $quoteDetailsId = explode(",", $_POST["quoteDetailsId"]);

        $sql = "UPDATE tbl_quotation set store_approved_date  = '$store_date' , store_approval_comment = '$store_comment' , quotation_status='Store Approved' ,    store_approved_by  = '$loginID'  Where tbl_quotation.id =  $quoteId  AND tbl_quotation.deleted = 'No'";
        $query = $conn->query($sql);

        $sql02 = "INSERT INTO quotation_log (step, step_head, token_id, remarks, token_status,department, created_by, created_date ) 
        VALUES( '7', 'Store','$tokenId','Receive Products as per PO','Running','Store','$loginID','$Date')";
        $query = $conn->query($sql02);

        $sql1 = "UPDATE tbl_token SET  department_status = 'Store'  , quotation_status='Store Approved' WHERE tbl_token.id = $tokenId";
        $query = $conn->query($sql1);

        if ($query) {
            for ($i = 0; $i < count($quoteDetailsId); $i++) {
                $sql = "UPDATE tbl_quotation_details set store_appproved_status  = 'Yes', updated_by = '$loginID' Where tbl_quotation_details.tbl_quotation_id = $quoteId AND tbl_quotation_details.id = $quoteDetailsId[$i]  AND deleted = 'No'";
                $query = $conn->query($sql);
            }


            if ($i > 0) {

                echo 'success';
            } else {
                echo json_encode($conn->error . $sql);
            }
        } else {
            echo json_encode($conn->error . $sql);
        }

    } else if ($_POST["Action"] == "productsAsPerStore") {

        $id = $_POST["id"];
        $token_id = $_POST["token_id"];

        $products = [];

        $sql = "SELECT fnl_procurement_approval_date ,store_approval_comment, store_approved_date from tbl_quotation where deleted = 'No'  AND tbl_quotation.id = $id Limit 1";
        $query = $conn->query($sql);
        $data = $query->fetch_assoc();
        $date = $data['fnl_procurement_approval_date'];
        $storeComment = $data['store_approval_comment'];
        $storeApprovedDate = $data['store_approved_date'];
        $status = '';
        if ($storeApprovedDate == '') {
            $status = 'store_not_accepted';
        } else {
            $status = 'store_accepted';
        }
        $sql = "SELECT * from tbl_quotation_details where deleted = 'No' AND store_appproved_status = 'Yes' AND tbl_quotation_details.tbl_quotation_id = $id  ORDER BY id desc";
        $query = $conn->query($sql);

        if ($query) {
            while ($row = $query->fetch_assoc()) {
                array_push($products, $row);
            }
            echo json_encode(['products' => $products, 'date' => $date, 'storeComment' => $storeComment, 'msg' => 'success', 'status' => $status]);
        } else {
            echo json_encode($conn->error . $sql);
        }
    } else if ($_POST["Action"] == "finalConfirmation") {

        $quoteId = $_POST["quoteId"];
        $tokenId = $_POST["tokenId"];
        $finalConfirmDate = $_POST["final_confirm_date"];
        $procurementComment = $_POST["procurement_comment"];

        $sql = "UPDATE tbl_token set status = 'Job Completed'  , quotation_status='Job Completed'  Where id = $tokenId AND deleted = 'No'";
        $query = $conn->query($sql);

        if ($query) {
            $sql = "UPDATE tbl_quotation set fnl_procurement_approval_date  = '$finalConfirmDate' , fnl_procurement_approval_comment = '$procurementComment' , quotation_status= 'Job Completed' ,  fnl_procurement_approve_by  = '$loginID' , is_accepted = '1' Where tbl_quotation.id = '$quoteId'  AND tbl_quotation.deleted = 'No'";
            $query = $conn->query($sql);

            if ($query) {

                $sql02 = "INSERT INTO quotation_log (step, step_head, token_id, remarks, token_status,department, created_by, created_date ) 
                VALUES( '8', 'Procurement','$tokenId','Physically Verified the receiving Goods and approved.','Job Completed','Procurement','$loginID','$Date')";
                $query02 = $conn->query($sql02);
                echo json_encode(['msg' => 'success']);
            } else {
                echo json_encode($conn->error . $sql);
            }
        } else {
            echo json_encode($conn->error . $sql);
        }
    } else if ($_POST["Action"] == "typeWiseVendor") {

        $vendorType = $_POST["vendorType"];

        $sql = "SELECT id, partyName from tbl_party where vendor_type = '$vendorType' AND deleted = 'No'";
        $query = $conn->query($sql);
        $vendors = [];

        if ($query) {
            while ($row = $query->fetch_assoc()) {
                array_push($vendors, $row);
            }
            echo json_encode(['vendors' => $vendors, 'msg' => 'success']);
        } else {
            echo json_encode($conn->error . $sql);
        }
    } else if ($_POST["Action"] == "setLowerBidder") {

        $token_id = $_POST["token_id"] > 0 || $_POST["token_id"] != '' || $_POST["token_id"] != null || $_POST["token_id"] != 'undefined' ? $_POST["token_id"] : 0;
        if ($token_id > 0) {
            $sql0 = "SELECT *
                        FROM tbl_quotation
                        INNER JOIN tbl_token on tbl_quotation.tbl_token_id = tbl_token.id
                        WHERE tbl_token.id =  $token_id AND tbl_quotation.deleted = 'No'";
            $query0 = $conn->query($sql0);

            if ($query0) {
                $rowsNum = $query0->num_rows;
                $flag = 0;
                if ($rowsNum < 3) {
                    echo json_encode(['code'=>204,'msg' => 'Get at least 3 quotation']);
                } else {
                    $audit_total =[];
                
                    while ($row0 = $query0->fetch_assoc()) {
                        array_push($audit_total, $row0['audit_grand_total']);
                        if ($row0['audit_grand_total'] == null || $row0['audit_grand_total'] == '') {
                            $flag++;
                        }
                    }
                    if ($flag > 0) {
                        echo json_encode(['code'=>203,'msg' => 'Audit price not set for all quotation.']);
                    } else {

                        $data = array();
                        $sql = "SELECT MAX(dbt.group_total) AS total, dbt.quotation_group_name, dbt.supplier_id FROM(
                                SELECT SUM(tbl_quotation_details.total_amount) as group_total, tbl_quotation.supplier_id, tbl_quotation_details.quotation_group_name
                                FROM tbl_quotation_details
                                INNER JOIN tbl_quotation ON tbl_quotation_details.tbl_quotation_id = tbl_quotation.id
                                INNER JOIN tbl_token_requisition ON tbl_token_requisition.id = tbl_quotation_details.tbl_token_requisition_id
                                WHERE tbl_token_requisition.tbl_token_id = $token_id AND tbl_token_requisition.deleted = 'No' AND tbl_quotation_details.deleted = 'No'
                                GROUP BY tbl_quotation.supplier_id, tbl_quotation_details.quotation_group_name ORDER BY tbl_quotation_details.quotation_group_name,group_total desc) as dbt
                                GROUP BY dbt.quotation_group_name;";
                        $query = $conn->query($sql);

                        if ($query) {
                            $i = 1;
                            while ($row = $query->fetch_assoc()) {
                                $data['group_' . $i] = $row['quotation_group_name'];
                                $data['lower_amount_' . $i] = $row['total'];
                                $data['supplier_' . $i] = $row['supplier_id'];
                                $i++;
                            }
                            if ($i < 3) {
                                echo json_encode(['code'=>202,'msg' => 'All Group Not Added.']);
                            } else {
                                $sql1 ="SELECT tbl_lower_bidder_info.*, supplier_1.partyName as supplier_1,supplier_2.partyName as supplier_2,supplier_3.partyName as supplier_3 from tbl_lower_bidder_info
                                            left join tbl_party as supplier_1 on tbl_lower_bidder_info.supplier_1 = supplier_1.id
                                            left join tbl_party as supplier_2 on tbl_lower_bidder_info.supplier_2 = supplier_2.id
                                            left join tbl_party as supplier_3 on tbl_lower_bidder_info.supplier_3 = supplier_3.id
                                            where token_id = $token_id";
                                $query1 = $conn->query($sql1);
                                $rowNum = $query1->num_rows;
                                if ($rowNum > 0) {
                                    $row1 = $query1->fetch_assoc();
                                    echo json_encode(['code'=>201,'msg' => 'exist', 'data' => $row1]);
                                } else {
                                    $sql02 = "INSERT INTO tbl_lower_bidder_info (token_id, group_1, lower_amount_1,supplier_1, group_2, lower_amount_2,supplier_2, group_3, lower_amount_3,supplier_3, created_by, created_at ) 
                                    VALUES( '$token_id',' " . $data['group_1'] . "', '" . $data['lower_amount_1'] . "', '" . $data['supplier_1'] . "','" . $data['group_2'] . "','" . $data['lower_amount_2'] . "', '" . $data['supplier_2'] . "','" . $data['group_3'] . "','" . $data['lower_amount_2'] . "', '" . $data['supplier_3'] . "','$loginID','$Date')";
                                    $query02 = $conn->query($sql02);
                                    $sql3 = "SELECT * from tbl_lower_bidder_info where token_id = $token_id";
                                    $query3 = $conn->query($sql3);
                                    if ($query02) {
                                        $row3 = $query3->fetch_assoc();
                                        echo json_encode(['code'=>200,'msg' => 'success', 'data' => $row3]);
                                    } else {
                                        echo json_encode(['code'=>404,'msg' => 'Error :' . $conn->error]);
                                    }
                                }
                            }


                        } else {
                            echo json_encode($conn->error . $sql);
                        }
                    }
                }
            }

        } else {
            echo json_encode(['msg' => 'Service ID not Found!']);
        }


    }
} else {
    $getId = $_GET['id'];

    $i = 1;
    $output = array('data' => array());
    $lowest = 0;
    $po_date = '';
    $sql1 = "SELECT MIN(tbl_quotation.audit_grand_total) as total, po_date as poDate FROM `tbl_quotation` 
             JOIN tbl_token on tbl_quotation.tbl_token_id = tbl_token.id
             WHERE tbl_quotation.deleted = 'No' and tbl_token.id = $getId  LIMIT 1";
    $query0 = $conn->query($sql1);
    $result = $query0->fetch_assoc();
    $lowest = $result['total'];
    $po_date = $result['poDate'];

    $sql = "SELECT tbl_quotation.*, tbl_token.token_title ,tbl_token.id  as token_id , tbl_party.partyName,tbl_party.partyAddress,tbl_party.partyPhone FROM `tbl_quotation` 
    JOIN tbl_token on tbl_quotation.tbl_token_id = tbl_token.id
    LEFT JOIN tbl_party on tbl_quotation.supplier_id = tbl_party.id
    WHERE tbl_quotation.deleted = 'No' and tbl_token.id = $getId ORDER BY tbl_quotation.id  DESC";
    $query = $conn->query($sql);

    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $auditGrand_total = $row['audit_grand_total'];
        $po_date = $row['po_date'];
        $bg_color = '';
        $approvalButtons = '';
        $billButtons = '';
        if ($row['ed_uplead_file'] != '') {
            $filePD = $row['ed_uplead_file'];
            $filePDF = '<a href="../images/quotation/' . $filePD . '" target="_blank">ED Uploaded PDF</a>';
        } else {
            $filePDF = '';
        }

        if ($lowest > 0) {
            if ($lowest == $auditGrand_total) {
                $bg_color = 'color: green';
                $approvalButtons = ' <li><a onclick="confirmApproval(' . $id . ',' . $row['token_id'] . ',\'auditor\')"><i class="fa fa-edit"></i> Auditor Vetting</a></li>

                <li><a onclick="confirmApproval(' . $id . ',' . $row['token_id'] . ',\'mngmnt\')"><i class="fa fa-edit"></i> Management Vetting</a></li>
                <li><a onclick="prGenerate(' . $id . ',' . $row['token_id'] . ')"><i class="fa fa-edit"></i> PR Generate</a></li>
                <li><a onclick="confirmApproval(' . $id . ',' . $row['token_id'] . ',\'ed\')"><i class="fa fa-edit"></i> Management Approval</a></li>
                <li><a onclick="poApproval(' . $id . ',' . $row['token_id'] . ')"><i class="fa fa-edit"></i> PO Approval</a></li>
                <li><a onclick="storeDeprt(' . $id . ',' . $row['token_id'] . ')"><i class="fa fa-edit"></i> Store Deprt</a></li>
                <li><a onclick="confirmProcurement(' . $id . ',' . $row['token_id'] . ')"><i class="fa fa-edit"></i> Final Approval</a></li>';
            } else {
                $bg_color = '';
                $approvalButtons = '';
            }
        }
        if ($po_date != '') {
            $billButtons .= '<li><a href="quatationDetails.php?id=' . $row['token_id'] . '&quote_id=' . $id . '"  target="_blank"><i class="fa fa-edit"></i> Challan Bill</a></li>';
        } else {
            $billButtons = '';
        }
        $partyName = $row['partyName'] . '<br>Contact : ' . $row['partyPhone'] . '<br>Address : ' . $row['partyAddress'];

        $id = $row['id'];
        $products = '';
        $sql2 = "SELECT tbl_quotation_details.Product_name, quotation_group_name FROM `tbl_quotation_details`
                WHERE tbl_quotation_details.tbl_quotation_id =  $id AND tbl_quotation_details.deleted ='No'";
        $query2 = $conn->query($sql2);
        $products .= '<table>';
        while ($row2 = $query2->fetch_assoc()) {
            $products .= '<tr><td>' . $row2['Product_name'] . ' </td><td> <small> ( ' . $row2['quotation_group_name'] . ')</small></td></tr>';
        }
        $products .= '</table>';
        $query1 = $conn->query($sql2);

        $quote_status = '<span class="label label-default">' . $row['quotation_status'] . '</span>';

        $button = '<div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-gear tiny-icon"></i>  <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                            <li><a href="addQuotationView.php?Token_id=' . $row['token_id'] . '&id=' . $row['id'] . '&type=wing_head" ><i class="fa fa-edit"></i> Wing Head Quotation</a></li>
                            <li><a href="addQuotationView.php?Token_id=' . $row['token_id'] . '&id=' . $row['id'] . '&type=audit" ><i class="fa fa-edit"></i> Audit Quotation</a></li>
                            <li><a href="quotationDetailReport.php?id=' . $row['token_id'] . '&quotationId=' . $id . '"  target="_blank"><i class="fa fa-file-pdf-o"></i> View Details</a></li>
                            ' . $approvalButtons . '
                            ' . $billButtons . '
                            <li><a href="#" onclick="confirmDelete(' . $id . ',' . $row['token_id'] . ')"><i class="fa fa-trash"></i> Delete</a></li>
                        </ul>
                    </div>';
        $output['data'][] = array(
            '<b style="' . $bg_color . '">' . $i++ . '</b>',
            '<b style="' . $bg_color . '">' . $row['quote_date'] . '</b>',
            '<b style="' . $bg_color . '">' . $partyName . '</b>',
            '<b style="' . $bg_color . '">' . $row['token_title'] . '</b>',
            '<b style="' . $bg_color . '">' . $products . '</b>',
            '<b style="' . $bg_color . '">Quote : ' . $row['grand_total'] . '<br>WingH : ' . $row['wing_head_grand_total'] . '<br>Audit : ' . $row['audit_grand_total'] . '</b>',
            '<b style="' . $bg_color . '">' . $quote_status . '</b>' . '<br>' . $filePDF,
            $button
        );
    }
    echo json_encode($output);
}

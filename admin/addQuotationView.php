<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<style>
    .select-group input.form-control {
        width: 65%
    }

    .select-group select.input-group-addon {
        width: 35%;
    }
</style>
<link rel="stylesheet" href="select2/select2.min.css" />

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>


        <div class="content-wrapper">

            <section class="content-header">
                <h1>Add Quotation</h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Add Quotation</li>
                </ol>
            </section>

            <section class="content">

                <link rel="stylesheet" href="buttons.dataTables.min.css" />
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="col-xs-6">
                                <div id='divMsg' class='alert alert-success alert-dismissible successMessage'>
                                </div>
                                <div id='divErrorMsg' class='alert alert-danger alert-dismissible errorMessage'>
                                </div>
                            </div>
                            <div class="box-header with-border">


                                <a onclick="history.back()" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fa fa-reply" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="box-body">
                                <div class="form-group ">
                                    <?php
                                    if (isset($_GET['Token_id'])) {

                                        //$quotation_id = $_GET['id'];
                                        $id = $_GET['Token_id'];
                                        $status = '';
                                        $button = '';
                                        $sql = "SELECT * FROM `tbl_token` WHERE id = $id ";
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        $token = $row['token_title'];

                                        $sql = "SELECT id  FROM   tbl_lower_bidder_info   
                                        WHERE tbl_lower_bidder_info.token_id = " . $id . " AND  tbl_lower_bidder_info.deleted = 'No' LIMIT 1";
                                        $query = $conn->query($sql);

                                        if ($query) {
                                            if ($query->num_rows > 0) {
                                                $status = 'Audit Already set price for final bidding.';
                                                $button = 'Disabled';
                                            }
                                        }

                                        $sql = "SELECT tbl_token.*,vehicle_master.vehicle_number,vehicle_master.employee_name, m.firstname m_name, e.firstname e_name FROM `tbl_token`
												left outer join vehicle_master  on tbl_token.vehicle_id = vehicle_master.id
												inner join admin as e on tbl_token.engineer_id = e.id
												left outer join admin as m on tbl_token.mechanic_id = m.id
												where tbl_token.deleted = 'No'  AND tbl_token.id = $id ORDER BY id  DESC";
                                        $query = $conn->query($sql);
                                        $row = $query->fetch_assoc();
                                        $tokenNo = $row['token_no'];
                                        $vehicle_number = $row['vehicle_number'];
                                        $employee_name = $row['employee_name'];
                                        $tokenDate = $row['token_date'];
                                        $engineerName = $row['e_name'];
                                        $problem = $row['problems'];
                                        //$str="Service No: $tokenNo \nService Date:  $tokenDate \nEngineer Name: $engineerName \nProblem Definition: $problem ";
                                        ?>
                                        <div class="row ">
                                            <div class="  col-md-4">
                                                <label for="">Demand No | Vehicle No</label>
                                                <input type="text" class="form-control"
                                                    value="<?= $tokenNo ?> | (<?= $vehicle_number ?> : <?= $employee_name ?>)"
                                                    disabled>
                                            </div>
                                            <div class=" col-md-4">
                                                <label for="">Demand Date</label>
                                                <input type="text" class="form-control" value="<?= $tokenDate ?>" readonly>
                                            </div>
                                            <div class=" col-md-4">
                                                <label for="">Engineer Name</label>
                                                <input type="text" class="form-control" value="<?= $engineerName ?>"
                                                    readonly>
                                            </div>

                                            <div class=" col-md-12">
                                                <label for="">Problem Definition</label>
                                                <textarea class="form-control" cols="10" readonly><?= $problem ?></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php
                                    }
                                    ?>

                                </div>


                                <div class="form-group ">
                                    <div class="col-sm-12 mb-1">
                                        <input type="hidden" id="tokenId" value="<?= $id ?>">
                                        <label class="">Service Remarks <span class="text-danger">*</span></label>
                                        <input type="text" id="tokenTitle" class="form-control" name="tokenTitle"
                                            placeholder=" Token Title " value="<?= $token ?>" disabled>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="">Quotation Date<span class="text-danger">*</span></label>
                                        <input type="date" id="quotationDate" class="form-control" name="quotationDate"
                                            value="<?= date('Y-m-d') ?>" placeholder=" Quotation Date ">
                                        <span id="quotationDateError"></span>
                                    </div>

                                    <?php
                                    if (isset($_GET['type'])) {
                                        if ($_GET['type'] == 'procurement') {
                                            ?>
                                            <div class="col-sm-4">
                                                <label class="">Vendor type<span class="text-danger">*</span></label>
                                                <select id="vendor_type" class="form-control" name="vendor_type"
                                                    onchange="typeWiseVendor()" placeholder="Vandor Type ">
                                                    <option value=''>Select Vendor type</option>
                                                    <option value='Passenger'>Passenger</option>
                                                    <option value='Commercial'>Commercial</option>

                                                </select>
                                                <span id="supplierError"></span>
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="">Vendor<span class="text-danger">*</span></label>
                                                <select type="date" id="supplier" class="form-control" name="supplier"
                                                    placeholder="Vandor ">
                                                    <option value=''>Select Vandor</option>

                                                </select>
                                                <span id="supplierError"></span>
                                            </div>

                                        <?php } else {

                                            $quotation_id = $_GET['id'];

                                            $sql = "SELECT supplier_id  FROM   tbl_quotation   
                                                     WHERE tbl_quotation.id = " . $quotation_id . " AND  tbl_quotation.deleted = 'No' LIMIT 1";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            $supplier_id = $row['supplier_id'];



                                            ?>
                                            <div class="col-sm-4">
                                                <label class="">Vendor<span class="text-danger">*</span></label>
                                                <select type="date" id="supplier" class="form-control" name="supplier" value="<?= $supplier_id ? $supplier_id:'' ?>"
                                                    placeholder="Select Vandor " disabled>
                                                    <?php
                                                        $sql = "SELECT tbl_quotation.is_vendor_workshop from tbl_quotation where id = $quotation_id";
                                                        $result = $conn->query($sql);
                                                        if ($result) {
                                                            $row = $result->fetch_assoc();
    
                                                            $vendor_workshop = $row['is_vendor_workshop'];
                            
                                                            if($vendor_workshop == 0){
                                                                $sql = "SELECT * from tbl_party where deleted = 'No' ORDER BY id desc";
                                                                $result = $conn->query($sql);
                                                                echo "<option value=''>Select Vandor</option>";
                                                                if ($result) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        if ($row['id'] == $supplier_id) {
                                                                            echo "<option value='" . $row['id'] . "' selected>" . $row['partyName'] . "</option>";
                                                                        } else {
                                                                            echo "<option value='" . $row['id'] . "'>" . $row['partyName'] . "</option>";
                                                                        }
                                                                    }
                                                                }
                                                            }else{
                                                                $sql = "SELECT id, wareHouseName from  tbl_warehouse where deleted = 'No' ORDER BY id desc";
                                                                $result = $conn->query($sql);
                                                                echo "<option value=''>Select Vandor</option>";
                                                                if ($result) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        if ($row['id'] == $supplier_id) {
                                                                            echo "<option value='" . $row['id'] . "' selected>" . $row['wareHouseName'] . "</option>";
                                                                        } else {
                                                                            echo "<option value='" . $row['id'] . "'>" . $row['wareHouseName'] . "</option>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                   

                                                    ?>
                                                </select>
                                                <span id="supplierError"></span>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <div class="col-sm-4">
                                        <label class="">Pdf File<span class="text-danger"></span></label>
                                        <input type="file" id="qutation_file" class="form-control" name="qutation_file">
                                        <span id="qutation_fileError"></span>
                                    </div>
                                </div>

                                <hr>
                                <?php
                                if (isset($_GET['type'])) {
                                    if ($_GET['type'] == 'wing_head') { ?>
                                        <div class="col-sm-4">
                                            <label class="">Wing head Approval Date<span class="text-danger">*</span></label>
                                            <input type="date" id="wing_head_approval_date" class="form-control"
                                                name="wing_head_approval_date" value="<?= date('Y-m-d') ?>"
                                                placeholder=" Wing head Approval Date ">
                                            <span id="wing_head_approval_dateError"></span>
                                        </div>
                                        <div class="col-sm-8">
                                            <label class="">Wing head Comment<span class="text-danger">*</span></label>
                                            <textarea id="wing_head_comment" class="form-control" name="wing_head_comment"
                                                placeholder=" Wing head Comment "></textarea>
                                            <span id="wing_head_commentError"></span>
                                        </div> <br> <br> <br> <br> <br>
                                    <?php } else if ($_GET['type'] == 'audit') { ?>
                                            <div class="col-sm-4">
                                                <label class="">Audit Approval Date<span class="text-danger">*</span></label>
                                                <input type="date" id="audit_approval_date" class="form-control"
                                                    name="audit_approval_date" value="<?= date('Y-m-d') ?>"
                                                    placeholder=" QuotAudit Approvalation Date ">
                                                <span id="audit_approval_dateError"></span>
                                            </div>
                                            <div class="col-sm-8">
                                                <label class="">Audit Comment<span class="text-danger">*</span></label>
                                                <textarea id="audit_comment" class="form-control" name="audit_comment"
                                                    placeholder=" Audit Comment "></textarea>
                                                <span id="audit_commentError"></span>
                                            </div> <br> <br> <br> <br> <br>
                                        <?php
                                    }
                                }
                                ?>

                                <div class=" form-group col-md-12 mt-4"><br>
                                    <table id="" class="table table-bordered">
                                        <thead class="bg-primary">
                                            <th width="2%">Id</th>
                                            <th width="30%">Product Name</th>
                                            <th width="5%">Specification</th>
                                            <th width="5%">Qty</th>
                                            <th width="5%">Unit</th>
                                            <th width="12%">Group</th>

                                            <?php
                                            if (isset($_GET['type'])) {
                                                if ($_GET['type'] == 'wing_head') {
                                                    echo '<th>Wing Head Unit </th>
                                                         <th>Wing Head Total </th>';
                                                } else if ($_GET['type'] == 'audit') {
                                                    echo '<th>Audit Unit price</th>
                                                         <th>Audit Total </th>';
                                                } else {
                                                    echo " <th>Unit price</th>
                                                    <th>Total Amount</th>";
                                                }
                                            }
                                            ?>
                                            <th>Active</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_GET['Token_id'])) {
                                                $token_id = $_GET['Token_id'];
                                                $data = '';
                                                if ($_GET['type'] == 'procurement') {
                                                    $sql = 'SELECT * FROM tbl_token_requisition where tbl_token_id = ' . $token_id . ' and deleted ="No" order by req_group_name';
                                                    $result = $conn->query($sql);
                                                } else {
                                                    $quotation_id = $_GET['id'];

                                                

                                                        $sql = "SELECT tbl_quotation_details.*, tbl_token_requisition.spec, tbl_token_requisition.req_product, tbl_quotation.is_vendor_workshop  FROM  tbl_quotation_details 
                                                                join tbl_quotation on tbl_quotation_details.tbl_quotation_id = tbl_quotation.id
                                                                join tbl_token_requisition on tbl_quotation_details.tbl_token_requisition_id = tbl_token_requisition.id
                                                                WHERE tbl_quotation.tbl_token_id = " . $token_id . " AND  tbl_quotation.id = " . $quotation_id . " AND tbl_quotation_details.deleted = 'No'  ";
                                                        $result = $conn->query($sql);
                                                    }

                                                }

                                                $i = 1;
                                                $j = 0;
                                                $totalUnitPrice = 0;
                                                if (isset($_GET['type'])) {
                                                    if ($_GET['type'] == 'wing_head') {

                                                        while ($row = $result->fetch_assoc()) {
                                                            $totalUnitPrice = 0;
                                                            $reqId = $row['id'];
                                                            $spec = $row['spec'];
                                                            $qty = $row['qty'];
                                                            $unit = $row['unit'];
                                                            $group = $row['quotation_group_name'];
                                                            $wing_tPrice = $row['wing_head_total_amount'];
                                                            $wing_uPrice = $row['wing_head_unit_price'];
                                                            $totalUnitPrice += (int) $wing_tPrice;
                                                            $vendor_workshop = $row['is_vendor_workshop'];
                                                            if ($vendor_workshop == 0 && $group != 'Vendor Workshop Works') {

                                                                echo '<tr id="rowNo_' . $j . '">
                                                                <td>' . $i++ . '</td>
                                                                <td>  <input type="hidden" id="quoteDetailsId_' . $j . '" value="' . $reqId . '" ><input class="form-control" type="text" id="req_product_' . $j . '" value="' . $row['req_product'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="spec_' . $j . '" value="' . $spec . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="qty_' . $j . '" value="' . $qty . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="unit_' . $j . '" value="' . $unit . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="group_' . $j . '" value="' . $group . '" disabled></td>
                                                                <td><input class="form-control" type="number" id="wing_head_uPrice_' . $j . '" value="' . $wing_uPrice . '" onkeyup="calTotalPrice(' . $j . ',\'wing_head\')" onchange="calTotalPrice(' . $j . ',\'wing_head\')" placeholder="Enter Amount" ></td>
                                                                <td><input class="form-control" type="number" id="wing_head_tPrice_' . $j . '" value="' . $wing_tPrice . '" disabled></td>
                                                                <td><i class="fa fa-trash" style="font-size: 22px; padding: 1px; " aria-hidden="true" onclick="deleteRow(' . $j . ')"></i></td>
                                                                </tr>';

                                                            } else {

                                                                echo '<tr id="rowNo_' . $j . '">
                                                                <td>' . $i++ . '</td>
                                                                <td>  <input type="hidden" id="quoteDetailsId_' . $j . '" value="' . $reqId . '" ><input class="form-control" type="text" id="req_product_' . $j . '" value="' . $row['req_product'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="spec_' . $j . '" value="' . $spec . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="qty_' . $j . '" value="' . $qty . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="unit_' . $j . '" value="' . $unit . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="group_' . $j . '" value="' . $group . '" disabled></td>
                                                                <td><input class="form-control" type="number" id="wing_head_uPrice_' . $j . '" value="' . $wing_uPrice . '" onkeyup="calTotalPrice(' . $j . ',\'wing_head\')" onchange="calTotalPrice(' . $j . ',\'wing_head\')" placeholder="Enter Amount" ></td>
                                                                <td><input class="form-control" type="number" id="wing_head_tPrice_' . $j . '" value="' . $wing_tPrice . '" disabled></td>
                                                                <td><i class="fa fa-trash" style="font-size: 22px; padding: 1px; " aria-hidden="true" onclick="deleteRow(' . $j . ')"></i></td>
                                                                </tr>';

                                                            }
                                                            $j++;
                                                        }
                                                    } else if ($_GET['type'] == 'audit') {

                                                        while ($row = $result->fetch_assoc()) {
                                                            $totalUnitPrice = 0;
                                                            $reqId = $row['id'];
                                                            $spec = $row['spec'];
                                                            $qty = $row['qty'];
                                                            $unit = $row['unit'];
                                                            $group = $row['quotation_group_name'];
                                                            $audit_uPrice = $row['audit_unit_price'];
                                                            $audit_tPrice = $row['audit_total_amount'];
                                                            $totalUnitPrice += (int) $audit_tPrice;
                                                            $vendor_workshop = $row['is_vendor_workshop'];

                                                            if ($vendor_workshop == '0' && $group != 'Vendor Workshop Works') {
                                                                echo '<tr id="rowNo_' . $j . '">
                                                                    <td>' . $i++ . '</td>
                                                                    <td><input type="hidden" id="quoteDetailsId_' . $j . '" value="' . $reqId . '"><input class="form-control" type="text" id="req_product_' . $j . '" value="' . $row['req_product'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="spec_' . $j . '" value="' . $spec . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="qty_' . $j . '" value="' . $qty . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="unit_' . $j . '" value="' . $unit . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="group_' . $j . '" value="' . $group . '" disabled></td>
                                                                    <td><input class="form-control" type="number" id="audit_uPrice_' . $j . '" value="' . $audit_uPrice . '" onkeyup="calTotalPrice(' . $j . ',\'audit\')" onchange="calTotalPrice(' . $j . ',\'audit\')" placeholder="Enter Amount"></td>
                                                                    <td><input class="form-control" type="number" id="audit_tPrice_' . $j . '" value="' . $audit_tPrice . '" disabled></td>
                                                                    <td><i class="fa fa-trash" style="font-size: 22px; padding: 1px;" aria-hidden="true" onclick="deleteRow(' . $j . ')"></i></td>
                                                                </tr>';
                                                            } else {
                                                                echo '<tr id="rowNo_' . $j . '">
                                                                <td>' . $i++ . '</td>
                                                                <td><input type="hidden" id="quoteDetailsId_' . $j . '" value="' . $reqId . '"><input class="form-control" type="text" id="req_product_' . $j . '" value="' . $row['req_product'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="spec_' . $j . '" value="' . $spec . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="qty_' . $j . '" value="' . $qty . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="unit_' . $j . '" value="' . $unit . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="group_' . $j . '" value="' . $group . '" disabled></td>
                                                                <td><input class="form-control" type="number" id="audit_uPrice_' . $j . '" value="' . $audit_uPrice . '" onkeyup="calTotalPrice(' . $j . ',\'audit\')" onchange="calTotalPrice(' . $j . ',\'audit\')" placeholder="Enter Amount"></td>
                                                                <td><input class="form-control" type="number" id="audit_tPrice_' . $j . '" value="' . $audit_tPrice . '" disabled></td>
                                                                <td><i class="fa fa-trash" style="font-size: 22px; padding: 1px;" aria-hidden="true" onclick="deleteRow(' . $j . ')"></i></td>
                                                                </tr>';
                                                            }
                                                            $j++;
                                                        }
                                                    } else {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $reqId = $row['id'];
                                                            $spec = $row['spec'];
                                                            $qty = $row['qty'];
                                                            $unit = $row['unit'];
                                                            $group = $row['req_group_name'];
                                                            if ($group != 'Vendor Workshop Works') {
                                                                echo '<tr id="rowNo_' . $j . '">
                                                                        <td>' . $i++ . '</td>
                                                                        <td><input type="hidden" id="requisitionId_' . $j . '" value="' . $row['id'] . '" ><input class="form-control" type="text" id="req_product_' . $j . '" value="' . $row['req_product'] . '" disabled></td>
                                                                        <td><input class="form-control" type="text" id="spec_' . $j . '" value="' . $row['spec'] . '" disabled></td>
                                                                        <td><input class="form-control" type="text" id="qty_' . $j . '" value="' . $row['qty'] . '" disabled></td>
                                                                        <td><input class="form-control" type="text" id="unit_' . $j . '" value="' . $row['unit'] . '" disabled></td>
                                                                        <td><input class="form-control" type="text" id="group_' . $j . '" value="' . $group . '" disabled></td>
                                                                        <td><input class="form-control" type="number" id="uPrice_' . $j . '" value="" onkeyup="calTotalPrice(' . $j . ',\'procurement\')" onchange="calTotalPrice(' . $j . ',\'procurement\')" placeholder="Enter Amount"></td>
                                                                        <td><input class="form-control" type="number" id="tPrice_' . $j . '" value="" onchange="priceUpdate()" disabled></td>
                                                                        <td><i class="fa fa-trash" style="font-size: 22px; padding: 1px;" aria-hidden="true" onclick="deleteRow(' . $j . ')"></i></td>
                                                                        </tr>';
                                                            }
                                                            $j++;
                                                        }
                                                    }

                                                }
                                            }

                                            ?>

                                            <tr>
                                                <td colspan="6"></td>
                                                <td style="text-align: right;">Total Price :</td>
                                                <td class="d-flex"><input id="price" value="<?= $totalUnitPrice ?>"
                                                        class="form-control" placeholder="Price" type="text" readonly>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td style="text-align: right;">Vat :</td>
                                                <td class="d-flex"><input id="vat" class="form-control" value="0"
                                                        placeholder="Vat" type="number" onkeyup="calculateTotal()"
                                                        onchange="calculateTotal()">
                                                    <span class="text-danger vatError"></span>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td style="text-align: right;">Ait :</td>
                                                <td class="d-flex"><input id="ait" class="form-control" value="0"
                                                        onkeyup="calculateTotal()" onchange="calculateTotal()"
                                                        placeholder="Ait" type="number">
                                                    <span class="text-danger aitError"></span>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td style="text-align: right;">Discount :</td>
                                                <td class="d-flex"><input id="discount" class="form-control"
                                                        placeholder="Discount" type="number" onkeyup="calculateTotal()"
                                                        value="0" onchange="calculateTotal()">
                                                    <span class="text-danger discountError"></span>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"></td>
                                                <td style="text-align: right;">Grand Total:</td>
                                                <td class="d-flex"><input id="grandTotal" class="form-control"
                                                        placeholder="Grand Total" type="number" readonly></td>
                                            </tr>
                                            <!-- <tr class="">
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Quote Amount :</td>
                                                <td class="d-flex"><input id="quoteAmount" class="form-control"
                                                        placeholder="Quote Amount" type="text"></td>
                                                <td></td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                    <div style="padding: 2%; margin-bottom: 2%;">

                                        <button style="width: 100%; box-shadow: 1px 1px 1px 0px #909090;"
                                            class="btn btn-default float-right" onclick="saveQuatation()" <?= $button ?>>
                                            <span class="glyphicon glyphicon-shopping-cart"
                                                style="color: #000cbd;"></span> Submit </span>
                                    </div>
                                    <div class="text-danger">
                                        <h5>
                                            <b><?= $status ?></b>
                                        </h5>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include 'includes/footer.php'; ?>

    </div>
    <?php include 'includes/scripts.php'; ?>
    <script src='../bootstrapvalidator.min.js'></script>
    <script src="select2/select2.min.js"></script>
    <script type="text/javascript">


        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        var type = urlParams.get('type')
        var quotation_id = urlParams.get('id')
        console.log(type);

        $(document).ready(function () {
            priceUpdate()
            $('#quoteBy').select2({
                width: "100%"
            });
            $('#supplier').select2({
                width: "100%",
                allowClear : true,
                placeholder: 'Select Vendor'
            });
        });


        function priceUpdate() {

            var Totalprice = 0;

            if (type == 'wing_head') {
                $('input[id^="wing_head_tPrice_"]').each(function () {
                    var $this = $(this);
                    if ($this.val() == '' || $this.val() == 'null' || $this.val() == 'NaN') {
                        $this.val(0);
                        //alert($this.val())
                    }
                    Totalprice += parseFloat($this.val());
                });
            }
            else if (type == 'audit') {
                $('input[id^="audit_tPrice_"]').each(function () {
                    var $this = $(this);
                    if ($this.val() == '' || $this.val() == 'null' || $this.val() == 'NaN') {
                        $this.val(0);
                        //alert($this.val())
                    }
                    Totalprice += parseFloat($this.val());
                });
            } else {
                $('input[id^="tPrice_"]').each(function () {
                    var $this = $(this);
                    if ($this.val() == '' || $this.val() == 'null' || $this.val() == 'NaN') {
                        $this.val(0);
                        //alert($this.val())
                    }
                    Totalprice += parseFloat($this.val());
                });
            }
            $('#price').val(Totalprice);

            calculateTotal()

        }

        function calculateTotal() {
            var totalAmount = $("#price").val();
            if (totalAmount == '') { totalAmount = 0; }
            var grandTotal = 0;
            vat = parseFloat($("#vat").val());
            if (isNaN(vat)) {
                vat = 0;
            }
            if (parseFloat($("#vat").val()) >= 0 || $("#vat").val() != '' || !isNaN($("#vat").val())) {

                if (parseFloat($("#vat").val()) >= 0) {
                    if (parseFloat($("#vat").val()) > totalAmount) {
                        $("#vatError").text("Vat cannot greater then price!");
                        $("#vat").val(totalAmount);
                    } else {
                        $("#vatError").text("");
                    }

                    vat = parseFloat($("#vat").val());
                } else {
                    $("#vat").val("0");
                    vat = 0;
                }
            }
            grandTotal = grandTotal + parseFloat(totalAmount) + parseFloat(vat);

            ait = parseFloat($("#ait").val());
            if (parseFloat($("#ait").val()) >= 0 || parseFloat($("#ait").val()) != '' || !isNaN($("#ait").val())) {
                if (parseFloat($("#ait").val()) >= 0) {
                    if (parseFloat($("#ait").val()) > totalAmount) {
                        $("#aitError").text("Ait cannot greater then price!");
                        $("#ait").val(totalAmount);
                    } else {
                        $("#aitError").text("");
                    }

                    ait = parseFloat($("#ait").val());
                } else {
                    $("#ait").val("0");
                    ait = 0;
                }

            }

            grandTotal = grandTotal + parseFloat(ait);

            if (parseFloat($("#discount").val()) >= 0 || parseFloat($("#discount").val()) != '' || !isNaN($("#discount").val())) {
                var discount = 0;
                var payChar = $("#discount").val().substr(-1);
                if (payChar == "%") {
                    discount = (totalAmount / 100) * parseFloat($("#discount").val());
                } else {
                    if (parseFloat($("#discount").val()) >= 0) {
                        discount = parseFloat($("#discount").val());
                        if (parseFloat($("#discount").val()) > totalAmount) {
                            $("#discountError").text("Discount cannot greater then price!");
                            $("#grandTotal").text("");
                            $("#discount").val(totalAmount);
                            $("#grandTotal").text("0");
                        } else {
                            $("#discountError").text("");
                        }

                    } else {
                        $("#discount").val("0");
                        discount = 0;
                    }
                }
            } else {
                $("#discount").val(0)
            }
            grandTotal = grandTotal - parseFloat(discount);
            $("#grandTotal").val(parseFloat(grandTotal));
        }






        function calTotalPrice(n, str) {

            if (str == "wing_head") {
                var qty = $('#qty_' + n).val();
                var unitPrice = $('#wing_head_uPrice_' + n).val();
                var total = qty * unitPrice;
                $('#wing_head_tPrice_' + n).val(total);
            }
            else if (str == "audit") {
                var qty = $('#qty_' + n).val();
                var unitPrice = $('#audit_uPrice_' + n).val();
                var total = qty * unitPrice;
                $('#audit_tPrice_' + n).val(total);
            } else {
                var qty = $('#qty_' + n).val();
                var unitPrice = $('#uPrice_' + n).val();
                var total = qty * unitPrice;
                $('#tPrice_' + n).val(total);
            }
            priceUpdate()
        }

        function typeWiseVendor() {
            var vendorType = $('#vendor_type').val();
            $.ajax({
                type: 'POST',
                url: 'phpScripts/quotationAdd.php',
                data: {
                    vendorType: vendorType,
                    "Action": 'typeWiseVendor'
                },
                dataType: 'json',
                beforeSend: function () {
                    // Show image container
                    $("#loading").show();
                },
                success: function (response) {
                    data = '';
                    $('#supplier').html('');
                    data += '- Seleted Vendor -';
                    for (var i = 0; i < response.vendors.length; i++) {
                        data += '<option value ="' + response.vendors[i].id + '">' + response.vendors[i].partyName + '</option>'
                    }
                    $('#supplier').append(data);
                }, error: function (xhr) {
                    alert(xhr.responseText);
                },
                complete: function (data) {
                    // Hide image container
                    $("#loading").hide();
                }
            });
        }





        function saveQuatation() {

            var tokenId = $('#tokenId').val();
            var quoteDate = $('#quotationDate').val();
            var quoteBy = $('#quoteBy').val();
            var vat = $('#vat').val();
            var ait = $('#ait').val();
            var discount = $('#discount').val();
            var grandTotal = $('#grandTotal').val();
            var quoteAmount = $('#grandTotal').val();
            var supplier = $('#supplier').val();

            if (supplier == '') {
                $("#divErrorMsg").html("<strong><i class='icon fa fa-check'></i>Not Procced ! </strong> Please select supplier!!");
                $("#divErrorMsg").show().delay(2200).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });
                return;
            }

            var quteImage = $('#qutation_file')[0].files[0];

            var requisitionIds = [];
            $('input[id^="requisitionId_"]').each(function () {
                var $this = $(this);
                requisitionIds.push($this.val());
            });

            if (type != 'procurement') {
                var quoteDetailsIds = [];
                $('input[id^="quoteDetailsId_"]').each(function () {
                    var $this = $(this);
                    quoteDetailsIds.push($this.val());
                });

                var wing_head_uPrice = [];
                $('input[id^="wing_head_uPrice_"]').each(function () {
                    var $this = $(this);
                    wing_head_uPrice.push($this.val());
                });

                var wing_head_tPrice = [];
                $('input[id^="wing_head_tPrice_"]').each(function () {
                    var $this = $(this);
                    wing_head_tPrice.push($this.val());
                });

                var audit_uPrice = [];
                $('input[id^="audit_uPrice_"]').each(function () {
                    var $this = $(this);
                    audit_uPrice.push($this.val());
                });

                var audit_tPrice = [];
                $('input[id^="audit_tPrice_"]').each(function () {
                    var $this = $(this);
                    audit_tPrice.push($this.val());
                });
                var wing_head_approval_date = $('#wing_head_approval_date').val();
                var audit_approval_date = $('#audit_approval_date').val();
                var wing_head_comment = $('#wing_head_comment').val();
                var audit_comment = $('#audit_comment').val();

            }

            var products = [];
            $('input[id^="req_product_"]').each(function () {
                var $this = $(this);
                products.push($this.val());
            });

            var specs = [];
            $('input[id^="spec_"]').each(function () {
                var $this = $(this);
                specs.push($this.val());
            });

            var qty = [];
            $('input[id^="qty_"]').each(function () {
                var $this = $(this);
                qty.push($this.val());
            });

            var units = [];
            $('input[id^="unit_"]').each(function () {
                var $this = $(this);
                units.push($this.val());
            });

            var group = [];
            $('input[id^="group_"]').each(function () {
                var $this = $(this);
                group.push($this.val());
            });


            var unitPrice = [];
            $('input[id^="uPrice_"]').each(function () {
                var $this = $(this);
                unitPrice.push($this.val());
            });

            var totalPrice = [];
            $('input[id^="tPrice_"]').each(function () {
                var $this = $(this);
                totalPrice.push($this.val());
            });


            var fd = new FormData();

            fd.append('tokenId', tokenId);
            fd.append('quoteDate', quoteDate);
            fd.append('quoteBy', quoteBy);
            fd.append('file', quteImage);
            fd.append('supplier', supplier);
            fd.append('requisitionIds', requisitionIds);
            fd.append('products', products);
            fd.append('specs', specs);
            fd.append('qty', qty);
            fd.append('units', units);
            fd.append('group', group);
            fd.append('qty', qty);
            fd.append('unitPrice', unitPrice);
            fd.append('totalPrice', totalPrice);

            if (type != 'procurement') {
                fd.append('quotation_id', quotation_id);
                fd.append('quoteDetailsIds', quoteDetailsIds);

                fd.append('wing_head_uPrice', wing_head_uPrice);
                fd.append('wing_head_tPrice', wing_head_tPrice);

                fd.append('audit_uPrice', audit_uPrice);
                fd.append('audit_tPrice', audit_tPrice);

                fd.append('wing_head_approval_date', wing_head_approval_date);
                fd.append('audit_approval_date', audit_approval_date);
                fd.append('wing_head_comment', wing_head_comment);
                fd.append('audit_comment', audit_comment);
            }

            fd.append('vat', vat);
            fd.append('ait', ait);
            fd.append('discount', discount);
            fd.append('grandTotal', grandTotal);
            fd.append('quoteAmount', quoteAmount);
            fd.append('type', type);
            fd.append('Action', 'saveQuotation');

            $.ajax({
                url: "phpScripts/quotationAdd.php",
                method: "POST",
                data: fd,
                contentType: "application/json",
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (result) {
                    console.log(result.msg)
                    if (result['msg'] != "success") {
                        alert(JSON.stringify(result));
                    } else if (result.msg == "success") {
                        if (confirm('Do you what to view the report?')) {
                            // window.location.href = 'quotationDetailReport.php?id=' + result.tokenId + '&quotationId=' + result.quotationId;
                            window.open('quotationDetailReport.php?id=' + result.tokenId + '&quotationId=' + result.quotationId, '_blank');
                            history.back()
                        } else {
                            history.back()
                        }
                    }
                },
                error: function (response) {
                    alert(JSON.stringify(response));
                },

                beforeSend: function () {
                    $('#loading').show();
                },
                complete: function () {
                    $('#loading').hide();
                }
            });
        }


        function deleteRow(row, id) {
            if (confirm('Are you sure you want to delete?')) {
                $('#rowNo_' + row).remove();
            } else {
                return
            }
        }



    </script>
</body>

</html>
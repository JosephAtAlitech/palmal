<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php';

?>

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
                            <div class="box-header with-border">
                                <a onclick="history.back()" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fa fa-reply" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="box-body">
                                <div class="form-group ">
                                    <?php
                                    if (isset($_GET['Token_id'])) {
                                        $id = $_GET['Token_id'];
                                        $sql = "SELECT * FROM `tbl_token` WHERE id = $id ";
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        $token = $row['token_title'];
                                    }
                                    ?>
                                    <div class="col-sm-4">
                                        <input type="hidden" id="tokenId" value="<?= $id ?>">
                                        <label class="">Token Title <span class="text-danger">*</span></label>
                                        <input type="text" id="tokenTitle" class="form-control" name="tokenTitle"
                                            placeholder=" Token Title " value="<?= $token ?>" disabled>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="">Quotation Date<span class="text-danger">*</span></label>
                                        <input type="date" id="quotationDate" class="form-control" name="quotationDate"
                                            value="<?= date('Y-m-d') ?>" placeholder=" Quotation Date ">
                                        <span id="quotationDateError"></span>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="">Supplier<span class="text-danger">*</span></label>
                                        <select type="date" id="supplier" class="form-control" name="supplier"
                                            placeholder="Vandor ">

                                            <?php
                                            $sql = "SELECT * from tbl_party where deleted = 'No' ORDER BY id desc";
                                            $result = $conn->query($sql);
                                            echo "<option value='0'>Select Vandor</option>";
                                            if ($result) {
                                                while ($row = $result->fetch_assoc()) {
                                                    if ($_SESSION["id"] == $row['id']) {
                                                        echo "<option value='" . $row['id'] . "' selected>" . $row['partyName'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $row['id'] . "'>" . $row['partyName'] . "</option>";
                                                    }
                                                }
                                            }

                                            ?>
                                        </select>
                                        <span id="supplierError"></span>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <hr>

                                <div class=" form-group col-md-12 mt-4">
                                    <table id="" class="table table-bordered">
                                        <thead>
                                            <th>id</th>
                                            <th>Product Name</th>
                                            <th>Specification</th>
                                            <th>Qty</th>
                                            <th>unit</th>

                                            <?php
                                            if (isset($_GET['type'])) {
                                                if ($_GET['type'] == 'wing_head') {
                                                    echo '<th>Wing Head Unit price</th>
                                                         <th>Wing Head Total Amount</th>';
                                                } else if ($_GET['type'] == 'audit') {
                                                    echo '<th>Audit Unit price</th>
                                                         <th>Audit Total Amount</th>';
                                                } else {
                                                    echo " <th>Unit price</th>
                                                    <th>Total Amount</th>";
                                                }
                                            }
                                            ?>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_GET['Token_id'])) {
                                                $token_id = $_GET['Token_id'];


                                                if ($_GET['type'] == 'procurement') {
                                                    $sql = 'SELECT * FROM tbl_token_requisition where tbl_token_id = ' . $token_id . ' and deleted ="No"';
                                                    $result = $conn->query($sql);
                                                } else {
                                                    $quotation_id = $_GET['id'];

                                                    $sql = "SELECT tbl_quotation_details.*, tbl_token_requisition.spec, tbl_token_requisition.req_product  FROM  tbl_quotation_details 
                                                    join tbl_quotation on tbl_quotation_details.tbl_quotation_id = tbl_quotation.id
                                                    join tbl_token_requisition on tbl_quotation_details.tbl_token_requisition_id = tbl_token_requisition.id
                                                    WHERE tbl_quotation.tbl_token_id = '" . $token_id . "' AND  tbl_quotation.id = '" . $quotation_id . "'  ORDER BY id DESC";
                                                    $result = $conn->query($sql);
                                                }


                                                $i = 1;
                                                $j = 0;
                                                if (isset($_GET['type'])) {
                                                    if ($_GET['type'] == 'wing_head') {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $reqId = $row['id'];
                                                            $spec = $row['spec'];
                                                            $qty = $row['qty'];
                                                            $unit = $row['unit'];
                                                            $wing_uPrice = $row['wing_head_unit_price'];
                                                            $wing_tPrice = $row['wing_head_total_amount'];
                                                            echo '<tr>
                                                                    <td>' . $i++ . '</td>
                                                                    <td>  <input type="hidden" id="quoteDetailsId_' . $j . '" value="' . $reqId . '" ><input class="form-control" type="text" id="req_product_' . $j . '" value="' . $row['req_product'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="spec_' . $j . '" value="' . $spec . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="qty_' . $j . '" value="' . $qty . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="unit_' . $j . '" value="' . $unit . '" disabled></td>
                                                                    <td><input class="form-control" type="number" id="wing_head_uPrice_' . $j . '" value="' . $wing_uPrice . '" onkeyup="calTotalPrice(' . $j . ',\'wing_head\')" onchange="calTotalPrice(' . $j . ',\'wing_head\')"></td>
                                                                    <td><input class="form-control" type="number" id="wing_head_tPrice_' . $j . '" value="' . $wing_tPrice . '"></td>
                                                                </tr>';
                                                            $j++;
                                                        }
                                                    } else if ($_GET['type'] == 'audit') {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $reqId = $row['id'];
                                                            $spec = $row['spec'];
                                                            $qty = $row['qty'];
                                                            $unit = $row['unit'];
                                                            $audit_uPrice = $row['audit_unit_price'];
                                                            $audit_tPrice = $row['audit_total_amount'];
                                                            echo '<tr>
                                                                    <td>' . $i++ . '</td>
                                                                    <td> <input type="hidden" id="quoteDetailsId_' . $j . '" value="' . $reqId . '" ><input class="form-control" type="text" id="req_product_' . $j . '" value="' . $row['req_product'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="spec_' . $j . '" value="' . $spec . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="qty_' . $j . '" value="' . $qty . '" disabled></td>
                                                                    <td><input class="form-control" type="text" id="unit_' . $j . '" value="' . $unit . '" disabled></td>
                                                                    <td><input class="form-control" type="number" id="audit_uPrice_' . $j . '" value="' . $audit_uPrice . '" onkeyup="calTotalPrice(' . $j . ',\'audit\')" onchange="calTotalPrice(' . $j . ',\'audit\')"></td>
                                                                    <td><input class="form-control" type="number" id="audit_tPrice_' . $j . '" value="' . $audit_tPrice . '"></td>
                                                                </tr>';
                                                            $j++;
                                                        }
                                                    } else {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $reqId = $row['id'];
                                                            $spec = $row['spec'];
                                                            $qty = $row['qty'];
                                                            $unit = $row['unit'];

                                                            echo '<tr>
                                                                <td>' . $i++ . '</td>
                                                                <td> <input type="hidden" id="requisitionId_' . $j . '" value="' . $row['id'] . '" ><input class="form-control" type="text" id="req_product_' . $j . '" value="' . $row['req_product'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="spec_' . $j . '" value="' . $row['spec'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="qty_' . $j . '" value="' . $row['qty'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" id="unit_' . $j . '" value="' . $row['unit'] . '" disabled></td>
                                                                <td><input class="form-control" type="number" id="uPrice_' . $j . '" value="" onkeyup="calTotalPrice(' . $j . ',\'procurement\')" onchange="calTotalPrice(' . $j . ',\'procurement\')"></td>
                                                                <td><input class="form-control" type="number" id="tPrice_' . $j . '" value="" disabled></td>
                                                            </tr>';
                                                            $j++;
                                                        }
                                                    }

                                                }
                                            }

                                            ?>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Quote By :</td>
                                                <td class="d-flex"><select id="quoteBy" class="form-control" type="text"
                                                        disabled>
                                                        <?php
                                                        $sql = "SELECT * from admin where deleted = 'On' ORDER BY id desc";
                                                        $result = $conn->query($sql);
                                                        echo "<option value='0'>Select Vandor</option>";
                                                        if ($result) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                if ($_SESSION["id"] == $row['id']) {
                                                                    echo "<option value='" . $row['id'] . "' selected>" . $row['firstname'] . "</option>";
                                                                } else {
                                                                    echo "<option value='" . $row['id'] . "'>" . $row['firstname'] . "</option>";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Vat :</td>
                                                <td class="d-flex"><input id="vat" class="form-control"
                                                        placeholder="Vat" type="text">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Ait :</td>
                                                <td class="d-flex"><input id="ait" class="form-control"
                                                        placeholder="Ait" type="text">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Discount :</td>
                                                <td class="d-flex"><input id="discount" class="form-control"
                                                        placeholder="Discount" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Grand Total:</td>
                                                <td class="d-flex"><input id="grandTotal" class="form-control"
                                                        placeholder="Grand Total" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Quote Amount :</td>
                                                <td class="d-flex"><input id="quoteAmount" class="form-control"
                                                        placeholder="Quote Amount" type="text"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 2%; margin-bottom: 2%;">
                                        <a style="width: 35%; margin-left: 15%; box-shadow: 1px 1px 1px 0px #909090;"
                                            href="#" class="btn btn-default" id="clear_cart"> <span
                                                class="glyphicon glyphicon-refresh" style="color: #000cbd;"></span>
                                            Clear Form</a>
                                        <span style="width: 35%; box-shadow: 1px 1px 1px 0px #909090;"
                                            class="btn btn-default" onclick="saveQuatation()"> <span
                                                class="glyphicon glyphicon-shopping-cart"
                                                style="color: #000cbd;"></span> Submit </span>
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
            $('#quoteBy').select2({
                width: "100%"
            });
            $('#supplier').select2({
                width: "100%"
            });
        });


        function calTotalPrice(n, str) {

            if (str == "wing_head") {
                var qty = $('#qty_' + n).val();
                var unitPrice = $('#wing_head_uPrice_' + n).val();
                var total = qty * unitPrice;
                $('#wing_head_tPrice_' + n).val(total);
            }
            else if (str == "wing_head") {
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


        }


        var manageTokenTable = '';
        $(document).ready(function () {
            manageTokenTable = $("#tokenTable").DataTable({
                'ajax': 'quotationAdd.php',
                'order': [],
                'dom': 'Bfrtip',
                'buttons': [
                    'pageLength', 'copy', 'csv', 'pdf', 'print'
                ],
                language: {
                    processing: "<img src='../images/loader.gif'>"
                },
            });

        });



        function saveQuatation() {

            var tokenId = $('#tokenId').val();
            var quoteDate = $('#quotationDate').val();
            var quoteBy = $('#quoteBy').val();
            var vat = $('#vat').val();
            var ait = $('#ait').val();
            var discount = $('#discount').val();
            var grandTotal = $('#grandTotal').val();
            var quoteAmount = $('#quoteAmount').val();

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
            fd.append('requisitionIds', requisitionIds);
            fd.append('products', products);
            fd.append('specs', specs);
            fd.append('qty', qty);
            fd.append('units', units);
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
            }

            fd.append('quoteBy', quoteBy);
            fd.append('vat', vat);
            fd.append('ait', ait);
            fd.append('discount', discount);
            fd.append('grandTotal', grandTotal);
            fd.append('quoteAmount', quoteAmount);
            fd.append('type', type);
            fd.append('Action', 'saveQuotation');

            $.ajax({
                url: "quotationAdd.php",
                method: "POST",
                data: fd,
                contentType: false,
                processData: false,
                datatype: "json",
                success: function (result) {
                    if (result != "success") {
                        alert(JSON.stringify(result));
                    } else if (result == "success") {
                        if (confirm('Do you what to view the report?')) {
                            window.location('');
                        } else {

                        }
                    }
                    //alert(JSON.stringify(result));
                    manageTokenTable.ajax.reload(null, false);
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

        function mechanicComment(id) {
            $('#mechanicComment').modal('show');
            $.ajax({
                type: 'POST',
                url: 'tokenAdd.php',
                data: {
                    id: id,
                    "Action": 'getMechanic'
                },
                dataType: 'json',
                beforeSend: function () {
                    // Show image container
                    $("#editLoader").show();
                },
                success: function (response) {
                    //alert(JSON.stringify(response));
                    $('#id_fr_mc_info').val(response.id);
                    $('#mechanicInfo').val(response.m_name ? response.m_name : '');
                    $('#problems').text(response.problems ? response.problems : '');
                },
                error: function (xhr) {
                    alert(xhr.responseText);
                },
                complete: function (data) {
                    // Hide image container
                    $("#editLoader").hide();
                }
            });
        }


        function addEgineerRequisition(id) {
            $('#addEgineerRequisition').modal('show');
            $.ajax({
                type: 'POST',
                url: 'tokenAdd.php',
                data: { id: id },
                dataType: 'json',
                beforeSend: function () {
                    // Show image container
                    $("#editLoader").show();
                },
                success: function (response) {
                    //alert(JSON.stringify(response));
                    $('#deletid').val(response.id);
                    $('#deletTripid').html(response.id);


                }, error: function (xhr) {
                    alert(xhr.responseText);
                },
                complete: function (data) {
                    // Hide image container
                    $("#editLoader").hide();
                }
            });
        }









    </script>
</body>

</html>
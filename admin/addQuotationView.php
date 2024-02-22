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
                                <a href="tokenList.php" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-reply"
                                        aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="box-body">
                                <div class="form-group ">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $id = $_GET['id'];
                                        $sql = 'SELECT * FROM `tbl_token` WHERE id =' . $id . '';
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                        $token = $row['token_title'];
                                    }
                                    ?>
                                    <div class="col-sm-6">
                                        <label class="">Token Title <span class="text-danger">*</span></label>
                                        <input type="text" id="tokenTitle" class="form-control" name="tokenTitle"
                                            placeholder=" Token Title " value="<?= $token ?>" disabled>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="">Quotation Date<span class="text-danger">*</span></label>
                                        <input type="date" id="quotationDate" class="form-control" name="quotationDate"
                                            value="<?= date('Y-m-d') ?>" placeholder=" Quotation Date ">
                                        <span id="quotationDateError"></span>
                                    </div>
                                </div>
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
                                                }
                                                else if ($_GET['type'] == 'audit') {
                                                    echo '<th>Audit Unit price</th>
                                                         <th>Audit Total Amount</th>';
                                                }
                                                else{
                                                    echo    " <th>Unit price</th>
                                                    <th>Total Amount</th>";                                                }
                                            }
                                            ?>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_GET['id'])) {

                                                $id = $_GET['id'];
                                                $sql = 'SELECT * from tbl_token_requisition where tbl_token_id = ' . $id . '';
                                                $result = $conn->query($sql);
                                                $i = 1;
                                                $j=0;
                                                if (isset($_GET['type'])) {
                                                    if ($_GET['type'] == 'wing_head') {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<tr>
                                                                    <td>' . $i++ . '</td>
                                                                    <td><input class="form-control" type="text" value="' . $row['req_product'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" value="' . $row['Spec'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" value="' . $row['qty'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" value="' . $row['unit'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" value=""></td>
                                                                    <td><input class="form-control" type="text" value=""></td>
                                                                </tr>';
                                                        }
                                                    } else if ($_GET['type'] == 'audit') {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<tr>
                                                                    <td>' . $i++ . '</td>
                                                                    <td><input class="form-control" type="text" value="' . $row['req_product'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" value="' . $row['Spec'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" value="' . $row['qty'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" value="' . $row['unit'] . '" disabled></td>
                                                                    <td><input class="form-control" type="text" value=""></td>
                                                                    <td><input class="form-control" type="text" value=""></td>
                                                                </tr>';
                                                        }
                                                    } else {

                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<tr>
                                                                <td>' . $i++ . '</td>
                                                                <td><input class="form-control" type="text" value="' . $row['req_product'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" value="' . $row['Spec'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" value="' . $row['qty'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" value="' . $row['unit'] . '" disabled></td>
                                                                <td><input class="form-control" type="text" value=""></td>
                                                                <td><input class="form-control" type="text" value=""></td>
                                                            </tr>';
                                                        }
                                                    }

                                                }
                                            }

                                            ?>
                                             <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Quote By :</td>
                                                <td class="d-flex"><select class="form-control" type="text">
                                                    <option> Select Vandor</option>
                                                </select></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Vat :</td>
                                                <td class="d-flex"><input class="form-control" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Ait :</td>
                                                <td class="d-flex"><input class="form-control" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Discount :</td>
                                                <td class="d-flex"><input class="form-control" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Grand :</td>
                                                <td class="d-flex"><input class="form-control" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td style="text-align: right;">Quote Amount :</td>
                                                <td class="d-flex"><input class="form-control" type="text"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="padding: 2%; margin-bottom: 2%;">
                    <a  style="width: 35%; margin-left: 15%; box-shadow: 1px 1px 1px 0px #909090;" href="#" class="btn btn-default" id="clear_cart"> <span class="glyphicon glyphicon-refresh" style="color: #000cbd;"></span> Clear Form</a>
                    <span  style="width: 35%; box-shadow: 1px 1px 1px 0px #909090;" class="btn btn-default" onclick="checkOutCart()"> <span class="glyphicon glyphicon-shopping-cart" style="color: #000cbd;"></span>  Submit </span>
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



        $(document).ready(function () {
            $('#mechanic').select2({
                width: "100%"
            });
            $('#engineer').select2({
                width: "100%"
            });
        });


        var manageTokenTable = '';
        $(document).ready(function () {
            manageTokenTable = $("#tokenTable").DataTable({
                'ajax': 'tokenAdd.php',
                'order': [],
                'dom': 'Bfrtip',
                'buttons': [
                    'pageLength', 'copy', 'csv', 'pdf', 'print'
                ],
                language: {
                    processing: "<img src='../images/loader.gif'>"
                },
            });

            $('#token_add_form').bootstrapValidator({
                live: 'enabled',
                message: 'This value is not valid',
                submitButton: '$token_add_form button [type="Submit"]',
                submitHandler: function (validator, form, submitButton) {

                    var tolenTitle = $("#tokenTitle").val();
                    var tolenDetails = $("#tokenDetails").val();
                    var mechanic = $("#mechanic").val();
                    var engineer = $('#engineer').val();
                    var tokenDate = $("#tokenDate").val();

                    var fd = new FormData();

                    fd.append('tokenTitle', tolenTitle);
                    fd.append('tokenDetails', tolenDetails);
                    fd.append('mechanic', mechanic);
                    fd.append('engineer', engineer);
                    fd.append('tokenDate', tokenDate);
                    fd.append('Action', 'addToken');

                    $.ajax({
                        url: "tokenAdd.php",
                        method: "POST",
                        data: fd,
                        contentType: false,
                        processData: false,
                        datatype: "json",
                        success: function (result) {
                            if (result != "success") {
                                alert(JSON.stringify(result));
                            } else if (result == "success") {
                                $('#addnewToken').modal('hide');
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
                },
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                excluded: [':disabled'],
                fields: {
                    tokenTitle: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please Insert Token Number'
                            },
                            regexp: {
                                regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                                message: 'Please insert alphanumeric value only'
                            }
                        }
                    },
                    mechanic: {
                        validators: {
                            notEmpty: {
                                message: 'Please Select mechanic'
                            }
                        }
                    },
                    engineer: {
                        validators: {
                            notEmpty: {
                                message: 'Please Select Engineer'
                            }
                        }
                    },
                    tokenDate: {
                        validators: {
                            date: {
                                message: 'The date is not valid',
                                format: 'YYYY/MM/DD'
                            },
                        }
                    }
                }
            })

        });




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


        function confirmDelete(id) {
            $('#deleteTrip').modal('show');
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
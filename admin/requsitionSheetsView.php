<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php';
include('wialon.php');
$wialon_api = new Wialon(); ?>
<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
<style>
    .select-group input.form-control {
        width: 65%
    }

    .select-group select.input-group-addon {
        width: 35%;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>
        <link rel="stylesheet" href="select2/select2.min.css" />
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Vehicle Requsition</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Vehicle Requsition</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- <?php

                // $sql = "SELECT tokenId FROM `customer_token` WHERE status='Active' ORDER BY `id`  DESC";
                // $query = $conn->query($sql);
                // $row = $query->fetch_assoc();
                // $token = $row['tokenId'];

                // $tokenInfo = $token;
                // $result = $wialon_api->login($tokenInfo);
                // $json = json_decode($result, true);
                ?> -->
           
            <div id='divErrorMsg' class='alert alert-danger alert-dismissible' style="display:none" >
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> </h4>
            
            </div>

            <div id='divMsg' class='alert alert-success alert-dismissible'  style="display:none">
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
            </div>
                <link rel="stylesheet" href="buttons.dataTables.min.css" />
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">


                            <div class="box-body">

                                <table id="table_document_proposal" class="table table-bordered" width="100%">
                                    <thead>
                                        <th>id</th>
                                        <th>Vehicle number</th>
                                        <th>Entry Date</th>
                                        <th>Office Fee</th>
                                        <th>Token Fee</th>
                                        <th>Others Fee</th>
                                        <th>Total</th>
                                        <th>Adjusted Amount</th>
                                        <th>Action</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/vehicle-modal.php'; ?>
        <?php include 'includes/Vehicalreqadjust-modal.php'; ?>
    </div>
    <?php include 'includes/scripts.php'; ?>
    <script src='../bootstrapvalidator.min.js'></script>
    <script src="select2/select2.min.js"></script>
    <script type="text/javascript">


// for show the requisitionsheets data by form table id.

        $(document).ready(function() {
            manageRequisitionTable = $("#table_document_proposal").DataTable({
                'ajax': 'phpScripts/requisitionSheetAction.php',
                'order': [],
                'dom': 'Bfrtip',
                'scrollX': true,
                'buttons': [
                    'pageLength', 'copy', 'csv', 'pdf', 'print'
                ],
                language: {
                    processing: "<img src='../images/loader.gif'>"
                },
                processing: true
            })
        });

        function vNumberAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_AvilabilityVehicle.php",
                data: 'vehicleNumber=' + $("#vehicleNumber").val(),
                type: "POST",
                success: function(data) {
                    $("#vNumber-availability-status").html(data);
                    if (data == "OK") {
                        $('#submit-button').prop('disabled', false)
                        return true;
                    } else {
                        $('#submit-button').prop('disabled', true)
                        return false;
                    }
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }

        function chasisAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_AvilabilityVehicle.php",
                data: 'chasisNumberCheck=' + $("#chasisNumberCheck").val(),
                type: "POST",
                success: function(data) {
                    $("#chasis-availability-status").html(data);
                    if (data == "OK") {
                        $('#submit-button').prop('disabled', false)
                        return true;
                    } else {
                        $('#submit-button').prop('disabled', true)
                        return false;
                    }
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }

        function engineAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_AvilabilityVehicle.php",
                data: 'EnginNumberCheck=' + $(EnginNumberCheck).val(),
                type: "POST",
                success: function(data) {
                    $("#engine-availability-status").html(data);
                    if (data == "OK") {
                        $('#submit-button').prop('disabled', false)
                        return true;
                    } else {
                        $('#submit-button').prop('disabled', true)
                        return false;
                    }
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }


    // for delete data from requisitionsheets view 

        function deleteRow(id) {
            if (confirm("Are you want to delete the record!") == true) {
                var id = id;

                jQuery.ajax({
                    url: "phpScripts/requisitionSheetAction.php",
                    data: 'Action=deleteRequisitionSheet&id=' + id,
                    type: "POST",
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    success: function(data) {
                        //alert(JSON.stringify(data))
                        manageRequisitionTable.ajax.reload(null, false);

                        $("#loaderIcon").hide();
                    },
                    error: function(error) {
                        alert(error)
                    },
                    complete: function(data) {
                        $('#loading').hide();
                    }
                });
            } else {
                text = "You canceled!";
            }
        }


        // ADJUST VEHICAL REQUISITION 

        function adjustrow(id) {
            var id = id;
            var fd = new FormData();
            fd.append('Action', 'adjustVehicleRequisition');
            fd.append('id', id);
            jQuery.ajax({
                type: "POST",
                url: "phpScripts/requisitionSheetAction.php",
                data: fd,
                contentType: false,
                processData: false,
                datatype: "json",
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if(response.status == "Success"){
                        var response_row = response.row;
                        // showing the data in modal // 
                        $('#adjustVehicleRequisitionModal').modal('show');
                        $('#grandtotal').val(response.total);
                        $('#editvehicle_no').val(response_row[0].vehicle_number);
                        $('#doctimefrom').val(response_row[0].start_date);
                        $('#timeto').val(response_row[0].end_date);
                        $('#fethofficefee').val(response_row[0].office_fee);
                        $('#fethtokenfee').val(response_row[0].token_fee);
                        $('#fethotherfee').val(response_row[0].others_fee);
                        $('#editamount').val(response.total);
                        $('#editid').val(response_row[0].id);
                        $("#loaderIcon").hide();
                    }else if(response.status == "Information"){
                         //success of error message 
                        $("#divErrorMsg").html("<strong><i class='icon fa fa-check'></i>Error ! </strong>"+response.message);
                        $("#divErrorMsg").show().delay(2000).fadeOut().queue(function (n) {
                            $(this).hide(); n();
                        });

                    }else{
                        alert(response);
                    }
                },
                error: function(error) {
                    alert(error)
                },
                complete: function(data) {
                    $('#loading').hide();
                }
            });


            // $.ajax({
            //     type: 'POST',
            //     url: 'phpScripts/requisitionSheetAction.php',
            //     data: {
            //         Action: 'adjustRequisitionSheet',
            //         id: id,
            //     },
            //     dataType: 'json',

            //     success: function(data) {
            //         alert(JSON.stringify(data));
            //         alert('success');
            //         $('#adjustVehicleRequisitionModal').modal('show');
            //         data['row'];
            //         data['total'];
            //         $('#editvehicle_no').val(data['row'].vehicle_number);
            //         $('#doctimefrom').val(data['row'].start_date);
            //         $('#timeto').val(data['row'].end_date);
            //         $('#fethofficefee').val(data['row'].office_fee);
            //         $('#fethtokenfee').val(data['row'].token_fee);
            //         $('#fethotherfee').val(data['row'].others_fee);
            //         $('#grandtotal').val(data.total);
            //     },
            //     error: function(error) {
            //         alert('error');
            //         alert(JSON.stringify(error));
            //         $('#adjustVehicleRequisitionModal').modal('show');

            //         $('#editvehicle_no').text(response.responseJSON.error['row'].vehicle_number);
            //         // error['row'];
            //         // error['total'];
            //         // $('#editvehicle_no').val(error['row'].vehicle_number);
            //         // $('#doctimefrom').val(error['row'].start_date);
            //         // $('#timeto').val(error['row'].end_date);
            //         // $('#fethofficefee').val(error['row'].office_fee);
            //         // $('#fethtokenfee').val(error['row'].token_fee);
            //         // $('#fethotherfee').val(error['row'].others_fee);
            //         // $('#grandtotal').val(error.total);
            //         //alert(error);

            //     },
            //     beforeSend: function() {
            //         $('#loading').show();
            //     },
            //     complete: function(data) {
            //         $('#loading').hide();
            //     }

            // });
        }

        $(document).ready(function() {
            $(".searchVehicle").select2({
                dropdownParent: $("#addnewVehicle")
            });
        });
        $(document).ready(function() {
            $("#BranchStatus").select2({
                dropdownParent: $("#addnewVehicle")
            });
        });
        $(document).ready(function() {
            $("#MakersName").select2({
                dropdownParent: $("#addnewVehicle")
            });
        });
        $(document).ready(function() {
            $("#YearOfManufacture").select2({
                dropdownParent: $("#addnewVehicle")
            });
        });
        $(document).ready(function() {
            $("#vehicleNumberName12").select2({
                dropdownParent: $("#addnewVehicle")
            });
        });


        //ADD to requisition Adjusted table
        // insert code without veledation

        $("#adjustbuttonsubmit").submit(function(e) {
            e.preventDefault();
            var editamount = $("#editamount").val();
            var document_proposal_id = $("#editid").val();
            var payment_type = $("#payment_type").val();
            var action = 'adjustRequisitionAmount';
            var fd = new FormData();
            fd.append('editamount', editamount);
            fd.append('document_proposal_id', document_proposal_id);
            fd.append('payment_type', payment_type);
            fd.append('Action', action);

            $.ajax({
                url: 'phpScripts/requisitionSheetAction.php',
                type: 'POST',
                datatype: 'json',
                data: fd,
                contentType: false,
                processData: false,
                success: function(result) {
                    if(result == "Success"){
                        manageRequisitionTable.ajax.reload(null, false);
                        $('#adjustVehicleRequisitionModal').modal('hide');
                        //alert("Successfully Saved");
                     
                        $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong>Succefully Saved");
                        $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                            $(this).hide(); n();
                        });

                    }
                },
                error: function(response) {
                    alert(JSON.stringify(response));
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                complete: function() {
                    $('#loading').hide();
                }
            })
        })


        $(document).ready(function() {
            $('#contact_form').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                excluded: [':disabled'],
                fields: {
                    vehicleNumber: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please Vehicle Number like Number DHA-11-1111'
                            },
                            regexp: {
                                regexp: /(\d{2}[- ])\d{4}$/,
                                message: 'Please insert Vehicle Number DHA-11-1111'
                            }
                        }
                    },
                    oilTankCapacity: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please Vehicle Oil Tank Capacity In liter'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'Please Vehicle Oil Tank Capacity In liter'
                            }
                        }
                    },
                    branchCode: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please Insert Branch Code Only'
                            },
                            regexp: {
                                regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
                                message: 'Please insert alphanumeric value only'
                            }
                        }
                    },
                    PurchaseDate: {
                        validators: {
                            date: {
                                message: 'The date is not valid',
                                format: 'YYYY/MM/DD'
                            },
                        }
                    },
                    YearOfManufacture: {
                        validators: {
                            stringLength: {
                                max: 4,
                            },
                            notEmpty: {
                                message: 'Please Insert Year Of Manufacture'
                            },
                            regexp: {
                                regexp: /^([0-9]{1,9})[,]*([0-9]{3,3})*[,]*([0-9]{1,3})*([.]([0-9]{2,2})){0,1}$/,
                                message: 'Please insert Number Only'
                            }
                        }
                    },
                    ChesisNumber: {
                        validators: {
                            stringLength: {
                                min: 3,
                            },
                            notEmpty: {
                                message: 'Please Insert Only Chesis Number'
                            },
                            regexp: {
                                regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                                message: 'Please insert alphanumeric value only'
                            }
                        }
                    },
                    EnginNumber: {
                        validators: {
                            stringLength: {
                                min: 3,
                            },
                            notEmpty: {
                                message: 'Please Insert Only Engin Number'
                            },
                            regexp: {
                                regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                                message: 'Please insert alphanumeric value only'
                            }
                        }
                    }
                }
            })
        });

        $(document).ready(function() {
            $('#contact_formEdit').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                excluded: [':disabled'],
                fields: {
                    vehicleNumber: {
                        validators: {
                            stringLength: {
                                min: 3,
                            },
                            notEmpty: {
                                message: 'Please Insert Only Vehicle Number'
                            },
                            regexp: {
                                regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                                message: 'Please insert alphanumeric value only'
                            }
                        }
                    },
                    oilTankCapacity: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please Vehicle Oil Tank Capacity In liter'
                            },
                            regexp: {
                                regexp: /^[0-9]+$/,
                                message: 'Please Vehicle Oil Tank Capacity In liter'
                            }
                        }
                    },
                    branchCode: {
                        validators: {
                            stringLength: {
                                min: 2,
                            },
                            notEmpty: {
                                message: 'Please Insert Branch Code Only'
                            },
                            regexp: {
                                regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
                                message: 'Please insert alphanumeric value only'
                            }
                        }
                    },
                    RegistrationDate: {
                        validators: {
                            date: {
                                message: 'The date is not valid',
                                format: 'YYYY/MM/DD'
                            },
                        }
                    },
                    YearOfManufacture: {
                        validators: {
                            notEmpty: {
                                message: 'Please Insert Year Of Manufacture'
                            },
                            regexp: {
                                regexp: /^([0-9]{1,9})[,]*([0-9]{3,3})*[,]*([0-9]{1,3})*([.]([0-9]{2,2})){0,1}$/,
                                message: 'Please insert Number Only'
                            }
                        }
                    },
                    ChesisNumber: {
                        validators: {
                            stringLength: {
                                min: 3,
                            },
                            notEmpty: {
                                message: 'Please Insert Only Chesis Number'
                            },
                            regexp: {
                                regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                                message: 'Please insert alphanumeric value only'
                            }
                        }
                    },
                    EnginNumber: {
                        validators: {
                            stringLength: {
                                min: 3,
                            },
                            notEmpty: {
                                message: 'Please Insert Only Engin Number'
                            },
                            regexp: {
                                regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                                message: 'Please insert alphanumeric value only'
                            }
                        }
                    }


                }
            })
        });
    </script>
    <script>
        var userselect = document.getElementById('input');
    </script>
    <script type="text/javascript">
        // Print message to log
        function msg(text) {
            $("#log").prepend(text + "<br/>");
        }

        function init() { // Execute after login succeed
            var getSelectedUnitInfo = '';
            var sess = wialon.core.Session.getInstance(); // get instance of current Session
            // flags to specify what kind of data should be returned
            var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;

            sess.loadLibrary("itemIcon"); // load Icon Library	
            sess.updateDataFlags( // load items to current session
                [{
                    type: "type",
                    data: "avl_unit",
                    flags: flags,
                    mode: 0
                }], // Items specification
                function(code) { // updateDataFlags callback
                    if (code) {
                        msg(wialon.core.Errors.getErrorText(code));
                        return;
                    } // exit if error code

                    // get loaded 'avl_unit's items  
                    var units = sess.getItems("avl_unit");
                    if (!units || !units.length) {
                        msg("Units not found");
                        return;
                    } // check if units found

                    for (var i = 0; i < units.length; i++) { // construct Select object using found units
                        var u = units[i]; // current unit in cycle
                        // append option to select
                        $("#units").append("<option value='" + u.getId() + "'>" + u.getName() + "</option>");
                    }
                    // bind action to select change event
                    $("#units").change(getSelectedUnitInfo);
                }
            );
        }

        // execute when DOM ready
        $(document).ready(function() {
            var myToken = <?php echo (json_encode($token)); ?>;
            wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
            // For more info about how to generate token check
            // http://sdk.wialon.com/playground/demo/app_auth_token
            wialon.core.Session.getInstance().loginToken(myToken, "", // try to login
                function(code) { // login callback
                    // if error code - print error message
                    if (code) {
                        msg(wialon.core.Errors.getErrorText(code));
                        return;
                    }
                    //msg("Logged successfully"); 
                    init(); // when login suceed then run init() function
                });
        });
    </script>

</body>

</html>
var manageTable;
var w = $("#vehicle-info-box");

/*--------- Start View customer /supplier from databse to datatable ---------------*/
$(document).ready(function () {
    w.height(0);
    //$("#vehicle-info-box").hide();
    // retrive customer or supplier data
    manageTable = $("#traffic_police_expnse_table").DataTable({
        'ajax': 'phpScripts/Traffic-case-exp-action.php',
        'order': [],
        'dom': 'Bfrtip',
        "scrollX": true,
        "responsive": true,
        'buttons': [
            'pageLength', 'copy', 'csv', 'pdf', 'print'
        ],
        language: {
            processing: "<img src='../images/loader.gif'>"
        },
        processing: true
    });
});


function getVehicleInfo() {
    var vehicle = $("#vehicle").val();
    $.ajax({
        type: 'POST',
        url: 'phpScripts/Traffic-case-exp-action.php',
        data: {
            vehicle: vehicle,
            action: 'getVehicleInfo'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            //alert(JSON.stringify(response));

            var l = $(".list");
            if (response != '') {
                w.height(l.outerHeight(true));

                $('#v_num').val(response.vehicle_number);
                $('#d_name').val(response.driver_name);
                $('#e_name').val(response.employee_name);
                $('#b_name').val(response.branch_name);
                $('#d_name_id').val(response.d_id);
                $('#b_name_id').val(response.b_id);
            } else {
                $("#vehicle-info-box").hide();
            }

        }, error: function (xhr) {
            alert(JSON.stringify(xhr));
        },
        complete: function (data) {
            $("#loading").hide();
        }
    });
}

function edit_getVehicleInfo() {
    var vehicle = $("#edit_vehicle").val();
    $.ajax({
        type: 'POST',
        url: 'phpScripts/Traffic-case-exp-action.php',
        data: {
            vehicle: vehicle,
            action: 'getVehicleInfo'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            //alert(JSON.stringify(response));

            var l = $(".list");
            if (response != '') {

                $('#edit_v_num').val(response.vehicle_number);
                $('#edit_d_name').val(response.driver_name);
                $('#edit_e_name').val(response.employee_name);
                $('#edit_b_name').val(response.branch_name);
                $('#edit_d_name_id').val(response.d_id);
                $('#edit_b_name_id').val(response.b_id);
            } else {
                $("#edit-vehicle-info-box").hide();
            }


        }, error: function (xhr) {
            alert(JSON.stringify(xhr));
        },
        complete: function (data) {
            $("#loading").hide();
        }
    });
}
/*--------- End View customer /supplier from databse to datatable ---------------*/

// //Edit Unit
function editExp(id) {
    $('#editExpModal').modal('show');

    $.ajax({
        type: 'POST',
        url: 'phpScripts/Traffic-case-exp-action.php',
        data: {
            id: id,
            action: 'getExpenseRow'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            $('#edit_id').val(response.id);

            $('#edit_vehicle').val(response.vehicle_id).trigger('change');
            $('#edit_v_num').val(response.vehicle_number);
            $('#edit_d_name').val(response.driver_name);
            $('#edit_b_name').val(response.branch_name);
            $('#edit_d_name_id').val(response.d_id);
            $('#edit_b_name_id').val(response.b_id);
            $('#edit_case_id').val(response.case_id);
            $('#edit_receptable_amount').val(response.receptable_amount);
            $('#edit_non_receptable_amount').val(response.non_receptable_amount);
            $('#edit_settle_date').val(response.occurrence_date);
            $('#edit_reason').val(response.reason);
            $('#edit_remarks').val(response.remarks);

        }, error: function (xhr) {
            alert(JSON.stringify(xhr));
        },
        complete: function (data) {
            $("#loading").hide();
        }
    });
}


// /*----------------Start CRM Save & validation parts----------------------*/
$(document).ready(function () {
    $('#form_traficExpanse').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        submitButton: '$form_addCustomer button [type="Submit"]',
        submitHandler: function (validator, form, submitButton) {
            var vehicle = $("#vehicle").val();
            var driver_id = $("#d_name_id").val();
            var branch_id = $("#b_name_id").val();
            var case_id = $("#case_id").val();
            var receptable_amount = $("#receptable_amount").val();
            var non_receptable_amount = $("#non_receptable_amount").val();
            var settle_date = $("#settle_date").val();
            var reason = $("#reason").val();
            var remarks = $("#remarks").val();

            var fd = new FormData();
            fd.append('vehicle', vehicle);
            fd.append('driver_id', driver_id);
            fd.append('branch_id', branch_id);
            fd.append('case_id', case_id);
            fd.append('receptable_amount', receptable_amount);
            fd.append('non_receptable_amount', non_receptable_amount);
            fd.append('settle_date', settle_date);
            fd.append('reason', reason);
            fd.append('remarks', remarks);

            fd.append('action', 'savePoliceExp');

            $.ajax({
                type: 'POST',
                url: 'phpScripts/Traffic-case-exp-action.php',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response == 'success') {

                        manageTable.ajax.reload(null, false);
                        $("#vehicle").val('').trigger('change');
                        $("#d_name_id").val('');
                        $("#b_name_id").val('');
                        $("#case_id").val('');
                        $("#receptable_amount").val('');
                        $("#non_receptable_amount").val('');
                        $("#reason").val('');
                        $("#remarks").val('');
                        w.height(0);
                        $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Successfully Saved");
                        $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                            $(this).hide(); n();
                        });
                        $('#addExpModal').modal('hide');
                        $("#form_traficExpanse").data('bootstrapValidator').resetForm();
                    } else {
                        alert(JSON.stringify(response));
                    }
                }, error: function (xhr) {
                    alert(JSON.stringify(xhr));
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
            case_id: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Please Insert Case ID Only'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            receptable_amount: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please Insert Number Only'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Ex: 100'
                    }
                }
            },
            non_receptable_amount: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please Insert Number Only'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Ex: 100'
                    }
                }
            },

            reason: {
                validators: {

                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            remarks: {
                validators: {

                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            vehicle: {
                validators: {
                    notEmpty: {
                        message: 'Please Select vehicle'
                    },
                }
            },settle_date: {
                validators: {
                    notEmpty: {
                        message: 'Please set a date'
                    },
                }
            }
        }
    });

    $('#edit_form_traficExpanse').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        submitButton: '$form_editCustomer button [type="Submit"]',
        submitHandler: function (validator, form, submitButton) {
            var id = $("#edit_id").val();
            var vehicle = $("#edit_vehicle").val();
            var driver_id = $("#edit_d_name_id").val();
            var branch_id = $("#edit_b_name_id").val();
            var case_id = $("#edit_case_id").val();
            var receptable_amount = $("#edit_receptable_amount").val();
            var non_receptable_amount = $("#edit_non_receptable_amount").val();
            var settle_date = $("#edit_settle_date").val();
            var reason = $("#edit_reason").val();
            var remarks = $("#edit_remarks").val();

            var fd = new FormData();
            fd.append('id', id);
            fd.append('vehicle', vehicle);
            fd.append('driver_id', driver_id);
            fd.append('branch_id', branch_id);
            fd.append('case_id', case_id);
            fd.append('receptable_amount', receptable_amount);
            fd.append('non_receptable_amount', non_receptable_amount);
            fd.append('settle_date', settle_date);
            fd.append('reason', reason);
            fd.append('remarks', remarks);
            fd.append('action', 'updatePoliceExpanse');

            $.ajax({
                type: 'POST',
                url: 'phpScripts/Traffic-case-exp-action.php',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response == 'success') {
                        $('#editExpModal').modal('hide');
                        manageTable.ajax.reload(null, false);
                        $("#edit_vehicle").val('');
                        $("#edit_d_name_id").val('');
                        $("#edit_b_name_id").val('');
                        $("#edit_case_id").val('');
                        $("#edit_receptable_amount").val('');
                        $("#edit_non_receptable_amount").val('');
                        $("#edit_reason").val('');
                        $("#edit_remarks").val('');
                        $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Updated Successfully");
                        $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                            $(this).hide(); n();
                        });
                    } else {
                        alert(response);
                    }
                }, error: function (xhr) {
                    alert(JSON.stringify(xhr));
                }, beforeSend: function () {
                    $('#loading').show();
                },
                complete: function () {
                    $('#loading').hide();
                }
            });

            $('#editCustomerSupplier').modal('hide');
        },
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: [':disabled'],
        fields: {
            edit_case_id: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Please Insert Case ID Only'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            edit_receptable_amount: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please Insert Number Only'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Ex: 100'
                    }
                }
            },
            edit_non_receptable_amount: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please Insert Number Only'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Ex: 100'
                    }
                }
            },

            edit_reason: {
                validators: {

                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            edit_remarks: {
                validators: {

                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            edit_vehicle: {
                validators: {
                    notEmpty: {
                        message: 'Please Select vehicle'
                    },
                }
            }
        }
    });
});




$("#vehicle").select2({
    placeholder: "Select vehicle",
    width: '100%',
    allowClear: true
});

$("#getVehicle").select2({
    placeholder: "Select vehicle",
    width: '100%',
    allowClear: true
});
$("#edit_vehicle").select2({
    placeholder: "Select vehicle",
    width: '100%',
    allowClear: true
});
$("#edit_tblCity12").select2({
    placeholder: "Select District Name",
    dropdownParent: $("#editCustomerSupplier"),
    allowClear: true
});





function confirmDelete(id) {
    if (confirm('Are you sure you want to delete?')) {
        $.ajax({
            type: 'POST',
            url: 'phpScripts/Traffic-case-exp-action.php',
            data: {
                id: id,
                "action": 'deleteExp'
            },
            dataType: 'json',
            beforeSend: function () {
                // Show image container
                $("#loading").show();
            },
            success: function (response) {
                if (response == 'success') {
                    $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Deleted");
                    $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                        $(this).hide(); n();
                    });
                }
                //alert(JSON.stringify(response));
                manageTable.ajax.reload(null, false);
            }, error: function (xhr) {
                //alert(xhr.responseText);
            },
            complete: function (data) {
                // Hide image container
                $("#loading").hide();
            }
        });
    }
}


function getPdf() {
    var monthAndYear = $("#yearmonth").val();
    var vehicle = $("#getVehicle").val();
    var year = monthAndYear.split("-")[0];
    var month = monthAndYear.split("-")[1];
    if(monthAndYear == 0 || monthAndYear == ''){
        alert('Please Select Month');
        return;
    }
    //alert("Year: " + year + "Month: " + month);
    window.open('policeExpenseDetails.php?year=' + year + '&month=' + month+ '&vehicle=' + vehicle, '_blank');
    // alert(monthAndYear);
    // $.ajax({
    //     type: 'POST',
    //     url: 'phpScripts/Traffic-case-exp-action.php',
    //     data: {
    //         monthAndYear: monthAndYear,
    //         "action": 'extractDate'
    //     },
    //     dataType: 'json',
    //     beforeSend: function () {
    //         // Show image container
    //         $("#loading").show();
    //     },
    //     success: function (response) {

    //         alert(response)
    //     }, error: function (xhr) {
    //         //alert(xhr.responseText);
    //     },
    //     complete: function (data) {
    //         // Hide image container
    //         $("#loading").hide();
    //     }
    // });
}
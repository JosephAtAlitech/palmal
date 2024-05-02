var manageWarehouseTable = '';
$(document).ready(function () {

    manageWarehouseTable = $("#warehouseTable").DataTable({
        'ajax': 'phpScripts/warehouse-add.php',
        'order': [],
        'dom': 'Bfrtip',
        'buttons': [
            'pageLength', 'copy', 'csv', 'pdf', 'print'
        ],
        language: {
            processing: "<img src='../images/loader.gif'>"
        }

    });
    $('#form_addWarehouse').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        submitButton: '$form_addWarehouse button [type="Submit"]',
        submitHandler: function (validator, form, submitButton) {


            var warehouseName = $("#warehouseName").val();
            var warehouse_type = $('#warehouse_type').val();
            var address = $("#address").val();
            var position_type = $('#position_type').val();

            var fd = new FormData();

            fd.append('warehouseName', warehouseName);
            fd.append('warehouse_type', warehouse_type);
            fd.append('address', address);
            fd.append('position_type', position_type);
            fd.append('Action', 'warehouseAdd');

            $.ajax({
                url: "phpScripts/warehouse-add.php",
                method: "POST",
                data: fd,
                contentType: false,
                processData: false,
                datatype: "json",
                success: function (result) {
                    if (result != "success") {
                        alert(JSON.stringify(result));
                    } else if (result == "success") {
                        $('#addnewWorkshop').modal('hide');
                        $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Warehouse Added");
                        $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                            $(this).hide(); n();
                        });
                    }
                    //alert(JSON.stringify(result));
                    manageWarehouseTable.ajax.reload(null, false);
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
            warehouseName: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Please Insert Only Warehouse Name'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            
            warehouse_type: {
                validators: {
                 
                    notEmpty: {
                        message: 'Please Select Workshop Type'
                    },
                   
                }
            },
            address: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            }


        }
    });

    $('#form_editUnit').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        submitButton: '$form_editUnit button [type="Submit"]',
        submitHandler: function (validator, form, submitButton) {
            //alert('Calling');

            var name = $("#edit_warehouseName").val();
            var address = $("#edit_address").val();
            var status = $("#edit_status").val();
            var type = $("#edit_warehouse_type").val();
            var id = $("#edit_id").val();
            var position_type = $('#edit_position_type').val();
  
            var fd = new FormData();
            fd.append('id', id);
            fd.append('warehouseName', name);
            fd.append('address', address);
            fd.append('warehouse_type', type);
            fd.append('status', status);
            fd.append('Action', 'updateWatehouse');
            fd.append('position_type', position_type);

            $.ajax({
                url: "phpScripts/warehouse-add.php",
                method: "POST",
                data: fd,
                contentType: false,
                processData: false,
                datatype: "json",
                success: function (result) {
                    if (result != "success") {
                        alert(JSON.stringify(result));
                    } else if (result == "success") {
                        $('#editWarehouseModal').modal('hide');
                        $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Warehouse Added");
                        $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                            $(this).hide(); n();
                        });
                    }
                    //alert(JSON.stringify(result));
                    manageWarehouseTable.ajax.reload(null, false);
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
            edit_warehouseName: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Please Insert Only Name'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            edit_warehouse_type: {
                validators: {
                 
                    notEmpty: {
                        message: 'Please Select Workshop Type'
                    },
                   
                }
            },
            edit_address: {
                enabled: false,
                validators: {
                    stringLength: {
                        min: 0
                    },
                    notEmpty: {
                        message: 'Please Insert Only Address'
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


function editWarehouse(id) {
 
    $('#editWarehouseModal').modal('show');
  
    $.ajax({
        type: 'POST',
        url: 'phpScripts/warehouse-add.php',
        data: {
            id: id,
            'Action' : 'getWarehouseRow'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#editLoader").show();
        },
        success: function (response) {
            $('#edit_id').val(response.id);
            $('#edit_warehouseName').val(response.wareHouseName);
            $('#edit_address').val(response.wareHouseAddress);
            $('#edit_warehouse_type').val(response.type).trigger('change');
            $('#edit_position_type').val(response.position_type).trigger('change');
            $('#edit_Unitstatus').val(response.status);
        }
        , error: function (xhr) {
            alert(xhr.responseText);
        },
        complete: function (data) {
            // Hide image container
            $("#editLoader").hide();
        }
    });
}

// check avilability diuring save
function manageAvailability() {
    $("#loaderIcon").show();
    var warehouseName = $("#warehouseName").val();
    jQuery.ajax({
        url: "phpScripts/warehouse-add.php", 
         data: {
            'name': warehouseName,
            'Action' : 'checkAvailability'
        },
        type: "POST",
        success: function (data) {
            $("#manage-availability-status").html(data);
            if (data == "Available") {

                $('#btn_saveUnit').prop('disabled', false);

                //return true;    
            } else {

                $('#btn_saveUnit').prop('disabled', true);
                //return false;   
            }
            $("#loaderIcon").hide();
        },
        error: function () { }
    });
}
/*----------------End Unit save & validation parts----------------------*/

/*----------------Start Unit Edit & validation parts----------------------*/

$('input[name="editUnitDescription"]').keyup(function () {
    var data = $(this).val();
    var regx = /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/;

    //console.log( data + ' patt:'+ data.match(regx));

    if (data === '' || data.match(regx)) {
        $('.descriptionErr').fadeOut('slow');
        $('button[type="submit"]').prop('disabled', false);
    }
    else {
        $('.descriptionErr')
            .text('only Numeric Digits(0 to 9) allowed!')
            .css({ 'color': '#fff', 'background': '#990000', 'padding': '3px' })
            .fadeIn('fast');
        $('button[type="submit"]').prop('disabled', true);
    }
});


// check avilability diuring save
function manageEditAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "phpScripts/checkManageAvilability.php",
        data: 'name=' + $("#edit_UnitName").val() + "&page=" + $("#type").val() + "&id=" + $("#Uid").val(),
        type: "GET",
        success: function (data) {
            if (data == "Already used") {
                $("#manageEdit-availability-status").html("<span class='status-not-available' style='color: red;'> " + data + ".</span>");
                $('button[type="submit"]').prop('disabled', true);
            } else {
                $("#manageEdit-availability-status").html("<span class='status-available' style='color: green;'> " + data + ".</span>");

                $('button[type="submit"]').prop('disabled', false);
            }

            $("#loaderIcon").hide();
        },
        error: function () { }
    });
}
/*----------------End Unit Edit & validation parts----------------------*/

function confirmDelete(id) {

    if (confirm('Are you sure you want to delete?')) {
        $.ajax({
            type: 'POST',
            url: 'phpScripts/warehouse-add.php',
            data: {
                id: id,
                "Action": 'deleteWarehouse'
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
                manageWarehouseTable.ajax.reload(null, false);
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

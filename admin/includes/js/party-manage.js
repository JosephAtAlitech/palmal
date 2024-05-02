var manageCustomerSupplierTable;
/*--------- Start View customer /supplier from databse to datatable ---------------*/
$(document).ready(function () {
    // retrive customer or supplier data
    manageCustomerSupplierTable = $("#partyTable").DataTable({
        'ajax': 'phpScripts/party-action.php',
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
/*--------- End View customer /supplier from databse to datatable ---------------*/

//Edit Unit
function editCustomerSupplier(partyId, tblType) {
    $('#editCustomerSupplier').modal('show');
    var dataString = "id=" + partyId + "&action='getPartyRow'";
    //alert(dataString)
    $.ajax({
        type: 'POST',
        url: 'phpScripts/party-action.php',
        data: {
            id: partyId,
            action: 'getPartyRow'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            $('#Uid').val(response.id);
            $('#edit_partyName').val(response.partyName);
            $('#edit_tblCountry').val(response.tblCountry);
            $('#edit_tblCity').val(response.tblCity);
            $('#edit_locationArea').val(response.locationArea);
            $('#edit_partyAddress').val(response.partyAddress);
            $('#edit_partyType').val(response.partyType);
            $('#edit_contactPerson').val(response.contactPerson);
            $('#edit_partyPhone').val(response.partyPhone);
            $('#edit_altphoneNumber').val(response.partyAltPhone);
            $('#edit_partyEmail').val(response.partyEmail);
            $('#edit_remarks').val(response.remarks);
            $('#edit_status').val(response.status);
            $('#edit_tblType').val(response.tblType);
            $('#edit_Unitstatus').val(response.status);
        }, error: function (xhr) {
            alert(JSON.stringify(xhr));
        },
        complete: function (data) {
            $("#loading").hide();
        }
    });
}


/*----------------Start CRM Save & validation parts----------------------*/
$(document).ready(function () {
    $('#form_addCustomer').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        submitButton: '$form_addCustomer button [type="Submit"]',
        submitHandler: function (validator, form, submitButton) {
            var tblType = $("#add_tblType").val();
            var customerName = $("#add_customerName").val();
            var emailAddress = $("#add_emailAddress").val();
            var contactPerson = $("#add_contactPerson").val();
            var phoneNumber = $("#add_phoneNumber").val();
            var altphoneNumber = $("#add_altphoneNumber").val();
            var countryName = $("#add_countryName").val();
            var cityName = $("#add_cityName").val();
            var locationArea = $("#add_locationArea").val();
          
            var customerStatus = $("#add_customerStatus").val();
           
            var address = $("#add_address").val();
            var vendorType = $("#vendor_type").val();
           
          
            //var dataString = "CityName="+cityName+"&LocationArea="+locationArea+"&CountryName="+countryName+"&TblType="+tblType+"&CustomerName="+customerName+"&EmailAddress="+emailAddress+"&ContactPerson="+contactPerson+"&PhoneNumber="+phoneNumber+"&altPhoneNumber="+altphoneNumber+"&CountryName="+countryName+"&CityName="+cityName+"&CustomerType="+customerType+"&CustomerStatus="+customerStatus+"&CreditLimit="+creditLimit+"&Address="+address+"&saveCustomerSupplier=1";

            var fd = new FormData();
            fd.append('TblType', tblType);
            fd.append('CustomerName', customerName);
            fd.append('EmailAddress', emailAddress);
            fd.append('ContactPerson', contactPerson);
            fd.append('PhoneNumber', phoneNumber);
            fd.append('altPhoneNumber', altphoneNumber);
            fd.append('CountryName', countryName);
            fd.append('CityName', cityName);
            fd.append('LocationArea', locationArea);
            fd.append('CustomerType', 'Cash');
            fd.append('vendorType', vendorType);
            fd.append('CustomerStatus', customerStatus);
           
            fd.append('Address', address);
         
            fd.append('action', 'saveCustomerSupplier');

            $.ajax({
                type: 'POST',
                url: 'phpScripts/party-action.php',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response == 'success') {
                        manageCustomerSupplierTable.ajax.reload(null, false);
                        $("#add_customerName").val('');
                        $("#add_emailAddress").val('');
                        $("#add_contactPerson").val('');
                        $("#add_phoneNumber").val('');
                        $("#add_altphoneNumber").val('');
                        $("#add_countryName").val('');
                        $("#add_cityName").val('').trigger('change');
                        $("#add_locationArea").val('');
                        $("#add_customerType").val('');
                        $("#add_customerStatus").val('');
                        $("#add_creditLimit").val('');
                        $("#add_address").val('');
                        $("#add_customerSalesType").val('');

                        $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Successfully Saved");
                        $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                            $(this).hide(); n();
                        });
                        $('#addPartyModal').modal('hide');
                        $("#form_addCustomer").data('bootstrapValidator').resetForm();
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
            CustomerName: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Please Insert Only Name'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            EmailAddress: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9.!$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
                        message: 'Please insert eMail value only'
                    }
                }
            },
            ContactPerson: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Please Insert Contact Person'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            PhoneNumber: {
                validators: {
                    stringLength: {
                        min: 11,
                    },
                    notEmpty: {
                        message: 'Please Insert Phone Number'
                    },
                    regexp: {
                        regexp: /^[0-9 , ]+$/,
                        message: 'Mobile Ex: 01000000000'
                    }
                }
            },
            altPhoneNumber: {
                validators: {
                    regexp: {
                        regexp: /^[0-9 , - ]+$/,
                        message: 'Mobile Ex: 01000000000'
                    }
                }
            },
            CountryName: {
                validators: {
                    notEmpty: {
                        message: 'Please Insert Country Name'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            CityName: {
                validators: {
                    notEmpty: {
                        message: 'Please Insert City Name'
                    },
                }
            },
            LocationArea: {
                validators: {
                    notEmpty: {
                        message: 'Please Insert Location Area'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            Address: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Please Insert Address'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            }
        }
    });
});
/*----------------End CRM Save & validation parts----------------------*/

/*----------------Start CRM Edit & validation parts----------------------*/
$(document).ready(function () {
    $('#form_editCustomer').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        submitButton: '$form_editCustomer button [type="Submit"]',
        submitHandler: function (validator, form, submitButton) {
            var tblType = $("#edit_tblType").val();
            var tblUid = $("#Uid").val();
            var customerName = $("#edit_partyName").val();
            var emailAddress = $("#edit_partyEmail").val();
            var contactPerson = $("#edit_contactPerson").val();
            var phoneNumber = $("#edit_partyPhone").val();
            var altphoneNumber = $("#edit_altphoneNumber").val();
            var countryName = $("#edit_tblCountry").val();
            var cityName = $("#edit_tblCity").val();
            var locationArea = $("#edit_locationArea").val();
            var customerType = $("#edit_partyType").val();
            var customerStatus = $("#edit_status").val();
            var creditLimit = $("#edit_creditLimit").val();
            var address = $("#edit_partyAddress").val();
            var edittblType = $("#edit_tblType").val();
            var customerSalesType = $("#EdiCustomerSalesType").val();
            // var dataString = "TblUid="+tblUid+"&CityName="+cityName+"&LocationArea="+locationArea+"&CountryName="+countryName+"&TblType="+tblType+"&CustomerName="+customerName+"&EmailAddress="+emailAddress+"&ContactPerson="+contactPerson+"&PhoneNumber="+phoneNumber+"&altPhoneNumber="+altphoneNumber+"&CountryName="+countryName+"&CityName="+cityName+"&CustomerType="+customerType+"&CustomerStatus="+customerStatus+"&CreditLimit="+creditLimit+"&Address="+address+"&EdittblType="+edittblType+"&updateCustomerSupplier=2";
            var fd = new FormData();
            fd.append('TblType', tblType);
            fd.append('TblUid', tblUid);
            fd.append('CustomerName', customerName);
            fd.append('EmailAddress', emailAddress);
            fd.append('ContactPerson', contactPerson);
            fd.append('PhoneNumber', phoneNumber);
            fd.append('altPhoneNumber', altphoneNumber);
            fd.append('CountryName', countryName);
            fd.append('CityName', cityName);
            fd.append('LocationArea', locationArea);
            fd.append('CustomerType', customerType);
            fd.append('CustomerStatus', customerStatus);
            fd.append('CreditLimit', creditLimit);
            fd.append('Address', address);
            fd.append('CustomerSalesType', customerSalesType);
            fd.append('action', 'updateCustomerSupplier');

            $.ajax({
                type: 'POST',
                url: 'phpScripts/party-action.php',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response == 'success') {
                        manageCustomerSupplierTable.ajax.reload(null, false);
                        $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Updated Successfully");
                        $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                            $(this).hide(); n();
                        });
                    } else {
                        alert(response);
                    }
                }, error: function (xhr) {
                    alert(xhr.responseText);
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
            CustomerName: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Please Insert Only Name'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ \.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ \.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            EmailAddress: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9.!$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
                        message: 'Please insert eMail value only'
                    }
                }
            },
            ContactPerson: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Please Insert Contact Person'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ \.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ \.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            PhoneNumber: {
                validators: {
                    stringLength: {
                        min: 11,
                    },
                    notEmpty: {
                        message: 'Please Insert Phone Number'
                    },
                    regexp: {
                        regexp: /^[0-9 , ]+$/,
                        message: 'Mobile Ex: 01000000000'
                    }
                }
            },
            altPhoneNumber: {
                validators: {
                    regexp: {
                        regexp: /^[0-9 , ]+$/,
                        message: 'Mobile Ex: 01000000000'
                    }
                }
            },
            CountryName: {
                validators: {
                    notEmpty: {
                        message: 'Please Insert Country Name'
                    },
                }
            },
            CityName: {
                validators: {
                    notEmpty: {
                        message: 'Please Insert City Name'
                    },
                }
            },
            CustomerStatus: {
                validators: {
                    notEmpty: {
                        message: 'Please Insert Customer Status'
                    },
                }
            },
            CreditLimit: {
                validators: {

                    regexp: {
                        regexp: /^[+-]?([0-9]*[.])?[0-9]+$/,
                        message: 'Only Amount : 20000.00'
                    }
                }
            },
            Address: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    notEmpty: {
                        message: 'Please Insert Address'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ \.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ \.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            },
            LocationArea: {
                validators: {
                    stringLength: {
                        min: 3,
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9_ \.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ \.\-\s\,\;\:\/\&\$\%\(\)]+$/,
                        message: 'Please insert alphanumeric value only'
                    }
                }
            }


        }
    });
});
/*----------------End CRM Edit & validation parts----------------------*/

/*------------------ Start Save & Edit Item or Products select2 panel ---------------------- */

$("#add_cityName").select2({
    placeholder: "Select District Name",
    dropdownParent: $("#addnew"),
    allowClear: true
});
$("#edit_tblCity12").select2({
    placeholder: "Select District Name",
    dropdownParent: $("#editCustomerSupplier"),
    allowClear: true
});


/*------------------ End Save Item or Products select2 panel ---------------------- */



/*----------------Start CRM Edit & validation parts----------------------*/

function editDueClearMessage() {

}
function updateDue(partyId) {
    editDueClearMessage();
    $.ajax({
        url: "phpScripts/party-action.php",
        method: "GET",
        data: {
            "id": partyId,
            "action": 'openingDue'
        },
        dataType: "json",
        success: function (result) {
            $("#editOpeningDueModal").modal('show');
            $("#editOpeningDueId").val(result.id);
            $("#editOpeningDuePartyName").val(result.partyName);
            if (result.opening_due != '0.00') {
                $("#editOpeningDueInsert").val(result.opening_due).attr('disabled', true);
                $('#saveOpeningDue').attr("disabled", true);
            } else {
                $("#editOpeningDueInsert").val(result.opening_due).attr('disabled', false);
                $('#saveOpeningDue').attr("disabled", false);
            }
            //$("#initialPartyDue").html('<tr><td>'+result.partyName+'</td><td>'+result.opening_due+'</td></tr>');

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
$("#editOpeningDueForm").submit(function (e) {
    e.preventDefault();
    var partyId = $("#editOpeningDueId").val();
    var openingDue = $("#editOpeningDueInsert").val();
    var dueType = $("#editOpeningDueType").val();
    var action = 'UpdateOpeningDue';
    var id = $("#editId").val();
    var fd = new FormData();
    fd.append('partyId', partyId);
    fd.append('openingDue', openingDue);
    fd.append('dueType', dueType);
    fd.append('action', action);
    $.ajax({
        url: "phpScripts/party-action.php",
        method: "POST",
        data: fd,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (result) {
            alert(result);

            manageCustomerSupplierTable.ajax.reload(null, false);

        },
        error: function (response) {
            alert(response);
        },
        beforeSend: function () {
            $('#loading').show();
        },
        complete: function () {
            $('#loading').hide();
        }
    })
    $('#editOpeningDueForm').modal('hide');
})



function confirmDelete(id) {

    if (confirm('Are you sure you want to delete?')) {
        $.ajax({
            type: 'POST',
            url: 'phpScripts/party-action.php',
            data: {
                id: id,
                "action": 'deleteParty'},
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
                    manageCustomerSupplierTable.ajax.reload(null, false);
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
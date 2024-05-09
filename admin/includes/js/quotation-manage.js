
const queryString = window.location.search;
console.log(queryString);
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get('id')
console.log(id);

$(document).ready(function () {
    $('#mechanic').select2({
        width: "100%"
    });
    $('#engineer').select2({
        width: "100%"
    });
});


function setLowerBidder(){
    var token_id = $('#token_id').val();
    $.ajax({
        type: 'POST',
        url: 'phpScripts/quotationAdd.php',
        data: {
            id: id,
            token_id: token_id,
            "Action": 'setLowerBidder'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
          
            //alert(JSON.stringify(response));
           
            if(response.code != 200){
                $("#lowerBidderErrorMsg").html("<strong><i class='icon fa fa-check'></i>"+response.code+" ! </strong> "+response.msg);
                $("#lowerBidderErrorMsg").show().delay(4500).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });
            }
            $('#lowerBidderModal').modal('show');
            $("#bidderTableHeader").html('');
            $("#bidderInfo").html('');
            data ='';
            data1 ='';
            if(response.code == 200 || response.code == 201){
                data1 ='<th>Group</th><th>Price</th><th>Supplier</th>';
                data+='<tr><td>'+response.data.group_1+'</td><td>'+response.data.lower_amount_1+'</td><td>'+response.data.supplier_1+'</td></tr>'
                data+='<tr><td>'+response.data.group_2+'</td><td>'+response.data.lower_amount_2+'</td><td>'+response.data.supplier_2+'</td></tr>'
                data+='<tr><td>'+response.data.group_3+'</td><td>'+response.data.lower_amount_3+'</td><td>'+response.data.supplier_3+'</td></tr>'
                
                $("#bidderTableHeader").append(data1);
                $("#bidderInfo").append(data);
            }
           
        },
        error: function (xhr) {
            alert(xhr.responseText);
        },
        complete: function (data) {
            // Hide image container
            $("#loading").hide();
        }
    });
}



var manageTokenTable = '';
$(document).ready(function () {

    manageTokenTable = $("#quotationTable").DataTable({
        'ajax': 'phpScripts/quotationAdd.php?id=' + id,
        'order': [],
        'dom': 'Bfrtip',
        'buttons': [
            'pageLength', 'copy', 'csv', 'pdf', 'print'
        ],
        language: {
            processing: "<img src='../images/loader.gif'>"
        },
    });

    $('#quatationApprovalForm').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        submitButton: '$quatationApprovalForm button [type="Submit"]',
        submitHandler: function (validator, form, submitButton) {
            var token_id_for_approval = $("#token_id_for_approval").val();
            var id = $("#quote_id").val();
            var approvalDate = $("#approvalDate").val();
            var comment = $("#comment").val();
            var userType = $("#userType").val();
            var approvalStatus = $("#approvalStatus").val();
           
            var fd = new FormData();

            if(userType =='ed'){
                var file = $('#file')[0].files[0];
                fd.append('file', file);
            }
            fd.append('token_id_for_approval', token_id_for_approval);
            fd.append('id', id);
            fd.append('approvalDate', approvalDate);
            fd.append('comment', comment);
            fd.append('userType', userType);
            fd.append('approvalStatus', approvalStatus);
            fd.append('Action', 'approval');

            $.ajax({
                url: "phpScripts/quotationAdd.php",
                method: "POST",
                data: fd,
                contentType: false,
                processData: false,
                datatype: "json",
                success: function (result) {
                    if (result != "success") {
                        alert(JSON.stringify(result));
                    } else if (result == "success") {
                        $('#dgmApprovalModal').modal('hide');
                        $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Approved");
                        $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                            $(this).hide(); n();
                        });

                        $("#comment").val('');
                        $("#userType").val('');
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
            comment: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please Comment'
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

// PO section
function prGenerate(token_id) {
   // $("#quote_id_fr_pr").val(id);
    $("#token_id_fr_pr").val(token_id);
    $.ajax({
        type: 'POST',
        url: 'phpScripts/quotationAdd.php',
        data: {
            token_id: token_id,
            "Action": 'getPrInfo'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            $('#prGenerateModal').modal('show');
            //alert(JSON.stringify(response));
            if (response == 'mngmnt_not_approved') {
                $("#prModalErrorMsg").html("<strong><i class='icon fa fa-check'></i>Not Procced ! </strong> Management Not Approved");
                $("#prModalErrorMsg").show().delay(3500).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });
                $('.confirmPr').prop('disabled', true);
            }else{
                if(response == 'have_pr') {
                    $('.pr_label').text('Already PR Generated');
                    $('#view_pr_button').show();
                    $('#view_pr_button').prop('disabled', false);
                    $('.confirmPr').prop('disabled', true);
                } else if (response == 'dont_have_pr') {
                    $('.pr_label').text(' Do You Want to Generate PR? ');
                    $('#view_pr_button').prop('disabled', true);
                    $('.confirmPr').prop('disabled', false);
                } else {
                    alert(JSON.stringify(response));
                }
            }
        },
        error: function (xhr) {
            alert(xhr.responseText);
        },
        complete: function (data) {
            // Hide image container
            $("#loading").hide();
        }
    });
}

function confirmPr() {
    // var id = $("#quote_id_fr_pr").val();
    var token_id = $("#token_id_fr_pr").val();
    var pr_date = $("#pr_date").val();
//alert(id+' '+token_id+' '+po_date);
    $.ajax({
        type: 'POST',
        url: 'phpScripts/quotationAdd.php',
        data: {
            token_id: token_id,
            pr_date: pr_date,
            "Action": 'setPrGenerateDate'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            //alert(JSON.stringify(response));
            if (response == 'success') {
                $('#prGenerateModal').modal('hide');
                $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Pre Requisition");
                $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });

            } else {
                alert(JSON.stringify(response));
            }
            manageTokenTable.ajax.reload(null, false);
        }, error: function (xhr) {
            alert(xhr.responseText);
        },
        complete: function (data) {
            // Hide image container
            $("#loading").hide();
        }
    });
}



// PO section
function poApproval(token_id) {
    // $("#quote_id_fr_po").val(id);
    $("#token_id_fr_po").val(token_id);
 
    $.ajax({
        type: 'POST',
        url: 'phpScripts/quotationAdd.php',
        data: {
            token_id: token_id,
            "Action": 'poApprovalGet'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            $('#poApprovalModal').modal('show');
            //alert(JSON.stringify(response));
            if (response == 'ed_not_approved') {
                $("#poModalErrorMsg").html("<strong><i class='icon fa fa-check'></i>Not Procced ! </strong> ED Not Approved");
                $("#poModalErrorMsg").show().delay(3500).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });
                $('.confirmPo').prop('disabled', true);
            }else{
                if (response == 'have_po') {
                    $('.po_label').text('Already Have Purchase Oprder');
                    $('#view_bill_button').show();
                    $('#view_bill_button').prop('disabled', false);
                    $('.confirmPo').prop('disabled', true);
                } else if (response == 'dont_have_po') {
                    $('.po_label').text(' Do You Want to Confirm Purchase Order? ');
                    $('#view_bill_button').prop('disabled', true);
                    $('.confirmPo').prop('disabled', false);
                } else {
                    alert(JSON.stringify(response));
                }
            }
            
          
        },
        error: function (xhr) {
            alert(xhr.responseText);
        },
        complete: function (data) {
            // Hide image container
            $("#loading").hide();
        }
    });
}

function confirmPo() {
    // var id = $("#quote_id_fr_po").val();
    var token_id = $("#token_id_fr_po").val();
    var po_date = $("#po_date").val();
    //alert(id+' '+token_id+' '+po_date);
    $.ajax({
        type: 'POST',
        url: 'phpScripts/quotationAdd.php',
        data: {
            token_id: token_id,
            po_date: po_date,
            "Action": 'setPoApprovalDate'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            //alert(JSON.stringify(response));
            if (response == 'success') {
                $('#poApprovalModal').modal('hide');
                $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Purchase Order");
                $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });
            } else {
                alert(JSON.stringify(response));
            }
            manageTokenTable.ajax.reload(null, false);
        }, error: function (xhr) {
            alert(xhr.responseText);
        },
        complete: function (data) {
            // Hide image container
            $("#loading").hide();
        }
    });
}



// store section

function storeDeprt(token_id) {
    //$("#quote_id_fr_str").val(id);
    $("#token_id_fr_str").val(token_id);
    //alert(id)
    $.ajax({
        type: 'POST',
        url: 'phpScripts/quotationAdd.php',
        data: {
            token_id: token_id,
            "Action": 'productsAsPerPo'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            $('#storeApprovalModal').modal('show');

            //alert(response.date)
            if (response.msg == 'success') {
                var i = 0;
                data = '';
                $('#lowBidProducts').html('');
                for (i = 0; i < response['products'].length; i++) {
                    data += '<tr id="rowId_' + i + '"><td><input type="hidden" id="quote_details_id_' + i + '" value="' + response['products'][i].id + '"><input type="checkbox" id="checkbox_no_' + i + '" value="' + response['products'][i].id + '" ></td><td><input class="form-control" placeholder="Product Name" id="products_' + i + '" type="text" value="' + response['products'][i].req_product + '" readonly></td><td><input class="form-control" placeholder="Quantity" id="qty_' + i + '" type="number" value="' + response['products'][i].qty + '" readonly></td><td><input class="form-control" placeholder="Unit" id="unit_' + i + '" type="text" value="' + response['products'][i].unit + '" readonly></td><td><input class="form-control" placeholder="Total price" id="last_price_' + i + '" type="text" value="' + response['products'][i].audit_total_amount + '" readonly> </td></tr>';
                }
                $('#lowBidProducts').append(data);

            } else {
                alert(JSON.stringify(response));
            }
            if(response.status == 'po_not_generated'){
                $("#storeModalErrorMsg").html("<strong><i class='icon fa fa-check'></i>Not Procced ! </strong> PO Not Generated!");
                $("#storeModalErrorMsg").show().delay(2000).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });
                $('#storeConfirmBtn').prop('disabled', true);
            }else{
                if (response.date === null) {
                    $('#storeConfirmBtn').prop('disabled', false);
                } else {
                    $("#storeModalErrorMsg").html("<strong><i class='icon fa fa-check'></i>Not Procced ! </strong> Already Approved");
                    $("#storeModalErrorMsg").show().delay(2000).fadeOut().queue(function (n) {
                        $(this).hide(); n();
                    });
                    $('#storeConfirmBtn').prop('disabled', true);
                }
                
            }
            
        },
        error: function (xhr) {
            alert(xhr.responseText);
        },
        complete: function (data) {
            // Hide image container
            $("#loading").hide();
        }
    });
}


function confirmStore() {
    //var quoteId = $("#quote_id_fr_str").val();
    var tokenId = $("#token_id_fr_str").val();
    var store_date = $("#store_date").val();
    var storeComment = $("#storeComment").val();
    var quoteDetailsId = [];

    $('[id^="checkbox_no_"]').each(function () {
        if ($(this).is(':checked')) {
            quoteDetailsId.push($(this).val());
        }
    });

    if (quoteDetailsId == '') {
        $("#divModalErrorMsg").html("<strong>Error ! </strong> Select Product First!");
        $("#divModalErrorMsg").show().delay(2000).fadeOut().queue(function (n) {
            $(this).hide(); n();
        });
        return
    }

    var fd = new FormData();

    fd.append('tokenId', tokenId);
    fd.append('store_date', store_date);
    fd.append('storeComment', storeComment);
    fd.append('quoteDetailsId', quoteDetailsId);
    fd.append('Action', "setStoreApprovalInfo");
    $.ajax({
        url: 'phpScripts/quotationAdd.php',
        method: "POST",
        data: fd,
        contentType: "application/json",
        contentType: false,
        processData: false,
        datatype: "json",
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            //alert(JSON.stringify(response));
            if (response == 'success') {
                $('#storeApprovalModal').modal('hide');
                $("#storeComment").val('');
                $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Store Approved");
                $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });

            } else {
                alert(JSON.stringify(response));
            }
            manageTokenTable.ajax.reload(null, false);
        }, error: function (xhr) {
            alert(xhr.responseText);
        },
        complete: function (data) {
            // Hide image container
            $("#loading").hide();
        }
    });
}


// confirm Procurement section

function confirmProcurement(token_id) {
    //$("#quote_id_fr_prc").val(id);
    $("#token_id_fr_prc").val(token_id);
    $.ajax({
        type: 'POST',
        url: 'phpScripts/quotationAdd.php',
        data: {
            token_id: token_id,
            "Action": 'productsAsPerStore'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#loading").show();
        },
        success: function (response) {
            $('#procurementApprovalModal').modal('show');

            $('#storeCommentreview').val(response.storeComment)
            //alert(response.date)
            
            if (response.status === 'store_not_accepted') {
                $("#procurementModalErrorMsg").html("<strong><i class='icon fa fa-check'></i>Not Procced ! </strong> Store Not Accepted");
                    $("#procurementModalErrorMsg").show().delay(3500).fadeOut().queue(function (n) {
                        $(this).hide(); n();
                    });
                    $('#procurementConfirmBtn').prop('disabled', true);
            }else{
                if (response.date === null) {
                    $('#procurementConfirmBtn').prop('disabled', false);
                } else {
                    $("#procurementModalErrorMsg").html("<strong><i class='icon fa fa-check'></i>Not Procced ! </strong> Already Approved");
                    $("#procurementModalErrorMsg").show().delay(2000).fadeOut().queue(function (n) {
                        $(this).hide(); n();
                    });
                    $('#procurementConfirmBtn').prop('disabled', true);
                }
            }
      
            if (response.msg == 'success') {
                var i = 0;
                data = '';
                $('#finalProducts').html('');
                for (i = 0; i < response['products'].length; i++) {
                    data += '<tr id="rowId_' + i + '"><td><input type="hidden" id="quote_details_id_' + i + '" value="' + response['products'][i].id + '"><input class="form-control" placeholder="Product Name" id="products_' + i + '" type="text" value="' + response['products'][i].Product_name + '" readonly></td><td><input class="form-control" placeholder="Quantity" id="qty_' + i + '" type="number" value="' + response['products'][i].qty + '" readonly></td><td><input class="form-control" placeholder="Unit" id="unit_' + i + '" type="text" value="' + response['products'][i].unit + '" readonly></td><td><input class="form-control" placeholder="Total price" id="last_price_' + i + '" type="text" value="' + response['products'][i].audit_total_amount + '" readonly> </td></tr>';
                }
                $('#finalProducts').append(data);

            } else {
                alert(JSON.stringify(response));
            }
        },
        error: function (xhr) {
            alert(xhr.responseText);
        },
        complete: function (data) {
            // Hide image container
            $("#loading").hide();
        }
    });
}

function finalConfirmation() {
    var id = $("#quote_id_fr_prc").val();
    var token_id = $("#token_id_fr_prc").val();
    var final_confirm_date = $("#final_confirm_date").val();
    var procurement_comment = $("#procurement_comment").val();
    if (confirm('Do You Want To Confirm the Quotation?')) {
        $.ajax({
            type: 'POST',
            url: 'phpScripts/quotationAdd.php',
            data: {
                quoteId: id,
                tokenId: token_id,
                final_confirm_date: final_confirm_date,
                procurement_comment: procurement_comment,
                "Action": 'finalConfirmation'
            },
            dataType: 'json',
            beforeSend: function () {
                // Show image container
                $("#loading").show();
            },
            success: function (response) {
                //alert(JSON.stringify(response));
                if (response.msg == 'success') {
                    $('#procurementApprovalModal').modal('hide');
                    $("#procurement_comment").val('');
                    $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Procurement Approved");
                    $("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
                        $(this).hide(); n();
                    });
                } else {
                    alert(JSON.stringify(response));
                }
                manageTokenTable.ajax.reload(null, false);
            }, error: function (xhr) {
                alert(xhr.responseText);
            },
            complete: function (data) {
                // Hide image container
                $("#loading").hide();
            }
        });
    }

}


function confirmApproval(id, user) {
    let userType = user.replace(/^\'+|\'+$/g, '');

    $('#dgmApprovalModal').modal('show');

    switch (userType) {
        case 'auditor':
            $('#approvalType').text('Auditor Vetting');
            $('.txt-label').text('Audit Vetting');
            $('.file').hide();
            break;
        case 'mngmnt':
            $('#approvalType').text('Management Vetting');
            $('.txt-label').text('Management Recommendation');
            $('.file').hide();
            break;
        case 'md':
            $('#approvalType').text('MD approval');
            $('.txt-label').text('Comment');
            $('.file').hide();
            break;
        case 'ed':
            $('#approvalType').text('Management approval');
            $('.txt-label').text('Comment');
            $('.file').show();
            break;
        default:
        // code block
    }
    //$("#quote_id").val(id);
    $("#userType").val(userType);
    $("#token_id_for_approval").val(id);

    $.ajax({
        type: 'POST',
        url: 'phpScripts/quotationAdd.php',
        data: {
            token_id: id,
            userType: userType,
            "Action": 'checkAppovalStatus'
        },
        dataType: 'json',
        beforeSend: function () {
            // Show image container
            $("#editLoader").show();
        },
        success: function (response) {
            alert(JSON.stringify(response));
            if (response == 'revious_step_not_approved') {
                $("#approvalModalErrorMsg").html("<strong><i class='icon fa fa-check'></i>Not Procced ! </strong> Waiting for approval process!");
                $("#approvalModalErrorMsg").show().delay(3000).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });
                $('#approvalSaveBtn').prop('disabled', true);
                $('#comment').prop('disabled', true);
                $('#approvalStatus').prop('disabled', true);
            }
            else if (response == 'dont_have_approval') {
                $('#approvalSaveBtn').prop('disabled', false);
                $('#comment').prop('disabled', false);
                $('#approvalStatus').prop('disabled', false);
            }
            else {
                $("#approvalModalErrorMsg").html("<strong><i class='icon fa fa-check'></i>Not Procced ! </strong> Already Approved");
                $("#approvalModalErrorMsg").show().delay(3000).fadeOut().queue(function (n) {
                    $(this).hide(); n();
                });
                $('#approvalSaveBtn').prop('disabled', true);
                $('#comment').prop('disabled', true);
                $('#approvalStatus').prop('disabled', true);
            }
        }, error: function (xhr) {
            alert(JSON.stringify(xhr));
        },
        complete: function (data) {
            // Hide image container
            $("#editLoader").hide();
        }
    });

}



function generateBill() {
    var qid = $("#quote_id_fr_po").val();
    var tid = $("#token_id_fr_po").val();
    
    window.open('quatationDetails.php?id=' + tid + '&quote_id=' + qid, '_blank');
}

function generatePr() {
    var qid = $("#quote_id_fr_pr").val();
    var tid = $("#token_id_fr_pr").val();
    //window.location.href = 'prDetails.php?id=' + tid + '&quote_id=' + qid;
    window.open('prDetails.php?id=' + tid + '&quote_id=' + qid, '_blank');
}

function confirmDelete(id, token_id) {

    if (confirm('Are you sure you want to delete?')) {
        $.ajax({
            type: 'POST',
            url: 'phpScripts/quotationAdd.php',
            data: {
                id: id,
                token_id: token_id,
                "Action": 'deleteQuotation'
            },
            dataType: 'json',
            beforeSend: function () {
                // Show image container
                $("#editLoader").show();
            },
            success: function (response) {
                //alert(JSON.stringify(response));
                manageTokenTable.ajax.reload(null, false);
            }, error: function (xhr) {
                alert(xhr.responseText);
            },
            complete: function (data) {
                // Hide image container
                $("#editLoader").hide();
            }
        });
    } else {

    }
}


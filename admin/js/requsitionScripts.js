//for  save the  generate requisition reports data 

$("#form_vechicleRequisition").submit(function (){
    event.preventDefault();
    var i = 0;
    var vehicle_info_id=[];
	var vehicle_id=[];
	var officeCost=[];   
	var tokenCost=[];
	var othersCost=[];
	var type=[];
    //var riderId = $("#rider").val();
	$('input[type="checkbox"]').each(function() {
        if($("#"+$(this).attr('id')).prop('checked') == true){ 
			var infoId = $(this).attr('id');
			vehicle_info_id[i] = infoId+"@!@";
			vehicle_id[i] = $("#vehicle_"+infoId).val()+"@!@";
			officeCost[i] = $("#officeCbx_"+infoId).val()+"@!@";
			tokenCost[i] = $("#tokenCbx_"+infoId).val()+"@!@";
			othersCost[i] = $("#othersCbx_"+infoId).val()+"@!@";
			type[i] = $("#type_"+infoId).val()+"@!@";
			i = i + 1;
    		/*productId[i] = $(this).val()+"@!@";
    		*/
        }
	});
	var fd = new FormData();
      fd.append('vehicle_info_id',vehicle_info_id);
      fd.append('vehicle_id',vehicle_id);
      fd.append('officeCost',officeCost);
      fd.append('tokenCost',tokenCost);
      fd.append('othersCost',othersCost);
      fd.append('type',type);
      fd.append('action','saveVehicleRequisition');
    $.ajax({
		type: 'POST',
		url: 'vehicleRequsitionStatus.php',
		data: fd,
		contentType: false,
		processData: false,
		dataType: 'json',
		beforeSend: function(){
            $('#loading').show();
       },
		success: function(response){
			//alert(response);
			
			if(response == "Success"){
				$("#factory").trigger('change');
			    $("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Successfully Saved");
			    $("#divMsg").show().delay(2000).fadeOut().queue(function(n) {
				  $(this).hide(); n();
				});
				$('#rider').trigger('change');
			}
		},error: function (xhr) {
			alert(xhr.responseText);
		},
		complete:function(data){
            $('#loading').hide();
        }
	  });
})

//for loding the selectes items data for generating requisition data

$("#factory").change(function (){
    var factoryId = $("#factory").val();
    alert(factoryId);
	if(factoryId != "0" && factoryId != ""){
        
		$.ajax({
    		type: 'POST',
    		url: 'vehicleRequsitionStatus.php',
    		data: "action=loadCompletedProducts&id="+factoryId,
    		dataType: 'json',
			beforeSend: function(){
                $('#loading').show();
            },
    		success: function(response){
    			$("#table_completedProductList").html(response);
    			$("#btn_riderPaymentStatus").show();
    		},error: function (xhr) {
    			alert(xhr.responseText);
    			$("#btn_riderPaymentStatus").hide();
    		},
    		complete:function(data){
                $('#loading').hide();
            }
        });
    }else{
        $("#table_completedProductList").html("");
    }
})
// for checking the checked items data akter selecting the factory.
function checkedStatus(cbxIdThis){
	var cbxId = $(cbxIdThis).attr('id');
	if($("#"+cbxId).prop('checked') == true){
		$("#officeCbx_"+cbxId).attr("Disabled",false);
		$("#tokenCbx_"+cbxId).attr("Disabled",false);
		$("#othersCbx_"+cbxId).attr("Disabled",false);
		$('#btn_riderPaymentStatus').attr('Disabled',false);
	}else{
		$("#officeCbx_"+cbxId).val("");
		$("#tokenCbx_"+cbxId).val("");
		$("#othersCbx_"+cbxId).val("");
		
		$("#officeCbx_"+cbxId).attr("Disabled",true);
		$("#tokenCbx_"+cbxId).attr("Disabled",true);
		$("#othersCbx_"+cbxId).attr("Disabled",true);
		$('#btn_riderPaymentStatus').attr('Disabled',true);
	}
}

$("#checkall").change(function () {
    $('.cb-element').prop('checked',this.checked);
	
})

$('.cb-element').change(function () {
 if ($('.cb-element:checked').length == $('.cb-element').length){
  $('#checkall').prop('checked',true);
 }
 else {
  $('#checkall').prop('checked',false);
 }
});

$("#form_riderPaymentStatus").submit(function (){
    event.preventDefault();
    var i = 0;
    var productId=[];
    var riderId = $("#rider").val();
    $('input[name^="riderCbx"]').each(function() {
        if($("#"+$(this).attr('id')).prop('checked') == true){ 
    		productId[i] = $(this).val()+"@!@";
    		i = i + 1;
        }
	});
	var fd = new FormData();
      fd.append('rider',riderId);
      fd.append('order_details',productId);
      fd.append('action','saveRiderPaymentStatus');
    $.ajax({
		type: 'POST',
		url: 'phpScripts/riderPaymentStatusAction.php',
		data: fd,
		contentType: false,
		processData: false,
		dataType: 'json',
		beforeSend: function(){
            $('#loading').show();
       },
		success: function(response){
			if(response == "Success"){
				$("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Successfully Saved");
			    $("#divMsg").show().delay(2000).fadeOut().queue(function(n) {
				  $(this).hide(); n();
				});
				$('#rider').trigger('change');
			}
		},error: function (xhr) {
			alert(xhr.responseText);
		},
		complete:function(data){
            $('#loading').hide();
        }
	  });
})

function changeRiderDelivery(id){
    $.ajax({
		type: 'POST',
		url: 'phpScripts/riderPaymentStatusAction.php',
		data: "action=saveRiderPaymentStatusSingle&id="+id,
		dataType: 'json',
		beforeSend: function(){
            $('#loading').show();
       },
		success: function(response){
			if(response == "Success"){
				$("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Successfully Updated");
			    $("#divMsg").show().delay(2000).fadeOut().queue(function(n) {
				  $(this).hide(); n();
				});
				$('#rider').trigger('change');
			}else{
			    alert(response);
			}
		},error: function (xhr) {
			alert(xhr.responseText);
		},
		complete:function(data){
            $('#loading').hide();
        }
	  });
}
    var manageExampleCompany;
	$(document).ready(function() {
		// manage Shop table
		//alert($("#sortData").val());
		manageExampleCompany = $("#example_company").DataTable({
			
			'ajax': 'trip-sheetsView.php?sortData='+$("#sortData").val(),
			'order': [],
			'dom': 'Bfrtip',
			'buttons': [
				'pageLength','copy', 'csv', 'pdf', 'print'
			],
			language: {
				processing: "<img src='../images/loader.gif'>"
			},
			processing: true
		});
	});
	$( "#sortData" ).change(function() {
	    manageExampleCompany.ajax.url("trip-sheetsView.php?sortData="+$("#sortData").val()).load();
	}); 
	
	function EditTripSheet(id){
	    //alert(id);
	    //var id = $(this).data('id');
        $("#tripId").val(id);
        $("#modeStatus").val("Edit");
        $('#addnew').modal('show');
        $("#previousLog").show();
        $("#lblPreviousLog").show();
        
        
        $.ajax({
            type: 'POST',
            url: 'tripSheet-row.php',
            data: {id:id},
            dataType: 'json',
            beforeSend: function(){
                // Show image container
                $("#editLoader").show();
           },
            success: function(response){
            //alert(JSON.stringify(response));
            
            $('#tripId').val(response.id);
            $('#start_dt').val(response.trip_start_date);
            $('#end_dt').val(response.trip_end_date);
            $('#travelDistance').val(response.travel_distance);
            $('#fuelIssue').val(response.fuel_issue);
            $('#vftFuel').val(response.vft_fuel);
            $('#units').val(response.vft_vehicle_no).trigger('change');
            $('#previousLog').val(response.vft_km);
              
            },error: function (xhr) {
                alert(xhr.responseText);
            },
            complete:function(data){
                // Hide image container
                $("#editLoader").hide();
            }
        });
    }
    
	
	function deleteTrip(id){
	    $('#deleteTrip').modal('show');
        $.ajax({
            type: 'POST',
            url: 'tripSheet-row.php',
            data: {id:id},
            dataType: 'json',
            beforeSend: function(){
                // Show image container
                $("#editLoader").show();
           },
            success: function(response){
            //alert(JSON.stringify(response));
            $('#deletid').val(response.id);
            $('#deletTripid').html(response.id);
            
              
            },error: function (xhr) {
                alert(xhr.responseText);
            },
            complete:function(data){
                // Hide image container
                $("#editLoader").hide();
            }
        });
    }
	
	
	
	
	
	$(document).ready(function() {
	  $("#units").select2({
		dropdownParent: $("#addnew")
	  });
	});
	$(document).ready(function() {
	  $("#SupervisorName").select2({
		dropdownParent: $("#addnew")
	  });
	});
	
	//  plane fiels view vehicle Number Search
	$("#vehicleNumber12").select2( {
	placeholder: "Select vehicle Number",
	allowClear: true
	} );
	
 
	function unitsAvailability() {
	    var x = document.getElementById("units");
		UnitValue = x.value;
		jQuery.ajax({
		url: "check_Avilability.php",
		data: {UnitValue:UnitValue},
		type: "POST",
		dataType: 'json',
		success:function(data){
		    $("#editid").val(data.id);
		},
		error:function (){}
		});
	}
	
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
                        notEmpty: {
                            message: 'The Field is required'
                        }
                    }
				},
				travelDistance: {
                        validators: {
                            stringLength: {
                                min: 1,
                            },
                            notEmpty: {
                                    message: 'Travel KM required'
                            },
        					regexp: {
        						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
        						message: 'Please insert alphanumeric value only'
        					}
                        }
				},
				fuelIssue: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
				},
				vftFuel: {
                validators: {
                    stringLength: {
                        min: 1,
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
                    notEmpty: {
                        message: 'The Field is required'
                    }
                }
				},
				travelDistance: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
				},
				fuelIssue: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
				},
				vftFuel: {
                validators: {
                    stringLength: {
                        min: 1,
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

	var userselect = document.getElementById('input');
function AddNewTrip(){
    $("#modeStatus").val("Add");
    $("#tripId").val("");
    $('#addnew').modal('show');
    $("#previousLog").hide();
    $("#lblPreviousLog").hide();
        $(".exampleEnd").val(date.getMonth()+1 + '/' + date.getDate() + '/' + date.getFullYear()+' 8:00 AM');
	    date.setDate(date.getDate()-1);
	    $(".example").val(date.getMonth()+1 + '/' + date.getDate() + '/' + date.getFullYear()+' 8:00 AM');
        $('#travelDistance').val('0');
        $('#fuelIssue').val('');
        $('#vftFuel').val('0');
        $('#units').val('').trigger('change');
        $('#previousLog').val('0');
      
    
}
$(function(){
  /*$('.EditTripSheet').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $("#tripId").val(id);
    $("#modeStatus").val("Edit");
    $('#addnew').modal('show');
    $("#previousLog").show();
    $("#lblPreviousLog").show();
    getRow(id);
  });

  $('.deleteTrip').click(function(e){
    e.preventDefault();
    $('#deleteTrip').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });*/
});
/*
function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'tripSheet-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#tripId').val(response.id);
      $('#deletid').val(response.id);
      $('#deletTripid').html(response.id);
      $('#start_dt').val(response.trip_start_date);
      $('#end_dt').val(response.trip_end_date);
      $('#travelDistance').val(response.travel_distance);
      $('#fuelIssue').val(response.fuel_issue);
      $('#vftFuel').val(response.vft_fuel);
      $('#units').val(response.vft_vehicle_no).trigger('change');
      $('#previousLog').val(response.vft_km);
      
	}
  });
}*/
//date_default_timezone_set('Asia/Dhaka');
	$('.example').datetimepicker();
	$('.exampleEdit').datetimepicker();
	$('.exampleEnd').datetimepicker();
	$('.exampleEditEnd').datetimepicker();
	var date = new Date();
	$(".exampleEnd").val(date.getMonth()+1 + '/' + date.getDate() + '/' + date.getFullYear()+' 8:00 AM');
	date.setDate(date.getDate()-1);
	$(".example").val(date.getMonth()+1 + '/' + date.getDate() + '/' + date.getFullYear()+' 8:00 AM');
	

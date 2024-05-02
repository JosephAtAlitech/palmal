<?php include 'includes/session.php'; 
	include '../timezone.php'; 
	$today = date('Y-m-d');
	$year = date('Y');
	if(isset($_GET['year'])){
    $year = $_GET['year'];
	}
	$first_date = date('Y-m-d',strtotime('first day of this month'));
	$last_date = date('Y-m-d',strtotime('last day of this month'));
	$first_day_of_year=date('Y-m-d', strtotime('first day of january this year'));
?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
<link rel="stylesheet" href="select2/select2.min.css" />
<script type='text/javascript'>
	function showMyData(){  
	alert('Generate Reports From Start To End Date: '+$('#startDate').val());
	$.ajax({ 
			type: "POST",
			url :"vehecleWiseFuelCostingReportView.php",
			
			data:{
				 	cName:$('#vehicleNumber').val(),
				 	fName:$('#factoryName').val(),
				 	startDate:$('#startDate').val(),
					endtDate:$('#endtDate').val()
			 },
			 success: function(data){
				// alert(data);
				 $("#myDiv").html(data);
			 }
	});
	}
</script>

<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
	
	
	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Vehicle Wise Fuel Costing Reports 
		</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vehicle Wise Fuel Costing Reports </li>
      </ol>
    </section>
    <!-- Main content -->
		<section class="content">
		<div class="row">
        <div class="col-xs-12">
			<div class="box">
				<div class="box-body" style="height: auto;"> 
				<h4 style="color: gray;text-align: center;"> Vehicle Wise Fuel Costing Reports </h4><hr>
					<div class="col-md-12">
						<form  class="form-horizontal" method="POST">
							<div class="col-md-3">
								<label>Factoory Name</label>
									<select class="form-control" id="factoryName" name="factoryName">
										<option value="" selected>~~Factoory Name~~</option>
										<?php
											  $sql = "SELECT id,branch_name FROM `branch_master` WHERE status='Active'  ORDER BY `branch_master`.`branch_name` ASC";
											  $query = $conn->query($sql);
											  while($prow = $query->fetch_assoc()){
												echo "
												  <option value='".$prow['id']."'>".$prow['branch_name']."</option>
												";
											  }
											?>
									</select>
							</div>
							<div class="col-md-3">
								<label>Vehicle Number</label>
									<select class="form-control" id="vehicleNumber" name="vehicleNumber"></select>
							</div>	
							<div class="col-md-2">
								<label>Start Date</label>
								<input name="min" id="startDate" class="form-control datetimepicker" placeholder="Select Start date" name="startDate" value="<?php echo date('Y-m-d'); ?>" type="date" data-date-format="yyyy-mm-dd" style="padding: 0%;"/>					
							</div>
							<div class="col-md-2">
								<label>End Date</label>
								<input name="max" id="endtDate" class="form-control datetimepicker" placeholder="Select End date" name="endtDate" type="date" value="<?php echo date('Y-m-d'); ?>" data-date-format="yyyy-mm-dd" style="padding: 0%;"/>
							</div>
							<div class="col-md-2" style="margin-top: 2%;">
								<button type="button" id="btndisplay" class="btn btn-default btn-flat pull-left" name="btndisplay" onclick="showMyData();" style="background-color: #3f3e93;color: #fff;border-color: #3f3e93;"><i class="fa fa-search"></i> Search </button>
							</div>
						</form><br><br><br><br>
						<!--input type="submit" id="btndisplay" value="show" onclick="showMyData();"-->
						<div id="myDiv">
						
						</div>
					</div>
				</div>
            </div>
         </div>
        </div>
		</section> 
	<!-- Main content 02-->
		
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php //include 'includes/thana-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src="select2/select2.min.js"></script>
<script>
    $("#vehicleNumber").select2( {
    	placeholder: "Select vehicle number",
    	dropdownAutoWidth: true,
		width: '100%',
    	allowClear: true
    	} );
	$("#factoryName").select2( {
    	placeholder: "Select factoory name",
    	dropdownAutoWidth: true,
		width: '100%',
    	allowClear: true
    	} );

// Serach Factory wise Vehicle name
    $("#factoryName").change(function(){
    var facatoryId = $(this).val();
    var action = "fetchFactory";
	//alert(facatoryId);
    $.ajax({
		url:"fetchvehicle.php",
		method:"POST",
		data:{action:action, facatoryId:facatoryId},
		dataType:"json",
		beforeSend: function(){
                // Show image container
                $("#editLoader").show();
           },
		success:function(data)
		{
		    $("#vehicleNumber").empty().trigger('change');
		    $("#vehicleNumber").append("<option value=''>~~ Select Vehicle ~~</option>");
		    for(var i=0; i<data.length; i++){
			    $("#vehicleNumber").append("<option value='"+data[i].id+"'>"+data[i].vehicle_number+"</option>");
			    
			}
			$("#factoryID").val("<input value='"+data[i].bID+"'></input>");
		},
		complete:function(data){
                // Hide image container
                $("#editLoader").hide();
				
            }
	    });
    });


$(function(){
  $('.editSoldiers').click(function(e){
    e.preventDefault();
    $('#editSoldiers').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.deleteSoldiers').click(function(e){
    e.preventDefault();
    $('#deleteSoldiers').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'soldiers-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#soldiersid').val(response.id);
      $('#del_solid').val(response.id);
      $('#soldiers_Id').val(response.police_id);
      $('#del_soldiers_Id').html(response.police_id);
      $('#soldiersname').val(response.name);
      $('#soldiersPhone').val(response.phone);
      $('#soldiersaddress').val(response.address);
      $('#soldiersstatus').val(response.status);
    }
  });
}

	function checkAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_availability.php",
		data:'policeCode='+$("#policeCode").val(),
		type: "POST",
		success:function(data){
		$("#user-availability-status").html(data);
		$("#loaderIcon").hide();
		},
		error:function (){}
		});
	}
</script>
<script>

$(document).ready(function() {
    $('#example_company').DataTable( {
      //responsive: true
	  dom: 'Bfrtip',
        buttons: [
            'pageLength','copy', 'csv', 'pdf', 'print'
        ]
    })
  })
</script>
</body>
</html>

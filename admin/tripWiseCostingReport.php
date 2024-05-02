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
<script type='text/javascript'>
	function showMyData(){  
	alert('Generate Reports For Trip Number : '+$('#tripNumber').val());
	$.ajax({ 
			type: "POST",
			url :"tripWiseCostingReportView.php",
			
			data:{
				 	cName:$('#tripNumber').val(),
					startDate:$('#startDate').val()
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
			Trip Wise Costing Reports 
		</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Trip Wise Costing Reports </li>
      </ol>
    </section>
    <!-- Main content -->
		<section class="content">
		<div class="row">
        <div class="col-xs-12">
			<div class="box">
				<div class="box-body" style="height: auto;"> 
				<h4 style="color: gray;text-align: center;"> Trip Wise Costing Reports </h4><hr>
					<div class="col-md-12">
						<form  class="form-horizontal" method="POST">
							<div class="col-sm-2"></div>
							<div class="col-sm-6">
								<label for="categoryName" class="control-label">Trip Number :</label>
								<select class="form-control"  id="tripNumber" name="tripNumber" required>
									<option value="" selected>~~ Select Trip ~~</option>
									<?php
									  $sql = "SELECT id,trip_number FROM `trip_sheets` ORDER BY `trip_sheets`.`id`  DESC";
									  $query = $conn->query($sql);
									  while($prow = $query->fetch_assoc()){
										echo "
										  <option value='".$prow['id']."'> Trip Number : ".$prow['trip_number']."</option>
										";
									  }
									?>
								</select>
							</div>
							<input id="startDate" class="form-control" placeholder="Select Start date" name="startDate" type="hidden" />					
							
							
							<div class="col-md-2">
								<button type="button" id="btndisplay" class="btn btn-default btn-flat pull-left" name="btndisplay" onclick="showMyData();" style="background-color: #3f3e93;color: #fff;margin-top: 19%;border-color: #3f3e93;"><i class="fa fa-search"></i> Search </button>
								
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
<script>
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

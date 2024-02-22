<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vehicle Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vehicle Information</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
	  <link rel="stylesheet" href="buttons.dataTables.min.css"/>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
				<a href="#addnewVehicle" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Vehicle</a>
				<a href="vehicle-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
				<a href="vehicle-inactive.php" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-eye"></i> In-Active </a>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>VehicleInfo</th>
					<th>RegistrationInfo</th>
					<th>InsuranceInfo</th>
					<th>PollutionInfo</th>
					<th>PermitInfo</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT * FROM `vehicle_master` WHERE delete_status!='Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td><u>V No</u>: ".$row['vehicle_number']." - ".$row['year_of_manufacture']."<br><u>C No</u>: ".$row['chasis_number']."<br><u>E No</u>: ".$row['engin_number']."</td>
							<td><u>RegD</u>: ".$row['registration_date']."<br><u>RegStD</u>: ".$row['reg_start_date']."<br><u>RegEtD</u>: ".$row['reg_end_date']."</td>
							<td><u>Insd</u>: ".$row['insu_start_date']."<br><u>InsEd</u>: ".$row['insu_end_date']."</td>
							<td><u>PollSD</u>: ".$row['pollu_start_date']."<br><u>PollED</u>: ".$row['pollu_end_date']."</td>
							<td><u>Permit</u>: ".$row['permits']." <br><u>PermSD</u>: ".$row['per_start_date']."<br><u>PermED</u>: ".$row['per_end_date']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm activeVehicle btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-trash'></i> Active</button>
								<button class='btn btn-success btn-sm editBranch btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-eye'></i></button>
								<button class='btn btn-primary btn-sm deleteBranch btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-print'></i></button>
							</td>
                        </tr>
                      ";
					}
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/vehicle-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.activeVehicle').click(function(e){
    e.preventDefault();
    $('#activeVehicle').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.deleteVehicle').click(function(e){
    e.preventDefault();
    $('#deleteVehicle').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'vehicle-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#deletid').val(response.id);
      $('#activeVehicleid').val(response.id);
      $('#vehicleNumber').val(response.vehicle_number);
      $('#deletvehicleNumber').html(response.vehicle_number);
      $('#InActivevehicleNumber').val(response.vehicle_number);
      $('#statusvehicleNumber').val(response.delete_status);
	  
      $('#RegistrationDate').val(response.registration_date);
      $('#MakersName').val(response.makers_name);
      $('#YearOfManufacture').val(response.year_of_manufacture);
      $('#ChesisNumber').val(response.chasis_number);
      $('#EnginNumber').val(response.engin_number);
      
	  $('#RegistrationStartDate12').val(response.reg_start_date);
      $('#RegistrationEndDate').val(response.reg_end_date);
      
	  $('#InsuranceStartDate').val(response.insu_start_date);
      $('#InsuranceEndDate').val(response.insu_end_date);
      $('#Permit').val(response.permits);
	  $('#PermitStartDate').val(response.per_start_date);
      $('#PermitEndDate').val(response.per_end_date);
	  $('#PollutionStartDate').val(response.pollu_start_date);
      $('#PollutionEndDate').val(response.pollu_end_date);
      $('#BranchStatus').val(response.branch_status);
      $('#Users').val(response.users);
	  
		$('#RegistrationCirtificate12').html("<img src='../images/registration/"+response.registration_cirtificate+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#Insurancecertificate12').html("<img src='../images/insurance/"+response.insurance_cirtificate+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#PermitCirtificate12').html("<img src='../images/permit/"+response.permit_cirtificate+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#PollutionCirtificate12').html("<img src='../images/pollution/"+response.pollution_cirtificate+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
	  //$('#RegistrationCirtificate').val(response.registration_cirtificate);
	  //$('#Insurancecertificate').val(response.insurance_cirtificate);
      //$('#PermitCirtificate').val(response.permit_cirtificate);
      //$('#PollutionCirtificate').val(response.pollution_cirtificate);
	}
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

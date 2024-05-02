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
        Driver Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Driver Information</li>
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
				<a href="#addnewDriver" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Driver</a>
				<a href="driver-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
				<a href="driver-inactive.php" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-eye"></i> In-Active </a>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>DriverInfo</th>
					<th>DriverImage</th>
					<th>LicenceInfo</th>
					<th>Status</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT * FROM `driver_master`  WHERE status!='Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td><u>Diver Name</u>: ".$row['driver_name']." <br><u>Phone</u>: ".$row['phone']."<br><u>Alt Phone</u>: ".$row['alter_phone']."</td>
							<td><img src='../images/driver/".$row['dri_image']."' style='width:100px height:120px;' /></td>
							<td><u>Licence No</u>: ".$row['licence_number']."<br><u>Licence Exp Date</u>: ".$row['licence_exp_date']."<br><u>Create Date</u>: ".$row['licence_exp_date']."</td>
							<td>".$row['status']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm activeDriver btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-trash'></i> Active</button>
								<a href='driverHistory-viewpdf.php?vid=".$row['id']."' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i> Print </a>
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
  <?php include 'includes/driver-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.EditDriver').click(function(e){
    e.preventDefault();
    $('#EditDriver').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.activeDriver').click(function(e){
    e.preventDefault();
    $('#activeDriver').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'driver-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#edidrivertid').val(response.id);
      $('#deletid').val(response.id);
      $('#deletid12').val(response.id);
      $('#driver_name12').val(response.driver_name);
      $('#deldriver_name').html(response.driver_name);
      $('#status').val(response.status);
      $('#alter_phone').val(response.alter_phone);
      $('#DriverLicenceNumber').val(response.licence_number);
      $('#licence_exp_date').val(response.licence_exp_date);
      $('#ChesisNumber').val(response.chasis_number);
      $('#EnginNumber').val(response.engin_number);
      
		$('#dri_licence_image').html("<img src='../images/driver/"+response.dri_licence_image+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#dri_image').html("<img src='../images/driver/"+response.dri_image+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#drice_aadhar_card').html("<img src='../images/driver/"+response.drice_aadhar_card+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#drive_bank_accounts').html("<img src='../images/driver/"+response.drive_bank_accounts+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
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

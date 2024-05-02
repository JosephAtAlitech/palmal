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
        Tyre Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tyre Information</li>
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
				<a href="#addnewTyre" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add New Tyre</a>
				<a href="driver-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
				<a href="driver-inactive.php" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-eye"></i> In-Active </a>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>TyreInfo</th>
					<th>VehicleInfo</th>
					<th>TyreCost</th>
					<th>Status</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT * FROM `tyre_master` WHERE status!='Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td><u>Tyre No</u>: ".$row['tyre_no']." <br><u>Tyre Company</u>: ".$row['tyre_company']."<br><u>Tyre Model</u>: ".$row['tyre_model']."</td>
							<td><u>Vehicle NO</u>: ".$row['vehicle_no']."<br><u>Supervisor</u>: ".$row['supervisor']."</td>
							<td><u>Tyre Cost</u>: ".$row['tyre_cost']."<br><u>Create Date</u>: ".$row['create_date']."<br><u>Date</u>: ".$row['date']."</td>
							<td>".$row['status']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm ActiveTyre btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-edit'></i> Active</button>
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
  <?php include 'includes/tyre-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.ActiveTyre').click(function(e){
    e.preventDefault();
    $('#ActiveTyre').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.deleteDriver').click(function(e){
    e.preventDefault();
    $('#deleteDriver').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'tyre-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#tyreid').val(response.id);
      $('#Activeid').val(response.id);
      $('#tyreDate').val(response.date);
      $('#vehicle_no').val(response.vehicle_no);
      $('#tyre_type').val(response.tyre_type);
      $('#tyre_position').val(response.tyre_position);
      $('#tyre_no').val(response.tyre_no);
      $('#tyre_company').val(response.tyre_company);
      $('#tyre_model').val(response.tyre_model);
      $('#tyre_cost').val(response.tyre_cost);
      $('#supervisor').val(response.supervisor);
      $('#ActiveStatus').val(response.status);
      	
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

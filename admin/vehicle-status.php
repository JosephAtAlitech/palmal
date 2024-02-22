<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
	
	<link rel="stylesheet" href="select2/select2.min.css" />
	
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Vehicle Status Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Party Status Information</li>
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
				<b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
			</div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>SL</th>
					<th>Vehicle Number</th>
					<th>Trip Number</th>
					<th>Driver Name</th>
					<th>Helper Name</th>
					<th>Status</th>
					<th style="width: 20%;">Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT vehicle_master.id,vehicle_master.vehicle_number,vehecle_status.trip_id,vehecle_status.vehecle_id,vehecle_status.driver_id,driver_master.driver_name,vehecle_status.helper_id,
							helper_master.helper_name,vehecle_status.status,vehecle_status.delete_status
								FROM `vehicle_master`
								LEFT JOIN vehecle_status ON vehecle_status.vehecle_id=vehicle_master.id
								LEFT JOIN driver_master ON driver_master.id=vehecle_status.driver_id
								LEFT JOIN helper_master ON helper_master.id=vehecle_status.helper_id group by vehicle_master.id";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
							if($row['trip_id']== ''|| $row['delete_status']== 2){
								//$trip_status ="<a href='#tripAdd' data-toggle='modal' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-plus'></i> Trip Add </a>";
								$trip_status ="<button class='btn btn-primary btn-sm tripAdd ' data-id='".$row['id']."'><i class='fa fa-plus'></i> Trip Add</button>";
							 }
							 else{$trip_status ='Trip No: '.$row['trip_id'].' '; }
							 
							if($row['driver_id']== ''|| $row['delete_status']== 2){
								$driver_status ="<button class='btn btn-primary btn-sm driverAdd ' data-id='".$row['id']."'><i class='fa fa-plus'></i> Add Driver </button>";
							 }
							 else{$driver_status =$row['driver_name'];}
							 
							 if($row['helper_id']== ''||$row['delete_status']== 2){
								$helper_status ="<button class='btn btn-primary btn-sm helperAdd ' data-id='".$row['id']."'><i class='fa fa-plus'></i>Add Helper </button>";
							 }
							 else{$helper_status =$row['helper_name'];}
							 
							 if($row['status']== ''||$row['delete_status']== 2){
								$vc_status ='<span class="label label-danger">Idle ..</span>';
							 }
							 else if($row['status']== 'Warning'||$row['delete_status']== 2){
								 $vc_status ='<h4><span class="label label-warning">Loaded ..</span></h4>';
								 }
							else if($row['status']== 'Running'||$row['delete_status']== 2){
								 $vc_status ='<h4><span class="label label-success">Running ..</span></h4>';
								 }
							 
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td>".$row['vehicle_number']."</td>
							<td>".$trip_status."</td>
							<td>".$driver_status."</td>
							<td>".$helper_status."</td>
							<td>".$vc_status."</td>
							<td>
							";
							if($row['status']== 'Running' || $row['status']== '' || $row['driver_id']== ''){
								echo "<button class='btn btn-danger disabled btn-sm  '><i class='fa fa-assistive-listening-systems'></i> Start Trip </button>";
							}
							else{
								echo "<button class='btn btn-warning btn-sm startVeStatus ' data-id='".$row['id']."'><i class='fa fa-assistive-listening-systems'></i> Start Trip </button>";
							}
							if($row['status']== 'Running'){
								echo"<button style='margin: 1%;' class='btn btn-success  btn-sm deleteVeStatus ' data-id='".$row['id']."'><i class='fa fa-eye-slash'></i> End Trip </button>";
							}
							else{
								echo"<button style='margin: 1%;' class='btn btn-primary disabled btn-sm '><i class='fa fa-eye-slash'></i> End Trip </button>";
							}
							echo"</td>
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
  <?php include 'includes/vehicleStatus-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	
	function phoneAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_Avilability.php",
		data:'PhoneCheck='+$("#PhoneCheck").val(),
		type: "POST",
		success:function(data){
		$("#phone-availability-status").html(data);
		$("#loaderIcon").hide();
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
				companyName: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Company Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				contactPerson: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Contact Person'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
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
							message: 'Please Insert Only Address'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				
				phoneNumber: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Phone Number'
						},
						regexp: {
							regexp: /^(?:\+?88)?01[15-9]\d{8}$/,
							message: 'Mobile Ex: 8801823835334'
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
				companyName: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Company Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				contactPerson: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Contact Person'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
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
							message: 'Please Insert Only Address'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				
				phoneNumber: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Phone Number'
						},
						regexp: {
							regexp: /^(?:\+?88)?01[15-9]\d{8}$/,
							message: 'Mobile Ex: 8801823835334'
						}
					}
				}
				
			}
        })	
	}); 
	
</script>
<script>

$(function(){
  $('.tripAdd').click(function(e){
    e.preventDefault();
    $('#tripAdd').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.driverAdd').click(function(e){
    e.preventDefault();
    $('#driverAdd').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  
  $('.helperAdd').click(function(e){
    e.preventDefault();
    $('#helperAdd').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  
  $('.deleteVeStatus').click(function(e){
    e.preventDefault();
    $('#deleteVeStatus').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  
  $('.startVeStatus').click(function(e){
    e.preventDefault();
    $('#startVeStatus').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'vehicleStatus-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#veid').val(response.veId);
	  $('#veid1').val(response.veId);
      $('#veid12').val(response.veId);
      $('#veid123').val(response.veId);
      $('#veid1234').val(response.veId);
	  $('#veid12345').val(response.veId);
      $('#vehicleNumber').val(response.vehicle_number);
      $('#vehicleNumber12').val(response.vehicle_number);
      $('#vehicleNumber123').val(response.vehicle_number);
      $('#vehicleNumber1234').html(response.vehicle_number);
      $('#vehicleNumber12345').html(response.vehicle_number);
	  $('#driverid1').val(response.driver_id);
	  $('#helperid1').val(response.helper_id);
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

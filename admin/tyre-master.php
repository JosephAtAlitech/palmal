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
				<a href="tyre-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
				<a href="tyre-InActiveMaster.php" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-eye"></i> In-Active </a>
				<b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>Tyre Info</th>
					<th>Vehicle Info</th>
					<th>Tyre Cost</th>
					<th>Tyre Position</th>
					<th>Status</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT tyre_master.id,tyre_master.date,tyre_master.vehicle_no,tyre_master.tyre_type,tyre_master.tyre_position,tyre_position.position_name,tyre_master.tyre_company,tyre_master.tyre_model,tyre_master.tyre_cost,tyre_master.supervisor,tyre_master.create_date,tyre_master.status,tyre_master.update_date,vehicle_master.vehicle_number,supervisor_master.supervisor_name FROM `tyre_master` 
							LEFT JOIN vehicle_master ON  vehicle_master.id=tyre_master.vehicle_no
							LEFT JOIN supervisor_master ON supervisor_master.id=tyre_master.supervisor
                            LEFT JOIN tyre_position ON tyre_position.id=tyre_master.tyre_position
							WHERE tyre_master.status='Active' ORDER BY tyre_master.id  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td><b>Tyre No</b>: ".$row['tyre_no']." <br><b>Brand</b>: ".$row['tyre_company']."<br><b>Model</b>: ".$row['tyre_model']."</td>
							<td><b>Vehicle NO</b>: ".$row['vehicle_number']."<br><b>Supervisor</b>: ".$row['supervisor_name']."</td>
							<td><b>Tyre Cost</b>: ".$row['tyre_cost']."<br><b>Create Date</b>: ".$row['create_date']."<br><b>Date</b>: ".$row['date']."</td>
							<td>".$row['position_name']."</td>
							<td>".$row['status']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm EditTyre btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
								<button class='btn btn-danger btn-sm deleteDriver btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-trash'></i></button>
								<a href='tyreHistory-viewpdf.php?vid=".$row['id']."' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i> Print </a>
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
<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	
	function loadPurchase(){
	var tyreVehicle = $('#tyreVehicle').val();
	var dataString = 'loadPurchaseByPurchaseCode=1&tyreVehicle='+tyreVehicle;
	
	$.ajax({
		type: 'GET',
		url: 'loadTyre.php',
		data: dataString,
		dataType: 'json',
		success: function(response){
			var len = response.length;
			$("#Tyreposition").empty();
			for( var i = 0; i<len; i++){
				var id = response[i]['id'];
				var position = response[i]['position_name'];
				$("#Tyreposition").append("<option value='"+id+"'>"+position+"</option>");
			}
		},
		error: function (xhr) {
			//alert("3="+xhr.responseText);
			alert(xhr.responseText);
		}
	});
	}
	
	
	$(document).ready(function() {
	  $("#tyreVehicle12").select2({
		dropdownParent: $("#addnewTyre")
	  });
	});
	$(document).ready(function() {
	  $("#Tyreposition12").select2({
		dropdownParent: $("#addnewTyre")
	  });
	});
	$(document).ready(function() {
	  $("#tyreSupervisor").select2({
		dropdownParent: $("#addnewTyre")
	  });
	});
	
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
				tyreDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				tyreNumber: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Tyre Number'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				tyreCompany: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Tyre Company'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				tyreModel: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Tyre Model'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				tyreCost: {
                validators: {
                    notEmpty: {
                        message: 'Please Insert Tyre Cost'
                    },
                    regexp: {
					regexp: /^([0-9]{1,9})[,]*([0-9]{3,3})*[,]*([0-9]{1,3})*([.]([0-9]{2,2})){0,1}$/,
					message: 'Please insert Number Only'
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
				tyreDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				tyreNumber: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Tyre Number'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				tyreCompany: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Tyre Company'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				tyreModel: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Tyre Model'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				tyreCost: {
                validators: {
                    notEmpty: {
                        message: 'Please Insert Tyre Cost'
                    },
                    regexp: {
					regexp: /^([0-9]{1,9})[,]*([0-9]{3,3})*[,]*([0-9]{1,3})*([.]([0-9]{2,2})){0,1}$/,
					message: 'Please insert Number Only'
					}
                }
				}
			}
        })	
	});
</script>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.EditTyre').click(function(e){
    e.preventDefault();
    $('#EditTyre').modal('show');
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
      $('#deletid').val(response.id);
      $('#tyreDate').val(response.date);
      $('#vehicle_no').val(response.vehicle_no);
      $('#tyre_type').val(response.tyre_type);
      $('#tyre_position').val(response.tyre_position);
      $('#tyre_no').val(response.tyre_no);
      $('#tyre_company').val(response.tyre_company);
      $('#tyre_model').val(response.tyre_model);
      $('#tyre_cost').val(response.tyre_cost);
      $('#supervisor').val(response.supervisor);
      $('#tyreStatus').val(response.status);
      	
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

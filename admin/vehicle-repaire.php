
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
        Vehicle Repairs  Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="vehicle-repaire.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vehicle Repairs Information</li>
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
				<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Vehicle Repairs </a>
				<b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th class='hidden'></th>
					<th>id</th>
					<th>Vehicle Name</th>
					<th>LF Number</th>
					<th>Particulars</th>
					<th>Repair Type</th>
					<th>Amount</th>
					<th>Date</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT vehicle_repaire.*,vehicle_master.vehicle_number FROM `vehicle_repaire`
								LEFT JOIN vehicle_master ON vehicle_master.id=vehicle_repaire.vehicle_no
								where vehicle_repaire.delete_status!='In-Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$idNo++."</td>
							<td>".$row['vehicle_number']."</td>
							<td>".$row['lf_number']."</td>
							<td>".$row['particulars']."</td>
							<td>".$row['repaire_type']."</td>
							<td>".$row['amount']."</td>
							<td>".$row['repaire_date']."</td>
							<td style='width: 10%;'>
								<button class='btn btn-success btn-sm editVehicleRep btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
								<button class='btn btn-danger btn-sm deleteVehicleRep btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i></button>
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
  <?php include 'includes/ve-repaire-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
	  $("#vehicleNumber").select2({
		dropdownParent: $("#addnew")
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
			repaireDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
            lfNumber: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only LF Number'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
            },
			particulars: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Particulars'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
            },
             Repamount: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Please Insert Amount Only'
                    },
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Amount value only'
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
			repaireDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
            lfNumber: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only LF Number'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
            },
			particulars: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Particulars'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
            },
             Repamount: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Please Insert Amount Only'
                    },
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Amount value only'
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
  $('.editVehicleRep').click(function(e){
    e.preventDefault();
    $('#editVehicleRep').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.deleteVehicleRep').click(function(e){
    e.preventDefault();
    $('#deleteVehicleRep').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'vehicle_rep_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#deletid').val(response.id);
      $('#editrepaire_date').val(response.repaire_date);
      $('#editvehicle_no').val(response.vehicle_no);
      $('#editlf_number').val(response.lf_number);
      $('#editparticulars').val(response.particulars);
      $('#editrepaire_type').val(response.repaire_type);
      $('#editamount').val(response.amount);
      $('#deletrepaire_type').html(response.repaire_type);
      $('#editbranch_code').val(response.branch_code);
      $('#editstatus').val(response.status);
      
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

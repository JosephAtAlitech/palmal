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
        Ledger List Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="legder-list.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ledger List Information</li>
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
				<a href="#addnewVehicle" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add New Ledger</a>
				<b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
			</div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>Particulars</th>
					<th>Repair Amount</th>
					<th>Paid Amount</th>
					<th>Acc Type</th>
					<th>Acc Paid Date</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT * FROM `ledger_list` WHERE status!='In-Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td>".$row['particulars']."</td>
							<td>".$row['repair_amount']."</td>
							<td>".$row['paid_amount']."</td>
							<td>".$row['acc_type']."</td>
							<td>".$row['acc_paid_date']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm EditLedger btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-edit'> Edit </i></button>
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
  <?php include 'includes/ledger-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src='../bootstrapvalidator.min.js'></script>
<script type="text/javascript">
	
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
				Particulars: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Particulars'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				RepairAmount: {
					validators: {
						stringLength: {
							min: 1,
						},
						notEmpty: {
							message: 'Please Insert Repair Amount'
						},
						regexp: {
							regexp: /^[0-9]{1,10}$/,
							message: 'Please insert Intiger value only'
						}
					}
				},
				PaidAmount: {
					validators: {
						stringLength: {
							min: 1,
						},
						notEmpty: {
							message: 'Please Insert Paid Amount'
						},
						regexp: {
							regexp: /^[0-9]{1,10}$/,
							message: 'Please insert Intiger value only'
						}
					}
				},
				paidDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
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
				Particulars: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Particulars'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				RepairAmount: {
					validators: {
						stringLength: {
							min: 1,
						},
						notEmpty: {
							message: 'Please Insert Repair Amount'
						},
						regexp: {
							regexp: /^[0-9]{1,10}$/,
							message: 'Please insert Intiger value only'
						}
					}
				},
				PaidAmount: {
					validators: {
						stringLength: {
							min: 1,
						},
						notEmpty: {
							message: 'Please Insert Paid Amount'
						},
						regexp: {
							regexp: /^[0-9]{1,10}$/,
							message: 'Please insert Intiger value only'
						}
					}
				},
				paidDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				}
				
			}
        })	
	}); 
	
</script>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.EditLedger').click(function(e){
    e.preventDefault();
    $('#EditLedger').modal('show');
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
    url: 'ledger-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#deletid').val(response.id);
      $('#editparticulars').val(response.particulars);
      $('#editrepair_amount').val(response.repair_amount);
      $('#editpaid_amount').val(response.paid_amount);
      $('#editacc_type').val(response.acc_type);
      $('#editacc_paid_date').val(response.acc_paid_date);
      
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

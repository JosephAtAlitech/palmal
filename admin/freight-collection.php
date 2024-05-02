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
        Freight Collection Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="legder-list.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Freight Collection Information</li>
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
				<a href="#addnewFreight" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add New Freight Collection</a>
				<a href="vehicle-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
				<a href="vehicle-inactive.php" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-eye"></i> In-Active </a>
				<b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th class="hidden"></th>
					<th>id</th>
					<th>Trip No</th>
					<th>Vehicle No</th>
					<th>Party Name</th>
					<th>Party Phone</th>
					<th>Trip Advance</th>
					<th>By</th>
					<th>Acc Type</th>
					<th>Date</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT freight_collection.*,vehicle_master.vehicle_number FROM `freight_collection`
							LEFT JOIN vehicle_master ON vehicle_master.id=freight_collection.vehicle_no
							WHERE status!='Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$idNo++."</td>
							<td>".$row['trip_no']."</td>
							<td>".$row['vehicle_number']."</td>
							<td>".$row['party_name']."</td>
							<td>".$row['party_phone']."</td>
							<td>".$row['trip_advance']."</td>
							<td>".$row['trip_advance_by']."</td>
							<td>".$row['acc_type']."</td>
							<td>".$row['freight_date']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm EditFreight btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
								<button class='btn btn-danger btn-sm deleteFreight btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-trash'></i></button>
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
  <?php include 'includes/freight-collection-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	
	function loadPurchase(){
	var tripNumber = $('#tripNumber').val();
	var dataString = 'loadPurchaseByPurchaseCode=1&tripNumber='+tripNumber;
	$.ajax({
		type: 'GET',
		url: 'loadFreightCollection.php',
		data: dataString,
		dataType: 'json',
		success: function(response){
			$('#vehicleNumber').val(response[0].id);
			$('#partyName').val(response[0].company_name);
			$('#tripAdance').val(response[0].trip_advance);
			$('#freightAmount').val(response[0].freight_amount);
			
		},
		error: function (xhr) {
			//alert("3="+xhr.responseText);
			alert(xhr.responseText);
		}
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
				partyName: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Party Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				partyPhone: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Party Phone'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				tripAdance: {
					validators: {
						stringLength: {
							min: 1,
						},
						notEmpty: {
							message: 'Please Insert Trip Adance'
						},
						regexp: {
							regexp: /^[0-9]{1,10}$/,
							message: 'Please insert Intiger value only'
						}
					}
				},
				TripAdvanceBy: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Trip Advance By'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				freightDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				tripDetails: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Makers Name'
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
				partyName: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Party Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				partyPhone: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Party Phone'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				tripAdance: {
					validators: {
						stringLength: {
							min: 1,
						},
						notEmpty: {
							message: 'Please Insert Trip Adance'
						},
						regexp: {
							regexp: /^[0-9]{1,10}$/,
							message: 'Please insert Intiger value only'
						}
					}
				},
				TripAdvanceBy: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Trip Advance By'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				freightDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				tripDetails: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Makers Name'
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
	
</script>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.EditFreight').click(function(e){
    e.preventDefault();
    $('#EditFreight').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.deleteFreight').click(function(e){
    e.preventDefault();
    $('#deleteFreight').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'freightCollection-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#deletid').val(response.id);
      $('#edittrip_no').val(response.trip_no);
      $('#Viewtrip_no').html(response.trip_no);
      $('#editvehicle_no').val(response.vehicle_no);
      $('#editparty_name').val(response.party_name);
      $('#editparty_phone').val(response.party_phone);
      $('#edittrip_advance').val(response.trip_advance);
      $('#edittrip_advance_by').val(response.trip_advance_by);
      $('#editacc_type').val(response.acc_type);
      $('#editfreight_date').val(response.freight_date);
      $('#edittrip_details').val(response.trip_details);
      
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

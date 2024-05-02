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
				<b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>Id</th>
					<th>Driver Info</th>
					<th>Driver Image</th>
					<th>License Info</th>
					<th>Status</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT * FROM `driver_master`  WHERE status='Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td><b>Diver Name</b>: ".$row['driver_name']." <br><b>Phone</b>: ".$row['phone']."<br><b>Alt Phone</b>: ".$row['alter_phone']."</td>
							<td><img onerror=this.src='broken_image.png' src='../images/driver/".$row['dri_image']."' style='width:80px; height:60px;' /></td>
							<td><b>License No</b>: ".$row['licence_number']."<br><b>License Exp Date</b>: ".$row['licence_exp_date']."<br><b>Create Date</b>: ".$row['licence_exp_date']."</td>
							<td>".$row['status']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm EditDriver btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
								<button class='btn btn-danger btn-sm deleteDriver btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-trash'></i></button>
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

<script src='../bootstrapvalidator.min.js'></script>
<script type="text/javascript">
	// image error 
	$(document).ready(function(){
		  $("img").bind("error",function(){
			// Set the default image
			$(this).attr("src","broken_image.png");
		  });
		});
	
	function phoneAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_Avilability.php",
		data:'PhoneCheck='+$("#PhoneCheck").val(),
		type: "POST",
		success:function(data){
		$("#phone-availability-status").html(data);
			if(data=="OK") {
				$('#submit-button').prop('disabled', false)
				return true;    
			} else {
				$('#submit-button').prop('disabled', true)
				return false;   
			}
		$("#loaderIcon").hide();
		},
		error:function (){}
		});
	}
	function licenceAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_Avilability.php",
		data:'LicenceCheck='+$("#LicenceCheck").val(),
		type: "POST",
		success:function(data){
		$("#licence-availability-status").html(data);
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
				DriverName: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Driver Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				PhoneNumber: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Phone Number'
						},
						regexp: {
							regexp: /^(?:\+?88)?01[13-9]\d{8}$/,
							message: 'Mobile Ex: 01823835334'
						}
					}
				},
				AlternateNumber: {
					validators: {
						stringLength: {
							min: 2,
						},
						
						regexp: {
							regexp: /^(?:\+?88)?01[13-9]\d{8}$/,
							message: 'Mobile Ex: 01823835334'
						}
					}
				},
				DriverLicenceNumber: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Driver Licence Number'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				driverSalaries: {
					validators: {
							stringLength: {
							min: 3,
						},
						
						regexp: {
						regexp: /^[0-9]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				
				DriverLicenceExpireDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				UploadDriverLicence: {
					validators: {
							stringLength: {
							min: 3,
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				driverImage: {
					validators: {
							stringLength: {
							min: 3,
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				AadharCard: {
					validators: {
							stringLength: {
							min: 3,
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				BankAccounts: {
					validators: {
							stringLength: {
							min: 3,
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
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
				DriverName: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Driver Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				PhoneNumber: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Phone Number'
						},
						regexp: {
							regexp: /^\+?(88)?0?1[3456789][0-9]{8}$/,
							message: 'Mobile Ex: 8801823835334'
						}
					}
				},
				AlternateNumber: {
					validators: {
						stringLength: {
							min: 2,
						},
						regexp: {
							regexp: /^(?:\+?88)?01[13-9]\d{8}$/,
							message: 'Mobile Ex: 8801823835334'
						}
					}
				},
				DriverLicenceNumber: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Driver Licence Number'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				DriverLicenceExpireDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				UploadDriverLicence: {
					validators: {
							stringLength: {
							min: 3,
						},
							
						regexp: {
							regexp: /^.*\.(jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				driverImage: {
					validators: {
							stringLength: {
							min: 3,
						},
							
						regexp: {
							regexp: /^.*\.(jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				AadharCard: {
					validators: {
							stringLength: {
							min: 3,
						},
							
						regexp: {
							regexp: /^.*\.(jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				BankAccounts: {
					validators: {
							stringLength: {
							min: 3,
						},
						
						regexp: {
							regexp: /^.*\.(jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
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
  $('.EditDriver').click(function(e){
    e.preventDefault();
    $('#EditDriver').modal('show');
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
    url: 'driver-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#edidrivertid').val(response.id);
      $('#deletid').val(response.id);
      $('#driver_name').val(response.driver_name);
      $('#deldriver_name').html(response.driver_name);
      $('#PhoneNumber').val(response.phone);
      $('#alter_phone').val(response.alter_phone);
      $('#editDriverLicenceNumber').val(response.licence_number);
      $('#licence_exp_date').val(response.licence_exp_date);
      $('#ChesisNumber').val(response.chasis_number);
      $('#EnginNumber').val(response.engin_number);
      $('#Editdriver_salaries').val(response.driver_salaries);
      $('#Editdriver_phone_limit').val(response.driver_phone_limit);
      
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

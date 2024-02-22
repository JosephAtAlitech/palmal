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
        Driver Salaries Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="legder-list.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Driver Salaries Information</li>
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
				<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add New Driver Salaries </a>
				<b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
				<!--a href="vehicle-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
				<a href="vehicle-inactive.php" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-eye"></i> In-Active </a>
            -->
			</div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>Salary Month</th>
					<th>Driver Name</th>
					<th>Driver Advance</th>
					<th>Trip Advance</th>
					<th>Phone</th>
					<th>Salary</th>
					<th>Ream Salary</th>
					<th>date</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT driver_salaries.*,driver_master.driver_name as Dname FROM `driver_salaries`
								LEFT JOIN driver_master ON driver_master.id= driver_salaries.driver_name
								WHERE driver_salaries.status!='In-Active' ORDER BY driver_salaries.id  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td>".$row['salary_month']."</td>
							<td>".$row['Dname']."</td>
							<td>".$row['driver_advance']."</td>
							<td>".$row['trip_expense']." </td>
							<td>".$row['phone_bill']."</td>
							<td>".$row['salary']."</td>
							<td>".$row['reamailning_salary']."</td>
							<td>".$row['date']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm EditDriverSalaries btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
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
  <?php include 'includes/driver-salries-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
	  $("#SalaryMonth").select2({
		dropdownParent: $("#addnew")
	  });
	});
	$(document).ready(function() {
	  $("#DriverName").select2({
		dropdownParent: $("#addnew")
	  });
	});
	
	function calc()
		{
			var elm = document.forms["myform"];

			if (elm["TotalAdvances"].value != "" && elm["TripExpenses"].value != "" && elm["phoneBill"].value != "" && elm["Salaries"].value != "" )
			{elm["RemainingSalaries"].value = parseFloat(elm["Salaries"].value) - (parseFloat(elm["TotalAdvances"].value) + parseFloat(elm["TripExpenses"].value) + parseFloat(elm["phoneBill"].value));}
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
				vehicleNumber: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Vehicle Number'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				branchCode: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Branch Code Only'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				RegistrationDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				MakersName: {
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
				},
				YearOfManufacture: {
                validators: {
                    notEmpty: {
                        message: 'Please Insert Year Of Manufacture'
                    },
                    regexp: {
					regexp: /^([0-9]{1,9})[,]*([0-9]{3,3})*[,]*([0-9]{1,3})*([.]([0-9]{2,2})){0,1}$/,
					message: 'Please insert Number Only'
					}
                }
				},
				ChesisNumber: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Chesis Number'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				EnginNumber: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Engin Number'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				RegistrationCirtificate: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Registration Cirtificate'
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				RegistrationStartDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				RegistrationEndDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				TaxTokenCirtificate: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only TaxToken Cirtificate'
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				TaxTokenStartDate: {
					validators: {
						date: {
							message: 'The date is not valid',
							format: 'YYYY/MM/DD'
						},
					}
				},
				TaxTokenEndDate: {
					validators: {
						date: {
							message: 'The date is not valid',
							format: 'YYYY/MM/DD'
						},
					}
				},
				Insurancecertificate: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Insurance Certificate'
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				InsuranceStartDate: {
					validators: {
						date: {
							message: 'The date is not valid',
							format: 'YYYY/MM/DD'
						},
					}
				},
				InsuranceEndDate: {
					validators: {
						date: {
							message: 'The date is not valid',
							format: 'YYYY/MM/DD'
						},
					}
				},
				Permit: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Permit'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				PermitStartDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				PermitEndDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				PermitCirtificate: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Permit Cirtificate'
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				PollutionCirtificate: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Pollution Cirtificate'
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				PollutionStartDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
				},
				PollutionEndDate: {
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
  $('.EditDriverSalaries').click(function(e){
    e.preventDefault();
    $('#EditDriverSalaries').modal('show');
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
      $('#vehicleNumber').val(response.vehicle_number);
      $('#deletvehicleNumber').html(response.vehicle_number);
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

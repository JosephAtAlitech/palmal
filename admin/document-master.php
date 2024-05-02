<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; include('wialon.php'); $wialon_api = new Wialon();?>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
<style>
.select-group input.form-control{ width: 65%}
.select-group select.input-group-addon { width: 35%; }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
	<link rel="stylesheet" href="select2/select2.min.css" />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>Vehicle Document Information</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Vehicle Document Information</li>
		</ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<?php
			$sql = "SELECT tokenId FROM `customer_token` WHERE status='Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$row = $query->fetch_assoc();
					$token = $row['tokenId'];
				
				$tokenInfo = $token;
				$result = $wialon_api->login($tokenInfo);
				$json = json_decode($result, true);
					
		?>
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
				<a href="#addnewDocument" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Document</a>
				<a href="vehicle-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
				<a href="vehicle-inactive.php" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-eye"></i> In-Active </a>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>VNumber</th>
					<th>Registration</th>
					<th>TaxToken</th>
					<th>Insurance</th>
					<th>RoutePermit</th>
					<th>Fitness</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
					$sql = "SELECT * FROM `vehicle_master`
						WHERE delete_status='Active'";
					$query_vehicle = $conn->query($sql);
					while($row_vehicle = $query_vehicle->fetch_assoc()){
					
						$sql = "SELECT vehicle_documents_info.id,vehicle_documents_info.vehicle_id,vehicle_documents_info.certificate,vehicle_documents_info.start_date,
							vehicle_documents_info.end_date,vehicle_documents_info.office_fee,vehicle_documents_info.token_fee,vehicle_documents_info.type,vehicle_documents_info.status 
								FROM `vehicle_documents_info`
								WHERE vehicle_documents_info.status='Active' AND vehicle_documents_info.deleted='No' and vehicle_id='".$row_vehicle['id']."'
							ORDER BY vehicle_documents_info.id DESC";
						$query = $conn->query($sql);
						$idNo=1;
						$regstartdate ='--';
						$regendDate ='--';
						$regofficeFee ='--';
						$regtokenFee ='--';
						
						$taxstartdate ='--';
						$taxendDate ='--';
						$taxofficeFee ='--';
						$taxtokenFee ='--';
						
						$insustartdate ='--';
						$insuendDate ='--';
						$insuofficeFee ='--';
						$insutokenFee ='--';
						
						$routstartdate ='--';
						$routendDate ='--';
						$routofficeFee ='--';
						$routtokenFee ='--';
						
						$fitstartdate ='--';
						$fitendDate ='--';
						$fitofficeFee ='--';
						$fittokenFee ='--';
						while($row = $query->fetch_assoc()){
							$id = $row['vehicle_id'];
						
							if($row['type']=='regType'){
								
								$regstartdate = $row['start_date'];
								$regendDate = $row['end_date'];
								$regofficeFee = $row['office_fee'];
								$regtokenFee = $row['token_fee'];
							}
							else if($row['type']=='taxType'){
								$taxstartdate = $row['start_date'];
								$taxendDate = $row['end_date'];
								$taxofficeFee = $row['office_fee'];
								$taxtokenFee = $row['token_fee'];
							}
							else if($row['type']=='insuType'){
								$insustartdate = $row['start_date'];
								$insuendDate = $row['end_date'];
								$insuofficeFee = $row['office_fee'];
								$insutokenFee = $row['token_fee'];
							}
							else if($row['type']=='RouteType'){
								$routstartdate = $row['start_date'];
								$routendDate = $row['end_date'];
								$routofficeFee = $row['office_fee'];
								$routtokenFee = $row['token_fee'];
							}
							else if($row['type']=='fitnessType'){
								$fitstartdate = $row['start_date'];
								$fitendDate = $row['end_date'];
								$fitofficeFee = $row['office_fee'];
								$fittokenFee = $row['token_fee'];
							}
						}			
						echo "<tr>
									<td>".$idNo++."</td>
									<td></b>".$row_vehicle['vehicle_number']."</b></td>
							<td>SDATE : <font color='gray'>".$regstartdate."</font><br>EDATE : <font color='gray'>".$regendDate."</font><br>FEE : <font color='gray'>".$regofficeFee." Tk</font><br>TFEE : <font color='gray'>".$regtokenFee." Tk</font></td>
							<td>SDATE : <font color='gray'>".$taxstartdate."</font><br>EDATE : <font color='gray'>".$taxendDate."</font><br>FEE : <font color='gray'>".$taxofficeFee." Tk</font><br>TFEE : <font color='gray'>".$taxtokenFee." Tk</font></td>
							<td>SDATE : <font color='gray'>".$insustartdate."</font><br>EDATE : <font color='gray'>".$insuendDate."</font><br>FEE : <font color='gray'>".$insuofficeFee." Tk</font><br>TFEE : <font color='gray'>".$insutokenFee." Tk</font></td>
							<td>SDATE : <font color='gray'>".$routstartdate."</font><br>EDATE : <font color='gray'>".$routendDate."</font><br>FEE : <font color='gray'>".$routofficeFee." Tk</font><br>TFEE : <font color='gray'>".$routtokenFee." Tk</font></td>
							<td>SDATE : <font color='gray'>".$fitstartdate."</font><br>EDATE : <font color='gray'>".$fitendDate."</font><br>FEE : <font color='gray'>".$fitofficeFee." Tk</font><br>TFEE : <font color='gray'>".$fittokenFee." Tk</font></td>
							<td style='width: 9%;'>
									<a href='vehicleHistory-viewpdf.php?vid=".$id."' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i> Print </a>
								</td>
							</tr>";
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
  <?php include 'includes/documents-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	
	function chasisAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_AvilabilityVehicle.php",
		data:'chasisNumberCheck='+$("#chasisNumberCheck").val(),
		type: "POST",
		success:function(data){
		$("#chasis-availability-status").html(data);
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
	function engineAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_AvilabilityVehicle.php",
		data:'EnginNumberCheck='+$(EnginNumberCheck).val(),
		type: "POST",
		success:function(data){
		$("#engine-availability-status").html(data);
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
	
	// image error 
	$(document).ready(function(){
		  $("img").bind("error",function(){
			// Set the default image
			$(this).attr("src","broken_image.png");
		  });
		});
	
	$(document).ready(function() {
	  $("#vehicleNumber").select2({
		dropdownParent: $("#addnewDocument")
	  });
	});
	$(document).ready(function() {
	  $("#BranchStatus").select2({
		dropdownParent: $("#addnewVehicle")
	  });
	});
	$(document).ready(function() {
	  $("#MakersName").select2({
		dropdownParent: $("#addnewVehicle")
	  });
	});
	$(document).ready(function() {
	  $("#YearOfManufacture").select2({
		dropdownParent: $("#addnewVehicle")
	  });
	});
	$(document).ready(function() {
	  $("#vehicleNumberName12").select2({
		dropdownParent: $("#addnewVehicle")
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
				vehicleNumber: {
					validators: {
							notEmpty: {
							message: 'Please Vehicle Number like Number DHA-11-1111'
						}
					}
				},
				cirtificate: {
					validators: {
							stringLength: {
							min: 3,
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				startDate: {
					validators: {
						date: {
							message: 'The date is not valid',
							format: 'YYYY/MM/DD'
						},
					}
				},
				endDate: {
					validators: {
						date: {
							message: 'The date is not valid',
							format: 'YYYY/MM/DD'
						},
					}
				},
				officeFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
						},
					}
				},
				tokenFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
						},
					}
				},
				TaxTokenCirtificate: {
					validators: {
							stringLength: {
							min: 3,
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
				taxTokenOfficeFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
						},
					}
				},
				taxTokenTokenFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
						},
					}
				},
				Insurancecertificate: {
					validators: {
							stringLength: {
							min: 3,
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
				insOfficeFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
						},
					}
				},
				insTokenFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
						},
					}
				},
				Permit: {
					validators: {
							stringLength: {
							min: 3,
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
				routOfficeFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
						},
					}
				},
				routTokenFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
						},
					}
				},
				PermitCirtificate: {
					validators: {
							stringLength: {
							min: 3,
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
				},
				fitnessOfficeFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
						},
					}
				},
				fitnessTokenFee: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Insert Amount Only'
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
				vehicleNumber: {
					validators: {
							
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				oilTankCapacity: {
					validators: {
							stringLength: {
							min: 2,
						},
							notEmpty: {
							message: 'Please Vehicle Oil Tank Capacity In liter'
						},
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'Please Vehicle Oil Tank Capacity In liter'
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
				},
				PollutionCirtificate: {
					validators: {
							stringLength: {
							min: 3,
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				PermitCirtificate: {
					validators: {
							stringLength: {
							min: 3,
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				Insurancecertificate: {
					validators: {
							stringLength: {
							min: 3,
						},
						regexp: {
							regexp: /^.*\.(jpg|JPG|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				},
				RegistrationCirtificate: {
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
  $('.EditVehicleDocuments').click(function(e){
    e.preventDefault();
    $('#EditVehicleDocuments').modal('show');
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
    url: 'vehicleDocument-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editDocid').val(response.id);
      
      $('#EditVehicle_number').val(response.Vid);
      $('#Editre_start_date').val(response.re_start_date);
      $('#Editre_end_date').val(response.re_end_date);
      $('#Editregoffice_fee').val(response.regoffice_fee);
      $('#Editregtoken_fee').val(response.regtoken_fee);
	  
	  $('#Edittat_start_date').val(response.tat_start_date);
      $('#Edittat_end_date').val(response.tat_end_date);
      $('#Edittaxoffice_fee').val(response.taxoffice_fee);
      $('#Edittaxtoken_fee').val(response.taxtoken_fee);
	  
	  $('#Editins_start_date').val(response.inc_start_date);
      $('#Editins_end_date').val(response.inc_end_date);
      $('#Editinsoffice_fee').val(response.insoffice_fee);
      $('#Editinstoken_fee').val(response.instoken_fee);
	  
	  $('#Editrop_start_date').val(response.rop_start_date);
      $('#Editrop_end_date').val(response.rop_end_date);
      $('#Editroutoffice_fee').val(response.routoffice_fee);
      $('#Editrouttoken_fee').val(response.routetokenfee);
	  
	  $('#Editfic_start_date').val(response.fic_start_date);
      $('#Editfic_end_date').val(response.fic_end_date);
      $('#Editfitoffice_fee').val(response.fitoffice_fee);
      $('#Editfittoken_fee').val(response.fittoken_fee);
      
	  
		$('#RegistrationCirtificate12').html("<img src='../images/registration/"+response.registration_certificate+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#Insurancecertificate12').html("<img src='../images/insurance/"+response.insurance_certificate+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#PermitCirtificate12').html("<img src='../images/permit/"+response.route_permit_certificate+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#PollutionCirtificate12').html("<img src='../images/pollution/"+response.fitness_certificate+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#EdittaxToken').html("<img src='../images/taxToken/"+response.tax_token+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
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
	$("#submit-button").show();
	$("#update-button").hide();
	
    $('#example_company').DataTable( {
      //responsive: true
	  dom: 'Bfrtip',
        buttons: [
            'pageLength','copy', 'csv', 'pdf', 'print'
        ]
    })
  })
  
$("#vehicleNumber").change(function (){
    if($("#type").val() != ""){
		$("#type").change();
	}else{
		$("#typeDetails").empty();
	}
})
  $("#type").change(function() {
	  if($("#vehicleNumber").val() != ""){
	 // alert(vid);
		$("#startDate").val('');
		$("#endDate").val('');
		$("#officeFee").val('');
		$("#tokenFee").val('');
		$("#EditCirtificate").html("");
		  if($("#type").val() != ""){
			jQuery.ajax({
			url: "load_documentsTypeData.php",
			data:'type='+$("#type").val()+"&vid="+$("#vehicleNumber").val(),
			type: "POST",
			success:function(data){
				$("#typeDetails").html(data);
				$("#loaderIcon").hide();
			},
			error:function (){}
			});
		  }else{
			  $("#typeDetails").empty();
		  }
	  }else{
		  $("#typeDetails").empty();
		  alert("Select Vehicle number first");
	  }
  })
  function EditDocuments(id){
		jQuery.ajax({
			url: "load_documentsTypeData.php",
			data:'action=editDocument&id='+id,
			type: "POST",
			dataType: 'json',
			success:function(data){
				$("#startDate").val(data.start_date);
				$("#endDate").val(data.end_date);
				$("#officeFee").val(data.office_fee);
				$("#tokenFee").val(data.token_fee);
				$("#EditCirtificate").html("<img src='../images/registration/"+data.certificate+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
				$("#update-button").show();
				$("#submit-button").hide();
			},
			error:function (){alert("Error Calling");}
		});
  };
  
	function deleteDocument(id){
	    var conMsg = confirm("Are you sure to delete??");
		if(conMsg){
			$.ajax({
			    type: "POST",
				url: "document-add.php",
				data: "action=deleteVfDocument&id="+id,
				success: function(response){
				//	alert(response);
				},
				error:function (){
					alert("Error Calling");
				}
			  });
		}
	};
</script>
</body>
</html>

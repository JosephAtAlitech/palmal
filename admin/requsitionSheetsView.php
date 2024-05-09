<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php';
include('wialon.php');
$wialon_api = new Wialon(); ?>
<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
<style>
	.select-group input.form-control {
		width: 65%
	}

	.select-group select.input-group-addon {
		width: 35%;
	}
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
				<h1>Vehicle Requsition</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Vehicle Requsition</li>
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
				if (isset($_SESSION['error'])) {
					echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
					unset($_SESSION['error']);
				}
				if (isset($_SESSION['success'])) {
					echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
					unset($_SESSION['success']);
				}
				?>
				<link rel="stylesheet" href="buttons.dataTables.min.css" />
				<div class="row">
					<div class="col-xs-12">
						<div class="box">

					
							<div class="box-body">
						
								<table id="example_company" class="table table-bordered">
									<thead>
										<th>id</th>
										<th>Vehicle number</th>
										<th>Entry Date</th>
										<th>Office Fee</th>
										<th>Token Fee</th>
										<th>Others Fee</th>
										<th>Total</th>
										<th>Action</th>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT vehicle_master.vehicle_number ,vehicle_documents_proposal.id,vehicle_documents_proposal.req_id,vehicle_documents_proposal.entry_date,
								SUM(vehicle_documents_proposal.office_fee) AS TotalOfficeFee ,SUM(vehicle_documents_proposal.token_fee)as  TotalTokenFee,SUM(vehicle_documents_proposal.others_fee) AS TotalOthersFee 
								FROM `vehicle_documents_proposal`
								INNER JOIN vehicle_master on vehicle_master.id = vehicle_documents_proposal.vehicle_id
								Where vehicle_documents_proposal.deleted= 'No'
								GROUP BY vehicle_documents_proposal.req_id ORDER BY `vehicle_documents_proposal`.`req_id`  DESC";
										$query = $conn->query($sql);
										$idNo = 1;
										while ($row = $query->fetch_assoc()) {
											$total = $row['TotalOfficeFee'] + $row['TotalTokenFee'] + $row['TotalOthersFee'];
											echo "
                        <tr>
							<td>" . $idNo++ . "</td>
							<td>" . $row['vehicle_number'] . "</td>
							<td>" . $row['entry_date'] . "</td>
							<td>" . $row['TotalOfficeFee'] . "</td>
							<td>" . $row['TotalTokenFee'] . "</td>
							<td>" . $row['TotalOthersFee'] . "</td>
							<td>" . $total . "</td>
							<td style='width: 9%;'>
								<a href='vehicleRequsition-viewpdf.php?reqId=" . $row['req_id'] . "' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i> Print </a>
							    <a href='#' class='btn btn-danger btn-sm deleteVehicleRequisition btn-flat' style='margin-bottom: 5px;' data-id='" . $row['id'] . "'><i class='fa fa-trash'> Delete</i></a>
								<a class='btn btn-warning btn-sm adjustVehicleRequisition btn-flat' style='margin-bottom: 5px;' data-id='" . $row['id'] . "'><i class='fa fa-edit'> Adjust</i> </a>
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
		<?php include 'includes/vehicle-modal.php'; ?>
		<?php include 'includes/Vehicalreqadjust-modal.php'; ?>
	</div>
	<?php include 'includes/scripts.php'; ?>
	<script src='../bootstrapvalidator.min.js'></script>
	<script src="select2/select2.min.js"></script>
	<script type="text/javascript">
		function vNumberAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_AvilabilityVehicle.php",
				data: 'vehicleNumber=' + $("#vehicleNumber").val(),
				type: "POST",
				success: function(data) {
					$("#vNumber-availability-status").html(data);
					if (data == "OK") {
						$('#submit-button').prop('disabled', false)
						return true;
					} else {
						$('#submit-button').prop('disabled', true)
						return false;
					}
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}

		function chasisAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_AvilabilityVehicle.php",
				data: 'chasisNumberCheck=' + $("#chasisNumberCheck").val(),
				type: "POST",
				success: function(data) {
					$("#chasis-availability-status").html(data);
					if (data == "OK") {
						$('#submit-button').prop('disabled', false)
						return true;
					} else {
						$('#submit-button').prop('disabled', true)
						return false;
					}
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}

		function engineAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_AvilabilityVehicle.php",
				data: 'EnginNumberCheck=' + $(EnginNumberCheck).val(),
				type: "POST",
				success: function(data) {
					$("#engine-availability-status").html(data);
					if (data == "OK") {
						$('#submit-button').prop('disabled', false)
						return true;
					} else {
						$('#submit-button').prop('disabled', true)
						return false;
					}
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}

		
		$(function() {

			$('.deleteVehicleRequisition ').click(function(e) {
				if (confirm("Are you want to delete the record!") == true) {
					var id = $(this).data('id');

					jQuery.ajax({
						url: "phpScripts/requisitionSheetAction.php",
						data: 'Action=deleteRequisitionSheet&id=' + id,
						type: "POST",
						beforeSend: function() {
							$('#loading').show();
						},
						success: function(data) {
							//alert(JSON.stringify(data))
							location.reload();

							$("#loaderIcon").hide();
						},
						error: function(error) {
							alert(error)
						},
						complete: function(data) {
							$('#loading').hide();
						}
					});
				} else {
					text = "You canceled!";
				}
			});
			});

			// ADJUST VEHICAL REQUISITION 
		$(function(){
				$('.adjustVehicleRequisition').click(function(){
					$('#adjustVehicleRequisitionModal').modal('show');
					var id = $(this).data('id');
					getRow(id);
				});
		});
		function getRow(id){
		$.ajax({
			type: 'POST',
			url: 'vehical_adjust_row.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
			$('#editid').val(response.id);
			$('#deletid').val(response.id);
			$('#editvehicle_no').val(response.vehicle_no);
			$('#editrepaire_type').val(response.repaire_type);
			$('#editamount').val(response.amount);
			$('#editstatus').val(response.status);
			
			}
		});
		}

		$(document).ready(function() {
			$(".searchVehicle").select2({
				dropdownParent: $("#addnewVehicle")
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
							stringLength: {
								min: 2,
							},
							notEmpty: {
								message: 'Please Vehicle Number like Number DHA-11-1111'
							},
							regexp: {
								regexp: /(\d{2}[- ])\d{4}$/,
								message: 'Please insert Vehicle Number DHA-11-1111'
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
					PurchaseDate: {
						validators: {
							date: {
								message: 'The date is not valid',
								format: 'YYYY/MM/DD'
							},
						}
					},
					YearOfManufacture: {
						validators: {
							stringLength: {
								max: 4,
							},
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
					}


				}
			})
		});
	</script>
	<script>
		var userselect = document.getElementById('input');



		
	</script>
	<script type="text/javascript">
		// Print message to log
		function msg(text) {
			$("#log").prepend(text + "<br/>");
		}

		function init() { // Execute after login succeed
			var sess = wialon.core.Session.getInstance(); // get instance of current Session
			// flags to specify what kind of data should be returned
			var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;

			sess.loadLibrary("itemIcon"); // load Icon Library	
			sess.updateDataFlags( // load items to current session
				[{
					type: "type",
					data: "avl_unit",
					flags: flags,
					mode: 0
				}], // Items specification
				function(code) { // updateDataFlags callback
					if (code) {
						msg(wialon.core.Errors.getErrorText(code));
						return;
					} // exit if error code

					// get loaded 'avl_unit's items  
					var units = sess.getItems("avl_unit");
					if (!units || !units.length) {
						msg("Units not found");
						return;
					} // check if units found

					for (var i = 0; i < units.length; i++) { // construct Select object using found units
						var u = units[i]; // current unit in cycle
						// append option to select
						$("#units").append("<option value='" + u.getId() + "'>" + u.getName() + "</option>");
					}
					// bind action to select change event
					$("#units").change(getSelectedUnitInfo);
				}
			);
		}

		// execute when DOM ready
		$(document).ready(function() {
			var myToken = <?php echo (json_encode($token)); ?>;
			wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
			// For more info about how to generate token check
			// http://sdk.wialon.com/playground/demo/app_auth_token
			wialon.core.Session.getInstance().loginToken(myToken, "", // try to login
				function(code) { // login callback
					// if error code - print error message
					if (code) {
						msg(wialon.core.Errors.getErrorText(code));
						return;
					}
					//msg("Logged successfully"); 
					init(); // when login suceed then run init() function
				});
		});
	</script>
	<script>
		$(document).ready(function() {
			$('#example_company').DataTable({
				//responsive: true
				dom: 'Bfrtip',
				buttons: [
					'pageLength', 'copy', 'csv', 'pdf', 'print'
				]
			})
		})
	</script>
</body>

</html>
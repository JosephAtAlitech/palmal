<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php';
include ('wialon.php');
$wialon_api = new Wialon(); ?>
<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
<style>
	.select-group input.form-control {	width: 65% }
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
				<h1>Vehicle Information</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Vehicle Information</li>
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
							<div class="box-header with-border">
								<a href="#addnewVehicle" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i
										class="fa fa-plus"></i> Add Vehicle</a>
								<a href="vehicle-master.php" class="btn btn-success btn-sm btn-flat"><i
										class="fa fa-eye"></i> Active </a>
								<a href="vehicle-inactive.php" class="btn btn-danger btn-sm btn-flat"><i
										class="fa fa-eye"></i> In-Active </a>
							</div>
							<div class="box-body">
								<table id="example_company" class="table table-bordered">
									<thead>
										<th>id</th>
										<th>VFT ID</th>
										<th>Vehicle Information</th>
										<th>Others Information</th>
										<th>User Info</th>
										<th>Status</th>
										<th>Action</th>
									</thead>
									<tbody>
							<?php
							$sql = "SELECT vehicle_master.id,vehicle_master.wUnitID,vehicle_master.v_type,vehicle_master.vehicle_number,vehicle_master.oil_tank_capacity,vehicle_master.delete_status,vehicle_master.purchase_date,vehicle_master.registration_date,manufacturer_name.name,vehicle_master.year_of_manufacture,
							vehicle_master.chasis_number,vehicle_master.engin_number,branch_master.branch_name,vehicle_master.create_date,
							vehicle_master.maker_brand,vehicle_master.cc_brand,vehicle_master.fuel_type,vehicle_master.wings_name,vehicle_master.employee_name,vehicle_master.location
							FROM `vehicle_master`
							LEFT JOIN manufacturer_name ON manufacturer_name.id=vehicle_master.makers_name
							LEFT JOIN branch_master ON branch_master.id=vehicle_master.branch_status
							Where vehicle_master.delete_status='Active' ORDER BY vehicle_master.id  DESC";
							$query = $conn->query($sql);
							$idNo = 1;
							while ($row = $query->fetch_assoc()) {
								if ($row['delete_status'] == 'Active') {
									$status = '<b style="color:green">' . $row['delete_status'] . '</b>';
								} else {
									$status = '<b style="color:red">' . $row['delete_status'] . '</b>';
								}
								echo "
                                <tr>
        							<td>" . $idNo++ . "</td>
        							<td>VFT : " . $row['wUnitID'] . "</td>
        							<td>Vno : " . $row['vehicle_number'] . " / " . $row['name'] . "<br>Brand : " . $row['maker_brand'] . " CC : " . $row['cc_brand'] . "<br>Fuel  : " . $row['oil_tank_capacity'] . " L<br><b>Cno</b> : " . $row['chasis_number'] . "<br><b>Eno</b> : " . $row['engin_number'] . "<br><b>Manufacture</b> : " . $row['year_of_manufacture'] . "</td>
        							<td><b>Branch</b> : " . $row['branch_name'] . "<br><b>Purchase</b> : " . $row['purchase_date'] . "<br><b>Reg. </b> : " . $row['registration_date'] . "</td>
        							<td>User Name : " . $row['employee_name'] . "<br>Wings : " . $row['wings_name'] . "<br>Location : " . $row['location'] . "</td>
        							<td>" . $status . "<br>" . $row['v_type'] . "</td>
        							<td style='width: 9%;'>
        								<button class='btn btn-success btn-sm editVehicle btn-flat' style='margin-bottom: 5px;' data-id='" . $row['id'] . "'><i class='fa fa-edit'> Edit</i></button>
        								<button class='btn btn-danger btn-sm deleteVehicle btn-flat' style='margin-bottom: 5px;' data-id='" . $row['id'] . "'><i class='fa fa-trash'> Delete</i></button>
        								<a href='vehicleHistory-viewpdf.php?vid=" . $row['id'] . "' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i> Print </a>
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
				success: function (data) {
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
				error: function () { }
			});
		}
		function chasisAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_AvilabilityVehicle.php",
				data: 'chasisNumberCheck=' + $("#chasisNumberCheck").val(),
				type: "POST",
				success: function (data) {
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
				error: function () { }
			});
		}
		function engineAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_AvilabilityVehicle.php",
				data: 'EnginNumberCheck=' + $(EnginNumberCheck).val(),
				type: "POST",
				success: function (data) {
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
				error: function () { }
			});
		}


		$(document).ready(function () {
			$(".searchVehicle").select2({
				dropdownParent: $("#addnewVehicle")
			});
			$('#driver').select2({
				width: "100%"
			});
			$('#engineer').select2({
				width: "100%"
			});
			$('#editDriver').select2({
				width: "100%"
			});
			$('#editEngineer').select2({
				width: "100%"
			});
		});
		$(document).ready(function () {
			$("#BranchStatus").select2({
				dropdownParent: $("#addnewVehicle")
			});
		});
		$(document).ready(function () {
			$("#MakersName").select2({
				dropdownParent: $("#addnewVehicle")
			});
		});
		$(document).ready(function () {
			$("#YearOfManufacture").select2({
				dropdownParent: $("#addnewVehicle")
			});
		});
		$(document).ready(function () {
			$("#vehicleNumberName12").select2({
				dropdownParent: $("#addnewVehicle")
			});
		});

		$(document).ready(function () {
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
								//regexp: /(\d{2}[- ])\d{4}$/,
								regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
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

					ChesisNumber: {
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
					EnginNumber: {
						validators: {
							stringLength: {
								min: 3,
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

		$(document).ready(function () {
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

		$(function () {
			$('.editVehicle').click(function (e) {
				e.preventDefault();
				$('#editVehicle').modal('show');
				var id = $(this).data('id');
				getRow(id);
			});

			$('.deleteVehicle').click(function (e) {
				e.preventDefault();
				$('#deleteVehicle').modal('show');
				var id = $(this).data('id');
				getRow(id);
			});
		});

		function getRow(id) {
			//alert(id);
			$.ajax({
				type: 'POST',
				url: 'vehicle-row.php',
				data: { id: id },
				dataType: 'json',
				success: function (response) {
					$('#editid').val(response.id);
					$('#deletid').val(response.id);
					$('#EditVehicleNumber').val(response.vehicle_number);
					$('#wVFTID').val(response.wUnitID);
					$('#Editvtype').val(response.v_type);
					$('#oilTankCapacity').val(response.oil_tank_capacity);

					$('#editDriver').val(response.driver_id).trigger('change');
					$('#editEngineer').val(response.engineer_id).trigger('change');

					$('#deletvehicleNumber').html(response.vehicle_number);
					$('#EditpurchaseDate').val(response.purchase_date);
					$('#EditMakersName').val(response.makers_name);
					$('#Editpurchase_date').val(response.purchase_date);
					$('#EditYearOfManufacture').val(response.year_of_manufacture);
					$('#ChesisNumber').val(response.chasis_number);
					$('#EnginNumber').val(response.engin_number);
					$('#EditBranchStatus').val(response.branch_status);


					$('#Editregistration_date').val(response.registration_date);
					$('#EditMaker_brand').val(response.maker_brand);
					$('#EditCc_brand').val(response.cc_brand);
					$('#EditFuel_type').val(response.fuel_type);
					$('#EditWings_name').val(response.wings_name);
					$('#EditEmployee_name').val(response.employee_name);
					$('#EditLocation').val(response.location);

					$('#Users').val(response.users);

					$('#RegistrationCirtificate12').html("<img src='../images/registration/" + response.registration_cirtificate + "' style='width: 100%;height: 90px;border-radius: 15%;'/>");
					$('#Insurancecertificate12').html("<img src='../images/insurance/" + response.insurance_cirtificate + "' style='width: 100%;height: 90px;border-radius: 15%;'/>");
					$('#PermitCirtificate12').html("<img src='../images/permit/" + response.permit_cirtificate + "' style='width: 100%;height: 90px;border-radius: 15%;'/>");
					$('#PollutionCirtificate12').html("<img src='../images/pollution/" + response.pollution_cirtificate + "' style='width: 100%;height: 90px;border-radius: 15%;'/>");

				}
			});
		}
	</script>
	<script type="text/javascript">
		// Print message to log
		function msg(text) { $("#log").prepend(text + "<br/>"); }

		function init() { // Execute after login succeed
			var sess = wialon.core.Session.getInstance(); // get instance of current Session
			// flags to specify what kind of data should be returned
			var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;

			sess.loadLibrary("itemIcon"); // load Icon Library	
			sess.updateDataFlags( // load items to current session
				[{ type: "type", data: "avl_unit", flags: flags, mode: 0 }], // Items specification
				function (code) { // updateDataFlags callback
					if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code

					// get loaded 'avl_unit's items  
					var units = sess.getItems("avl_unit");
					if (!units || !units.length) { msg("Units not found"); return; } // check if units found

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
		$(document).ready(function () {
			var myToken = <?php echo (json_encode($token)); ?>;
			wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
			// For more info about how to generate token check
			// http://sdk.wialon.com/playground/demo/app_auth_token
			wialon.core.Session.getInstance().loginToken(myToken, "", // try to login
				function (code) { // login callback
					// if error code - print error message
					if (code) { msg(wialon.core.Errors.getErrorText(code)); return; }
					//msg("Logged successfully"); 
					init(); // when login suceed then run init() function
				});
		});
	</script>
	<script>

		$(document).ready(function () {
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
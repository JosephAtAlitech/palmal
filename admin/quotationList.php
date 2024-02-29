<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php';

?>

<style>
	.select-group input.form-control {
		width: 65%
	}

	.select-group select.input-group-addon {
		width: 35%;
	}
</style>
<link rel="stylesheet" href="select2/select2.min.css" />

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<?php include 'includes/navbar.php'; ?>
		<?php include 'includes/menubar.php'; ?>


		<div class="content-wrapper">

			<section class="content-header">
				<h1>Token Information</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Token List</li>
				</ol>
			</section>

			<section class="content">

				<link rel="stylesheet" href="buttons.dataTables.min.css" />
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<?php
							if(isset($_GET['id']) ) {
								$id = $_GET['id'];
							} else {
								$id = '';
							}
							?>
							<div class="box-header with-border">
								<a href="addQuotationView.php?Token_id=<?=$id?>&type=procurement" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i
										class="fa fa-plus"></i> Add Quotation</a>
							</div>
							<div class="box-body">
								<table id="quotationTable" class="table table-bordered">
									<thead>
										<th>id</th>
										<th>Quotation Date No</th>
										<th>Quote By</th>
										<th>Token Title</th>
										<th>Action</th>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?php include 'includes/footer.php'; ?>
		<?php include 'includes/token-modal.php'; ?>
	</div>
	<?php include 'includes/scripts.php'; ?>
	<script src='../bootstrapvalidator.min.js'></script>
	<script src="select2/select2.min.js"></script>
	<script type="text/javascript">


		const queryString = window.location.search;
		console.log(queryString);
		const urlParams = new URLSearchParams(queryString);
		const id = urlParams.get('id')
		console.log(id);

		$(document).ready(function () {
			$('#mechanic').select2({
				width: "100%"
			});
			$('#engineer').select2({
				width: "100%"
			});
		});

		var manageTokenTable = '';
		$(document).ready(function () {
			
			manageTokenTable = $("#quotationTable").DataTable({
				'ajax': 'quotationAdd.php?id='+id,
				'order': [],
				'dom': 'Bfrtip',
				'buttons': [
					'pageLength', 'copy', 'csv', 'pdf', 'print'
				],
				language: {
					processing: "<img src='../images/loader.gif'>"
				},
			});

			$('#token_add_form').bootstrapValidator({
				live: 'enabled',
				message: 'This value is not valid',
				submitButton: '$token_add_form button [type="Submit"]',
				submitHandler: function (validator, form, submitButton) {

					var tolenTitle = $("#tokenTitle").val();
					var tolenDetails = $("#tokenDetails").val();
					var mechanic = $("#mechanic").val();
					var engineer = $('#engineer').val();
					var tokenDate = $("#tokenDate").val();

					var fd = new FormData();

					fd.append('tokenTitle', tolenTitle);
					fd.append('tokenDetails', tolenDetails);
					fd.append('mechanic', mechanic);
					fd.append('engineer', engineer);
					fd.append('tokenDate', tokenDate);
					fd.append('Action', 'addToken');

					$.ajax({
						url: "tokenAdd.php",
						method: "POST",
						data: fd,
						contentType: false,
						processData: false,
						datatype: "json",
						success: function (result) {
							if (result != "success") {
								alert(JSON.stringify(result));
							} else if (result == "success") {
								$('#addnewToken').modal('hide');
							}
							//alert(JSON.stringify(result));
							manageTokenTable.ajax.reload(null, false);
						},
						error: function (response) {
							alert(JSON.stringify(response));
						},

						beforeSend: function () {
							$('#loading').show();
						},
						complete: function () {
							$('#loading').hide();
						}
					});
				},
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				excluded: [':disabled'],
				fields: {
					tokenTitle: {
						validators: {
							stringLength: {
								min: 2,
							},
							notEmpty: {
								message: 'Please Insert Token Number'
							},
							regexp: {
								regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
								message: 'Please insert alphanumeric value only'
							}
						}
					},
					mechanic: {
						validators: {
							notEmpty: {
								message: 'Please Select mechanic'
							}
						}
					},
					engineer: {
						validators: {
							notEmpty: {
								message: 'Please Select Engineer'
							}
						}
					},
					tokenDate: {
						validators: {
							date: {
								message: 'The date is not valid',
								format: 'YYYY/MM/DD'
							},
						}
					}
				}
			})
			$('#allocateMechanic_form').bootstrapValidator({
				live: 'enabled',
				message: 'This value is not valid',
				submitButton: '$allocateMechanic_form button [type="Submit"]',
				submitHandler: function (validator, form, submitButton) {

					var id = $("#id_fr_mc_allct").val();
					var mechanic_for_allocate = $("#mechanic_for_allocate").val();

					///alert(id)
					var fd = new FormData();

					fd.append('id', id);
					fd.append('mechanic_for_allocate', mechanic_for_allocate);
					fd.append('Action', 'allocateMechanic');

					$.ajax({
						url: "tokenAdd.php",
						method: "POST",
						data: fd,
						contentType: false,
						processData: false,
						datatype: "json",
						success: function (result) {
							if (result.status != "success") {
								alert(JSON.stringify(result));
							} else if (result.status == "success") {
								$('#allocateMechanic').modal('hide');
							}
							//alert(JSON.stringify(result));
							manageTokenTable.ajax.reload(null, false);
						},
						error: function (response) {
							//alert(JSON.stringify(response));
						},

						beforeSend: function () {
							$('#loading').show();
						},
						complete: function () {
							$('#loading').hide();
						}
					});
				},
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				excluded: [':disabled'],
				fields: {

					mechanic_for_allocate: {
						validators: {
							notEmpty: {
								message: 'Please Select mechanic'
							}
						}
					}
				}
			})
			$('#mechanicComment').bootstrapValidator({
				live: 'enabled',
				message: 'This value is not valid',
				submitButton: '$mechanicComment button [type="Submit"]',
				submitHandler: function (validator, form, submitButton) {

					var id = $("#id_fr_mc_info").val();
					var problems = $("#problems").val();


					alert(problems)
					var fd = new FormData();

					fd.append('id', id);
					fd.append('problems', problems);
					fd.append('Action', 'mechanicComment');

					$.ajax({
						url: "tokenAdd.php",
						method: "POST",
						data: fd,
						contentType: false,
						processData: false,
						datatype: "json",
						success: function (result) {
							if (result != "success") {
								alert(JSON.stringify(result));
							} else if (result == "success") {
								$('#mechanicComment').modal('hide');
							}
							manageTokenTable.ajax.reload(null, false);
							//alert(JSON.stringify(result));
						},
						error: function (response) {
							alert(JSON.stringify(response));
						},

						beforeSend: function () {
							$('#loading').show();
						},
						complete: function () {
							$('#loading').hide();
						}
					});
				},
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				excluded: [':disabled'],
				fields: {

					mechanic_for_allocate: {
						validators: {
							notEmpty: {
								message: 'Please Select mechanic'
							}
						}
					}
				}
			})
		});



		function allocateMechanic(id) {
			$('#allocateMechanic').modal('show');
			$.ajax({
				type: 'POST',
				url: 'tokenAdd.php',
				data: {
					id: id,
					"Action": 'getMechanic'
				},
				dataType: 'json',
				beforeSend: function () {
					// Show image container
					$("#editLoader").show();
				},
				success: function (response) {
					//alert(JSON.stringify(response));
					$('#id_fr_mc_allct').val(response.id);
					$('#mechanic_for_allocate').val(response.mechanic_id).trigger('change');

				}, error: function (xhr) {
					alert(xhr.responseText);
				},
				complete: function (data) {
					// Hide image container
					$("#editLoader").hide();
				}
			});
		}

		function mechanicComment(id) {
			$('#mechanicComment').modal('show');
			$.ajax({
				type: 'POST',
				url: 'tokenAdd.php',
				data: {
					id: id,
					"Action": 'getMechanic'
				},
				dataType: 'json',
				beforeSend: function () {
					// Show image container
					$("#editLoader").show();
				},
				success: function (response) {
					//alert(JSON.stringify(response));
					$('#id_fr_mc_info').val(response.id);
					$('#mechanicInfo').val(response.m_name ? response.m_name : '');
					$('#problems').text(response.problems ? response.problems : '');
				},
				error: function (xhr) {
					alert(xhr.responseText);
				},
				complete: function (data) {
					// Hide image container
					$("#editLoader").hide();
				}
			});
		}


		function addEgineerRequisition(id) {
			$('#addEgineerRequisition').modal('show');
			$.ajax({
				type: 'POST',
				url: 'tokenAdd.php',
				data: { id: id },
				dataType: 'json',
				beforeSend: function () {
					// Show image container
					$("#editLoader").show();
				},
				success: function (response) {
					//alert(JSON.stringify(response));
					$('#deletid').val(response.id);
					$('#deletTripid').html(response.id);


				}, error: function (xhr) {
					alert(xhr.responseText);
				},
				complete: function (data) {
					// Hide image container
					$("#editLoader").hide();
				}
			});
		}



		function confirmDelete(id) {

			if (confirm('Are you sure you want to delete?')) {
				$.ajax({
					type: 'POST',
					url: 'quotationAdd.php',
					data: {
						id: id,
						"Action": 'deleteQuotation'
					},
					dataType: 'json',
					beforeSend: function () {
						// Show image container
						$("#editLoader").show();
					},
					success: function (response) {
						//alert(JSON.stringify(response));
						manageTokenTable.ajax.reload(null, false);
					}, error: function (xhr) {
						alert(xhr.responseText);
					},
					complete: function (data) {
						// Hide image container
						$("#editLoader").hide();
					}
				});
			} else {

			}
		}





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
					$('#deletvehicleNumber').html(response.vehicle_number);
					$('#EditpurchaseDate').val(response.purchase_date);
					$('#EditMakersName').val(response.makers_name);
					$('#Editpurchase_date').val(response.purchase_date);
					$('#EditYearOfManufacture').val(response.year_of_manufacture);
					$('#ChesisNumber').val(response.chasis_number);
					$('#EnginNumber').val(response.engin_number);
					$('#EditBranchStatus').val(response.branch_status);

					$('#Users').val(response.users);

					$('#RegistrationCirtificate12').html("<img src='../images/registration/" + response.registration_cirtificate + "' style='width: 100%;height: 90px;border-radius: 15%;'/>");
					$('#Insurancecertificate12').html("<img src='../images/insurance/" + response.insurance_cirtificate + "' style='width: 100%;height: 90px;border-radius: 15%;'/>");
					$('#PermitCirtificate12').html("<img src='../images/permit/" + response.permit_cirtificate + "' style='width: 100%;height: 90px;border-radius: 15%;'/>");
					$('#PollutionCirtificate12').html("<img src='../images/pollution/" + response.pollution_cirtificate + "' style='width: 100%;height: 90px;border-radius: 15%;'/>");

				}
			});
		}



	</script>
</body>

</html>
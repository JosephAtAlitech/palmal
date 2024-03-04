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
							<div class="box-header with-border">
								<a href="#addnewToken" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i
										class="fa fa-plus"></i> Add Token</a>
							</div>
							<div class="row">
								<div class="col-xs-6">

								</div>
								<div class="col-xs-6">
									<div id='divMsg' class='alert alert-success alert-dismissible successMessage'>
									</div>
									<div id='divErrorMsg' class='alert alert-danger alert-dismissible errorMessage'>
									</div>
								</div>
							</div>
							<div class="box-body">

								<table id="tokenTable" class="table table-bordered">
									<thead>
										<th>id</th>
										<th>Token No</th>
										<th>Token Title</th>
										<th>Mechanic Info</th>
										<th>Engneer</th>
										<th>Requisions</th>
										<th>Quotations</th>
										<th>Status</th>
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

		var roNo = 1;
		function addRow() {
			$.ajax({
				type: 'POST',
				url: 'tokenAdd.php',
				data: {
					"Action": 'getUnit'
				},
				dataType: 'json',
				beforeSend: function () {
					// Show image container
					$("#editLoader").show();
				},
				success: function (response) {

					var data = '';
					data += '<tr id="rowId_' + roNo + '"><td><input type="hidden" value="-1"  id="requisition_id_' + roNo + '" ><input class="form-control" placeholder="Product Name" id="products_' + roNo + '" type="text"></td><td><input class="form-control" placeholder="Specification" id="spec_' + roNo + '" type="text"></td><td><input class="form-control" placeholder="Quantity" id="qty_' + roNo + '" type="number"></td><td><select class="custom-select form-control" id="unit_' + roNo + '" name="unit_' + roNo + '" aria-describedby="inputGroupSuccess1Status">';

					data += '<option value="0">Select Unit</option>';
					for (var i = 0; i < response.length; i++) {
						data += '<option value="' + response[i].unitName + '">' + response[i].unitName + '</option>';
					}
					data += '</select></td><td><input class="form-control" placeholder="Remarks" id="remarks_' + roNo + '" type="text"></td><td><i class="fa fa-trash" style="font-size: 22px; padding: 1px; " aria-hidden="true" onclick="deleteReq(' + roNo + ')"></i></td></tr>';
					$('#requisitionTableBody').append(data);
					roNo++;
				}, error: function (xhr) {
					alert(xhr.responseText);
				},
				complete: function (data) {
					// Hide image container
					$("#editLoader").hide();
				}
			});

		}


		function deleteReq(row) {

			if (confirm('Are you sure you want to delete?')) {
				$('#rowId_' + row).remove();
			} else {

				return
			}

		}
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
			manageTokenTable = $("#tokenTable").DataTable({
				'ajax': 'tokenAdd.php',
				'order': [],
				'dom': 'Bfrtip',
				'buttons': [
					'pageLength', 'copy', 'csv', 'pdf', 'print'
				],
				language: {
					processing: "<img src='../images/loader.gif'>"
				}

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
								$("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Token Added");
								$("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
									$(this).hide(); n();
								});
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
							if (result != "success") {
								//alert(JSON.stringify(result));
							} else if (result == "success") {
								$('#allocateMechanic').modal('hide');
								$("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Mechanic Allocated");
								$("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
									$(this).hide(); n();
								});
							}
							alert(JSON.stringify(result));
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
							if (result != '\"success\"') {
								alert(JSON.stringify(result));
							} else if (result == '\"success\"') {
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


		function saveRequisition() {

			var id = $('#id_fr_req').val();
			var engineerComment = $('#engineerCommentForRequisition').val();
			var engineerRequisitionDate = $('#engineerRequisitionDate').val();
			
			//alert(engineerComment+"  "+engineerRequisitionDate)
			
			var regEx = /^[0-9a-zA-Z]+$/;
			if (engineerComment.match(regEx)) {
				$('#engineerCommentForError').text('');
			}
			else {
				$('#engineerCommentForError').text("Please enter letters and numbers only.");
				return;
			}
			
			
			var requisition_ids = [];
			$('input[id^="requisition_id_"]').each(function () {
				var $this = $(this);
				requisition_ids.push($this.val());
			});

			var flag_p = 0;
			var products = [];
			$('input[id^="products_"]').each(function () {
				var $this = $(this);
				products.push($this.val());
				if ($this.val() == '') {
					alert("Product Cannot empty!!")
					flag_p = 1;
					return false;
				}
			});

			if (flag_p == 1) {
				return;
			}
			var specs = [];
			$('input[id^="spec_"]').each(function () {
				var $this = $(this);
				specs.push($this.val());
			});
			var flag = 0;
			var qty = [];
			$('input[id^="qty_"]').each(function () {
				var $this = $(this);
				if ($this.val() < 1) {
					alert("Cannot take Quantity less then 1 !!")
					flag = 1;
					return false;
				}
				qty.push($this.val());
			});
			if (flag == 1) {
				return;
			}

			var flag_u = 0;
			var units = [];
			$('select[id^="unit_"]').each(function () {
				var $this = $(this);
				units.push($this.val());
				if ($this.val() == '') {
					alert("Unit Cannot empty!!")
					flag_u = 1;
					return false;
				}
			});
			if (flag_u == 1) {
				return;
			}

			var remarks = [];
			$('input[id^="remarks_"]').each(function () {
				var $this = $(this);
				remarks.push($this.val());
			});
		
			var fd = new FormData();

			fd.append('id', id);
			fd.append('engineerRequisitionDate', engineerRequisitionDate);
			fd.append('engineerComment', engineerComment);
			fd.append('requisition_ids', requisition_ids);
			fd.append('products', products);
			fd.append('specs', specs);
			fd.append('qty', qty);
			fd.append('units', units);
			fd.append('remarks', remarks);
			fd.append('Action', 'addRequisitions');
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
					} else if (result == 'success') {
						$('#addEgineerRequisition').modal('hide');
							$("#divMsg").html("<strong><i class='icon fa fa-check'></i>Success ! </strong> Mechanic Allocated");
								$("#divMsg").show().delay(2000).fadeOut().queue(function (n) {
									$(this).hide(); n();
								});
					}
					$('#engineerCommentForRequisition').val('');
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

		}

		function allocateMechanic(id) {
			$('#allocateMechanic').modal('show');
			$.ajax({
				type: 'POST',
				url: 'tokenAdd.php',
				data: {
					id: id,
					"Action": 'getMechanicAndEngineer'
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
					"Action": 'getMechanicAndEngineer'
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
				data: {
					id: id,
					"Action": 'getMechanicAndEngineer'
				},
				dataType: 'json',
				beforeSend: function () {
					// Show image container
					$("#editLoader").show();
				},
				success: function (result) {

					$('#id_fr_req').val(result.id);
					$('#tokenTitleForRequisition').val(result.token_title ? result.token_title : '');
					$('#tokenDateForRequisition').val(result.token_date ? result.token_date : '');
					$('#mechanicNameForRequisition').val(result.m_name ? result.m_name : '');
					$('#mechanicCommentForRequisition').val(result.problems ? result.problems : '');
					$('#engineerNameForRequisition').val(result.e_name ? result.e_name : '');
					$('#engineerCommentForRequisition').text(result.engr_req_details ? result.engr_req_details : '');

					$.ajax({
						type: 'POST',
						url: 'tokenAdd.php',
						data: {
							id: id,
							"Action": 'getTokenRequisition'
						},
						dataType: 'json',
						beforeSend: function () {
							// Show image container
							$("#editLoader").show();
						},
						success: function (response) {
						
							//alert(JSON.stringify(response.length));
							var i = 0;
							data = '';
							$('#requisitionTableBody').html('');
							for (i = 0; i < response['requisitions'].length; i++) {
								data += '<tr id="rowId_' + i + '"><td><input type="hidden" id="requisition_id_' + i + '" value="' + response['requisitions'][i].id + '"><input class="form-control" placeholder="Product Name" id="products_' + i + '" type="text" value="' + response['requisitions'][i].req_product + '"></td><td><input class="form-control" placeholder="Specification" id="spec_' + i + '" type="text" value="' + response['requisitions'][i].spec + '"> </td><td><input class="form-control" placeholder="Quantity" id="qty_' + i + '" type="number" value="' + response['requisitions'][i].qty + '"></td><td><select class="form-control" placeholder="Unit" id="unit_' + i + '"  value="' + response['requisitions'][i].unit + '">';
								data += '<option value="0">Select Unit</option>';
								for (var j = 0; j < response['units'].length; j++) {
									if (response['units'][i].unitName == response['requisitions'][i].unit) {
										data += '<option value="' + response['units'][j].unitName + '" selected>' + response['units'][j].unitName + '</option>';
									} else {
										data += '<option value="' + response['units'][j].unitName + '">' + response['units'][j].unitName + '</option>';
									}
								}
								data += '</select></td><td><input class="form-control" placeholder="Remarks" id="remarks_' + i + '" type="text" value="' + response['requisitions'][i].remarks + '"></td><td><i class="fa fa-trash" style="font-size: 22px; padding: 1px; " aria-hidden="true" onclick="deleteReqFromSource(' + i + ',' + response['requisitions'][i].id + ')"></i></td></tr>';
				             }
							 $('#requisitionTableBody').append(data);
							roNo = i;

						}, 
						error: function (xhr) {
							alert(xhr.responseText);
						},
						complete: function (data) {
								// Hide image container
								$("#editLoader").hide();
						}
					});

				}, error: function (xhr) {
			alert(JSON.stringify(xhr));
		},
		complete: function (data) {
			// Hide image container
			$("#editLoader").hide();
		}
			});

		}

		function deleteReqFromSource(row, id) {

			if (confirm('Are you sure you want to delete?')) {
				$.ajax({
					type: 'POST',
					url: 'tokenAdd.php',
					data: {
						id: id,
						"Action": 'deleteRequisition'
					},
					dataType: 'json',
					beforeSend: function () {
						// Show image container
						$("#loading").show();
					},
					success: function (response) {

						$('#rowId_' + row).remove();
					}, error: function (xhr) {
						alert(xhr.responseText);
					},
					complete: function (data) {
						// Hide image container
						$("#loading").hide();
					}
				});

			} else {

				return
			}

		}




		function confirmDelete(id) {

			if (confirm('Are you sure you want to delete?')) {
				$.ajax({
					type: 'POST',
					url: 'tokenAdd.php',
					data: {
						id: id,
						"Action": 'deleteToken'
					},
					dataType: 'json',
					beforeSend: function () {
						// Show image container
						$("#loading").show();
					},
					success: function (response) {
						//alert(JSON.stringify(response));
						manageTokenTable.ajax.reload(null, false);
					}, error: function (xhr) {
						alert(xhr.responseText);
					},
					complete: function (data) {
						// Hide image container
						$("#loading").hide();
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


	</script>
</body>

</html>
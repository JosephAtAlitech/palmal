<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
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
				<h1>Quotation Information</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Quotation List</li>
				</ol>
			</section>

			<section class="content">

				<link rel="stylesheet" href="buttons.dataTables.min.css" />
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<?php

							if (isset($_GET['id'])) {
								$id = $_GET['id'];
								$filePDF = '';
								$sql = "SELECT tbl_token.*,vehicle_master.vehicle_number, m.firstname m_name, e.firstname e_name FROM `tbl_token`
								left outer join vehicle_master  on tbl_token.vehicle_id = vehicle_master.id
								inner join admin as e on tbl_token.engineer_id = e.id
								left outer join admin as m on tbl_token.mechanic_id = m.id
								where tbl_token.deleted = 'No'  AND tbl_token.id = $id ORDER BY id  DESC";
								$query = $conn->query($sql);
								$row = $query->fetch_assoc();
								$sql1 = "SELECT tbl_lower_bidder_info.id,ed_uplead_file from tbl_lower_bidder_info where deleted ='No' AND token_id =$id ";
								$query1 = $conn->query($sql1);
								//$row1 = $query1->fetch_assoc();
								$row1No = $query1->num_rows;
								if($row1No > 0){
									$row1 = $query1->fetch_assoc();
									if ($row1['ed_uplead_file'] != '') {
										$filePD = $row1['ed_uplead_file'];
										$filePDF = '<a href="../images/quotation/' . $filePD . '" target="_blank">ED Uploaded PDF</a>';
									} else {
										$filePDF = '';
									}
								}
							} else {
								$id = '';
							}
							?>
							<div class="box-header with-border">
								<input type="hidden" id="token_id"
									value="<?= isset($_GET['id']) ? $id = $_GET['id'] : '' ?>">
									<?php if($row1No > 0){ ?>
								     <a href="#"
									data-toggle="modal" class="btn btn-primary btn-sm btn-flat"  ><i
										class="fa fa-plus"></i> Add Quotation</a> 	<?php }else {?>
											<a href="addQuotationView.php?Token_id=<?= isset($_GET['id']) ? $id = $_GET['id'] : '' ?>&type=procurement"
									data-toggle="modal" class="btn btn-primary btn-sm btn-flat"   ><i
										class="fa fa-plus"></i> Add Quotation</a> <?php } ?>
								<div class="btn-group">
									<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false">
										Set Lower Bidder
									</button>
									<div class="dropdown-menu">
									<li><a class="dropdown-item" onclick="setLowerBidder()"><b>Generate Lower Bidder</b></a></li>
										<li><a
												onclick="confirmApproval('<?php  echo $id ?>','\'auditor\'')"><i
													class="fa fa-edit"></i> Auditor Vetting</a></li>
										<li><a
												onclick="confirmApproval('<?php  echo $id ?>','\'mngmnt\'')"><i
													class="fa fa-edit"></i> Management Vetting</a></li>
										<li><a onclick="prGenerate('<?php echo $id ?>')"><i
													class="fa fa-edit"></i> PR Generate</a></li>
										<li><a onclick="confirmApproval('<?php echo $id ?>','\'ed\'')"><i
													class="fa fa-edit"></i> Management Approval</a></li>
										<li><a onclick="poApproval('<?php echo $id ?>')"><i
													class="fa fa-edit"></i> PO Approval</a></li>
										<li><a onclick="storeDeprt(' <?php echo $id ?>')"><i
													class="fa fa-edit"></i> Store Deprt</a></li>
										<li><a onclick="confirmProcurement('<?php echo $id ?>')"><i
													class="fa fa-edit"></i> Final Approval</a></li>

									</div>
								</div>
								<hr>

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
								<div class="row">
									<?php
									if (isset($_GET['id'])) {
										$id = $_GET['id'];
										$sql = "SELECT tbl_token.*,vehicle_master.vehicle_number, vehicle_master.employee_name,m.firstname m_name, e.firstname e_name FROM `tbl_token`
												left outer join vehicle_master  on tbl_token.vehicle_id = vehicle_master.id
												inner join admin as e on tbl_token.engineer_id = e.id
												left outer join admin as m on tbl_token.mechanic_id = m.id
												where tbl_token.deleted = 'No'  AND tbl_token.id = $id ORDER BY id  DESC";
										$query = $conn->query($sql);
										$row = $query->fetch_assoc();


										$tokenNo = $row['token_no'];
										$vehicle_number = $row['vehicle_number'];
										$employee_name = $row['employee_name'];
										$tokenDate = $row['token_date'];
										$engineerName = $row['e_name'];
										$problem = $row['problems'];
										//$str="Service No: $tokenNo \nService Date:  $tokenDate \nEngineer Name: $engineerName \nProblem Definition: $problem ";
										?>

										<div class=" form-group col-md-4">
											<label for="">Demand No | Vehicle No</label>
											<input type="text" class="form-control"
												value="<?= $tokenNo ?> | (<?= $vehicle_number ?> : <?= $employee_name ?>)"
												)" disabled>
										</div>
										<div class="form-group col-md-4">
											<label for="">Demand Date</label>
											<input type="text" class="form-control" value="<?= $tokenDate ?>" readonly>
										</div>
										<div class="form-group col-md-4">
											<label for="">Engineer Name</label>
											<input type="text" class="form-control" value="<?= $engineerName ?>" readonly>
										</div>

										<div class="form-group col-md-12">
											<label for="">Problem Definition</label>
											<textarea class="form-control" cols="10" readonly><?= $problem ?></textarea>
										</div>
										<div class="form-group col-md-12">
										<?= $filePDF?>
										</div>
										
										<?php
									} ?>
								</div>
							</div>
							<div class="box-body">
								<table id="quotationTable" class="table table-bordered">
									<thead>
										<th>id</th>
										<th>Quotation Date No</th>
										<th>Quote By</th>
										<th>Token Title</th>
										<th>Quote Products</th>
										<th>Quote Amount</th>
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
	<script src="includes/js/quotation-manage.js"></script>
</body>

</html>
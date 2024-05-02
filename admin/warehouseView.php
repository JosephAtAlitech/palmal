<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php';?>

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
				<h1>Workshop Information</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Workshop List</li>
				</ol>
			</section>

			<section class="content">

				<link rel="stylesheet" href="buttons.dataTables.min.css" />
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header with-border">
								<a href="#addnewWorkshop" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i
										class="fa fa-plus"></i> Add Workshop </a>
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

								<table id="warehouseTable" class="table table-bordered">
									<thead>
										<th>No</th>
										<th>Workshop Name</th>
										<th>Description</th>
										<th>Workshop Type</th>
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
		<?php include 'includes/warehouseAdd-modal.php'; ?>
		<?php include 'includes/js/warehouse-manage.php'; ?>
	</div>
	<?php include 'includes/scripts.php'; ?>
	<script src='../bootstrapvalidator.min.js'></script>
	<script src="select2/select2.min.js"></script>
	<script src="includes/js/warehouse-manage.js"></script>

</body>

</html>
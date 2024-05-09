<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<style>
	.select-group input.form-control { width: 65% }
	.select-group select.input-group-addon { width: 35%;}

	.hexa {
		background-color: #3FDD50;
        padding: 20px 30px 30px 30px;
        margin: 2px 2px;
        color: #424242;
        justify-content: center;
        align-items: center;
        clip-path: polygon(8% 24%, 72% 24%, 89% 50%, 74% 75%, 7% 76%, 16% 50%);
        font-size: 11px;
        width: 97%;
	}
    .divbox {
		padding: 10px;
        margin: 6% 0% 0% 0%;
        border: 1px solid #bfbfbf;
        background-color: antiquewhite;
        border-radius: 7%;
		display: block ;
	}
	.divRemarksBox {
		padding: 10px;
        margin: 11px 5px;
        border: 1px solid #ddd;
        background-color: white;
        justify-content: center;
        align-items: center;
        border-radius: 5%;
	}
	.midbox{ 
		display: block ;
	}
	.arrow{ margin: 40px 5px;width: 100%;}
	#logtable tr:last-child { background: #d2d2d2;}
	
	
</style>
<link rel="stylesheet" href="select2/select2.min.css" />

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<?php include 'includes/navbar.php'; ?>
		<?php include 'includes/menubar.php'; ?>


		<div class="content-wrapper">

			<section class="content-header">
				<h1>Maintenance Information</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Service List</li>
				</ol>
			</section>

			<section class="content">

				<link rel="stylesheet" href="buttons.dataTables.min.css" />
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header with-border">
								<a href="#addnewToken" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Service </a>
							</div>
							<div class="row">
								<div class="col-xs-6"></div>
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
										<th>Service info</th>
										<th>Details Info</th>
										<th>Requisitions</th>
										<th>Quotations Info</th>
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
	<script src="includes/js/token-manage.js"></script>

</body>

</html>
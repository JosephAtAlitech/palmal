<?php include 'includes/session.php'; 
	include '../timezone.php'; 
	$today = date('Y-m-d');
	$year = date('Y');
	if(isset($_GET['year'])){
    $year = $_GET['year'];
	}
	$first_date = date('Y-m-d',strtotime('first day of this month'));
	$last_date = date('Y-m-d',strtotime('last day of this month'));
	$first_day_of_year=date('Y-m-d', strtotime('first day of january this year'));
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<link rel="stylesheet" href="select2/select2.min.css"/>
<div class="wrapper">
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1> Requisition Sheets</h1>
              <ol class="breadcrumb">
                <li><a href="manage-view.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Requisition Sheets</li>
              </ol>
            </section>
            <!-- Main content -->
            <section class="content">
              <link rel="stylesheet" href="css/buttons.dataTables.min.css"/>
              <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header with-border">
                        <div class="col-xs-6"></div>
            			<div class="col-xs-6">
            				<div id='divMsg' class='alert alert-success alert-dismissible' style='margin: -13% -5% -4% 20%;display:none;'></div>
            				<div id='divErrorMsg' class='alert alert-danger alert-dismissible' style='margin: -13% -5% -4% 20%;display:none;'></div>
            			</div>
                    </div>
                    <div class="box-body">
					<form class="form-horizontal" id="form_vechicleRequisition" method="POST" action="#">
						<div class="form-group">
							<div class="col-sm-2"></div>
							<div class="col-sm-8">
								<div class="col-lg-5">
								<label for="factory">Factory Name</label>
								<select class="form-control" name="factory" id="factory" required>
									<option value="" selected>~~ Choose Factory ~~</option>
									<?php
									$sql = "SELECT id, branch_name, branch_code FROM branch_master order by id DESC";
									$query = $conn->query($sql);
									while ($prow = $query->fetch_assoc()) {
										echo "<option value='" . $prow['id'] . "'>" . $prow['branch_name'] ."</option>";
									}
									?>
								</select>
								</div>
							</div> 
						</div>				
						<div class="table-responsive">
							<h2>Make Requisition Sheets </h2>
							<h2 id="sql"></h2>
							<table class="table table-hover">
								<thead style="background-color: #4d4d4d;color: white;">
								  <tr>
									<th><!--input type="checkbox" name="all" id="checkall"--></th>
									<th>Vehicle Number</th>
									<th>Expire Date</th>
									<th>Document Name</th>
									<th>Office Money</th>
									<th>Token Money</th>
									<th>Others Money</th>
				
								  </tr>
								</thead>
								<tbody id="table_completedProductList"></tbody>
							</table>
							<button type='submit' class='btn btn-success btn-sm btn-flat' id="btn_riderPaymentStatus" Disabled> Generate Requisition Reports</button>
						</div>
					</form>
                </div>
              </div>
              </div>
              
                
            </section>   
            
        </div>
       
      <?php include 'includes/footer.php'; ?>
    </div>
     
</div>
<?php include 'includes/scripts.php'; ?>
<script src="js/requsitionScripts.js"></script>
<script src="select2/select2.min.js"></script>
<script>
    $("#factory").select2( {
    	placeholder: "Select Factory Name",
    	allowClear: true
    	} );
	$("#factoryName").select2( {
    	placeholder: "Select factoory name",
    	allowClear: true
    	} );
	
</script>
</body>
</html>

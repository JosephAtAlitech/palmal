<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tax Certificate Alert (30 Days Advance)
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tax Token Certificate</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
	  <link rel="stylesheet" href="buttons.dataTables.min.css"/>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>Vehicle Number</th>
					<th>Chasis Number</th>
					<th>Engin Number</th>
					<th>TaxToken Certificate</th>
					<th>TaxToken Start Date</th>
					<th>TaxToken End Date</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
					/*	$sql = "SELECT id,vehicle_number,chasis_number,engin_number,tax_certificate,tax_start_date,tax_end_date FROM vehicle_master
							WHERE tax_end_date >= NOW() - INTERVAL 4 DAY AND tax_end_date  <= NOW() + INTERVAL 30 DAY  
							ORDER BY `vehicle_master`.`tax_end_date`  ASC";*/
					$sql = "SELECT id,vehicle_number,chasis_number,engin_number,tax_certificate,tax_start_date,tax_end_date FROM vehicle_master
							WHERE tax_end_date  <= NOW() + INTERVAL 30 DAY  
							ORDER BY `vehicle_master`.`tax_end_date`  ASC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td>".$row['vehicle_number']."</td>
							<td>".$row['chasis_number']."</td>
							<td>".$row['engin_number']."</td>
							<td>".$row['tax_Certificate']."</td>
							<td>".$row['tax_start_date']."</td>
							<td>".$row['tax_end_date']."</td>
							<td style='width: 9%;'>
								<a href='vehicleHistory-viewpdf.php?vid=".$row['id']."' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i> Print </a>
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
</div>
<?php include 'includes/scripts.php'; ?>

<script type="text/javascript">

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

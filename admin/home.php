<?php include 'includes/session.php'; 
    include '../timezone.php'; 
    $today = date('Y-m-d');
    $factory = '10';
    if(isset($_GET['factory'])){
        $factory = $_GET['factory'];
    }
	
?>
<style>
* {box-sizing: border-box}
/* Style tab links */
.tablink {background-color: #555;color: white;float: left;border: none;outline: none;cursor: pointer;font-size: 17px;width: 25%;border-radius: 20px 30px 0px 55px;box-shadow: 1px 2px #7b7b7b;}
.tablink:hover { background-color: #777;}
.shoaib{background-color:white;left: -5px;box-shadow: 0px 1px 3px 2px #d2cccc;border-radius: 10px;}
.shoaibLink{margin: 8px 0px 7px 0px;box-shadow: 0px 1px 1px 2px#baeadf;border-radius: 5px;}
.shoaibSpan{font-size: 30px;font-weight: 800;margin-left: 27%;color: #ff3407;}
/* Style the tab content (and add height:100% for full page content) */
.tabcontent {color: black;display: none;padding: 10px 10px;}
.exp div {margin-top: -50px;height: 100px;text-align: center;box-shadow: -3px 2px 5px 4px #7eb4d36b;}
#Home {background-color:#f9f9f9;box-shadow: 2px 5px 5px 2px#dfdfdf;border-radius: 7px;}
#News {background-color:#f9f9f9;box-shadow: 2px 5px 5px 2px#dfdfdf;border-radius: 7px;}
#Contact {background-color:#f9f9f9;box-shadow: 2px 5px 5px 2px#dfdfdf;border-radius: 7px;}
#About {background-color:#f9f9f9;box-shadow: 2px 5px 5px 2px#dfdfdf;border-radius: 7px;}
#customers {font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; border-collapse: collapse;width: 100%;margin: 8px 0px 7px 0px;}
#customers td, #customers th { border: 1px solid #ddd;padding: 8px; }
#customers tr:nth-child(even){background-color: #f2f2f2;}
#customers tr:hover {background-color: #ddd;}
#customers th {padding-top: 10px;padding-bottom: 10px;text-align: left;background-color: #9D9D9D;color: white;}
#legend12 ul {
    list-style: none;
}
#legend12 ul li {
    display: inline;
    padding-left: 30px;
    position: relative;
    margin-bottom: 4px;
    border-radius: 5px;
    padding: 2px 8px 2px 28px;
    font-size: 14px;
    cursor: default;
    -webkit-transition: background-color 200ms ease-in-out;
    -moz-transition: background-color 200ms ease-in-out;
    -o-transition: background-color 200ms ease-in-out;
    transition: background-color 200ms ease-in-out;
}
#legend12 li span {
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 20px;
    height: 100%;
    border-radius: 5px;
}
</style>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  	<?php include 'includes/navbar.php'; ?>
  	<?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Dashboard <?php echo $user['username']; ?> - <?php echo $user['id']; ?> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
	<section class="content">
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
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      
        <div class="col-lg-2 col-xs-3">
          <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM vehicle_master WHERE delete_status='Active'";
                $query = $conn->query($sql);

				echo "<h3><b style='color: #fff;'>".$query->num_rows."</b></h3>";
              ?>

              <p>Total Active<br>Vehicles</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="vehicle-master.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>
        
	
		<div class="col-lg-2 col-xs-3">
			  <!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <?php
					$sql = "SELECT COUNT(id) AS id FROM vehicle_master
							WHERE delete_status='Active' and insu_end_date  <= NOW() + INTERVAL 7 DAY  
							ORDER BY `vehicle_master`.`insu_end_date`  ASC";
				   $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						echo "<h3><b style='color: #fff;'>".$row['id']."</b></h3>";
					}
				?>

				  <p>Insurance <br>last(07 Days)</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-stalker"></i>
				</div>
				<a href="insurance-cirtificateAlert.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>	
			<div class="col-lg-2 col-xs-3">
			  <!-- small box -->
			  <div class="small-box bg-orange">
				<div class="inner">
				  <?php
					$sql = "SELECT COUNT(id) AS id FROM vehicle_master
							WHERE delete_status='Active' and reg_end_date  <= NOW() + INTERVAL 7 DAY  
							ORDER BY `vehicle_master`.`reg_end_date`  ASC";
				   $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						echo "<h3><b style='color: #fff;'>".$row['id']."</b></h3>";
					}

				   
				  ?>

				  <p>Registration <br>last(07 Days)</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-stalker"></i>
				</div>
				<a href="registration-cirtificateAlert.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>	
			<div class="col-lg-2 col-xs-3">
			  <!-- small box -->
			  <div class="small-box bg-green">
				<div class="inner">
				  <?php
					$sql = "SELECT COUNT(id) AS id FROM vehicle_master
							WHERE delete_status='Active' and pollu_end_date  <= NOW() + INTERVAL 7 DAY  
							ORDER BY `vehicle_master`.`pollu_end_date`  ASC";
				   $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						echo "<h3><b style='color: #fff;'>".$row['id']."</b></h3>";
					}
				?>

				  <p>Fitness <br>last(07 Days)</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-stalker"></i>
				</div>
				<a href="fitness-cirtificateAlert.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>	
			<div class="col-lg-2 col-xs-3">
			  <!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <?php
					$sql = "SELECT COUNT(id) AS id FROM vehicle_master
							WHERE delete_status='Active' and per_end_date  <= NOW() + INTERVAL 7 DAY  
							ORDER BY `vehicle_master`.`per_end_date`  ASC";
				   $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						echo "<h3><b style='color: #fff;'>".$row['id']."</b></h3>";
					}
				?>

				  <p>Route Permit <br>last(07 days)</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-stalker"></i>
				</div>
				<a href="route-cirtificateAlert.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>	
			<div class="col-lg-2 col-xs-3">
			  <!-- small box -->
			  <div class="small-box bg-green">
				<div class="inner">
				  <?php
					$sql = "SELECT COUNT(id) AS id FROM vehicle_master
							WHERE delete_status='Active' and tax_end_date  <= NOW() + INTERVAL 7 DAY  
							ORDER BY `vehicle_master`.`tax_end_date`  ASC";
				   $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						echo "<h3><b style='color: #fff;'>".$row['id']."</b></h3>";
					}
				?>

				  <p>Tax Token <br>last(07 Days)</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-stalker"></i>
				</div>
				<a href="tax-cirtificateAlert.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>	
			
		<div class="row">
        <div class="col-lg-12">
			<div class="col-lg-6">
				<div class="box">
				<div class="box-header with-border">
				  <div class="col-lg-12">
					  <div class="form-group">
						<label>Select Factory: </label>
						<select class="form-control input-sm" id="selectBranch">
							<?php
							$sql = "SELECT id, branch_name, branch_code FROM branch_master order by id DESC";
							$query = $conn->query($sql);
							
							while($row = $query->fetch_assoc()){
								$selected = ($row['id']==$factory)?'selected':'';
								echo "<option value='".$row['id']."' ".$selected.">".$row['branch_name']." - ".$row['branch_code']."</option>";
							}
							?>
						</select>
					  </div>
					</div>
					<h4 style="text-align: center;">Fuel Summary Report Last 07 Days</h4>
				</div>
				<div class="box-body">
				  <div class="chart">
					<div id="legend" class="text-center"></div>
					<canvas id="barChart" style="height:350px"></canvas>
				  </div>
				</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="box">
				<div class="box-header with-border">
				  <div class="">
					<div class="col-lg-12">
					  <div class="form-group">
						<label>Select Factory: </label>
						<select class="form-control input-sm" id="selectBranch12">
							<?php
							$sql = "SELECT id, branch_name, branch_code FROM branch_master order by id DESC";
							$query = $conn->query($sql);
							
							while($row = $query->fetch_assoc()){
								$selected12 = ($row['id']==$factory)?'selected':'';
								echo "<option value='".$row['id']."' ".$selected12.">".$row['branch_name']." - ".$row['branch_code']."</option>";
							}
							?>
						</select>
					  </div>
					</div>  
				  </div>
				<h4 style="text-align: center;">Trip Summary Report Last 07 Days</h4>
				</div>
				<div class="box-body">
				  <div class="chart">
					<div id="legend12" class="text-center"></div>
					<canvas id="barChart12" style="height:350px"></canvas>
				  </div>
				</div>
				</div>
			</div>
        </div>
		</div>
    </section>
      <!-- right col -->
    </div>
  	<?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->
<?php include 'includes/scripts.php'; ?>
<?php
  $months = array();
  $ontime = array();
  $late = array();
 
			$sql = "SELECT SUM(diesel_litre) as diesel, SUM(total_amount) as total, vehicle_master.vehicle_number 
					FROM diesel_reports 
					INNER JOIN vehicle_master ON diesel_reports.vehicle_no = vehicle_master.id
					WHERE  vehicle_master.branch_status = '".$factory."' and diesel_reports.create_date  <= NOW() + INTERVAL 7 DAY
					GROUP BY vehicle_master.vehicle_number";
			$oquery = $conn->query($sql);
			while($rows = $oquery->fetch_assoc()){
				array_push($months, $rows['vehicle_number']);
				array_push($ontime, $rows['diesel']);
				array_push($late, $rows['total']);
			}
		

  $months = json_encode($months);
  $late = json_encode($late);
  $ontime = json_encode($ontime);
?>

<script>
$(function(){
	$("#selectBranch").change(function(){
		window.location.href = 'home.php?factory='+$(this).val();
	})
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChart = new Chart(barChartCanvas)
  var barChartData = {
    labels  : <?php echo $months; ?>,
    datasets: [
      {
        label               : 'Amount',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : <?php echo $late; ?>
      },
      {
        label               : 'Fuel',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $ontime; ?>
      }
    ]
  }
  barChartData.datasets[1].fillColor   = '#00a65a'
  barChartData.datasets[1].strokeColor = '#00a65a'
  barChartData.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart = barChart.Bar(barChartData, barChartOptions)
  document.getElementById('legend').innerHTML = myChart.generateLegend();
});
</script>
<?php
  $months = array();
  $ontime = array();
  $late = array();
  
	$sql12 = "SELECT COUNT(trip_sheets.trip_number)AS totalTrip,vehicle_master.vehicle_number,
				SUM(trip_sheets.travel_distance) AS totaTravel,SUM(trip_sheets.vft_km)AS totalVftkm
				FROM `trip_sheets` 
				LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
				WHERE vehicle_master.branch_status = '".$factory."' and trip_sheets.create_date  <= NOW() + INTERVAL 7 DAY
				GROUP BY vehicle_master.vehicle_number";
	$oquery12 = $conn->query($sql12);
			
	while($rows = $oquery12->fetch_assoc()){
		array_push($months, $rows['vehicle_number']);
		array_push($ontime, $rows['totaTravel']);
		array_push($late, $rows['totalTrip']);
	}
		
  

  $months12 = json_encode($months);
  $late12 = json_encode($late);
  $ontime12 = json_encode($ontime);
?>

<script>
$(function(){
	$("#selectBranch12").change(function(){
		window.location.href = 'home.php?factory='+$(this).val();
	})
  var barChartCanvas12 = $('#barChart12').get(0).getContext('2d')
  var barChart12 = new Chart(barChartCanvas12)
  var barChartData12 = {
    labels  : <?php echo $months12; ?>,
    datasets: [
      {
        label               : 'Total Trip',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : <?php echo $late12; ?>
      },
      {
        label               : 'Total Travel Distance',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : <?php echo $ontime12; ?>
      }
    ]
  }
  barChartData12.datasets[1].fillColor   = '#00a65a'
  barChartData12.datasets[1].strokeColor = '#00a65a'
  barChartData12.datasets[1].pointColor  = '#00a65a'
  var barChartOptions                  = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend12"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false
  var myChart12 = barChart12.Bar(barChartData12, barChartOptions)
  document.getElementById('legend12').innerHTML = myChart12.generateLegend();
});
</script>

<script>
	function openPage(pageName,elmnt,color) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablink");
	  for (i = 0; i < tablinks.length; i++) {
		tablinks[i].style.backgroundColor = "";
	  }
	  document.getElementById(pageName).style.display = "block";
	  elmnt.style.backgroundColor = color;
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();

</script>
</body>
</html>

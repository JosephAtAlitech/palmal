 <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>VF Tracker</title>
		<link rel="stylesheet" href="https://gpsreports.in/vftracker/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://gpsreports.in/vftracker/bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://gpsreports.in/vftracker/bower_components/Ionicons/css/ionicons.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="https://gpsreports.in/vftracker/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="https://gpsreports.in/vftracker/dist/css/AdminLTE.min.css">
		


		


		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="https://gpsreports.in/vftracker/dist/css/skins/_all-skins.min.css">
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Google Font -->
		<link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--> 
		
		<script src="https://gpsreports.in/vftracker/bower_components/jquery/dist/jquery.min.js"></script>
		<style type="text/css">
			/* .navbar-nav .nav li a label{
			text-shadow: none;
			}*/
			
			
			.skin-blue .sidebar-menu>li:hover>a
			{
			background-color:#ff9800;
			}
			.skin-blue .sidebar-form input[type="text"], .skin-blue .sidebar-form .btn
			{
			background-color:#FFF;
			}
			.skin-blue .sidebar-form {
    border-radius: 3px;
    border: 10px solid #374850;
    margin: 10px 10px;
}

 .nav>li>a {
    position: relative;
    display: block;
    padding: 10px 10px;
}
label { 
font-weight: 400;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a {
    margin: 0;
    padding: 13px 10px;
    color: #FFF;
    font-family: sans-serif;
    font-size: 12px;
}

.navbar-nav>li>a {
    padding-top: 15px !important;
}
.skin-blue .main-header .logo {
    background-color: #2b3254;
    color: #fff;
    border-bottom: 0 solid transparent;
}
.skin-blue .main-header .navbar {
    background-color: #2b3254;
}
.text-center {
    font-family: 'Source Sans Pro',sans-serif;
    margin-bottom: 31px !important;
    border-bottom: 1px solid #95979e !important;
    padding: 12px !important;
    font-size: 30px;

}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a {
    /* border-bottom: 1px solid #847e7e;*/

}
.pull-right {
    float: left!important;
}
.fa {
    display: inline-block;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 7px 0;
    margin: 4px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #f3ec0a;
    color: #FFF !important;
    margin-top: 7px;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}
.dropdown-menu {
	
	    background-color: #00a0fc;
}
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a:hover {
    background: #2b3254;	
	color: #00a0fc;
}
input[type="date"]::before { 
	content: attr(data-placeholder);
	width: 100%;
}

/* hide our custom/fake placeholder text when in focus to show the default
 * 'mm/dd/yyyy' value and when valid to show the users' date of birth value.
 */
input[type="date"]:focus::before,
input[type="date"]:valid::before { display: none }
#trips_expense_reports thead tr {
    background: #2b3254 !important;
    color: #FFF;
}
input[type="month"]:focus::before,
input[type="month"]:valid::before { display: none }

thead tr {
	background: #2b3254 !important;
    color: #FFF;
	}
	.main-header {
    background: #2b3254 !important;
}
.panel {
    margin-bottom: 20px;
    /* background: #CCC !important; */
    background-color: #fff;
    border-right: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    /* border: 1px solid transparent; */
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
	border-top: 0px;
}
.panel-success>.panel-heading {
    color: #FFF;
    background-color: #3c5a63;
    border-color: #d6e9c6;
}
.panel-heading {
    padding: 0px 0px;
    border-bottom: 0px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
		</style>
	</head>
			<body class="hold-transition skin-blue sidebar-mini" style="">
		<div class="wrapper">	
			<header class="main-header">
				<!-- Logo -->
				<a href="https://gpsreports.in/vftracker/dashboard" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					
					<!-- logo for regular state and mobile devices -->
					<img src="https://gpsreports.in/vftracker/images/vficon1.png" alt="User Image" height="auto" width="50px;">VF TRACKER
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle hidden" data-toggle="push-menu" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					
					<div class="navbar-custom-menu" style="line-height:0px">
						<ul class="nav navbar-nav">
							<li class="dropdown messages-menu">
								<a href="https://gpsreports.in/vftracker/dashboard">
									<!-- <i class="fa fa-envelope-o"></i> 
									<span class="label label-success">4</span>-->
									<label style="text-shadow: none;">Dashboard</label>
								</a>
								
							</li>
							<!--<li class="dropdown messages-menu">
								<a href="">
									
									<label style="text-shadow: none;">Manage Trips</label>
								</a>
								</li>-->
							<!--	
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">									
									<label style="text-shadow: none;">Manage Trips</label>
								</a>
								<ul class="dropdown-menu" style="width: 0px; padding: 0px; max-height: auto;">
									<li>
										
										<ul class="menu"  style="max-height:none;">
											<li>
												<a href="">
													<label style="text-shadow: none;">Master Routes</label>
												</a>
											</li>
											<li>
												<a href="">
													<label style="text-shadow: none;">Notifications List</label>
												</a>
											</li>
											<li>
												<a href="">
													<label style="text-shadow: none;">Today Trips</label>
												</a>
											</li>											
											<li>
												<a href="">
													<label style="text-shadow: none;">Trips History</label>
												</a>
											</li>	
										</ul>
									</li>
								</ul>
							</li>-->
							
									
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">									
									<label style="text-shadow: none;">Expenses</label>
								</a>
								<ul class="dropdown-menu" style="width: 0px; padding: 0px; max-height: auto;">
									<li>
										
										<ul class="menu"  style="max-height:none;">
											<li>
												<a href="https://gpsreports.in/vftracker/trips">
													<label style="text-shadow: none;">Trip Expenses List</label>
												</a>
											</li>
											
											<li>
												<a href="https://gpsreports.in/vftracker/office_expenses">	
													<label style="text-shadow: none;">Office Expenses</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/office_expenses/office_expenses_reports">
													<label style="text-shadow: none;">Office Expenses Reports</label>
												</a>
											</li>
											<!-- end message -->
											<!--
											<li>
												<a href="">
													<label style="text-shadow: none;">Vehicles</label>
												</a>
											</li> 
											 <li>
												<a href="">
													<label style="text-shadow: none;">Geofences</label>
												</a>
											</li>
											-->
											
										</ul>
									</li>
								</ul>
							</li>
							
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">									
									<label style="text-shadow: none;">Vehicle Repairs</label>
								</a>
								<ul class="dropdown-menu" style="width: 0px; padding: 0px; max-height: auto;">
									<li>
										
										<ul class="menu"  style="max-height:none;">
											<li>
												<a href="https://gpsreports.in/vftracker/lorry_repairs">
													<label style="text-shadow: none;">Vehicle Repairs List</label>
												</a>
											</li>
											
											<li>
												<a href="https://gpsreports.in/vftracker/diesel_reports">	
													<label style="text-shadow: none;">Diesel Reports</label>
												</a>
											</li>
											<!-- end message -->
											<!-- <li>
												<a href="">
													<label style="text-shadow: none;">New Lorry Repair</label>
												</a>
											</li>	-->											
										</ul>
									</li>
								</ul>
							</li>
							<li class="dropdown messages-menu">
								<!--<a href="https://gpsreports.in/vftracker/apiaksharaschool/livevehicle/track">-->
								<a href="https://gpsreports.in/vftracker/Vehicleslive">	
									<label style="text-shadow: none;">Live</label>
								</a>
								
							</li>
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									
									<label style="text-shadow: none;">Ledger</label>
								</a>
								<ul class="dropdown-menu"  style="width: 0px; padding: 0px;">
									
									<li>
										
										<ul class="menu" style="max-height:none;">
											<li>
												<a href="https://gpsreports.in/vftracker/ledgers">	
													<label style="text-shadow: none;">Ledger List</label>
												</a>
											</li>
											<!--<li> 
												<a href="">
													<label style="text-shadow: none;">New Ledger</label>
												</a>
											</li>-->
											<li> 
												<a href="https://gpsreports.in/vftracker/ledgers/freightcollection">
													<label style="text-shadow: none;">Freight Collection</label>
												</a>
											</li>
											<!--<li> 
												<a href="">
													<label style="text-shadow: none;">Add New Freight Collection</label>
												</a>
											</li>-->
											<!--<li> 
												<a href="">
													<label style="text-shadow: none;">Add Driver Salary</label>
												</a>
											</li>-->
											<li> 
												<a href="https://gpsreports.in/vftracker/driver_names/view_driver_salaries">
													<label style="text-shadow: none;">Driver Salaries</label>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							
							<!--<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-envelope-o"></i> 
									<span class="label label-success">4</span>
									<label style="text-shadow: none;">Diesel Reports</label>
								</a>
								<ul class="dropdown-menu"  style="width: 0px; padding: 0px;">
									
									<li>
										inner menu: contains the actual data 
										<ul class="menu" style="max-height:none;">
											<li>
												<a href="">	
													<label style="text-shadow: none;">Diesel Reports</label>
												</a>
											</li>
											<li> 
												<a href="">
													<label style="text-shadow: none;">New Diesel Reports</label>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>-->
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<!-- <i class="fa fa-envelope-o"></i> 
									<span class="label label-success">4</span>-->
									<label style="text-shadow: none;">Trip Module</label>
								</a>
								<ul class="dropdown-menu"  style="width: 0px; padding: 0px;">
									
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu" style="max-height:none;">
											<li>
												<a href="https://gpsreports.in/vftracker/trip_sheets">	
													<label style="text-shadow: none;">Trip Sheets</label>
												</a>
											</li>
											<!--<li>
												<a href="">	
													<label style="text-shadow: none;">Trip Sheets 2</label>
												</a>
											</li>-->
											
											<li> 
												<a href="https://gpsreports.in/vftracker/trip_sheets/trip_sheet_history">
													<label style="text-shadow: none;">Trip Sheet History</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/trip_sheets/trip_wise_profit">
													<label style="text-shadow: none;">Trip Wise Profits</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/trip_sheets/lorry_wise_reports">
													<label style="text-shadow: none;">Vehicle Wise Reports by Year</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/trip_sheets/lorry_wise_profit">
													<label style="text-shadow: none;">Vehicle Wise Profits</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/trip_sheets/lorry_status">
													<label style="text-shadow: none;">Vehicle Status</label>
												</a>
											</li>
											
										</ul>
									</li>
								</ul>
							</li>
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<!-- <i class="fa fa-envelope-o"></i> 
									<span class="label label-success">4</span>-->
									<label style="text-shadow: none;">Masters</label>
								</a>
								<ul class="dropdown-menu"  style="width: 0px; padding: 0px;">
									
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu" style="max-height:none;">
										
										<!-----------admin user level codition start------------>
																					
																								<li> 
													<a href="https://gpsreports.in/vftracker/user_types">
														<label style="text-shadow: none;">User Types</label>
													</a>
												</li>
																							<li> 
												<a href="https://gpsreports.in/vftracker/users_list">
													<label style="text-shadow: none;">User Management</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/branches">
													<label style="text-shadow: none;">Branch Master</label>
												</a>
											</li>											
																						
											
										
										  
												<!--<li> 
													<a href="">
														<label style="text-shadow: none;">Master Admin Details</label>
													</a>
												</li>
											
												<li> 
													<a href="">
														<label style="text-shadow: none;">Master Sub Admin Details</label>
													</a>
												</li>
												<li> 
													<a href="">
														<label style="text-shadow: none;">Master Users</label>
													</a>
												</li>-->
												<!--<li> 
													<a href="">
														<label style="text-shadow: none;">All Managers</label>
													</a>
												</li>-->
												
												<!--<li> 
													<a href="">
														<label style="text-shadow: none;">Users List</label>
													</a>
												</li>-->
																						<!-----------admin user level codition end------------>	
										
										
											
											<li>
												<a href="https://gpsreports.in/vftracker/lorry_numbers">	
													<label style="text-shadow: none;">Vehicle Master</label>
												</a>
											</li>
											<!--<li> 
												<a href="">
													<label style="text-shadow: none;">New Lorry Number</label>
												</a>
											</li>-->
											<li>
												<a href="https://gpsreports.in/vftracker/driver_names">	
													<label style="text-shadow: none;">Driver Master</label>
												</a>
											</li>
											<li>
												<a href="https://gpsreports.in/vftracker/cleaner_names">	
													<label style="text-shadow: none;">Helper Master</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/tyres">
													<label style="text-shadow: none;">Tyre Master</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/locations">
													<label style="text-shadow: none;">Location Master</label>
												</a>
											</li>
											
											<li>
												<a href="https://gpsreports.in/vftracker/supervisors">	
													<label style="text-shadow: none;">Supervisor Master</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/status">
													<label style="text-shadow: none;">Trip Status Master</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/lorry_numbers/lorry_trip_status_list">
													<label style="text-shadow: none;">Vehicles Trip Status List</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/lorry_numbers/lorry_drivers_list">
													<label style="text-shadow: none;">Vehicles Drivers List</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/lorry_numbers/lorry_cleaners_list">
													<label style="text-shadow: none;">Vehicles Helper List</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/driver_names/view_driver_notifications">
													<label style="text-shadow: none;">Driver Notifications List</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/driver_names/view_lorry_notifications">
													<label style="text-shadow: none;">Vehicles Notifications List</label>
												</a>
											</li>										
											
											
											
										</ul>
									</li>
								</ul>
							</li>
							<!--commented on 10th Sept 2019 -start -->
																		
																			<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">									
									<label style="text-shadow: none;">Attendance</label>
								</a>
								<ul class="dropdown-menu" style="width: 0px; padding: 0px; max-height: auto;">
									<li>
										
										<ul class="menu"  style="max-height:none;">
											<li> 
												<a href="https://gpsreports.in/vftracker/attendance">
													<label style="text-shadow: none;">Attendance</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/category">
													<label style="text-shadow: none;">Attendance Category List</label>
												</a>
											</li>									
										</ul>
									</li>
								</ul>
							</li>		
						
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">									
									<label style="text-shadow: none;">Reports</label>
								</a>
								<ul class="dropdown-menu"  style="width: 0px; padding: 0px;">
									
									<li>
										
										<ul class="menu" style="max-height:none;">
											<!--<li>
												<a href="https://gpsreports.in/vftracker/reports/fuel_reports">	
													<label style="text-shadow: none;">Fuel Reports</label>
												</a>
											</li>-->
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/vehicles_list">
													<label style="text-shadow: none;">All Vehicles List</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/trips_reports">
													<label style="text-shadow: none;">Trips Reports</label>
												</a>
											</li>
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/trips_end_reports">
													<label style="text-shadow: none;">Trips End Reports</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/movement_status_reports">
													<label style="text-shadow: none;">Movement Status Reports</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/fuel_data_reports">
													<label style="text-shadow: none;">Fuel Data Reports</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/geofences_reports">
													<label style="text-shadow: none;">Geofences Reports</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/eco_driving_reports">
													<label style="text-shadow: none;">Eco Driving Reports</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/night_driving_reports">
													<label style="text-shadow: none;">Night Driving Reports</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/over_speed_reports">
													<label style="text-shadow: none;">Over Speed Reports</label>
												</a>
											</li>
											
											<li> 
												<a href="https://gpsreports.in/vftracker/reports/fuel_fillings_reports">
													<label style="text-shadow: none;">Fuel Filling Reports</label>
												</a>
											</li>
											<!--commented on 10th Sept 2019 -end first part-->
											
											<!------------------strt of all reports links--------------->
											<!--
											<li>
												<a href="">
													<label style="text-shadow: none;">Fuel Data Reports</label>
												</a>
											</li>
											
											<li>
												<a href="">
													<label style="text-shadow: none;">Fuel Filling Reports</label>
												</a>
											</li>
											<li>
												<a href="">
													<label style="text-shadow: none;">Movement Reports</label>
												</a>
											</li>
											<li>
												<a href="">
													<label style="text-shadow: none;">Halt Reports</label>
												</a>
											</li>
											<li>
												<a href="">
													<label style="text-shadow: none;">Geofences Reports</label>
												</a>
											</li>
											<li>
												<a href="">
													<label style="text-shadow: none;">Eco Driving Reports</label>
												</a>
											</li>
											<li>
												<a href="">
													<label style="text-shadow: none;">Over Speed Reports</label>
												</a>
											</li>
											<li>
												<a href="">
													<label style="text-shadow: none;">Night Driving Reports</label>
												</a>
											</li>
											<li>
												<a href="">
													<label style="text-shadow: none;">Total Kilometer</label>
												</a>
											</li>-->
											<!------------------end of all reports links--------------->
											
										<!--commented on 10th Sept 2019 -start second part-->	
										</ul>
									</li>
								</ul>
							</li>
							<!--commented on 10th Sept 2019 -end second part-->
							
							<li class="dropdown user user-menu">
								<a href="https://gpsreports.in/vftracker/login/logout" class="dropdown-toggle" data-toggle="dropdown">
									<!--  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
									<span class="hidden-xs"><i class="fa fa-sign-out"></i>
										Admin 									</span>
								</a>
								<ul class="dropdown-menu">
									<!-- Menu Footer-->
									<li class="user-footer" style="size: auto;">
										<div class="pull-right">
								
											<a href="https://gpsreports.in/vftracker/login/logout" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
						
									
								
					</div>
				</nav>
			</header>		
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper" style="margin-left: 1px;"> 
			<!-- <div class="content-wrapper" style="margin-left:0px;"> -->
			<!-- Main content -->
			<section class="content" style="padding: 0px;">
				<!-- /.row (main row) -->
						<style type="text/css">
	th{
    padding: 4px;
    color: #e74c3c;
	}
	td{
    padding: 5px;
	}
	
	table {
    border-collapse: collapse;
	}
	
	table, th, td {
	border: 1px solid black;
	}
	
	#ui-datepicker-div{
	
	width: 260px !important;
	
	}
	.ui-helper-hidden-accessible{
	display: none;
    }
	
    .ui-corner-all{
	font-size: 14px;
	margin-left: -29px;
    }
    .ui-corner-all.ui-state-focus{
	background-color: #bbc1c5;
    }
    .ui-corner-all a{
	color: #000;
	text-decoration: none;
    }
    .ui-autocomplete{
	background-color: #ddd;
	list-style: none;
	width: 188px !important;
    }
	body{}
	
</style>
<style>
#testTable thead tr {
	background: #3c5a63; 
	color:#FFF;
}
</style>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://hst-api.wialon.com/wsdk/script/wialon.js"></script>
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<section id="main-content">
    <section class="wrapper" style='width:98%'>
				<div class="row" style="padding-bottom: 20px;">
			<div class="col-lg-12" id="print2">
				<!-- <section class="panel"> -->
<!-- 					<header class="panel-heading" style="margin-left: 20px;font-size: 20px;">
						Vehicles list Live
					</header> -->
					<div  id="divloading" style="width:100%;color:#fff; text-align:center">
						Loading....Please wait
					</div>
					<table class="table table-striped table-advance table-hover" style="font-size: 12px;margin-top: 20px;margin-right: 20px;width:100%" align="center" id="testTable">
						<tbody>
							<tr>
                                <th style="background:#003366;color:#FFF"> #</th>
								<th style="background:#003366;color:#FFF"> Vehicle Name</th>
								<th style="background:#003366;color:#FFF"> Date Time</th>
								<th style="background:#003366;color:#FFF"> Speed (Km/h)</th>
								<th style="background:#003366;color:#FFF"> Idle Time</th>
								<th style="width:50%;background:#003366;color:#FFF"> Location</th>
								
							</tr>
																<tr id="row_19156158">
										<td id="rowcounter_19156158">1</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP24TC1112" target="_blank">AP24TC1112</a></td>
										<td><div id="19156158_message_time">-</div></td>
										<td><div id="19156158_message_speed">0 km/h</div></td>
										<td><div id="19156158_idle" >-</div></td>
										<td>
											<div id="19156158_message_location">-</div>										<div style="display:none" id="19156158_locator" ><a id="19156158locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024164">
										<td id="rowcounter_19024164">2</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD4681" target="_blank">AP28TD4681</a></td>
										<td><div id="19024164_message_time">-</div></td>
										<td><div id="19024164_message_speed">0 km/h</div></td>
										<td><div id="19024164_idle" >-</div></td>
										<td>
											<div id="19024164_message_location">-</div>										<div style="display:none" id="19024164_locator" ><a id="19024164locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024272">
										<td id="rowcounter_19024272">3</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD4682" target="_blank">AP28TD4682</a></td>
										<td><div id="19024272_message_time">-</div></td>
										<td><div id="19024272_message_speed">0 km/h</div></td>
										<td><div id="19024272_idle" >-</div></td>
										<td>
											<div id="19024272_message_location">-</div>										<div style="display:none" id="19024272_locator" ><a id="19024272locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024486">
										<td id="rowcounter_19024486">4</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD4881" target="_blank">AP28TD4881</a></td>
										<td><div id="19024486_message_time">-</div></td>
										<td><div id="19024486_message_speed">0 km/h</div></td>
										<td><div id="19024486_idle" >-</div></td>
										<td>
											<div id="19024486_message_location">-</div>										<div style="display:none" id="19024486_locator" ><a id="19024486locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19022080">
										<td id="rowcounter_19022080">5</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD4882" target="_blank">AP28TD4882</a></td>
										<td><div id="19022080_message_time">-</div></td>
										<td><div id="19022080_message_speed">0 km/h</div></td>
										<td><div id="19022080_idle" >-</div></td>
										<td>
											<div id="19022080_message_location">-</div>										<div style="display:none" id="19022080_locator" ><a id="19022080locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19021505">
										<td id="rowcounter_19021505">6</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD4883" target="_blank">AP28TD4883</a></td>
										<td><div id="19021505_message_time">-</div></td>
										<td><div id="19021505_message_speed">0 km/h</div></td>
										<td><div id="19021505_idle" >-</div></td>
										<td>
											<div id="19021505_message_location">-</div>										<div style="display:none" id="19021505_locator" ><a id="19021505locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024197">
										<td id="rowcounter_19024197">7</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD4884" target="_blank">AP28TD4884</a></td>
										<td><div id="19024197_message_time">-</div></td>
										<td><div id="19024197_message_speed">0 km/h</div></td>
										<td><div id="19024197_idle" >-</div></td>
										<td>
											<div id="19024197_message_location">-</div>										<div style="display:none" id="19024197_locator" ><a id="19024197locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19022204">
										<td id="rowcounter_19022204">8</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD5405" target="_blank">AP28TD5405</a></td>
										<td><div id="19022204_message_time">-</div></td>
										<td><div id="19022204_message_speed">0 km/h</div></td>
										<td><div id="19022204_idle" >-</div></td>
										<td>
											<div id="19022204_message_location">-</div>										<div style="display:none" id="19022204_locator" ><a id="19022204locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19022141">
										<td id="rowcounter_19022141">9</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD5406" target="_blank">AP28TD5406</a></td>
										<td><div id="19022141_message_time">-</div></td>
										<td><div id="19022141_message_speed">0 km/h</div></td>
										<td><div id="19022141_idle" >-</div></td>
										<td>
											<div id="19022141_message_location">-</div>										<div style="display:none" id="19022141_locator" ><a id="19022141locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19021999">
										<td id="rowcounter_19021999">10</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD5407" target="_blank">AP28TD5407</a></td>
										<td><div id="19021999_message_time">-</div></td>
										<td><div id="19021999_message_speed">0 km/h</div></td>
										<td><div id="19021999_idle" >-</div></td>
										<td>
											<div id="19021999_message_location">-</div>										<div style="display:none" id="19021999_locator" ><a id="19021999locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024637">
										<td id="rowcounter_19024637">11</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD5408" target="_blank">AP28TD5408</a></td>
										<td><div id="19024637_message_time">-</div></td>
										<td><div id="19024637_message_speed">0 km/h</div></td>
										<td><div id="19024637_idle" >-</div></td>
										<td>
											<div id="19024637_message_location">-</div>										<div style="display:none" id="19024637_locator" ><a id="19024637locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_">
										<td id="rowcounter_">12</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=AP28TD6791" target="_blank">AP28TD6791</a></td>
										<td><div id="_message_time">-</div></td>
										<td><div id="_message_speed">0 km/h</div></td>
										<td><div id="_idle" >-</div></td>
										<td>
											<div id="_message_location">-</div>										<div style="display:none" id="_locator" ><a id="locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19289346">
										<td id="rowcounter_19289346">13</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=bus1" target="_blank">bus1</a></td>
										<td><div id="19289346_message_time">-</div></td>
										<td><div id="19289346_message_speed">0 km/h</div></td>
										<td><div id="19289346_idle" >-</div></td>
										<td>
											<div id="19289346_message_location">-</div>										<div style="display:none" id="19289346_locator" ><a id="19289346locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19247287">
										<td id="rowcounter_19247287">14</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=bus2" target="_blank">bus2</a></td>
										<td><div id="19247287_message_time">-</div></td>
										<td><div id="19247287_message_speed">0 km/h</div></td>
										<td><div id="19247287_idle" >-</div></td>
										<td>
											<div id="19247287_message_location">-</div>										<div style="display:none" id="19247287_locator" ><a id="19247287locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19801514">
										<td id="rowcounter_19801514">15</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=officevehicle" target="_blank">officevehicle</a></td>
										<td><div id="19801514_message_time">-</div></td>
										<td><div id="19801514_message_speed">0 km/h</div></td>
										<td><div id="19801514_idle" >-</div></td>
										<td>
											<div id="19801514_message_location">-</div>										<div style="display:none" id="19801514_locator" ><a id="19801514locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19801918">
										<td id="rowcounter_19801918">16</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=OLD_bus1" target="_blank">OLD_bus1</a></td>
										<td><div id="19801918_message_time">-</div></td>
										<td><div id="19801918_message_speed">0 km/h</div></td>
										<td><div id="19801918_idle" >-</div></td>
										<td>
											<div id="19801918_message_location">-</div>										<div style="display:none" id="19801918_locator" ><a id="19801918locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19384673">
										<td id="rowcounter_19384673">17</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=raviteja" target="_blank">raviteja</a></td>
										<td><div id="19384673_message_time">-</div></td>
										<td><div id="19384673_message_speed">0 km/h</div></td>
										<td><div id="19384673_idle" >-</div></td>
										<td>
											<div id="19384673_message_location">-</div>										<div style="display:none" id="19384673_locator" ><a id="19384673locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19846932">
										<td id="rowcounter_19846932">18</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=Route-10" target="_blank">Route-10</a></td>
										<td><div id="19846932_message_time">-</div></td>
										<td><div id="19846932_message_speed">0 km/h</div></td>
										<td><div id="19846932_idle" >-</div></td>
										<td>
											<div id="19846932_message_location">-</div>										<div style="display:none" id="19846932_locator" ><a id="19846932locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19033712">
										<td id="rowcounter_19033712">19</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=Route14" target="_blank">Route14</a></td>
										<td><div id="19033712_message_time">-</div></td>
										<td><div id="19033712_message_speed">0 km/h</div></td>
										<td><div id="19033712_idle" >-</div></td>
										<td>
											<div id="19033712_message_location">-</div>										<div style="display:none" id="19033712_locator" ><a id="19033712locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19033812">
										<td id="rowcounter_19033812">20</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=Route15" target="_blank">Route15</a></td>
										<td><div id="19033812_message_time">-</div></td>
										<td><div id="19033812_message_speed">0 km/h</div></td>
										<td><div id="19033812_idle" >-</div></td>
										<td>
											<div id="19033812_message_location">-</div>										<div style="display:none" id="19033812_locator" ><a id="19033812locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19034070">
										<td id="rowcounter_19034070">21</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=Route2" target="_blank">Route2</a></td>
										<td><div id="19034070_message_time">-</div></td>
										<td><div id="19034070_message_speed">0 km/h</div></td>
										<td><div id="19034070_idle" >-</div></td>
										<td>
											<div id="19034070_message_location">-</div>										<div style="display:none" id="19034070_locator" ><a id="19034070locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_18733173">
										<td id="rowcounter_18733173">22</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=Route8" target="_blank">Route8</a></td>
										<td><div id="18733173_message_time">-</div></td>
										<td><div id="18733173_message_speed">0 km/h</div></td>
										<td><div id="18733173_idle" >-</div></td>
										<td>
											<div id="18733173_message_location">-</div>										<div style="display:none" id="18733173_locator" ><a id="18733173locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19033882">
										<td id="rowcounter_19033882">23</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=Route9" target="_blank">Route9</a></td>
										<td><div id="19033882_message_time">-</div></td>
										<td><div id="19033882_message_speed">0 km/h</div></td>
										<td><div id="19033882_idle" >-</div></td>
										<td>
											<div id="19033882_message_location">-</div>										<div style="display:none" id="19033882_locator" ><a id="19033882locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19435694">
										<td id="rowcounter_19435694">24</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS02UC3750" target="_blank">TS02UC3750</a></td>
										<td><div id="19435694_message_time">-</div></td>
										<td><div id="19435694_message_speed">0 km/h</div></td>
										<td><div id="19435694_idle" >-</div></td>
										<td>
											<div id="19435694_message_location">-</div>										<div style="display:none" id="19435694_locator" ><a id="19435694locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19435797">
										<td id="rowcounter_19435797">25</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS02UC3751" target="_blank">TS02UC3751</a></td>
										<td><div id="19435797_message_time">-</div></td>
										<td><div id="19435797_message_speed">0 km/h</div></td>
										<td><div id="19435797_idle" >-</div></td>
										<td>
											<div id="19435797_message_location">-</div>										<div style="display:none" id="19435797_locator" ><a id="19435797locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19435351">
										<td id="rowcounter_19435351">26</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS02UC3752" target="_blank">TS02UC3752</a></td>
										<td><div id="19435351_message_time">-</div></td>
										<td><div id="19435351_message_speed">0 km/h</div></td>
										<td><div id="19435351_idle" >-</div></td>
										<td>
											<div id="19435351_message_location">-</div>										<div style="display:none" id="19435351_locator" ><a id="19435351locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19424761">
										<td id="rowcounter_19424761">27</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS02UC3753" target="_blank">TS02UC3753</a></td>
										<td><div id="19424761_message_time">-</div></td>
										<td><div id="19424761_message_speed">0 km/h</div></td>
										<td><div id="19424761_idle" >-</div></td>
										<td>
											<div id="19424761_message_location">-</div>										<div style="display:none" id="19424761_locator" ><a id="19424761locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19424063">
										<td id="rowcounter_19424063">28</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS02UC3754" target="_blank">TS02UC3754</a></td>
										<td><div id="19424063_message_time">-</div></td>
										<td><div id="19424063_message_speed">0 km/h</div></td>
										<td><div id="19424063_idle" >-</div></td>
										<td>
											<div id="19424063_message_location">-</div>										<div style="display:none" id="19424063_locator" ><a id="19424063locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19435564">
										<td id="rowcounter_19435564">29</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS02UC3827" target="_blank">TS02UC3827</a></td>
										<td><div id="19435564_message_time">-</div></td>
										<td><div id="19435564_message_speed">0 km/h</div></td>
										<td><div id="19435564_idle" >-</div></td>
										<td>
											<div id="19435564_message_location">-</div>										<div style="display:none" id="19435564_locator" ><a id="19435564locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19435651">
										<td id="rowcounter_19435651">30</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS02UC3828" target="_blank">TS02UC3828</a></td>
										<td><div id="19435651_message_time">-</div></td>
										<td><div id="19435651_message_speed">0 km/h</div></td>
										<td><div id="19435651_idle" >-</div></td>
										<td>
											<div id="19435651_message_location">-</div>										<div style="display:none" id="19435651_locator" ><a id="19435651locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19424387">
										<td id="rowcounter_19424387">31</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS02UC3829" target="_blank">TS02UC3829</a></td>
										<td><div id="19424387_message_time">-</div></td>
										<td><div id="19424387_message_speed">0 km/h</div></td>
										<td><div id="19424387_idle" >-</div></td>
										<td>
											<div id="19424387_message_location">-</div>										<div style="display:none" id="19424387_locator" ><a id="19424387locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19435512">
										<td id="rowcounter_19435512">32</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS02UC3830" target="_blank">TS02UC3830</a></td>
										<td><div id="19435512_message_time">-</div></td>
										<td><div id="19435512_message_speed">0 km/h</div></td>
										<td><div id="19435512_idle" >-</div></td>
										<td>
											<div id="19435512_message_location">-</div>										<div style="display:none" id="19435512_locator" ><a id="19435512locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19022078">
										<td id="rowcounter_19022078">33</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UB0425" target="_blank">TS07UB0425</a></td>
										<td><div id="19022078_message_time">-</div></td>
										<td><div id="19022078_message_speed">0 km/h</div></td>
										<td><div id="19022078_idle" >-</div></td>
										<td>
											<div id="19022078_message_location">-</div>										<div style="display:none" id="19022078_locator" ><a id="19022078locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024150">
										<td id="rowcounter_19024150">34</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UB0426" target="_blank">TS07UB0426</a></td>
										<td><div id="19024150_message_time">-</div></td>
										<td><div id="19024150_message_speed">0 km/h</div></td>
										<td><div id="19024150_idle" >-</div></td>
										<td>
											<div id="19024150_message_location">-</div>										<div style="display:none" id="19024150_locator" ><a id="19024150locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19021233">
										<td id="rowcounter_19021233">35</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UB0427" target="_blank">TS07UB0427</a></td>
										<td><div id="19021233_message_time">-</div></td>
										<td><div id="19021233_message_speed">0 km/h</div></td>
										<td><div id="19021233_idle" >-</div></td>
										<td>
											<div id="19021233_message_location">-</div>										<div style="display:none" id="19021233_locator" ><a id="19021233locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024254">
										<td id="rowcounter_19024254">36</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UB0513" target="_blank">TS07UB0513</a></td>
										<td><div id="19024254_message_time">-</div></td>
										<td><div id="19024254_message_speed">0 km/h</div></td>
										<td><div id="19024254_idle" >-</div></td>
										<td>
											<div id="19024254_message_location">-</div>										<div style="display:none" id="19024254_locator" ><a id="19024254locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024339">
										<td id="rowcounter_19024339">37</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UB0514" target="_blank">TS07UB0514</a></td>
										<td><div id="19024339_message_time">-</div></td>
										<td><div id="19024339_message_speed">0 km/h</div></td>
										<td><div id="19024339_idle" >-</div></td>
										<td>
											<div id="19024339_message_location">-</div>										<div style="display:none" id="19024339_locator" ><a id="19024339locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024100">
										<td id="rowcounter_19024100">38</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UB0515" target="_blank">TS07UB0515</a></td>
										<td><div id="19024100_message_time">-</div></td>
										<td><div id="19024100_message_speed">0 km/h</div></td>
										<td><div id="19024100_idle" >-</div></td>
										<td>
											<div id="19024100_message_location">-</div>										<div style="display:none" id="19024100_locator" ><a id="19024100locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024682">
										<td id="rowcounter_19024682">39</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UB8090" target="_blank">TS07UB8090</a></td>
										<td><div id="19024682_message_time">-</div></td>
										<td><div id="19024682_message_speed">0 km/h</div></td>
										<td><div id="19024682_idle" >-</div></td>
										<td>
											<div id="19024682_message_location">-</div>										<div style="display:none" id="19024682_locator" ><a id="19024682locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19021741">
										<td id="rowcounter_19021741">40</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE3861" target="_blank">TS07UE3861</a></td>
										<td><div id="19021741_message_time">-</div></td>
										<td><div id="19021741_message_speed">0 km/h</div></td>
										<td><div id="19021741_idle" >-</div></td>
										<td>
											<div id="19021741_message_location">-</div>										<div style="display:none" id="19021741_locator" ><a id="19021741locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024179">
										<td id="rowcounter_19024179">41</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE3862" target="_blank">TS07UE3862</a></td>
										<td><div id="19024179_message_time">-</div></td>
										<td><div id="19024179_message_speed">0 km/h</div></td>
										<td><div id="19024179_idle" >-</div></td>
										<td>
											<div id="19024179_message_location">-</div>										<div style="display:none" id="19024179_locator" ><a id="19024179locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19021223">
										<td id="rowcounter_19021223">42</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE3863" target="_blank">TS07UE3863</a></td>
										<td><div id="19021223_message_time">-</div></td>
										<td><div id="19021223_message_speed">0 km/h</div></td>
										<td><div id="19021223_idle" >-</div></td>
										<td>
											<div id="19021223_message_location">-</div>										<div style="display:none" id="19021223_locator" ><a id="19021223locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19022120">
										<td id="rowcounter_19022120">43</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE4280" target="_blank">TS07UE4280</a></td>
										<td><div id="19022120_message_time">-</div></td>
										<td><div id="19022120_message_speed">0 km/h</div></td>
										<td><div id="19022120_idle" >-</div></td>
										<td>
											<div id="19022120_message_location">-</div>										<div style="display:none" id="19022120_locator" ><a id="19022120locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024236">
										<td id="rowcounter_19024236">44</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE4281" target="_blank">TS07UE4281</a></td>
										<td><div id="19024236_message_time">-</div></td>
										<td><div id="19024236_message_speed">0 km/h</div></td>
										<td><div id="19024236_idle" >-</div></td>
										<td>
											<div id="19024236_message_location">-</div>										<div style="display:none" id="19024236_locator" ><a id="19024236locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19021899">
										<td id="rowcounter_19021899">45</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE4282" target="_blank">TS07UE4282</a></td>
										<td><div id="19021899_message_time">-</div></td>
										<td><div id="19021899_message_speed">0 km/h</div></td>
										<td><div id="19021899_idle" >-</div></td>
										<td>
											<div id="19021899_message_location">-</div>										<div style="display:none" id="19021899_locator" ><a id="19021899locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024223">
										<td id="rowcounter_19024223">46</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE6324" target="_blank">TS07UE6324</a></td>
										<td><div id="19024223_message_time">-</div></td>
										<td><div id="19024223_message_speed">0 km/h</div></td>
										<td><div id="19024223_idle" >-</div></td>
										<td>
											<div id="19024223_message_location">-</div>										<div style="display:none" id="19024223_locator" ><a id="19024223locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19022238">
										<td id="rowcounter_19022238">47</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE8091" target="_blank">TS07UE8091</a></td>
										<td><div id="19022238_message_time">-</div></td>
										<td><div id="19022238_message_speed">0 km/h</div></td>
										<td><div id="19022238_idle" >-</div></td>
										<td>
											<div id="19022238_message_location">-</div>										<div style="display:none" id="19022238_locator" ><a id="19022238locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_18732888">
										<td id="rowcounter_18732888">48</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE8092" target="_blank">TS07UE8092</a></td>
										<td><div id="18732888_message_time">-</div></td>
										<td><div id="18732888_message_speed">0 km/h</div></td>
										<td><div id="18732888_idle" >-</div></td>
										<td>
											<div id="18732888_message_location">-</div>										<div style="display:none" id="18732888_locator" ><a id="18732888locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19021766">
										<td id="rowcounter_19021766">49</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE8093" target="_blank">TS07UE8093</a></td>
										<td><div id="19021766_message_time">-</div></td>
										<td><div id="19021766_message_speed">0 km/h</div></td>
										<td><div id="19021766_idle" >-</div></td>
										<td>
											<div id="19021766_message_location">-</div>										<div style="display:none" id="19021766_locator" ><a id="19021766locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024300">
										<td id="rowcounter_19024300">50</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE8094" target="_blank">TS07UE8094</a></td>
										<td><div id="19024300_message_time">-</div></td>
										<td><div id="19024300_message_speed">0 km/h</div></td>
										<td><div id="19024300_idle" >-</div></td>
										<td>
											<div id="19024300_message_location">-</div>										<div style="display:none" id="19024300_locator" ><a id="19024300locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_18732709">
										<td id="rowcounter_18732709">51</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UE8095" target="_blank">TS07UE8095</a></td>
										<td><div id="18732709_message_time">-</div></td>
										<td><div id="18732709_message_speed">0 km/h</div></td>
										<td><div id="18732709_idle" >-</div></td>
										<td>
											<div id="18732709_message_location">-</div>										<div style="display:none" id="18732709_locator" ><a id="18732709locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_">
										<td id="rowcounter_">52</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UG3802" target="_blank">TS07UG3802</a></td>
										<td><div id="_message_time">-</div></td>
										<td><div id="_message_speed">0 km/h</div></td>
										<td><div id="_idle" >-</div></td>
										<td>
											<div id="_message_location">-</div>										<div style="display:none" id="_locator" ><a id="locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_">
										<td id="rowcounter_">53</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS07UG3803" target="_blank">TS07UG3803</a></td>
										<td><div id="_message_time">-</div></td>
										<td><div id="_message_speed">0 km/h</div></td>
										<td><div id="_idle" >-</div></td>
										<td>
											<div id="_message_location">-</div>										<div style="display:none" id="_locator" ><a id="locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_">
										<td id="rowcounter_">54</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UA5613" target="_blank">TS08UA5613</a></td>
										<td><div id="_message_time">-</div></td>
										<td><div id="_message_speed">0 km/h</div></td>
										<td><div id="_idle" >-</div></td>
										<td>
											<div id="_message_location">-</div>										<div style="display:none" id="_locator" ><a id="locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19033933">
										<td id="rowcounter_19033933">55</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UA5614" target="_blank">TS08UA5614</a></td>
										<td><div id="19033933_message_time">-</div></td>
										<td><div id="19033933_message_speed">0 km/h</div></td>
										<td><div id="19033933_idle" >-</div></td>
										<td>
											<div id="19033933_message_location">-</div>										<div style="display:none" id="19033933_locator" ><a id="19033933locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19034026">
										<td id="rowcounter_19034026">56</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UA5785" target="_blank">TS08UA5785</a></td>
										<td><div id="19034026_message_time">-</div></td>
										<td><div id="19034026_message_speed">0 km/h</div></td>
										<td><div id="19034026_idle" >-</div></td>
										<td>
											<div id="19034026_message_location">-</div>										<div style="display:none" id="19034026_locator" ><a id="19034026locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19033786">
										<td id="rowcounter_19033786">57</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UA6755" target="_blank">TS08UA6755</a></td>
										<td><div id="19033786_message_time">-</div></td>
										<td><div id="19033786_message_speed">0 km/h</div></td>
										<td><div id="19033786_idle" >-</div></td>
										<td>
											<div id="19033786_message_location">-</div>										<div style="display:none" id="19033786_locator" ><a id="19033786locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19033769">
										<td id="rowcounter_19033769">58</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UA6756" target="_blank">TS08UA6756</a></td>
										<td><div id="19033769_message_time">-</div></td>
										<td><div id="19033769_message_speed">0 km/h</div></td>
										<td><div id="19033769_idle" >-</div></td>
										<td>
											<div id="19033769_message_location">-</div>										<div style="display:none" id="19033769_locator" ><a id="19033769locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_">
										<td id="rowcounter_">59</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UA6757" target="_blank">TS08UA6757</a></td>
										<td><div id="_message_time">-</div></td>
										<td><div id="_message_speed">0 km/h</div></td>
										<td><div id="_idle" >-</div></td>
										<td>
											<div id="_message_location">-</div>										<div style="display:none" id="_locator" ><a id="locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024385">
										<td id="rowcounter_19024385">60</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UB3583" target="_blank">TS08UB3583</a></td>
										<td><div id="19024385_message_time">-</div></td>
										<td><div id="19024385_message_speed">0 km/h</div></td>
										<td><div id="19024385_idle" >-</div></td>
										<td>
											<div id="19024385_message_location">-</div>										<div style="display:none" id="19024385_locator" ><a id="19024385locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024374">
										<td id="rowcounter_19024374">61</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UB3601" target="_blank">TS08UB3601</a></td>
										<td><div id="19024374_message_time">-</div></td>
										<td><div id="19024374_message_speed">0 km/h</div></td>
										<td><div id="19024374_idle" >-</div></td>
										<td>
											<div id="19024374_message_location">-</div>										<div style="display:none" id="19024374_locator" ><a id="19024374locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024145">
										<td id="rowcounter_19024145">62</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UB8098" target="_blank">TS08UB8098</a></td>
										<td><div id="19024145_message_time">-</div></td>
										<td><div id="19024145_message_speed">0 km/h</div></td>
										<td><div id="19024145_idle" >-</div></td>
										<td>
											<div id="19024145_message_location">-</div>										<div style="display:none" id="19024145_locator" ><a id="19024145locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19021949">
										<td id="rowcounter_19021949">63</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UD4598" target="_blank">TS08UD4598</a></td>
										<td><div id="19021949_message_time">-</div></td>
										<td><div id="19021949_message_speed">0 km/h</div></td>
										<td><div id="19021949_idle" >-</div></td>
										<td>
											<div id="19021949_message_location">-</div>										<div style="display:none" id="19021949_locator" ><a id="19021949locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19021232">
										<td id="rowcounter_19021232">64</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UD4600" target="_blank">TS08UD4600</a></td>
										<td><div id="19021232_message_time">-</div></td>
										<td><div id="19021232_message_speed">0 km/h</div></td>
										<td><div id="19021232_idle" >-</div></td>
										<td>
											<div id="19021232_message_location">-</div>										<div style="display:none" id="19021232_locator" ><a id="19021232locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024495">
										<td id="rowcounter_19024495">65</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UD5082" target="_blank">TS08UD5082</a></td>
										<td><div id="19024495_message_time">-</div></td>
										<td><div id="19024495_message_speed">0 km/h</div></td>
										<td><div id="19024495_idle" >-</div></td>
										<td>
											<div id="19024495_message_location">-</div>										<div style="display:none" id="19024495_locator" ><a id="19024495locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_18737819">
										<td id="rowcounter_18737819">66</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UE1982" target="_blank">TS08UE1982</a></td>
										<td><div id="18737819_message_time">-</div></td>
										<td><div id="18737819_message_speed">0 km/h</div></td>
										<td><div id="18737819_idle" >-</div></td>
										<td>
											<div id="18737819_message_location">-</div>										<div style="display:none" id="18737819_locator" ><a id="18737819locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19024539">
										<td id="rowcounter_19024539">67</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UE1983" target="_blank">TS08UE1983</a></td>
										<td><div id="19024539_message_time">-</div></td>
										<td><div id="19024539_message_speed">0 km/h</div></td>
										<td><div id="19024539_idle" >-</div></td>
										<td>
											<div id="19024539_message_location">-</div>										<div style="display:none" id="19024539_locator" ><a id="19024539locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_">
										<td id="rowcounter_">68</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UE1984" target="_blank">TS08UE1984</a></td>
										<td><div id="_message_time">-</div></td>
										<td><div id="_message_speed">0 km/h</div></td>
										<td><div id="_idle" >-</div></td>
										<td>
											<div id="_message_location">-</div>										<div style="display:none" id="_locator" ><a id="locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_19120312">
										<td id="rowcounter_19120312">69</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UE2302" target="_blank">TS08UE2302</a></td>
										<td><div id="19120312_message_time">-</div></td>
										<td><div id="19120312_message_speed">0 km/h</div></td>
										<td><div id="19120312_idle" >-</div></td>
										<td>
											<div id="19120312_message_location">-</div>										<div style="display:none" id="19120312_locator" ><a id="19120312locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_18737693">
										<td id="rowcounter_18737693">70</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UF1780" target="_blank">TS08UF1780</a></td>
										<td><div id="18737693_message_time">-</div></td>
										<td><div id="18737693_message_speed">0 km/h</div></td>
										<td><div id="18737693_idle" >-</div></td>
										<td>
											<div id="18737693_message_location">-</div>										<div style="display:none" id="18737693_locator" ><a id="18737693locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
																<tr id="row_18737627">
										<td id="rowcounter_18737627">71</td>
										<td><a href="https://gpsreports.in/tggapi/livevehicle.php?token=fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6&vehicle=TS08UF2164" target="_blank">TS08UF2164</a></td>
										<td><div id="18737627_message_time">-</div></td>
										<td><div id="18737627_message_speed">0 km/h</div></td>
										<td><div id="18737627_idle" >-</div></td>
										<td>
											<div id="18737627_message_location">-</div>										<div style="display:none" id="18737627_locator" ><a id="18737627locator_link" href="#"  onclick="alert('Not available')"  >Locator</a></div></td> 
										
																			 
							</tr>
							                             
				</tbody>
				<tbody id="units" hidden></tbody>
			</table>
		<!-- </section> -->
	</div>
	<div class="text-center" id="loading" style="color:#fff">
		Loading....Please wait
		
	</div>
	<div id="log" hidden></div>
	
	<div class="col-lg-4 hidden" style="padding-top:25px">
		<iframe src="https://gpsreports.in/vftracker/vehicleslive/map" style="width: 100%;height: 500px;"></iframe>
	</div>
</div>
<!-- page end-->
</section>
</section>
<script type="text/javascript">
	var total_vehicles = 71;
	function msg(text) { 
		//  $("#log").prepend(text + "<br/>"); 
	}
	vahicles_geofence=[];
	vahicles_list=[];
	vahicles_list_onlycodes=[];
	vehicles_ontrip=[];
	
	vehicles_names_byid=[];
	vahicles_list['19156158']='';vahicles_list['19024164']='';vahicles_list['19024272']='';vahicles_list['19024486']='';vahicles_list['19022080']='';vahicles_list['19021505']='';vahicles_list['19024197']='';vahicles_list['19022204']='';vahicles_list['19022141']='';vahicles_list['19021999']='';vahicles_list['19024637']='';vahicles_list['']='';vahicles_list['19289346']='';vahicles_list['19247287']='';vahicles_list['19801514']='';vahicles_list['19801918']='';vahicles_list['19384673']='';vahicles_list['19846932']='';vahicles_list['19033712']='';vahicles_list['19033812']='';vahicles_list['19034070']='';vahicles_list['18733173']='';vahicles_list['19033882']='';vahicles_list['19435694']='';vahicles_list['19435797']='';vahicles_list['19435351']='';vahicles_list['19424761']='';vahicles_list['19424063']='';vahicles_list['19435564']='';vahicles_list['19435651']='';vahicles_list['19424387']='';vahicles_list['19435512']='';vahicles_list['19022078']='';vahicles_list['19024150']='';vahicles_list['19021233']='';vahicles_list['19024254']='';vahicles_list['19024339']='';vahicles_list['19024100']='';vahicles_list['19024682']='';vahicles_list['19021741']='';vahicles_list['19024179']='';vahicles_list['19021223']='';vahicles_list['19022120']='';vahicles_list['19024236']='';vahicles_list['19021899']='';vahicles_list['19024223']='';vahicles_list['19022238']='';vahicles_list['18732888']='';vahicles_list['19021766']='';vahicles_list['19024300']='';vahicles_list['18732709']='';vahicles_list['']='';vahicles_list['']='';vahicles_list['']='';vahicles_list['19033933']='';vahicles_list['19034026']='';vahicles_list['19033786']='';vahicles_list['19033769']='';vahicles_list['']='';vahicles_list['19024385']='';vahicles_list['19024374']='';vahicles_list['19024145']='';vahicles_list['19021949']='';vahicles_list['19021232']='';vahicles_list['19024495']='';vahicles_list['18737819']='';vahicles_list['19024539']='';vahicles_list['']='';vahicles_list['19120312']='';vahicles_list['18737693']='';vahicles_list['18737627']='';	
	function init() { // Execute after login succeed
		
		//setTimeout(function(){ 
		var sess = wialon.core.Session.getInstance(); // get instance of current Session
		// flags to specify what kind of data should be returned
		var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;
		
		sess.loadLibrary("itemIcon"); // load Icon Library  
		//sess.updateDataFlags( // load items to current session
		//[{type: "type", data: "avl_unit", flags: flags, mode: 0}], // Items specification
		
		
		var res_flags = wialon.item.Item.dataFlag.base | wialon.item.Resource.dataFlag.reports;
		var unit_flags = wialon.item.Item.dataFlag.base;
		
		var sess = wialon.core.Session.getInstance(); // get instance of current Session
		sess.loadLibrary("resourceReports"); // load Reports Library
		sess.updateDataFlags( // load items to current session
		[{type: "type", data: "avl_resource", flags:res_flags , mode: 0}, // 'avl_resource's specification
		{type: "type", data: "avl_unit", flags: flags, mode: 0}], // 'avl_unit's specification
		
		
		function (code) { // updateDataFlags callback
			if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			
			// get loaded 'avl_unit's items  
			var units = sess.getItems("avl_unit");
			if (!units || !units.length){ msg("Units not found"); return; } // check if units found
			
			
			//alert(units.length)
			$("#units").append('<tbody>');
			j=0;
			k=0;
			for (var i = 0; i< units.length; i++){ // construct Select object using found units
				var u = units[i]; // current unit in cycle
				
				//console.log(u.getId()+"--------+"+vahicles_list[u.getId()]);
				//  if($.inArray( u.getId(), vahicles_list_onlycodes )>=0)
				a=vahicles_list[u.getId()];
				ontrip=vehicles_ontrip[u.getId()];
				
				
				vehicles_names_byid[u.getId()]=u.getName();;
									
					{ 
						
						setTimeout('getSelectedUnitInfo('+u.getId()+')',1000);
						//setInterval('UpdategetSelectedUnitInfo('+u.getId()+')',1000*30);
						// setInterval('resetLivevehiclemoment()',(1000*30));
						$("#units").append('</tr>');
						j++;
						
						k++;
					}
					
									
				
			}//for------------
			
			if(j==0)
			{
				$("#units").append('<tr><td colspan="100%">No vehicles are available</td></tr>');
				
				$('#loading').hide('slow');
				
				
				
			}
			
			
			
			setTimeout(function(){ 
				
				$("#units").show();
				$('#divloading').hide();
				
				$('#loading').hide();
				
			}, 1000*2);
			
			
			setTimeout(function(){  
				sortTable();  
			}, 1000*5);
			
			setInterval(function(){  
				sortTable();  
			}, 1000*30);
			
			$("#units").append('</tbody>');
			// bind action to select change event
			//$("#units").change( getSelectedUnitInfo );
		}
		);
		
		//}, 1000*60);
	}
	var livevehiclescount=0;
	function resetLivevehiclemoment()
	{
		/*
			$.ajax({
			url: "ajax_reset_livevehicle_count.php?status=",
			context: document.body
			}).done(function() {
			
			});
		*/
		livevehiclescount=0;
		$('#div_livemomentcountfrimifrmae', window.parent.document).html(livevehiclescount);
		
		
	}
	function getSelectedUnitInfo(unitid){ // print information about selected Unit
		//$("#"+unitid+"_message_time").css("background-color","red");
		var val = unitid;//$("#units").val(); // get selected unit id
		if(!val) return; // exit if no unit selected
		
		address='';
		
		var unit = wialon.core.Session.getInstance().getItem(val); // get unit by id
		if(!unit){ msg("Unit not found");return; } // exit if unit not found
		var text ="";
		// construct message with unit information
		//var text = "<div>'"+unit.getName()+"' selected. "; // get unit name
		var icon = unit.getIconUrl(32); // get unit Icon url
		unit_icon='';
		if(icon) unit_icon = "<img class='icon' src='"+ icon +"' alt='icon'/>"; // add icon to message
		var pos = unit.getPosition(); // get unit position
		//var  MileageCounter=unit.getMileageCounter(); 
		////console.log('MileageCounter-',MileageCounter)
		if(pos){ // check if position data exists
			var time = wialon.util.DateTime.formatTime(pos.t);
			text += "<b>Last message</b> "+ time +"<br/>"+ // add last message time
			"<b>Position</b> "+ pos.x+", "+pos.y +"<br/>"+ // add info about unit position
			"<b>Speed</b> "+ pos.s; // add info about unit speed
			// try to find unit location using coordinates 
			address='';
			wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}], function(code, address){ 
				if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
				updateIdleTime(unitid,   pos.t,address);
				updateZone(unitid);
				
				//alert(text + "<br/><b>Location of unit</b>: "+ address+"</div>")
				
				if(time!=$("#"+unitid+"_message_time").html() && $("#"+unitid+"_message_time").html()!='')
				{
					$("#"+unitid+"_message_time").css("color","green");
					
					
				}
				
				else if(time==$("#"+unitid+"_message_time").html())
				{
					$("#"+unitid+"_message_time").css("color","black");
				}
				else if($("#"+unitid+"_message_time").html()=='' )
				{
					$("#"+unitid+"_message_time").css("color","blue");
				}
				
				var d = new Date();
				
				
				var date1 = new Date(time);
				var date2 = d.getTime()-(5*60*1000);// //new Date('2020-02-16 14:12:30');
				//datediff=Date.parse(date1) - Date.parse(date2);
				datediff=Date.parse(date1) -  (date2);
				
				
				$("#"+unitid+"_message_time").html(time);
				//console.log('locator_link'+$('#'+unitid+'locator_link').attr('href'),$('#'+unitid+'locator_link').attr('href'));
				
				//if($('#'+unitid+'locator_link').attr('href')!='')
				
				
				//$("#"+unitid+"_message_location").html('<a href="javascript:openlocator(\''+unitid+'\')">'+address+'</a>');
				
				//else
				$("#"+unitid+"_message_location").html(address);
				
				
				//alert("vahicles_geofence")
				console.log('location address1- ',vahicles_geofence);
				
				$.each(vahicles_geofence, function( index, value ) {
					address=address+"";
					address=address.toLowerCase();
					value=value.toLowerCase();
					console.log('location address- 2', address.indexOf(value)+" - "+value+" - "+address);
					
					if (address.indexOf(value) >= 0)
					{
						$('#'+unitid+'_geofence_in_out').html('IN');
						
					}
					else
					{
						$('#'+unitid+'_geofence_in_out').html('OUT');
						
					}
				});
				
				
				
				
				////console.log(unitid +" -ZONE- "+vahicles_list[unitid]);
				
				//_geofence_in_out
				
				// //console.log(time +" ........ "+datediff);
				//$("#"+unitid+"_icon").html( unit_icon);
				
				updateIgnitionStatus(unitid);
				
				//if(pos.s==0)
				{
					//setTimeout(function(){ 
					
					
					
					
					setTimeout(function(){ 
						//  shorturl=makeRequest2(unitid);
						
					}, 1000*1);
					
				}
				
				//$("#"+unitid+"_mileage").html( MileageCounter);
				
				//if(pos.s=='0' || pos.s=='' || datediff<10*60*1000)
				if(pos.s=='0' || pos.s=='' || datediff<0)
				{
					
					setTimeout('updateMileage('+unitid+');  ',timeset_offline);
					timeset_offline=timeset_offline+5000;
					
				}
				else
				{  
					setTimeout('updateMileage('+unitid+');  ',timeset);
					timeset=timeset+5000;
					
					
					$("#"+unitid+"_message_speed").html(pos.s+' km/h' );
					
					
					
					//$('#'+unitid+'_ignition').html('IGNITION ON');
					
					$("#"+unitid+"_icon").html( '<i title="'+address+'  "class="fa fa-minus-circle speedicon " style="color:green" aria-hidden="true"></i>');
					
					if(pos.s>0)
					{
						
						$("#"+unitid+"_message_speed").css("color","green");
						$("#"+unitid+"_message_speed").css("font-weight","bold");
					}
					else
					{
						
						$("#"+unitid+"_message_speed").css("color","black");
						
						//$("#"+unitid+"_icon").html( 'STOP');
						$("#"+unitid+"_icon").html( '<i title="'+address+'  " class="fa fa-minus-circle speedicon " style="color:red" aria-hidden="true"></i>');
						
					}
					//$("#tr_"+unitid+"").show();
					/////$("#tr_"+unitid+"").next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').next('td').show();
					
					/*$.ajax({
						url: "ajax_updatelive_count.php?status=true&unitid="+unitid,
						context: document.body
						}).done(function() {
						
						});
					*/
					
					livevehiclescount=livevehiclescount+1;
					//alert(livevehiclescount+'-'+total_vehicles);
					$('#div_livemomentcountfrimifrmae', window.parent.document).html(livevehiclescount);
					$('#div_stoppedcount', window.parent.document).html(total_vehicles-livevehiclescount);
					
					
				}
				//updateDataFlags
				
				
				//$("#"+unitid+"_locator").html(shorturl);
				
				if($("#"+unitid+"_message_speed").html()=='-')
				{
					/////$("#tr_"+unitid+"").next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').next('td').hide();
					
					/*
						$.ajax({
						url: "ajax_updatelive_count.php?status=false&unitid="+unitid,
						context: document.body
						}).done(function() {
						
						});
					*/
				}
				
				//------------------
				//Update mileage
				
				
				
				// msg(text + "<br/><b>Location of unit</b>: "+ address+"</div>"); // print message to log
			});
		} else // position data not exists, print message
		msg(text + "<br/><b>Location of unit</b>: Unknown</div>"); 
		
		//$("#"+unitid+"_message_time").css("background-color","green");
		
	}
	function openlocator(unitid)
	{
		
		$('#'+unitid+'locator_link').click();
		
	}
	function updateZone(unitid)
	{ 
		try{ 
			if(vahicles_list[unitid]!=null)
			$('#'+unitid+'_zone').html(vahicles_list[unitid]);
		}catch(e)
		{
		}
		
	}
	trcounter=1;
	function updateIdleTime(unitid,lastmessagetime,address)
	{
		//time=time.replace('-','');
		var curdate = new Date();
		
		
		var lastmessagetimeDate = new Date(null);
		lastmessagetimeDate.setTime(lastmessagetime*1000);
		
		
		finel=curdate.getTime()-lastmessagetimeDate.getTime() ;
		finel=finel/1000;
		
		totalseconds=finel;
		
		var hours = Math.floor(finel / 3600);
		var min = Math.floor((finel - (hours*3600)) / 60);
		var seconds = Math.floor(finel % 60);
		//curdate.toLocaleString()
		//alert(curdate.toLocaleString());
				finel=hours+'h'+":"+min+'m';//+":"+seconds+'s ';
		//finel=finel+'<br/>'+curdate.toLocaleString();
		//finel=finel+'<br/>'+lastmessagetimeDate.toLocaleString();
		//finel=finel+'<br/>'+lastmessagetimeDate.toLocaleString();
		
		////console.log(unitid+"_lastmessagetimeDate",curdate.getTime()+"-------"+lastmessagetimeDate.getTime()+"---"+hours);
		
		if(hours>0)
		$('#'+unitid+'_idle').html(finel);
		
		hours=parseInt(hours);
		
		//totalseconds=totalseconds/60;
		
		
		$("#"+unitid+"_icon").html(   '<i title="'+address+'  " class="fa fa-minus-circle speedicon " style="color:#989191" aria-hidden="true"></i>');
		
		/*
			if(totalseconds<0)
			{
			$("#"+unitid+"_icon").html(  '<i   class="fa fa-minus-circle speedicon " style="color:green" aria-hidden="true"></i>');
			
			}
		*/
		
		
		if(hours>24)
		{
			$("#"+unitid+"_icon").html( '<i title="'+address+'  " class="fa fa-minus-circle speedicon " style="color:#989191" aria-hidden="true"></i>');
			
		}
		
		else if(hours<24 && hours>1)
		{
			$("#"+unitid+"_icon").html( '<i title="'+address+'  " class="fa fa-minus-circle speedicon " style="color:red" aria-hidden="true"></i>');
		}
		else if(hours<=0  && min>0)
		{
			$("#"+unitid+"_icon").html( '<i title="'+address+'  " class="fa fa-minus-circle speedicon " style="color:red" aria-hidden="true"></i>');
			
		}
		else if(hours<=0  && min<=0 && seconds>=-200)
		{
			//$('#'+unitid+'_ignition').html('IGNITION ON');
			$("#"+unitid+"_icon").html(  '<i  title="'+address+'  " class="fa fa-minus-circle speedicon " style="color:green" aria-hidden="true"></i>');
			
		}
		
		
	}
	function updateIgnitionStatus(unitid)
	{
		
		//$('#'+unitid+'_ignition').html('IGNITION');
		
		/*
			svc=events/get&params={"selector":[
			{
			"type":<text>,
			"expr":<text>,
			"indexFrom":<uint>,
			"indexTo":<uint>,
			"detalization":<uint>,
			"filter1":<uint>
			},
			...
			]}
			
		*/
	}
	function updateMileage(unitid)
	{
		
		console.log(unitid+'Time - ','2020-02-16 14:12:30');
		var sess = wialon.core.Session.getInstance(); // get instance of current Session
		var res = sess.getItems("avl_resource"); // get loaded 'avl_resource's items
		//if (!res || !res.length){ msg("Resources not found"); return; } // check if resources found
		//for (var i = 0; i< res.length; i++) // construct Select object using found resources
		//$("#res").append("<option value='" + res[i].getId() + "'>" + res[i].getName() + "</option>");
		
		
		
		var id_res=res[0].getId();//'15405301';
		var id_templ=1;//DHL Daily Trip Report(16-6-2017)
		var id_unit=unitid;//'15399639';
		var time=1581791400;//86400;
		
		
		//var id_res=$("#res").val(), id_templ=$("#templ").val(), id_unit=$("#units").val(), time=$("#interval").val();
		
		
		//console.log(id_res,id_templ,id_unit,time);
		
		
		if(!id_res){ msg("Select resource"); return;} // exit if no resource selected
		if(!id_templ){ msg("Select report template"); return;} // exit if no report template selected
		if(!id_unit){ msg("Select unit"); return;} // exit if no unit selected
		
		var sess = wialon.core.Session.getInstance(); // get instance of current Session
		var res = sess.getItem(id_res); // get resource by id
		var to = 1581842550;//  sess.getServerTime(); // get current server time (end time of report time interval)
		////console.log('to',to);
		////console.log('Date.now()',1581842550);
		var from = 1581791400;//to - parseInt( time, 10); // calculate start time of report
		//var from = to - parseInt( time, 10); // calculate start time of report
		// specify time interval object
		var interval = { "from": from, "to": to, "flags": wialon.item.MReport.intervalFlag.absolute };
		var template = res.getReport(id_templ); // get report template by id
		$("#exec_btn").prop("disabled", true); // disable button (to prevent multiclick while execute)
		
		res.execReport(template, id_unit, 0, interval, // execute selected report
		function(code, data) { // execReport template
			$("#exec_btn").prop("disabled", false); // enable button
			if(code){ console.log('ERROR 1',wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			
			console.log('data',data);
			
			
			var tables = data.getTables(); // get report tables
			//if (!tables) return; // exit if no tables
			for(var i=0; i < tables.length; i++){
				console.log('Total KMs Travelled',tables[i]);
				if(tables[i].label=='Total KMs Travelled')
				{
					$('#'+unitid+'_mileage').html(tables[i].total[1]);
				}
				
			}
			
			// cycle on tables
			/*
				//alert(result.getStatistics().length)
				var stats = data.getStatistics(); // get report tables
				
				for(var i=0; i < stats.length; i++)
				{
				console.log("Total KMs Travelled-",stats[i]);
				if(stats[i][0]=='Total KMs Travelled')
				{
				//alert(stats[i][1])
				//console.log(stats[i][1]);
				
				$('#'+unitid+'_mileage').html('<span>'+stats[i][1]+'</span>');
				}
				
				}
			*/
			
			
			/*
				if(!data.getTables().length){ // exit if no tables obtained
				msg("<b>There is no data generated</b>"); return; }
				else showReportResultTables(data); // show report result
				
			*/
		});
		
		//updateEngineHours(unitid);
		
		
	}
	function updateEngineHours(unitid)
	{
		
		console.log(unitid+'Time - ','2020-02-16 14:12:30');
		var sess = wialon.core.Session.getInstance(); // get instance of current Session
		var res = sess.getItems("avl_resource"); // get loaded 'avl_resource's items
		//if (!res || !res.length){ msg("Resources not found"); return; } // check if resources found
		//for (var i = 0; i< res.length; i++) // construct Select object using found resources
		//$("#res").append("<option value='" + res[i].getId() + "'>" + res[i].getName() + "</option>");
		
		
		
		var id_res=res[0].getId();//'15405301';
		var id_templ=4;//Engine Hours Daily report
		var id_unit=unitid;//'15399639';
		var time=1581791400;//86400;
		
		
		//var id_res=$("#res").val(), id_templ=$("#templ").val(), id_unit=$("#units").val(), time=$("#interval").val();
		
		
		//console.log(id_res,id_templ,id_unit,time);
		
		
		if(!id_res){ msg("Select resource"); return;} // exit if no resource selected
		if(!id_templ){ msg("Select report template"); return;} // exit if no report template selected
		if(!id_unit){ msg("Select unit"); return;} // exit if no unit selected
		
		var sess = wialon.core.Session.getInstance(); // get instance of current Session
		var res = sess.getItem(id_res); // get resource by id
		var to = 1581842550;//  sess.getServerTime(); // get current server time (end time of report time interval)
		////console.log('to',to);
		////console.log('Date.now()',1581842550);
		var from = 1581791400;//to - parseInt( time, 10); // calculate start time of report
		//var from = to - parseInt( time, 10); // calculate start time of report
		// specify time interval object
		var interval = { "from": from, "to": to, "flags": wialon.item.MReport.intervalFlag.absolute };
		var template = res.getReport(id_templ); // get report template by id
		$("#exec_btn").prop("disabled", true); // disable button (to prevent multiclick while execute)
		
		res.execReport(template, id_unit, 0, interval, // execute selected report
		function(code, data) { // execReport template
			$("#exec_btn").prop("disabled", false); // enable button
			if(code){ console.log('ERROR 2',wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			
			console.log('data - t4',data);
			
			
			var tables = data.getTables(); // get report tables
			//if (!tables) return; // exit if no tables
			for(var i=0; i < tables.length; i++){
				
				if(tables[i].label=='Engine Hours')
				{
					$('#'+unitid+'_enginehours').html(tables[i].total[3]);
				}
				
			}
			
			
			
			
			
			/*
				if(!data.getTables().length){ // exit if no tables obtained
				msg("<b>There is no data generated</b>"); return; }
				else showReportResultTables(data); // show report result
				
			*/
		});
		
		
		
	}
	timeset=3000;
	timeset_offline=1000*3;
	function UpdategetSelectedUnitInfo(unitid){ // print information about selected Unit
		//$("#"+unitid+"_message_time").css("background-color","red");
		var val = unitid;//$("#units").val(); // get selected unit id
		if(!val) return; // exit if no unit selected
		
		var unit = wialon.core.Session.getInstance().getItem(val); // get unit by id
		if(!unit){ msg("Unit not found");return; } // exit if unit not found
		var text ="";
		// construct message with unit information
		//var text = "<div>'"+unit.getName()+"' selected. "; // get unit name
		var icon = unit.getIconUrl(32); // get unit Icon url
		//if(icon) text = "<img class='icon' src='"+ icon +"' alt='icon'/>"+ text; // add icon to message
		var pos = unit.getPosition(); // get unit position
		
		if(pos){ // check if position data exists
			console.log('Speed',pos.s);
			var time = wialon.util.DateTime.formatTime(pos.t);
			text += "<b>Last message</b> "+ time +"<br/>"+ // add last message time
			"<b>Position</b> "+ pos.x+", "+pos.y +"<br/>"+ // add info about unit position
			"<b>Speed</b> "+ pos.s; // add info about unit speed
			// try to find unit location using coordinates 
			address='';
			wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}], function(code, address){ 
				if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
				
				
				
				//alert(text + "<br/><b>Location of unit</b>: "+ address+"</div>")
				
				if(time!=$("#"+unitid+"_message_time").html() && $("#"+unitid+"_message_time").html()!='')
				{
					$("#"+unitid+"_message_time").css("color","green");
					
					
				}
				
				else if(time==$("#"+unitid+"_message_time").html())
				{
					$("#"+unitid+"_message_time").css("color","black");
				}
				else if($("#"+unitid+"_message_time").html()=='' )
				{
					$("#"+unitid+"_message_time").css("color","blue");
				}
				
				var d = new Date();
				
				
				var date1 = new Date(time);
				var date2 = d.getTime()-(5*60*1000);// //new Date('2020-02-16 14:12:30');
				//datediff=Date.parse(date1) - Date.parse(date2);
				datediff=Date.parse(date1) -  (date2);
				
				
				$("#"+unitid+"_message_time").html(time);
				
				//  console.log('locator_link'+$('#'+unitid+'locator_link').attr('href'),$('#'+unitid+'locator_link').attr('href'));
				
				
				if($('#'+unitid+'locator_link').attr('href')!='') 
				$("#"+unitid+"_message_location").html('<a href="javascript:openlocator(\''+unitid+'\')">'+address+'</a>');
				
				else
				$("#"+unitid+"_message_location").html(address);
				
				
				
				
				
				
				$("#"+unitid+"_message_speed").html(pos.s+' km/h');
				
				//if(pos.s=='0' || pos.s=='' || datediff<10*60*1000)
				if(pos.s=='0' || pos.s=='' || datediff<0)
				{
					//$("#"+unitid+"_message_time").css("color","red");
					//$("#"+unitid+"_message_speed").html("<span style='color:red'>"+pos.s+' km/h'+"</span>");
					
					//////$("#tr_"+unitid+"").next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').next('td').hide();
					/*
						$.ajax({
						url: "ajax_updatelive_count.php?status=false&unitid="+unitid,
						context: document.body
						}).done(function() {
						
						});
					*/
				}
				else
				{  
					
					$("#"+unitid+"_message_speed").html(pos.s+' km/h');
					
					//$('#'+unitid+'_ignition').html('IGNITION ON');
					//$("#tr_"+unitid+"").show();
					/////$("#tr_"+unitid+"").next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').show();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').next('td').show();
					
					/*$.ajax({
						url: "ajax_updatelive_count.php?status=true&unitid="+unitid,
						context: document.body
						}).done(function() {
						
						});
					*/
					livevehiclescount=livevehiclescount+1;
					$('#div_livemomentcountfrimifrmae', window.parent.document).html(livevehiclescount);
					
					
				}
				
				if($("#"+unitid+"_message_speed").html()=='-')
				{
					/////$("#tr_"+unitid+"").next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').hide();
					/////$("#tr_"+unitid+"").next('td').next('td').next('td').next('td').next('td').next('td').hide();
					/*
						$.ajax({
						url: "ajax_updatelive_count.php?status=false&unitid="+unitid,
						context: document.body
						}).done(function() {
						
						});
					*/
				}
				
				
				// msg(text + "<br/><b>Location of unit</b>: "+ address+"</div>"); // print message to log
			});
		} else // position data not exists, print message
		msg(text + "<br/><b>Location of unit</b>: Unknown</div>"); 
		
		//$("#"+unitid+"_message_time").css("background-color","green");
		
		
		//updateGeofenceInandOut(unitid);
	}
	function updateGeofenceInandOut(unitid)
	{
		
		// get data from corresponding fields
		//var id_res=$("#res").val(), id_templ=$("#templ").val(), id_unit=$("#units").val(), time=$("#interval").val();
		//if(!id_res){ msg("Select resource"); return;} // exit if no resource selected
		//if(!id_templ){ msg("Select report template"); return;} // exit if no report template selected
		//if(!id_unit){ msg("Select unit"); return;} // exit if no unit selected
		
		var sess = wialon.core.Session.getInstance(); // get instance of current Session
		var res = sess.getItems("avl_resource"); // get loaded 'avl_resource's items
		
		id_res=res[0].getId();
		id_templ='2';
		id_unit=unitid; time=$("#interval").val() 
		
		var res = sess.getItem(id_res); // get resource by id
		var to = sess.getServerTime(); // get current server time (end time of report time interval)
		var from = to - (1000*60*60); // calculate start time of report
		// specify time interval object
		var interval = { "from": from, "to": to, "flags": wialon.item.MReport.intervalFlag.absolute };
		var template = res.getReport(id_templ); // get report template by id
		$("#exec_btn").prop("disabled", true); // disable button (to prevent multiclick while execute)
		
		res.execReport(template, id_unit, 0, interval, // execute selected report
		function(code, data) { // execReport template
			$("#exec_btn").prop("disabled", false); // enable button
			if(code){ msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			if(!data.getTables().length){ // exit if no tables obtained
			msg("<b>There is no data generated</b>"); return; }
			else showReportResult(data); // show report result
		});
		
	}
	// execute when DOM ready
	
	
	function showReportResult(result){ // show result after report execute
		var tables = result.getTables(); // get report tables
		if (!tables) return; // exit if no tables
		for(var i=0; i < tables.length; i++){ // cycle on tables
			// html contains information about one table
			var html = "<b>"+ tables[i].label +"</b><div class='wrap'><table style='width:100%'>";
			
			var headers = tables[i].header; // get table headers
			html += "<tr>"; // open header row
			for (var j=0; j<headers.length; j++) // add header
			html += "<th>" + headers[j] + "</th>";
			html += "</tr>"; // close header row
			result.getTableRows(i, 0, tables[i].rows, // get Table rows
			qx.lang.Function.bind( function(html, code, rows) { // getTableRows callback
				if (code) {msg(wialon.core.Errors.getErrorText(code)); return;} // exit if error code
				for(var j in rows) { // cycle on table rows
					if (typeof rows[j].c == "undefined") continue; // skip empty rows
					html += "<tr"+(j%2==1?" class='odd' ":"")+">"; // open table row
					for (var k = 0; k < rows[j].c.length; k++) // add ceils to table
					html += "<td>" + getTableValue(rows[j].c[k]) + "</td>";
					html += "</tr>";// close table row
				}
				html += "</table>";
				msg(html +"</div>");
			}, this, html)
			);
		}
		
		console.log('htmlhtml=',html);
	}
	
	function getTableValue(data) { // calculate ceil value
		if (typeof data == "object")
		if (typeof data.t == "string") return data.t; else return "";
		else return data;
	}
	
	$(document).ready(function () {
		
		
		/*
			setTimeout(function(){ 
			
			
			//  shorturl=makeRequest2(unitid);
			var rows = $('#units tr').get();
			
			
			
			var countr=1;
			var time = 400;
			$.each(rows, function(index, row) {
			try{ 
			unitid=$(this).attr('id').replace('tr_','');
			//alert(unitid)
			//setTimeout('updateMileage('+unitid+');  ',time);
			// setTimeout(function(unitid){ 
			//  updateMileage(unitid);  
			// }, time);
			time += 400;
			countr=countr+1;
			
			//alert(productId)
			}catch(e){console.log(e);}
			});
			
			}, 1000*2);
		*/
		
		setTimeout(function(){ 
			
			
			
			
		$('#loading').hide();
		
		}, 1000*10);
		
		
		var livevehiclescount=0;
		//setTimeout(function(){ 
		
		wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
		// For more info about how to generate token check
		// https://sdk.wialon.com/playground/demo/app_auth_token
		token='fe2a2c9ce2e7cbdf866f4d599b540ec0CABDD221D03293AE87340EB448C73DE1A27FC2F6';
		
		
		wialon.core.Session.getInstance().loginToken(token, "", // try to login
		function (code) { // login callback
		// if error code - print error message
		if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
		msg("Logged successfully");  // when login suceed then run init() function
		init();
		//setTimeout("init();",1000*10);
		}); 
		
		
		
		
		
		//-----------------------
		
		//}, 1000*60);
		
		});
		function viewnotifications()
		{
		$('#divnotifications').show('slow');
		
		}
		function closenotificaitons()
		{
		$('#divnotifications').hide('slow');
		
		}
		
		
		</script> 
		
	
		<script src="https://apis.google.com/js/client.js" type="text/javascript"> </script>
		
		<script type="text/javascript">
		function makeRequest() {
		var Url = document.getElementById("longurl").value;
		var request = gapi.client.urlshortener.url.insert({
		'resource': {
        'longUrl': Url
		}
		});
		request.execute(function(response) {
		
		if (response.id != null) {
        str = "<b>Long URL:</b>" + Url + "<br>";
        str += "<b>Test Short URL:</b> <a href='" + response.id + "'>" + response.id + "</a><br>";
        document.getElementById("result").innerHTML = str;
		}
		else {
        alert("Error: creating short url \n" + response.error);
		}
		});
		}
		
		function makeRequest2(unitid) {
		
		Url2=$("#"+unitid+"_locator").html();
		
		if(Url2!=null   )
		{
		if( Url2!='')
		{
        //alert(URL)
        
        var request = gapi.client.urlshortener.url.insert({
		'resource': {
		'longUrl': Url2
		}
        });
        request.execute(function(response) {
		
		if (response.id != null) {
		str2  = " <a target='_blank'  href='" + response.id + "'>Locator</a> ";
		$("#"+unitid+"_locator").html(str2);
		
		$("#"+unitid+"_locator").show('slow');
		
		//document.getElementById("result").innerHTML = str;
		}
		else {
		// alert("Error: creating short url \n" + response.error);
		}
        });
        
		}
		
		}
		}
		function load() {
		gapi.client.setApiKey('AIzaSyAtwJEicl2BbULBGZ_ygSHxGgjhdoYcXd0');
		gapi.client.load('urlshortener', 'v1', function() { test= ""; });
		}
		window.onload = load;
		</script>
		
		<script>
		timeset_offline=1000*3; //uncomment afrer delete retun false from sortTable
		function sortTable(){
		
		
		return false;
		
		
		
		
		var rows = $('#unitstable tbody  tr').get();
		
		rows.sort(function(a, b) {
		
		var A = $(a).children('td').eq(5).text().toUpperCase();
		var B = $(b).children('td').eq(5).text().toUpperCase();
		
		if(parseInt(A) < parseInt(B)) {
        
        
        return 1;
		}
		
		if(parseInt(A) > parseInt(B)) {
        return -1;
		}
		
		return 0;
		
		});
		
		$.each(rows, function(index, row) {
		$('#unitstable').children('tbody').append(row);
		});
		setTimeout(function(){ 
		
		
		addsrnumbers();
		
		
		}, 1000*5);
		
		
		}
		
		function addsrnumbers()
		{
		var rows = $('#unitstable tbody  tr').get();
		
		
		
		var countr=1;
		$.each(rows, function(index, row) {
		unitid=$(this).attr('id').replace('tr_','');
		
		
		
		
		
		
		//$('#units').children('tbody').append(row);
		var $tds = $(this).find('td');
		
		
		$tds.eq(0).html(countr);
		
		
		if(countr%2==0)
		{
        
        $(this).css('background','#e0d7d7');
		}
		else
		{
        $(this).css('background','#FFF');
		}
		
		
		
		countr=countr+1;
		
		//alert(productId)
		
		});
		}
		</script>

  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer> -->

   
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery 3 -->
<script src="https://gpsreports.in/vftracker/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://gpsreports.in/vftracker/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="https://gpsreports.in/vftracker/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://gpsreports.in/vftracker/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="https://gpsreports.in/vftracker/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="https://gpsreports.in/vftracker/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="https://gpsreports.in/vftracker/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://gpsreports.in/vftracker/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
	 $('#testTable').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    });
  })
</script>





</body>
</html>

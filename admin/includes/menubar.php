<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
			<a href="#">
				<i class="fa fa-send-o"></i>
				<span> Trip Module </span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
			    
				<li><a href="trip-sheets.php"><i class="fa fa-bars"></i> <span> Trip Sheets</span></a></li>
                <li><a href="dieselReport.php"><i class="fa fa-bars"></i> <span> Fuel Sheets</span></a></li>
                <?php if($_SESSION['admin'] != '38' && $_SESSION['admin'] != '39' && $_SESSION['admin'] != '40') { ?>
                    <li><a href="trip-expenses.php"><i class="fa fa-bars"></i> <span> Trip Expenses List</span></a></li>
				    <li><a href="party-list.php"><i class="fa fa-bars"></i> <span> Party List </span></a></li>
				    <li><a href="vehicle-status.php"><i class="fa fa-bars"></i> <span> Vehicle Status </span></a></li>
				<?php } ?>
			</ul>
		</li>
		<?php if($_SESSION['admin'] != '38' && $_SESSION['admin'] != '39' && $_SESSION['admin'] != '40') { ?>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-send-o"></i>
				<span> Requsition Module </span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="requsitionSheets.php"><i class="fa fa-bars"></i> <span> Requsition Sheets</span></a></li>
				<li><a href="requsitionSheetsView.php"><i class="fa fa-bars"></i> <span> Requsition Reports</span></a></li>
			</ul>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-podcast"></i>
				<span> Expenses Panel </span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				
				<li><a href="office-expenses.php"><i class="fa fa-bars"></i> <span> Office Expenses List</span></a></li>
				
			</ul>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-deaf"></i>
				<span> Vehicle Repairs </span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="vehicle-repaire.php"><i class="fa fa-bars"></i> <span> Vehicle Repairs List</span></a></li>
			</ul>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-server"></i>
				<span> Ledger Panel </span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="ledger-list.php"><i class="fa fa-bars"></i> <span> Ledger List</span></a></li>
				<li><a href="freight-collection.php"><i class="fa fa-bars"></i> <span> Freight Collection</span></a></li>
				<li><a href="driver-salaries.php"><i class="fa fa-bars"></i> <span> Driver Salaries</span></a></li>
				
			</ul>
		</li>
		<?php } ?>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-gears"></i>
				<span> Master Panel </span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="vehicle-master.php"><i class="fa fa-bars"></i> <span> Vehicle Master List</span></a></li>
				<li><a href="branch-master.php"><i class="fa fa-bars"></i> <span> Factory Master List</span></a></li>
				<li><a href="helper-master.php"><i class="fa fa-bars"></i> <span> Helper Master List</span></a></li>
				<li><a href="supervisor-master.php"><i class="fa fa-bars"></i> <span> Supervisor Master List</span></a></li>
				
			<?php if($_SESSION['admin'] != '38' && $_SESSION['admin'] != '39' && $_SESSION['admin'] != '40') { ?>
			    <li><a href="document-master.php"><i class="fa fa-bars"></i> <span> Vehicle Documents List</span></a></li>
				<li><a href="location-master.php"><i class="fa fa-bars"></i> <span> Location Master List</span></a></li>
				<li><a href="driver-master.php"><i class="fa fa-bars"></i> <span> Driver Master List</span></a></li>
				<li><a href="tyre-master.php"><i class="fa fa-bars"></i> <span> Tyre Master List</span></a></li>
				<li><a href="pump-name-master.php"><i class="fa fa-bars"></i> <span> Pump Name List</span></a></li>
			<?php } ?>	
			</ul>
		</li>
		<li class="treeview">
			<a href="#">
				<i class="fa fa-gears"></i>
				<span> Service Center</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="tokenList.php"><i class="fa fa-bars"></i> <span> Demand Letter</span></a></li>
				<li><a href="Traffic-case-exp-add.php"><i class="fa fa-bars"></i> <span> Traffic Case Expenses List</span></a></li>
			</ul>
		</li>
		<li class="treeview">
		<a href="#">
			<i class="fa fa-gears"></i>
			<span> Setting</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
				<li><a href="warehouseView.php"><i class="fa fa-bars"></i> <span> Workshop</span></a></li>
		</ul>
	    </li>
		<?php if($_SESSION['admin'] != '38' && $_SESSION['admin'] != '39' && $_SESSION['admin'] != '40') { ?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-rss"></i>
			<span> Live Panel</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<!--li><a href="live-units-tracking.php"><i class="fa fa-bars"></i> <span> Live Tracking </span></a></li-->
				<li><a href="allUnitTrack.php"><i class="fa fa-bars"></i> <span> All Live Tracking </span></a></li>
				<li><a href="live-units-tracking-map.php"><i class="fa fa-bars"></i> <span> Live Tracking With GPS MAP </span></a></li>
				<li><a href="execute_custom_report.php"><i class="fa fa-bars"></i> <span> Trip Custom Reports </span></a></li>
			</ul>
		</li>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-bell-o"></i>
			<span> Alert Panel</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<!--li><a href="live-units-tracking.php"><i class="fa fa-bars"></i> <span> Live Tracking </span></a></li-->
				<li><a href="registration-cirtificateAlert.php"><i class="fa fa-bars"></i> <span> Registration Alert </span></a></li>
				<li><a href="insurance-cirtificateAlert.php"><i class="fa fa-bars"></i> <span> Insurance Alert </span></a></li>
				<li><a href="tax-cirtificateAlert.php"><i class="fa fa-bars"></i> <span> Tax Alert </span></a></li>
				<li><a href="fitness-cirtificateAlert.php"><i class="fa fa-bars"></i> <span> Fitness Alert </span></a></li>
				<li><a href="route-cirtificateAlert.php"><i class="fa fa-bars"></i> <span> Route Permit Alert </span></a></li>
			</ul>
		</li>
		 
		<li class="treeview">
			<a href="#">
			<i class="fa fa-users"></i>
			<span> CRM Panel</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="user-add.php"><i class="fa fa-bars"></i> <span> Add User </span></a></li>
				<li><a href="party-view.php"><i class="fa fa-bars"></i> <span> Add Vendor </span></a></li>
			</ul>
		</li>
	<?php } ?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-file-pdf-o"></i>
			<span> Reports Panel</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li><a href="vehecleWiseFuelCostingReport.php"><i class="fa fa-bars"></i><span> Fuel Sheet report</span></a></li>
				<li><a href="tripWiseSheetReport.php"><i class="fa fa-bars"></i><span> Trip Sheet report</span></a></li>
				<li><a href="vehicleSummaryReport.php"><i class="fa fa-bars"></i><span> Vehicle Summary Reports</span></a></li>
			</ul>
		</li>
		<!--li class="treeview">
			  <a href="#">
				<i class="fa fa-users"></i>
				<span>Options</span>
				<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
			  </a>
			<ul class="treeview-menu">
				<li><a href="districts.php"><i class="fa fa-bars"></i> Add Districts</a></li>
				<li><a href="thana.php"><i class="fa fa-bars"></i> Add Thana</a></li>
				<li><a href="brands.php"><i class="fa fa-bars"></i> Add Brand</a></li>
				<li><a href="categories.php"><i class="fa fa-bars"></i> Add Gun Category </a></li>
			</ul>
		</li-->
		<!--li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Calendar Activities</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
		   <li><a href="view.php"><i class="fa fa-calendar"></i> <span>Make New Calendar</span></a></li>
		   <li><a href="calendar-view.php"><i class="fa fa-calendar"></i> <span>Full Calendar</span></a></li>
		   <li><a href="onday-view.php"><i class="fa fa-calendar"></i> <span>Onday Calendar</span></a></li>
		   <li><a href="offday-view.php"><i class="fa fa-calendar"></i> <span>Offday Calendar</span></a></li>
		   <li><a href="holiday-view.php"><i class="fa fa-calendar"></i> <span>Holiday Calendar</span></a></li>
          </ul>
        </li-->
		
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div id="loading" style="display:none;">
    <img id="loading-image" src="../images/loader.gif" alt="Loading..."  />
</div>

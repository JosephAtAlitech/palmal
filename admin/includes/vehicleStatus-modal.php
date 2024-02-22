<!-- Add new trip -->
<div class="modal fade" id="tripAdd">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add new trip to this vehecle </b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="tripStatus-add.php" enctype="multipart/form-data">
          		<input type="hidden" id="veid"  name="veId">
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Vahicle Name </label>
                    	<input type="text" id="vehicleNumber" class="form-control" name="VahecleName" readonly>
					</div>
					<div class="col-sm-6">
						<label class="">Trip Id</label>
                    	<select class="form-control" id="veid1" name="tripId">
							<option value="" selected>~~ Select Trip ~~</option>
							<?php
								$sql = "SELECT trip_sheets.id,trip_sheets.vehicle_no,trip_sheets.trip_number,vehecle_status.trip_id FROM `trip_sheets`
										LEFT JOIN vehecle_status ON vehecle_status.trip_id=trip_sheets.trip_number
                                        WHERE vehecle_status.trip_id IS null";
								$query = $conn->query($sql);
								while($prow = $query->fetch_assoc()){
									echo "<option value='".$prow['id']."'>Trip Number :".$prow['trip_number']."</option>";
								  }
								?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Trip Loading Status</label>
                    	<select class="form-control" id="" name="tripLoadingStatus">
							<option value="" selected>~~ Select Trip Status ~~</option>
							<option value="Loading Today"> Loading Today </option>
							<option value="No Loading Today"> No Loading Today </option>
							<option value="No Unloading Today"> No Unloading Today </option>
							
						</select>
					</div>
					<div class="col-sm-6">
						<label class="">Status</label>
                    	<select class="form-control" id="" name="tripStatus">
							<option value="" selected>~~ Select Status ~~</option>
							<option value="Active"> Active </option>
							<option value="Inactive"> Inactive </option>
							
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addTripStatus"><i class="fa fa-save"> </i> Add Trip </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Add new Driver -->
<div class="modal fade" id="driverAdd">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add new driver to this vehecle </b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="tripStatus-add.php" enctype="multipart/form-data">
          		<input type="hidden" id="veid12"  name="veid12">
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Vahicle Name </label>
                    	<input type="text" id="vehicleNumber12" class="form-control" name="VahecleName" readonly>
					</div>
					<div class="col-sm-6">
						<label class="">Driver Name</label>
                    	<select class="form-control" id="driverid1" name="driverId">
							<option value="" selected>~~ Select Driver ~~</option>
							<?php
								$sql = "SELECT driver_master.id,driver_master.driver_name,vehecle_status.delete_status FROM `driver_master`
										LEFT OUTER JOIN vehecle_status ON vehecle_status.driver_id=driver_master.id AND vehecle_status.delete_status!=2
										WHERE vehecle_status.driver_id IS null";
								$query = $conn->query($sql);
								while($prow = $query->fetch_assoc()){
									echo "<option value='".$prow['id']."'>".$prow['driver_name']."</option>";
								  }
								?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Status</label>
                    	<select class="form-control" id="" name="driverStatus">
							<option value="" selected>~~ Select Status ~~</option>
							<option value="Active"> Active </option>
							<option value="Inactive"> Inactive </option>
							
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addDriverStatus"><i class="fa fa-save"> </i> Add Trip </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Add new helper -->
<div class="modal fade" id="helperAdd">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add new Helper to this vehecle </b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="tripStatus-add.php" enctype="multipart/form-data">
          		<input type="hidden" id="veid123"  name="veid123">
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Vahicle Name </label>
                    	<input type="text" id="vehicleNumber123" class="form-control" name="VahecleName" readonly>
					</div>
					<div class="col-sm-6">
						<label class="">Helper Name</label>
                    	<select class="form-control" id="helperid1" name="helperId">
							<option value="" selected>~~ Select Helper ~~</option>
							<?php
								$sql = "SELECT helper_master.id,helper_master.helper_name,vehecle_status.delete_status FROM `helper_master`
										LEFT JOIN vehecle_status ON vehecle_status.helper_id=helper_master.id AND vehecle_status.delete_status!=2
										WHERE vehecle_status.helper_id IS null";
								$query = $conn->query($sql);
								while($prow = $query->fetch_assoc()){
									echo "<option value='".$prow['id']."'>".$prow['helper_name']."</option>";
								  }
								?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Status</label>
                    	<select class="form-control" id="" name="helperStatus">
							<option value="" selected>~~ Select Status ~~</option>
							<option value="Active"> Active </option>
							<option value="Inactive"> Inactive </option>
							
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addHelperStatus"><i class="fa fa-save"> </i> Add Trip </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- End Vehicle Trip -->
<div class="modal fade" id="deleteVeStatus">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>End Vehicle Trip...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="tripStatus-add.php">
            		<input type="hidden" id="veid1234" name="id">
            		<div class="text-center">
	                	<p>Re-Allocate Vehicle Number</p>
	                	<h2 id="vehicleNumber1234" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="deleteVehicleStatus"><i class="fa fa-eye-slash"></i> End Trip </button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Start Vehicle Trip -->
<div class="modal fade" id="startVeStatus">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Start Vehicle Trip...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="tripStatus-add.php">
            		<input type="hidden" id="veid12345" name="id">
            		<div class="text-center">
	                	<p>Allocate Vehicle Number For This Trip</p>
	                	<h2 id="vehicleNumber12345" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-warning btn-flat" name="startVehicleStatus"><i class="fa fa-assistive-listening-systems"></i> Start Trip </button>
            	</form>
          	</div>
        </div>
    </div>
</div>
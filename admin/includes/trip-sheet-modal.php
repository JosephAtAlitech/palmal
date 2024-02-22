<!-- Add Trip Sheet -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Trip Sheet</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="trip-sheet-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
				<select style="display:none;" id="res"></select>
				<select style="display:none;" id="templ"><option value="unit_trips">Trips</option></select>	
					<?php
						$sql = "SELECT id FROM `trip_sheets` ORDER BY id DESC LIMIT 1";
						$query = $conn->query($sql);
						$id=1;
						while($prow = $query->fetch_assoc()){
							$id=$prow['id']+1;
						}
					?>
					<input type="hidden" id="TripNumber" class="" name="TripNumber" value="<?php echo $id; ?>" readonly>
					<input type="hidden" id="modeStatus" class="" name="modeStatus" value="Add" readonly>
					<input type="hidden" id="tripId" class="" name="tripId" value="" readonly>
					<div class="col-sm-4">
						<label class="">VFT Vehicle Number</label><br>
						<select id="units" class="form-control" name="vehicleNumber" onchange="unitsAvailability(this.value); runningDistanceVFT()" ><option value='' selected> Select Unit</option></select>
						<input id="editid" type="hidden" name="vId"></span>
					</div>
					<div class="col-sm-4">
					    <input type="hidden" id="today" value="<?php echo date("m/d/Y h:i:s A", strtotime("+2 hour")); ?>" >
						<label class="">Trip Start Date</label>
						<div class="input-group date">
                            <input type="text" class="form-control example" id="start_dt" value="<?php echo $toDayTime; ?>"  name="tripStartDate" placeholder=" Trip Start Date " onblur="runningDistanceVFT()" />
                            <span class="input-group-addon"><span  class="glyphicon glyphicon-calendar"></span></span>
                        </div>
					</div>
					<div class="col-sm-4">
						<label class="">Trip End Date</label>
						<div class="input-group date">
                            <input type="text" class="form-control exampleEnd" id="end_dt" name="tripEndDate" placeholder=" Trip End Date "  onblur="runningDistanceVFT()" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
					</div>
					<ul id="columns"></ul>
					
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Travel KM</label>
						<input type="text" id="travelDistance" class="form-control" name="travelDistance" placeholder=" Enter Distance In KM " >
					</div>
					<div class="col-sm-6">
						<label class="">Fuel Issue </label>
                    	<input type="text" id="fuelIssue" class="form-control" name="fuelIssue" placeholder=" Enter Fuel Issue " >
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">VFT KM </label>	
						<input type="text" id="log" class="form-control" name="vftKm" placeholder=" Enter VFT KM " Readonly required>
						<label class="" id="lblPreviousLog">Previous VFT KM </label>	
						<input type="text" id="previousLog" class="form-control" name="previousVftKm" placeholder=" Enter VFT KM " Readonly required>
					</div>		
					<div class="col-sm-6">
						<label class="">VFT Fuel</label>
                    	<input type="text" id="vftFuel" class="form-control" name="vftFuel" placeholder=" Enter VFT Fuel " >
					</div>
					
					<select style="display:none;" id="interval" class="form-control"></select>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addTripSheet"><i class="fa fa-save"> </i> Save Trip Sheet</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Trip Delete -->
<div class="modal fade" id="deleteTrip">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="trip-sheet-add.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE TRIP ID</p>
	                	<h2 id="deletTripid" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteTrip"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Active Branch -->
<div class="modal fade" id="activeVehicle">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>In-Active to Active Added Vehicle</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="vehicle-edit.php" enctype="multipart/form-data">
          		
				<input type="hidden" id="activeVehicleid" name="id">
               
				
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Branch Name :</label>
                  	<div class="col-sm-5">
                    	<input type="text" id="InActivevehicleNumber" class="form-control" name="branchName" placeholder=" Write Branch Name " readonly>
					</div>
					
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Status Activation :</label>
					<div class="col-sm-9">
                    	<select class="form-control" id="statusvehicleNumber" name="status"  required>
							<option value="" selected>~~ Select One ~~</option>
							<option value="Active">~~ Active ~~</option>
							<option value="In-Active">~~ In-Active ~~</option>
						</select>
					</div>
				</div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="activatedVehicle"><i class="fa fa-save"> </i> Edit Branch</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
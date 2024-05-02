<!-- Add Freight Collection -->
<div class="modal fade" id="addnewFreight">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Freight Collection</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="freight-collection-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Trip Number:</label>
						<select class="form-control" id="tripNumber" name="tripNumber">
							<option value="" selected>~~ Select Trip ~~</option>
							<?php
								  $sql = "SELECT id,trip_number FROM `trip_sheets` WHERE status!='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>Trip No ".$prow['trip_number']."</option>
									";
								  }
								?>
						</select>
					</div>
					<div class="col-sm-6">
						<label class="">Vehicle Number:</label>
						<select class="form-control" id="vehicleNumber" name="vehicleNumber" required>
							<option value="" selected>~~ Select Vehicle Number ~~</option>
							<?php
								  $sql = "SELECT id,vehicle_number FROM `vehicle_master` WHERE delete_status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['vehicle_number']."</option>
									";
								  }
								?>
						</select>
					</div>
					
					
				</div>
				
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Party Name:</label>
                    	<input type="text" id="partyName" class="form-control" name="partyName" placeholder=" Enter Party Name" required>
					</div>
					<div class="col-sm-6">
						<label class="">Party Phone:</label>
                    	<input type="text" id="branchName" class="form-control" name="partyPhone" placeholder="Enter Party Phone"  required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Trip Advance :</label>
                    	<input type="text" id="tripAdance" class="form-control" name="tripAdance" placeholder=" Enter Trip Advance " required>
					</div>
					<div class="col-sm-6">
						<label class="">Trip Advance By :</label>
                    	<input type="text" id="branchName" class="form-control" name="TripAdvanceBy" placeholder=" Trip Advance By " required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Accounts Type:</label>
                    	<select class="form-control" id=""  name="accountType" required>
							<option value="" selected>~~ Select Type~~</option>
							<option value="Cash">Cash</option>
							<option value="Credit">Credit</option>
						</select>
					</div>
					<div class="col-sm-6">
						<label class="">Date:</label>
                    	<input type="date" id="freightDate" class="form-control" name="freightDate" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<label class="">Trip Details:</label>
						<textarea class="form-control" id=""  name="tripDetails" placeholder="Trip Deatails" ></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addFreight"><i class="fa fa-save"> </i> Add Freight Collection</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit freight Collection -->
<div class="modal fade" id="EditFreight">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Freight Collection</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="freight-collection-add.php" enctype="multipart/form-data">
          		<input type="hidden" id="editid" name="id">
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Trip Number:</label>
						<select class="form-control" id="edittrip_no" name="tripNumber">
							<option value="" selected>~~ Select Trip ~~</option>
							<?php
								  $sql = "SELECT id,trip_number FROM `trip_sheets` WHERE status!='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>Trip No ".$prow['trip_number']."</option>
									";
								  }
								?>
						</select>
					</div>
					<div class="col-sm-6">
						<label class="">Vehicle Number:</label>
						<select class="form-control" id="editvehicle_no" name="vehicleNumber" required>
							<option value="" selected>~~ Select Vehicle Number ~~</option>
							<?php
								  $sql = "SELECT id,vehicle_number FROM `vehicle_master` WHERE delete_status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['vehicle_number']."</option>
									";
								  }
								?>
						</select>
					</div>
					
					
				</div>
				
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Party Name:</label>
                    	<input type="text" id="editparty_name" class="form-control" name="partyName" placeholder=" Enter Party Name" required>
					</div>
					<div class="col-sm-6">
						<label class="">Party Phone:</label>
                    	<input type="text" id="editparty_phone" class="form-control" name="partyPhone" placeholder="Enter Party Phone"  required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Trip Advance :</label>
                    	<input type="text" id="edittrip_advance" class="form-control" name="tripAdance" placeholder=" Enter Trip Advance " required>
					</div>
					<div class="col-sm-6">
						<label class="">Trip Advance By :</label>
                    	<input type="text" id="edittrip_advance_by" class="form-control" name="TripAdvanceBy" placeholder=" Trip Advance By " required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Accounts Type:</label>
                    	<select class="form-control" id="editacc_type"  name="accountType" required>
							<option value="" selected>~~ Select Type~~</option>
							<option value="Cash">Cash</option>
							<option value="Credit">Credit</option>
						</select>
					</div>
					<div class="col-sm-6">
						<label class="">Date:</label>
                    	<input type="date" id="editfreight_date" class="form-control" name="freightDate" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<label class="">Trip Details:</label>
						<textarea class="form-control" id="edittrip_details"  name="tripDetails" placeholder="Trip Deatails" ></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="editFreight"><i class="fa fa-save"> </i> Add Freight Collection</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Freight Delete -->
<div class="modal fade" id="deleteFreight">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="freight-collection-add.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE FREIGHT TRIP NO</p>
	                	<h2 id="Viewtrip_no" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteFreight"><i class="fa fa-trash"></i> Delete</button>
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
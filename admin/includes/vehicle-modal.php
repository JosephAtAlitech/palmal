<!-- Add Vehicle -->
<div class="modal fade" id="addnewVehicle">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Vehicle</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="vehicle-add.php" enctype="multipart/form-data">
          		<div class="form-group">
					<div class="col-md-4">
						<label for="sunit">Select <?php echo '<b> - '.$json['user']['nm'].'- </b>';?>Online unit:</label>
						<select class="searchVehicle form-control" id="units" name="wUnitId">
							<option value="" selected>~~ Select Units ~~</option>
						</select>
					</div>
					<div class="col-sm-4">
						<label class="">Oil Tank Capacity:</label>
						<input type="text" id="oilTankCapacity12" maxlength="7" class="form-control" name="oilTankCapacity" placeholder=" Write Oil Tank Capacity ">
					</div>
					<div class="col-sm-4">
						<label class="">Branch Name:</label>
                    	<select id="BranchStatus" class="form-control" name="BranchStatus">
							<option value="" selected>~~ Select Status ~~</option>
								<?php
								  $sql = "SELECT id,branch_name FROM `branch_master` WHERE status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['branch_name']."</option>
									";
								  }
								?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label class="">Vehicle Number:</label>
						<input type="text" id="vehicleNumber" maxlength="20" class="form-control"  name="vehicleNumber" onblur="vNumberAvailability()" placeholder=" Write Vehicle Number " required>
					    <span id="vNumber-availability-status"></span>
					</div>
					<div class="col-sm-3">
						<label class="">Vehicle Type:</label>
                    	<select id="vtype" class="form-control" name="vtype">
							<option value="vf-tracker"> VF-Tracker </option>
							<option value="v-tracker"> V-Tracker </option>
							<option value="cng"> CNG </option>
							<option value="generator"> Generator </option>
							<option value="boiler"> Boiler </option>
						</select>
					</div>
					<div class="col-sm-3">
						<label class="">Chassis Number:</label>
                    	<!--input type="text" id="chasisNumberCheck" class="form-control" name="ChesisNumber" onblur="chasisAvailability()" placeholder=" Write Chesis Number "-->
                    	<input type="text" id="chasisNumberCheck" class="form-control" name="ChesisNumber"  placeholder=" Write Chesis Number ">
						<span id="chasis-availability-status"></span>
					</div>
					<div class="col-sm-3">
						<label class="">Engine Number:</label>
                    	<!--input type="text" id="EnginNumberCheck" class="form-control" name="EnginNumber" onblur="engineAvailability()" placeholder=" Write Engin Number "-->
                    	<input type="text" id="EnginNumberCheck" class="form-control" name="EnginNumber"  placeholder=" Write Engin Number ">
						<span id="engine-availability-status"></span>
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Year Of Manufacture:</label>
                    	<?php $years = range(1971, strftime("%Y", time())); ?>
							<select class="form-control"  id="YearOfManufacture" name="YearOfManufacture">
							  <option>~~ Select Year ~~</option>
							  <?php foreach($years as $year) : ?>
								<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
							  <?php endforeach; ?>
							</select>
					</div>
					<div class="col-sm-4">
						<label class="">Purchase Date:</label>
                    	<input type="date" id="PurchaseDate" class="form-control" name="PurchaseDate" placeholder=" Write Purchase Date ">
					</div>
					<div class="col-sm-4">
						<label class="">Makers Name:</label>
                    	<select id="MakersName" class="form-control" name="MakersName">
							<option value="" selected>~~ Select Makers ~~</option>
								<?php
								  $sql = "SELECT id,name FROM `manufacturer_name`";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['name']."</option>
									";
								  }
								?>
						</select>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" id="submit-button" name="addVehicle"><i class="fa fa-save"> </i> Add Vehicle</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>


<!-- Edit Vehicle -->
<div class="modal fade" id="editVehicle">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit added Vehicle</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="vehicle-add.php" enctype="multipart/form-data">
          		<input type="hidden" id='editid' name="vid">
				<div class="form-group">
					<div class="col-sm-3">
						<label class="">Vehicle Number:</label>
						<input type="text" id="EditVehicleNumber" maxlength="7" class="form-control" name="vehicleNumber" onblur="vNumberAvailability()" placeholder=" Write Vehicle Number " required readonly>
					    <span id="vNumber-availability-status"></span>
					</div>
					<div class="col-sm-3">
						<label class="">Vehicle Type:</label>
                    	<select id="Editvtype" class="form-control" name="vtype">
							<option value="vf-tracker"> VF-Tracker </option>
							<option value="v-tracker"> V-Tracker </option>
							<option value="cng"> CNG </option>
							<option value="generator"> Generator </option>
							<option value="boiler"> Boiler </option>
						</select>
					</div>
					<div class="col-sm-3">
						<label class="">Oil Tank Capacity:</label>
						<input type="text" id="oilTankCapacity" maxlength="7" class="form-control" name="oilTankCapacity" placeholder=" Write Oil Tank Capacity ">
					</div>
					<div class="col-sm-3">
						<label class="">Branch Name:</label>
                    	<select id="EditBranchStatus" class="form-control" name="BranchStatus">
							<option value="" selected>~~ Select Status ~~</option>
								<?php
								  $sql = "SELECT id,branch_name FROM `branch_master` WHERE status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['branch_name']."</option>
									";
								  }
								?>
						</select>
					</div>
				</div>
				<div class="form-group">
					
					<div class="col-sm-4">
						<label class="">wVFT ID:</label>
                    	<input type="text" id="wVFTID" class="form-control" name="wVFTID"  placeholder=" WVft ID only ">
					</div>
					<div class="col-sm-4">
						<label class="">Chassis Number:</label>
                    	<input type="text" id="ChesisNumber" class="form-control" name="ChesisNumber" onblur="chasisAvailability()" placeholder=" Write Chesis Number ">
						<span id="chasis-availability-status"></span>
					</div>
					<div class="col-sm-4">
						<label class="">Engine Number:</label>
                    	<input type="text" id="EnginNumber" class="form-control" name="EnginNumber" onblur="engineAvailability()" placeholder=" Write Engin Number ">
						<span id="engine-availability-status"></span>
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Year Of Manufacture:</label>
                    	<?php $years = range(1971, strftime("%Y", time())); ?>
							<select class="form-control"  id="EditYearOfManufacture" name="YearOfManufacture">
							  <option>~~ Select Year ~~</option>
							  <?php foreach($years as $year) : ?>
								<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
							  <?php endforeach; ?>
							</select>
					</div>
					<div class="col-sm-4">
						<label class="">Purchase Date:</label>
                    	<input type="date" id="Editpurchase_date" class="form-control" name="PurchaseDate" placeholder=" Write Purchase Date ">
					</div>
					<div class="col-sm-4">
						<label class="">Makers Name:</label>
                    	<select id="EditMakersName" class="form-control" name="MakersName">
							<option value="" selected>~~ Select Makers ~~</option>
								<?php
								  $sql = "SELECT id,name FROM `manufacturer_name`";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['name']."</option>
									";
								  }
								?>
						</select>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" id="submit-button" name="editVehicle"><i class="fa fa-save"> </i> Update Vehicle</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Vehicle Delete -->
<div class="modal fade" id="deleteVehicle">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="vehicle-edit.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE VEHICLE NAME</p>
	                	<h2 id="deletvehicleNumber" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteVehicle"><i class="fa fa-trash"></i> Delete</button>
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
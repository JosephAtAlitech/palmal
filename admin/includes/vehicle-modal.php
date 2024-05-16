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
				<form class="form-horizontal" id="contact_form" method="POST" action="vehicle-add.php"
					enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-md-4">
							<label for="sunit">Select
								<!-- <?php echo '<b> - ' . $json['user']['nm'] . '- </b>'; ?> -->
								Online unit:
							</label>
							<select class="searchVehicle form-control" id="units" name="wUnitId">
								<option value="" selected>~~ Select Units ~~</option>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Oil Tank Capacity:</label>
							<input type="text" id="oilTankCapacity12" maxlength="7" class="form-control"
								name="oilTankCapacity" placeholder=" Write Oil Tank Capacity ">
						</div>
						<div class="col-sm-4">
							<label class="">Fectory / Dept. Name:</label>
							<select id="BranchStatus" class="form-control" name="BranchStatus">
								<option value="" selected>~~ Select Status ~~</option>
								<?php
								$sql = "SELECT id,branch_name FROM `branch_master` WHERE status='Active' ORDER BY `id`  DESC";
								$query = $conn->query($sql);
								while ($prow = $query->fetch_assoc()) {
									echo "
									  <option value='" . $prow['id'] . "'>" . $prow['branch_name'] . "</option>
									";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Vehicle Number:</label>
							<input type="text" id="vehicleNumber" maxlength="20" class="form-control"
								name="vehicleNumber" onblur="vNumberAvailability()" placeholder=" Write Vehicle Number "
								required>
							<span id="vNumber-availability-status"></span>
						</div>
						<div class="col-sm-4">
							<label class="">Vehicle Type:</label>
							<select id="vtype" class="form-control" name="vtype">
								<option value="vf-tracker"> VF-Tracker </option>
								<option value="v-tracker"> V-Tracker </option>
								<option value="cng"> CNG </option>
								<option value="lpg"> LPG </option>
								<option value="generator"> Generator </option>
								<option value="boiler"> Boiler </option>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Chassis Number:</label>
							<!--input type="text" id="chasisNumberCheck" class="form-control" name="ChesisNumber" onblur="chasisAvailability()" placeholder=" Write Chesis Number "-->
							<input type="text" id="chasisNumberCheck" class="form-control" name="ChesisNumber"
								placeholder=" Write Chesis Number ">
							<span id="chasis-availability-status"></span>
						</div>


					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Engine Number:</label>
							<!--input type="text" id="EnginNumberCheck" class="form-control" name="EnginNumber" onblur="engineAvailability()" placeholder=" Write Engin Number "-->
							<input type="text" id="EnginNumberCheck" class="form-control" name="EnginNumber"
								placeholder=" Write Engin Number ">
							<span id="engine-availability-status"></span>
						</div>
						<div class="col-sm-4">
							<label class="">Select Driver </label>
							<select id="driver" class="form-control" name="driver" placeholder="Select Driver ">
								<?php
								$sql = "SELECT id, driver_name, phone from driver_master where status = 'Active' ORDER BY id desc";
								$result = $conn->query($sql);
								echo "<option value=''>Select Driver</option>";
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['id'] . "'>" . $row['driver_name'] . " - " . $row['phone'] . "</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Select Engineer </label>
							<select id="engineer" class="form-control" name="engineer" placeholder="Select Engineer ">
								<?php
								$sql = "SELECT * from admin where department = 'Workshop' AND position = 'Engineer' AND deleted = 'On' ORDER BY id desc";
								$result = $conn->query($sql);
								echo "<option value=''>Select Engineer</option>";
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['id'] . "'>" . $row['firstname'] . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Year Of Manufacture:</label>
							<?php $years = range(1971, strftime("%Y", time())); ?>
							<select class="form-control" id="YearOfManufacture" name="YearOfManufacture">
								<option>~~ Select Year ~~</option>
								<?php foreach ($years as $year): ?>
									<option value="<?php echo $year; ?>">
										<?php echo $year; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Purchase Date:</label>
							<input type="date" id="PurchaseDate" class="form-control" name="PurchaseDate"
								placeholder=" Write Purchase Date ">
						</div>
						<div class="col-sm-4">
							<label class="">Registration Date:</label>
							<input type="date" id="registrationDate" class="form-control" name="registrationDate"
								placeholder=" Write Purchase Date ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Makers Name:</label>
							<select id="MakersName" class="form-control" name="MakersName">
								<option value="" selected>~~ Select Makers ~~</option>
								<?php
								$sql = "SELECT id,name FROM `manufacturer_name`";
								$query = $conn->query($sql);
								while ($prow = $query->fetch_assoc()) {
									echo "
									  <option value='" . $prow['id'] . "'>" . $prow['name'] . "</option>
									";
								}
								?>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Makers Brand :</label>
							<input type="text" id="makerBrand" maxlength="100" class="form-control" name="makerBrand"
								placeholder=" Vehicle Brand">
						</div>
						<div class="col-sm-4">
							<label class=""> CC :</label>
							<input type="text" id="ccBrand" maxlength="7" class="form-control" name="ccBrand"
								placeholder=" Write CC ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Fuel Type:</label>
							<select id="fueltype" class="form-control" name="fueltype">
								<option value="CNG"> CNG </option>
								<option value="LPG"> LPG </option>
								<option value="Octane"> Octane </option>
								<option value="Disel"> Diesel </option>
								<option value="Petrol"> Petrol </option>
							</select>
						</div>
						<div class="col-sm-4">
							<label class=""> Wings Name:</label>
							<input type="text" id="wingsName" maxlength="100" class="form-control" name="wingsName"
								placeholder=" Write Wings name ">
						</div>
						<div class="col-sm-4">
							<label class=""> Assigned Emplooyee Name:</label>
							<input type="text" id="employeeName" maxlength="200" class="form-control"
								name="employeeName" placeholder=" Write Employee Name ">
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Registration start date:</label>
							<input type="date" id="reg_start_date" maxlength="100" class="form-control" name="reg_start_date"
								placeholder=" reg_start_date ">
						</div>
						<div class="col-sm-4">
							<label class="">Registration end date:</label>
							<input type="date" id="reg_end_date" maxlength="100" class="form-control" name="reg_end_date"
								placeholder=" reg_end_date Brand">
						</div>
						<div class="col-sm-4">
							<label class=""> Tax start date :</label>
							<input type="date" id="tax_start_date" maxlength="100"  class="form-control" name="tax_start_date"
								placeholder=" Write tax_start_date ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Tax end date:</label>
							<input type="date" id="tax_end_date" maxlength="100" class="form-control" name="tax_end_date"
								placeholder="write tax_end_date ">
						</div>
						<div class="col-sm-4">
							<label class="">insurance start date:</label>
							<input type="date" id="insu_start_date" maxlength="100" class="form-control" name="insu_start_date"
								placeholder="Write insu_start_date ">
						</div>
						<div class="col-sm-4">
							<label class=""> insurance end date :</label>
							<input type="date" id="insu_end_date" maxlength="100" class="form-control" name="insu_end_date"
								placeholder=" Write insurance end date ">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-4">
							<label class="">permits start date:</label>
							<input type="date" id="per_start_date" maxlength="100" class="form-control" name="per_start_date"
								placeholder=" write per_start_date ">
						</div>
						<div class="col-sm-4">
							<label class="">permits end date:</label>
							<input type="date" id="per_end_date" maxlength="100" class="form-control" name="per_end_date"
								placeholder="write per_end_date">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<label class=""> Location:</label>
							<input type="text" id="location" maxlength="200" class="form-control" name="location"
								placeholder=" Write Location ">
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary btn-flat" id="submit-button" name="addVehicle"><i
								class="fa fa-save"> </i> Add Vehicle</button>
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
				<form class="form-horizontal" id="contact_formEdit" method="POST" action="vehicle-add.php"
					enctype="multipart/form-data">
					<input type="hidden" id='editid' name="vid">
					<div class="form-group">
						<div class="col-sm-3">
							<label class="">Vehicle Number:</label>
							<input type="text" id="EditVehicleNumber" class="form-control" name="vehicleNumber"	onblur="vNumberAvailability()" placeholder=" Write Vehicle Number " required>
							<span id="vNumber-availability-status"></span>
						</div>
						<div class="col-sm-3">
							<label class="">Vehicle Type:</label>
							<select id="Editvtype" class="form-control" name="vtype">
								<option value="vf-tracker"> VF-Tracker </option>
								<option value="v-tracker"> V-Tracker </option>
								<option value="cng"> CNG </option>
								<option value="lpg"> LPG </option>
								<option value="generator"> Generator </option>
								<option value="boiler"> Boiler </option>
							</select>
						</div>
						<div class="col-sm-3">
							<label class="">Oil Tank Capacity:</label>
							<input type="text" id="oilTankCapacity" maxlength="7" class="form-control"
								name="oilTankCapacity" placeholder=" Write Oil Tank Capacity ">
						</div>
						<div class="col-sm-3">
							<label class="">Branch Name:</label>
							<select id="EditBranchStatus" class="form-control" name="BranchStatus">
								<option value="" selected>~~ Select Status ~~</option>
								<?php
								$sql = "SELECT id,branch_name FROM `branch_master` WHERE status='Active' ORDER BY `id`  DESC";
								$query = $conn->query($sql);
								while ($prow = $query->fetch_assoc()) {
									echo "
									  <option value='" . $prow['id'] . "'>" . $prow['branch_name'] . "</option>
									";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">

						<div class="col-sm-4">
							<label class="">wVFT ID:</label>
							<input type="text" id="wVFTID" class="form-control" name="wVFTID"
								placeholder=" WVft ID only ">
						</div>
						<div class="col-sm-4">
							<label class="">Chassis Number:</label>
							<input type="text" id="ChesisNumber" class="form-control" name="ChesisNumber"
								onblur="chasisAvailability()" placeholder=" Write Chesis Number ">
							<span id="chasis-availability-status"></span>
						</div>
						

					</div>
					<div class="form-group">
					<div class="col-sm-4">
							<label class="">Engine Number:</label>
							<input type="text" id="EnginNumber" class="form-control" name="EnginNumber"
								onblur="engineAvailability()" placeholder=" Write Engin Number ">
							<span id="engine-availability-status"></span>
						</div>
					<div class="col-sm-4">
							<label class="">Select Driver </label>
							<select id="editDriver" class="form-control" name="editDriver" placeholder="Select Driver ">
								<?php
								$sql = "SELECT id, driver_name, phone from driver_master where status = 'Active' ORDER BY id desc";
								$result = $conn->query($sql);
								echo "<option value=''>Select Driver</option>";
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['id'] . "'>" . $row['driver_name'] . " - " . $row['phone'] . "</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Select Engineer </label>
							<select id="editEngineer" class="form-control" name="editEngineer" placeholder="Select Engineer ">
								<?php
								$sql = "SELECT * from admin where department = 'Workshop' AND position = 'Engineer' AND deleted = 'On' ORDER BY id desc";
								$result = $conn->query($sql);
								echo "<option value=''>Select Engineer</option>";
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['id'] . "'>" . $row['firstname'] . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Year Of Manufacture:</label>
							<?php $years = range(1971, strftime("%Y", time())); ?>
							<select class="form-control" id="EditYearOfManufacture" name="YearOfManufacture">
								<option>~~ Select Year ~~</option>
								<?php foreach ($years as $year): ?>
									<option value="<?php echo $year; ?>">
										<?php echo $year; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Purchase Date:</label>
							<input type="date" id="Editpurchase_date" class="form-control" name="PurchaseDate"
								placeholder=" Write Purchase Date ">
						</div>
						<div class="col-sm-4">
							<label class="">Registration Date:</label>
							<input type="date" id="Editregistration_date" class="form-control" name="registrationDate"
								placeholder=" Write Purchase Date ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Makers Name:</label>
							<select id="EditMakersName" class="form-control" name="MakersName">
								<option value="" selected>~~ Select Makers ~~</option>
								<?php
								$sql = "SELECT id,name FROM `manufacturer_name`";
								$query = $conn->query($sql);
								while ($prow = $query->fetch_assoc()) {
									echo "
									  <option value='" . $prow['id'] . "'>" . $prow['name'] . "</option>
									";
								}
								?>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Makers Brand :</label>
							<input type="text" id="EditMaker_brand" maxlength="100" class="form-control"
								name="makerBrand" placeholder=" Vehicle Brand">
						</div>
						<div class="col-sm-4">
							<label class=""> CC :</label>
							<input type="text" id="EditCc_brand" maxlength="50" class="form-control" name="ccBrand"
								placeholder=" Write CC ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Fuel Type:</label>
							<select id="EditFuel_type" class="form-control" name="fuelType">
								<option value="CNG"> CNG </option>
								<option value="LPG"> LPG </option>
								<option value="Octane"> Octane </option>
								<option value="Disel"> Diesel </option>
								<option value="Petrol"> Petrol </option>
							</select>
						</div>
						<div class="col-sm-4">
							<label class=""> Wings Name:</label>
							<input type="text" id="EditWings_name" maxlength="100" class="form-control" name="wingsName"
								placeholder=" Write Wings name ">
						</div>
						<div class="col-sm-4">
							<label class=""> Assigned Emplooyee Name:</label>
							<input type="text" id="EditEmployee_name" maxlength="200" class="form-control"
								name="employeeName" placeholder=" Write Employee Name ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label class=""> Location:</label>
							<input type="text" id="EditLocation" maxlength="200" class="form-control" name="location"
								placeholder=" Write Location ">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label class=""> Remarks: <small>(If Driver Changes)</small></label>
							<textarea type="text" id="EditRemarks"  class="form-control" name="EditRemarks"
								placeholder=" Write Note "></textarea >
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary btn-flat" id="submit-button" name="editVehicle"><i
								class="fa fa-save"> </i> Update Vehicle</button>
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
				<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
						class="fa fa-close"></i> Close</button>
				<button type="submit" class="btn btn-danger btn-flat" name="deleteVehicle"><i class="fa fa-trash"></i>
					Delete</button>
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
							<input type="text" id="InActivevehicleNumber" class="form-control" name="branchName"
								placeholder=" Write Branch Name " readonly>
						</div>

					</div>
					<div class="form-group">
						<label for="categoryName" class="col-sm-3 control-label">Status Activation :</label>
						<div class="col-sm-9">
							<select class="form-control" id="statusvehicleNumber" name="status" required>
								<option value="" selected>~~ Select One ~~</option>
								<option value="Active">~~ Active ~~</option>
								<option value="In-Active">~~ In-Active ~~</option>
							</select>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
						class="fa fa-close"></i> Close</button>
				<button type="submit" class="btn btn-primary btn-flat" name="activatedVehicle"><i class="fa fa-save">
					</i> Edit Branch</button>
				</form>
			</div>
		</div>
	</div>
</div>
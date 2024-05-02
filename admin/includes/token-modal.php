<!-- Add Driver -->
<div class="modal fade" id="addnewToken">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Add Maintenance Letter</b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="token_add_form" enctype="multipart/form-data">

					<div class="form-group">
					    <div class="col-sm-6">
							<label class="">Service Title <span class="text-danger">*</span></label>
							<input type="text" id="tokenTitle" class="form-control" name="tokenTitle"
								placeholder=" Service Title ">
						</div>
						<div class="col-sm-6">
							<label class="">Last Repair Date</label>
							<input type="date" id="tokenDate" class="form-control" name="tokenDate"
								value="<?= date("Y-m-d") ?>" placeholder=" Last Repair Date ">
						</div>

						

					</div>
					<div class="form-group">
						<div class="col-sm-4">
							<label class="">Vehicle No <span class="text-danger">*</span></label>
							<select id="vehicle" class="form-control" name="vehicle" placeholder="Select Vehicle "
								onchange="getDriverAndEngr()">
								<?php
								$sql = "SELECT vehicle_master.id,vehicle_master.vehicle_number,manufacturer_name.name,vehicle_master.maker_brand,vehicle_master.cc_brand,vehicle_master.fuel_type,vehicle_master.wings_name,vehicle_master.employee_name,vehicle_master.location 
                                        FROM `vehicle_master`  
                                        INNER JOIN manufacturer_name ON manufacturer_name.id=vehicle_master.makers_name
                                         WHERE delete_status='Active' ORDER BY `vehicle_master`.`id` DESC ";
								$result = $conn->query($sql);
								echo "<option value=''>Select Vehicle</option>";
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['id'] . "'>" . $row['vehicle_number'] . " " . $row['name'] . " " . $row['maker_brand'] . " " . $row['cc_brand'] . " CC (" . $row['employee_name'] . ") </option>";
									}
								}
								?>
							</select>
						</div>

						<div class="col-sm-4">
							<label class="">Select Driver </label>
							<select id="driver" class="form-control" name="driver" placeholder="Select Driver " disabled>
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
							<select id="engineer" class="form-control" name="engineer" placeholder="Select Engineer " disabled>
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
							<label class="">Select Workshop </label>
							<select id="workshop" class="form-control" name="workshop" placeholder="Select Driver ">
								<?php
								$sql = "SELECT id,wareHouseName from tbl_warehouse where status = 'Active' AND deleted ='No' ORDER BY id desc";
								$result = $conn->query($sql);
								echo "<option value=''>Select Workshop</option>";
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['id'] . "'>" . $row['wareHouseName'] . "</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Select Mechanic </label>
							<select id="mechanic" class="form-control" name="mechanic" placeholder="Select Mechanic ">
								<?php
								$sql = "SELECT * from admin where department = 'Workshop' AND position = 'Mechanic' AND deleted = 'On' ORDER BY id desc";
								$result = $conn->query($sql);
								echo "<option value='0'>Select Mechanic</option>";
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['id'] . "'>" . $row['firstname'] . "</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="col-sm-4">
							<label class="">Current Mileage <span class="text-danger">*</span></label>
							<input type="text" id="currentMileage" class="form-control" name="currentMileage"
								placeholder=" Current Mileage ">
						</div>

					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<label class="">Maintenance Details <span class="text-danger">*</span></label>
							<textarea type="text" id="tokenDetails" class="form-control" name="tokenDetails"
								placeholder=" Service Details" rows="4"></textarea>
							<span id="phone-availability-status"></span>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary btn-flat" id="token_add" name="token_add"><i
								class="fa fa-save"> </i> Add Token</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>

<!-- Edit Allocate Mechanic -->
<div class="modal fade" id="statusViewerModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Quotation Status</b></h4>
			</div>
			<div class="modal-body">
				<table id="logtable" class="table">
				</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
							class="fa fa-close"></i> Close</button>

				</div>

			</div>
		</div>
	</div>
</div>
<!-- Edit Allocate Mechanic -->
<div class="modal fade" id="allocateMechanic">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Reallocate Mechanic</b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="allocateMechanic_form" method="POST" enctype="multipart/form-data">
					<input type="hidden" id="id_fr_mc_allct" name="id_fr_mc_allct" />

					<div class="form-group has-success has-feedback container-fluid">
						<label class="control-label" for="inputGroupSuccess1">Update token info</label>
						<div class="input-group">
							<span class="input-group-addon">Mechanic</span>
							<select class="custom-select form-control" id="mechanic_for_allocate"
								name="mechanic_for_allocate" aria-describedby="inputGroupSuccess1Status">
								<?php
								$sql = "SELECT * from admin where deleted = 'On' ORDER BY id desc";
								$result = $conn->query($sql);
								echo "<option value='0'>Select Mechanic</option>";
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['id'] . "'>" . $row['firstname'] . "</option>";
									}
								}
								?>
							</select>
						</div>
						<!-- <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span> -->
						<span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
					</div>


					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary btn-flat" name="editDricver"><i class="fa fa-save">
							</i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Edit Mechanic Comment -->
<div class="modal fade" id="mechanicComment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Diagnosis by Mechanic </b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="contact_formEdit" method="POST" enctype="multipart/form-data">
					<input type="hidden" id="id_fr_mc_info" name="id_fr_mc_info" />
					<div class="form-group">
						<div class="col-sm-12">
							<label class="">Mechanic Info <span class="text-danger">*</span></label>
							<input type="text" id="mechanicInfo" class="form-control" name="mechanicInfo"
								placeholder=" Name " readonly>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 mb-2">
							<label class="">Mechanic Remarks <span class="text-danger">*</span></label>
							<textarea class="form-control" rows="3" id="problems"></textarea>
						</div>
					</div>
					<div class="modal-footer mt-2">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary btn-flat" name="editDricver"><i
								class="fa fa-save"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="dgmApprovalModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="approvalType"><b></b></h4>
			</div>
			<div class="col-xs-6">
				<div id='approvalModalMsg' class='alert alert-success alert-dismissible successMessage'>
				</div>
				<div id='approvalModalErrorMsg' class='alert alert-danger alert-dismissible errorMessage'>
				</div>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="quatationApprovalForm" method="POST" enctype="multipart/form-data">
					<div class="fieldArea">
						<div class="form-group">
							<input type="hidden" id="token_id_for_approval">
							<input type="hidden" id="quote_id">
							<input type="hidden" id="userType">
							<div class="col-sm-12">
								<label class="">Approval Date <span class="text-danger">*</span></label>
								<input type="date" id="approvalDate" class="form-control" name="approvalDate"
									placeholder=" Approval Date " value="<?= date('Y-m-d') ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 mb-2">
								<label class="txt-label">Comment <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 mb-2">
								<label class="">Approval Status<span class="text-danger">*</span></label>
								<select class="form-control" id="approvalStatus" name="approvalStatus">
									<option value="Yes" selected>Approve</option>
									<option value="No">Reject</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12 mb-2 file" style="display:none">
								<label class="">Upload File <span class="text-danger">*</span></label>
								<input class="form-control" type="file" id="file" name="file">
							</div>
						</div>

					</div>

					<div class="modal-footer mt-2">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary btn-flat" name="approvalSaveBtn"
							id="approvalSaveBtn"><i class="fa fa-save">
							</i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="poApprovalModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Purchase Order </b></h4>
			</div>
			<div class="col-xs-6">
				<div id='poModalMsg' class='alert alert-success alert-dismissible successMessage'>
				</div>
				<div id='poModalErrorMsg' class='alert alert-danger alert-dismissible errorMessage'>
				</div>
			</div>
			<div class="modal-body">

				<div class="form-group">
					<input type="hidden" id="quote_id_fr_po">
					<input type="hidden" id="token_id_fr_po">
					<div class="col-sm-12">
						<label class="">PO Date <span class="text-danger">*</span></label>
						<input type="date" id="po_date" class="form-control" name="po_date"
							placeholder=" Purchase Order Date " value="<?= date('Y-m-d') ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 mb-2">
						<center><label class="po_label">
								<h2 class="m-5"> Want to Confirm Purchase Order? </h2>
							</label></center><br>
						<button id="view_bill_button" type="button" style="display:none" onclick="generateBill()">View
							Bill</button>
						<br>
					</div>

				</div>
				<div class="modal-footer mt-2">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
							class="fa fa-close"></i> Cancle</button>
					<button type="submit" class="btn btn-primary btn-flat confirmPo" name="" id="poSaveBtn"
						onclick="confirmPo()"><i class="fa fa-save"> </i> Yes</button>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="prGenerateModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Pre Requisition </b></h4>
			</div>
			<div class="col-xs-6">
				<div id='prModalMsg' class='alert alert-success alert-dismissible successMessage'>
				</div>
				<div id='prModalErrorMsg' class='alert alert-danger alert-dismissible errorMessage'>
				</div>
			</div>
			<div class="modal-body">

				<div class="form-group">
					<input type="hidden" id="quote_id_fr_pr">
					<input type="hidden" id="token_id_fr_pr">
					<div class="col-sm-12">
						<label class="">PR Date <span class="text-danger">*</span></label>
						<input type="date" id="pr_date" class="form-control" name="pr_date"
							placeholder=" Purchase Order Date " value="<?= date('Y-m-d') ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 mb-2">
						<center><label class="pr_label">
								<h2 class="m-5"> Want to Generate PR? </h2>
							</label></center><br>
						<button id="view_pr_button" type="button" style="display:none" onclick="generatePr()">View
							PR</button>
						<br>
					</div>

				</div>
				<div class="modal-footer mt-2">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
							class="fa fa-close"></i> Cancle</button>
					<button type="submit" class="btn btn-primary btn-flat confirmPr" name="" id="prSaveBtn"
						onclick="confirmPr()"><i class="fa fa-save"> </i> Yes</button>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="storeApprovalModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Product Information </b></h4>
			</div>
			<div class="col-xs-6">
				<div id='storeModalMsg' class='alert alert-success alert-dismissible successMessage'>
				</div>
				<div id='storeModalErrorMsg' class='alert alert-danger alert-dismissible errorMessage'>
				</div>
			</div>
			<div class="modal-body">

				<div class="form-group">
					<input type="hidden" id="quote_id_fr_str">
					<input type="hidden" id="token_id_fr_str">

					<div class="col-sm-12">
						<label class="">Store Approval Date <span class="text-danger">*</span></label>
						<input type="date" id="store_date" class="form-control" name="store_date"
							placeholder=" Purchase Order Date " value="<?= date('Y-m-d') ?>" readonly>
					</div>
				</div>

				<div class="col-sm-12 mb-2">
					<table class="table table-bordered">
						<thead>
							<th>Check</th>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Price</th>
						</thead>
						<tbody id="lowBidProducts">

						</tbody>
					</table>
				</div>

				<div class="form-group">
					<div class="col-sm-12 mb-2">
						<label class="">Comment <span class="text-danger">*</span></label>
						<textarea class="form-control" rows="3" id="storeComment" name="storeComment"></textarea>
					</div>
				</div>
				<div class="modal-footer mt-2">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
							class="fa fa-close"></i> Cancle</button>
					<button type="submit" class="btn btn-primary btn-flat" name="storeConfirmBtn" id="storeConfirmBtn"
						onclick="confirmStore()"><i class="fa fa-save">
						</i> Done</button>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="procurementApprovalModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Product Information </b></h4>
			</div>
			<div class="modal-body">
				<div class="col-xs-6">
					<div id='procurementModalMsg' class='alert alert-success alert-dismissible successMessage'>
					</div>
					<div id='procurementModalErrorMsg' class='alert alert-danger alert-dismissible errorMessage'>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" id="quote_id_fr_prc">
					<input type="hidden" id="token_id_fr_prc">
					<div class="col-sm-12">
						<label class="">Store Comment Review <span class="text-danger">*</span></label>
						<textarea class="form-control" id="storeCommentreview" name="storeCommentreview"
							readonly></textarea>
					</div>
					<div class="col-sm-12">
						<label class="">
							Procurement Confirmation Date <span class="text-danger">*</span></label>
						<input type="date" id="final_confirm_date" class="form-control" name="final_confirm_date"
							placeholder=" Confirmation Date " value="<?= date('Y-m-d') ?>" readonly>
					</div>
				</div>

				<div class="col-sm-12 mb-2">
					<table class="table table-bordered">
						<thead>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Price</th>
						</thead>
						<tbody id="finalProducts">

						</tbody>
					</table>
				</div>
				<div class="col-sm-12 mb-2">
					<label class="">Comment <span class="text-danger">*</span></label>
					<textarea class="form-control" rows="3" id="procurement_comment"
						name="procurement_comment"></textarea>
				</div>

				<div class="modal-footer mt-2">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
							class="fa fa-close"></i> Cancle</button>
					<button type="submit" class="btn btn-primary btn-flat" name="procurementConfirmBtn"
						id="procurementConfirmBtn" onclick="finalConfirmation()"><i class="fa fa-save">
						</i> Confirm</button>
				</div>

			</div>
		</div>
	</div>
</div>


<!-- Edit Mechanic Comment -->
<div class="modal fade" id="addEgineerRequisition">
	<div class="modal-dialog modal-lg" style="width:60%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Generate Requsition </b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="contact_formEdit" method="POST" enctype="multipart/form-data">
					<input type="hidden" id="id_fr_req" name="id_fr_req" />
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<div class="col-sm-12">
									<label class="">Service Information </label>
								</div>
								<div class="col-sm-12 mb-2">
									<label class="">Service Title </label>
									<textarea type="text" id="tokenTitleForRequisition" class="form-control"
										name="tokenTitleForRequisition" placeholder=" Name " readonly></textarea>
								</div>
								<div class="col-sm-12">
									<label class="">Service Issue Date</label>
									<input type="text" id="tokenDateForRequisition" class="form-control"
										name="tokenDateForRequisition" placeholder=" Date " readonly>
								</div>
							</div>
						</div>
						<div class="col-md-6" style="border-left: 1px solid #6ffcf5">
							<div class="form-group">
								<div class="col-sm-12">
									<label class="">Mechanic Informatiom </label>
								</div>
								<div class="col-sm-12 mb-2">
									<label class="">Mechanic Name </label>
									<input type="text" id="mechanicNameForRequisition" class="form-control"
										name="mechanicNameForRequisition" placeholder=" Name " readonly>
								</div>
								<div class="col-sm-12">
									<label class="">Mechanic Comment </label>
									<textarea type="text" id="mechanicCommentForRequisition" class="form-control"
										name="mechanicCommentForRequisition" placeholder=" Comment "
										readonly></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12" style="border-left: 1px solid #6ffcf5">
							<div class="form-group">
								<div class="col-sm-6 mb-2">
									<label class="">Engineer Requisition Date </label>
									<input type="date" id="engineerRequisitionDate" class="form-control"
										value="<?= date('Y-m-d') ?>" name="engineerRequisitionDate"
										placeholder=" RequisitionDate ">
								</div>
								<div class="col-sm-6 mb-2">
									<label class="">Engineer Name </label>
									<input type="text" id="engineerNameForRequisition" class="form-control"
										name="engineerNameForRequisition" placeholder=" Name " readonly>
								</div>

								<div class="col-sm-6 mb-2">
									<div class="head" style="display: flex">
										<h5><b>Workshop : </b></h5>
										<h5 id="workshopName"></h5>
									</div>

									<p id="workshopPosition"></p>
								</div>


								<div class="col-sm-6 mb-2">
									<label class="">Estimated Price </label>
									<input id="estimatedPrice" class="form-control" type="number" name="estimatedPrice"
										placeholder=" Estimated Price ">
									<span id="estimatedPriceError" class="text-danger"></span>
								</div>

								<div class="col-sm-12">
									<label class="">Engineer Comment </label>
									<textarea id="engineerCommentForRequisition" class="form-control"
										name="engineerCommentForRequisition" placeholder=" Comment "></textarea>
									<span id="engineerCommentForError" class="text-danger"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-4  col-md-offset-8" style="display:flex">
							<select class="form-control btn btn-default col-md-6 mr-2" id="groupSelection" onchange="changeDiv()">
							<?php
								$sql = "SELECT * from tbl_requisition_group";
								$result = $conn->query($sql);

								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['group_name'] . "'><b class='badge'>" . $row['group_name'] . "</b></option>";
									}
								}
								?>
							</select>	
							<button type="button"
									class="btn btn-primary col-md-6" onclick="addRow()">+</button></div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12 mb-2">
							<table id="requisitionTable" class="table table-bordered">
								<thead>
									<th>Product Name</th>
									<th>Specification</th>
									<th>Quantity</th>
									<th>Unit</th>
									<th>Remarks</th>
									<th>Action</th>
								</thead>
								<tbody id="requisitionSpareTableBody">
									<tr id="row1Id_0">
										<td><input class="form-control" placeholder="Product Name" id="products_0"
												type="text"></td>
										<td><input class="form-control" placeholder="Specification" id="spec_0"
												type="text"></td>
										<td><input class="form-control" placeholder="Quantity" id="qty_0" type="number">
										</td>
										<td>
											<select class="custom-select form-control" id="unit_0" name="unit_0"
												aria-describedby="inputGroupSuccess1Status">
												<?php
												$sql = "SELECT unitName, id from tbl_units where deleted = 'no' ORDER BY id desc";
												$result = $conn->query($sql);
												echo "<option value='0'>Select Unit</option>";
												if ($result) {
													while ($row = $result->fetch_assoc()) {
														echo "<option value='" . $row['unitName'] . "'>" . $row['unitName'] . "</option>";
													}
												}
												?>
											</select>
										</td>
										<td><input class="form-control" placeholder="Remarks" id="remarks_0"
												type="text"></td>
										<td><i class="fa fa-trash" style="font-size: 22px; padding: 1px; "
												aria-hidden="true" onclick="deleteReq(0)"></i></td>
									</tr>
								</tbody>
								<tbody id="requisitionRSpareTableBody" style="display:none">
									<tr id="row2Id_0">
										<td><input class="form-control" placeholder="Product Name" id="products_0"
												type="text"></td>
										<td><input class="form-control" placeholder="Specification" id="spec_0"
												type="text"></td>
										<td><input class="form-control" placeholder="Quantity" id="qty_0" type="number">
										</td>
										<td>
											<select class="custom-select form-control" id="unit_0" name="unit_0"
												aria-describedby="inputGroupSuccess1Status">
												<?php
												$sql = "SELECT unitName, id from tbl_units where deleted = 'no' ORDER BY id desc";
												$result = $conn->query($sql);
												echo "<option value='0'>Select Unit</option>";
												if ($result) {
													while ($row = $result->fetch_assoc()) {
														echo "<option value='" . $row['unitName'] . "'>" . $row['unitName'] . "</option>";
													}
												}
												?>
											</select>
										</td>
										<td><input class="form-control" placeholder="Remarks" id="remarks_0"
												type="text"></td>
										<td><i class="fa fa-trash" style="font-size: 22px; padding: 1px; "
												aria-hidden="true" onclick="deleteReq(0)"></i></td>
									</tr>
								</tbody>
								<tbody id="requisitionWorkshopTableBody" style="display:none">
									<tr id="row3Id_0">
										<td><input class="form-control" placeholder="Product Name" id="products_0"
												type="text"></td>
										<td><input class="form-control" placeholder="Specification" id="spec_0"
												type="text"></td>
										<td><input class="form-control" placeholder="Quantity" id="qty_0" type="number">
										</td>
										<td>
											<select class="custom-select form-control" id="unit_0" name="unit_0"
												aria-describedby="inputGroupSuccess1Status">
												<?php
												$sql = "SELECT unitName, id from tbl_units where deleted = 'no' ORDER BY id desc";
												$result = $conn->query($sql);
												echo "<option value='0'>Select Unit</option>";
												if ($result) {
													while ($row = $result->fetch_assoc()) {
														echo "<option value='" . $row['unitName'] . "'>" . $row['unitName'] . "</option>";
													}
												}
												?>
											</select>
										</td>
										<td><input class="form-control" placeholder="Remarks" id="remarks_0"
												type="text"></td>
										<td><i class="fa fa-trash" style="font-size: 22px; padding: 1px; "
												aria-hidden="true" onclick="deleteReq(0)"></i></td>
									</tr>
								</tbody>
								
							</table>
						</div>
					</div>
					<div class="modal-footer mt-2">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="button" class="btn btn-primary btn-flat" name="editDricver"
							onclick="saveRequisition()"><i class="fa fa-save"></i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="engnrConfirmationModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="approvalType"><b>Final Confimation</b></h4>
			</div>
			<div class="col-xs-6">
				<div id='confirmModalMsg' class='alert alert-success alert-dismissible successMessage'>
				</div>
				<div id='confirmModalErrorMsg' class='alert alert-danger alert-dismissible errorMessage'>
				</div>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="reqApprovalForm" method="POST" enctype="multipart/form-data">
					<div class="fieldArea">
						<div class="form-group">
							<input type="hidden" id="token_id_for_cnfrm">

							<div class="col-sm-12">
								<table>
									<tr class="tr">
										<td class="">Vehicle Number:</td>

										<td class="vh_num">
										</td>
									</tr>
									<tr>
										<td class="">Driver Name:</td>

										<td class="dr_name">
										</td>
									</tr>
									<tr>
										<td class="">Engineer Name:</td>

										<td class="engr_name">
										</td>
									</tr>
								</table>
								<hr>
							</div>
							<div class="col-sm-12">
								<label class="">Approval Date <span class="text-danger">*</span></label>
								<input type="date" id="fapprovalDate" class="form-control" name="fapprovalDate"
									placeholder=" Approval Date " value="<?= date('Y-m-d') ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 mb-2">
								<label class="txt-label">Comment <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="3" id="fcomment" name="fcomment"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12 mb-2">
								<label class="">Delivered Status<span class="text-danger">*</span></label>
								<select class="form-control" id="fapprovalStatus" name="fapprovalStatus">
									<option value="1" selected>Delivered</option>
								
								</select>
							</div>
						</div>


					</div>

					<div class="modal-footer mt-2">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary btn-flat" name="confirmationSaveBtn"
							id="confirmationSaveBtn"><i class="fa fa-save">
							</i> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<style>
	.input-sm {
		border: 0;
	}

	#vehicle-info-box {
		background: #ccc;
		overflow: hidden;
		transition: height 200ms;
	}
</style>

<!-- Add New Customer/Supplier-->
<div class="modal fade" id="addExpModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Add New <span id="typeHeading"></span> </b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form_traficExpanse" method="POST">
					<input type="hidden" value="" id="add_tblType" name="TblType">
					<input type="hidden" value="" id="add_pageName" name="pageName">
					<div class="form-group">
						<div class="col-sm-12">
							<label for="CustomerName"> Vehicle </label>
							<select class="form-control" id="vehicle" name="vehicle" onchange="getVehicleInfo()">
								<option value="" selected>Select Vehicle </option>
								<?php
								$sql = "SELECT id,vehicle_number FROM `vehicle_master` WHERE delete_status='Active' ORDER BY `id`  DESC";
								$query = $conn->query($sql);
								while ($prow = $query->fetch_assoc()) {
									echo "
									  <option value='" . $prow['id'] . "'>" . $prow['vehicle_number'] . "</option>
									";
								}
								?>
							</select>
						</div>
						<div class="col-sm-12   open" id="vehicle-info-box">
							<div class="row list">
								<div class="col-md-6">
									<table class="table">
										<tr>
											<td>Vehicle:</td>
											<td class="v_num">
												<input type="text" class="form-control input-sm" id="v_num" disabled>
											</td>
										</tr>
										<tr>
											<td>Driver:</td>
											<td class="d_name"><input type="text" class="form-control input-sm"
													id="d_name" disabled><input type="hidden" id="d_name_id">
											</td>
										</tr>
									</table>

								</div>
								<div class="col-md-6">
									<table class="table">
										<tr>
											<td>Branch:</td>
											<td class="b_name"><input type="text" class="form-control input-sm"
													id="b_name" disabled><input type="hidden" id="b_name_id">
											</td>
										</tr>
										<tr>
											<td>Employee:</td>
											<td class="e_name"><input type="text" class="form-control input-sm"
													id="e_name" disabled>
											</td>
										</tr>
									</table>
								</div>
							</div>

						</div>

					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label for="ContactPerson"> Case ID </label>
							<input class="form-control" id="case_id" name="case_id" placeholder="Case ID">
						</div>
						<div class="col-sm-6">
							<label for="receptable_amount"> Receptable Amount </label>
							<input type="text" class="form-control" id="receptable_amount" name="receptable_amount"
								placeholder="Receptable Amount ">
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-6">
							<label for="non_receptable_amount"> Non Receptable Amount </label>
							<input type="text" class="form-control" id="non_receptable_amount"
								name="non_receptable_amount" Value="" placeholder=" Non Receptable Amount ">
						</div>
						<div class="col-sm-6">
							<label for="settle_date">Settle Date </label>
							<input type="date" class="form-control" id="settle_date" name="settle_date"
								placeholder=" Settle Date">
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-12">
							<label for="CreditLimit"> Reason </label>
							<textarea class="form-control" id="reason" rows="1" cols="50" name="reason"
								placeholder="Describe reason..."></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<label for="remarks"> Remarks </label>
							<textarea class="form-control" id="remarks" rows="1" cols="50" name="remarks"
								placeholder="Remarks..."></textarea>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary btn-flat" name="addCustomer"
							id="btn_saveCustomer"><i class="fa fa-save"></i> Save </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Edit added Customer/Supplier-->
<div class="modal fade" id="editExpModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Edit Police Expanse </b></h4>
			</div>
			<div class="modal-body">
				<div id="editLoader" style="display:none; text-align:center;" class="col-md-12"><i
						class='fa fa-spinner fa-spin' style='font-size:50px;color:green'></i></div>
				<form class="form-horizontal" id="edit_form_traficExpanse" method="POST">
					<input type="hidden" value="" id="edit_id" name="edit_id">
					<div class="form-group">

						<div class="col-sm-12">
							<label for="CustomerName"> Vehicle </label>
							<select class="form-control" id="edit_vehicle" name="edit_vehicle"
								onchange="edit_getVehicleInfo()">
								<option value="" selected>Select Vehicle </option>
								<?php
								$sql = "SELECT id,vehicle_number FROM `vehicle_master` WHERE delete_status='Active' ORDER BY `id`  DESC";
								$query = $conn->query($sql);
								while ($prow = $query->fetch_assoc()) {
									echo "
									  <option value='" . $prow['id'] . "'>" . $prow['vehicle_number'] . "</option>
									";
								}
								?>
							</select>
						</div>
						<div class="col-sm-12   open" id="edit-vehicle-info-box">
							<div class="row list">
								<div class="col-md-6">
									<table class="table">
										<tr>
											<td>Vehicle:</td>
											<td class="edit_v_num">
												<input type="text" class="form-control input-sm" id="edit_v_num"
													disabled>
											</td>
										</tr>
										<tr>
											<td>Driver:</td>
											<td class="edit_d_name_id"><input type="text" class="form-control input-sm"
													id="edit_d_name" disabled><input type="hidden" id="edit_d_name_id">
											</td>
										</tr>
									</table>
								</div>
								<div class="col-md-6">
									<table class="table">
										<tr>
											<td>Branch:</td>
											<td class="edit_b_name_id"><input type="text" class="form-control input-sm"
													id="edit_b_name" disabled><input type="hidden" id="edit_b_name_id">
											</td>
										</tr>
										<tr>
											<td>Employee:</td>
											<td class="edit_e_name"><input type="text" class="form-control input-sm"
													id="edit_e_name" disabled>
											</td>
										</tr>
									</table>
								</div>
							</div>

						</div>

					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label for="ContactPerson"> Case ID </label>
							<input class="form-control" id="edit_case_id" name="edit_case_id" placeholder="Case ID">
						</div>
						<div class="col-sm-6">
							<label for="edit_receptable_amount"> Receptable Amount </label>
							<input type="text" class="form-control" id="edit_receptable_amount"
								name="edit_receptable_amount" placeholder="Receptable Amount ">
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-6">
							<label for="edit_non_receptable_amount"> Non Receptable Amount </label>
							<input type="text" class="form-control" id="edit_non_receptable_amount"
								name="edit_non_receptable_amount" Value="" placeholder=" Non Receptable Amount ">
						</div>
						<div class="col-sm-6">
							<label for="edit_settle_date">Settle Date </label>
							<input type="date" class="form-control" id="edit_settle_date" name="edit_settle_date"
								placeholder=" Settle Date">
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-12">
							<label for="edit_reason"> Reason </label>
							<textarea class="form-control" id="edit_reason" rows="1" cols="50" name="edit_reason"
								placeholder="Describe reason..."></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<label for="edit_remarks"> Remarks </label>
							<textarea class="form-control" id="edit_remarks" rows="1" cols="50" name="edit_remarks"
								placeholder="Remarks..."></textarea>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary btn-flat" name="addCustomer"
							id="btn_saveCustomer"><i class="fa fa-save"></i> Update </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- /.content-wrapper -->
<div class="modal fade" id="editOpeningDueModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update Opening Due</h4>
			</div>
			<div class="modal-body">
				<h6 style="color: red;">** For Supplier & Both 1. Due->Payable 2. Advance->Payment<br>** For Customer 1.
					Due->Payment 2. Advance (-)->Payable</h6>

				<form id="editOpeningDueForm" method="POST" enctype="multipart/form-data" action="#">
					<div class="row">

						<div class="form-group col-md-12">
							<input type="hidden" name="editOpeningDueId" id="editOpeningDueId">
							<label> Party Name <span class="text-danger"> * </span></label>
							<input class="form-control input-sm" id="editOpeningDuePartyName" type="text"
								name="editOpeningDuePartyName" disabled>
							<span class="text-danger" id="editOpeningDuePartyNameError"></span>
						</div>
						<div class="form-group col-md-6">
							<label> Opening Due </label>
							<input class="form-control input-sm" id="editOpeningDueInsert" type="number"
								name="editOpeningDueInsert">
							<span class="text-danger" id="editOpeningDueInsertError"></span>
						</div>
						<div class="form-group col-md-6">
							<label> Due Type </label>
							<select id="editOpeningDueType" name="editOpeningDueType" class="form-control input-sm">
								<option value="due">Due</option>
								<option value="advance">Advance</option>
							</select>
							<span class="text-danger" id="editOpeningDueTypeError"></span>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
								class="fa fa-close"></i> Close</button>
						<button type="submit" class="btn btn-primary " id="saveOpeningDue"><i class="fa fa-save"></i>
							Update Opening Due</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- modal -->
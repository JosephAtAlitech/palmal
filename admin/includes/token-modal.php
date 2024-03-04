<!-- Add Driver -->
<div class="modal fade" id="addnewToken">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Add Token</b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="token_add_form" enctype="multipart/form-data">

					<div class="form-group">
						<div class="col-sm-6">
							<label class="">Token Date</label>
							<input type="date" id="tokenDate" class="form-control" name="tokenDate"
								value="<?= date("Y-m-d") ?>" placeholder=" Token Date ">
						</div>
						<div class="col-sm-6">
							<label class="">Token Title <span class="text-danger">*</span></label>
							<input type="text" id="tokenTitle" class="form-control" name="tokenTitle"
								placeholder=" Token Title ">
						</div>

					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label class="">Select Mechanic </label>
							<select id="mechanic" class="form-control" name="mechanic" placeholder="Select Mechanic ">
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
						<div class="col-sm-6">
							<label class="">Select Engineer </label>
							<select id="engineer" class="form-control" name="engineer" placeholder="Select Engineer ">
								<?php
								$sql = "SELECT * from admin where deleted = 'On' ORDER BY id desc";
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
						<div class="col-sm-6">
							<label class="">Token Details <span class="text-danger">*</span></label>
							<textarea type="text" id="tokenDetails" class="form-control" name="tokenDetails"
								placeholder=" Token Details" rows="4"></textarea>
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
<div class="modal fade" id="allocateMechanic">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Allocate Mechanic</b></h4>
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
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Mechanic Comment </b></h4>
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
							<label class="">Comment <span class="text-danger">*</span></label>
							<textarea class="form-control" rows="3" id="problems"></textarea>
						</div>
					</div>
					<div class="modal-footer mt-2">
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
<div class="modal fade" id="addEgineerRequisition">
	<div class="modal-dialog modal-lg" style="width:60%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Mechanic Comment </b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="contact_formEdit" method="POST" enctype="multipart/form-data">
					<input type="hidden" id="id_fr_req" name="id_fr_req" />
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-sm-12">
									<label class="">Token Info </label>
								</div>
								<div class="col-sm-12 mb-2">
									<label class="">Token </label>
									<input type="text" id="tokenTitleForRequisition" class="form-control"
										name="tokenTitleForRequisition" placeholder=" Name " readonly>
								</div>
								<div class="col-sm-12">
									<label class="">Token Date</label>
									<input type="text" id="tokenDateForRequisition" class="form-control"
										name="tokenDateForRequisition" placeholder=" Date " readonly>
								</div>
							</div>
						</div>
						<div class="col-md-6" style="border-left: 1px solid #6ffcf5">
							<div class="form-group">
								<div class="col-sm-12">
									<label class="">Mechanic Info </label>
								</div>
								<div class="col-sm-12 mb-2">
									<label class="">Mechanic Name </label>
									<input type="text" id="mechanicNameForRequisition" class="form-control"
										name="mechanicNameForRequisition" placeholder=" Name " readonly>
								</div>
								<div class="col-sm-12">
									<label class="">Mechanic Comment </label>
									<input type="text" id="mechanicCommentForRequisition" class="form-control"
										name="mechanicCommentForRequisition" placeholder=" Comment " readonly>
								</div>
							</div>
						</div>
						<div class="col-md-12" style="border-left: 1px solid #6ffcf5">
							<div class="form-group">
							<div class="col-sm-6 mb-2">
									<label class="">Engineer Requisition Date </label>
									<input type="date" id="engineerRequisitionDate" class="form-control"
										name="engineerRequisitionDate" placeholder=" RequisitionDate " >
								</div>
								<div class="col-sm-6 mb-2">
									<label class="">Engineer Name </label>
									<input type="text" id="engineerNameForRequisition" class="form-control"
										name="engineerNameForRequisition" placeholder=" Name " readonly>
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
							<div class="col-md-1  col-md-offset-11"><button type="button"
									class="btn btn-primary col-md-12" onclick="addRow()">+</button></div>
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
								<tbody id="requisitionTableBody">
									<tr id="rowId_0">
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
							onclick="saveRequisition()"><i class="fa fa-save">
							</i> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>

</script>



<!-- Vehicle Delete -->
<div class="modal fade" id="deleteDriver">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Deleting...</b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="driver-edit.php">
					<input type="hidden" id="deletid" name="id">
					<div class="text-center">
						<p>DELETE DRIVER NAME</p>
						<h2 id="deldriver_name" class="bold"></h2>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
						class="fa fa-close"></i> Close</button>
				<button type="submit" class="btn btn-danger btn-flat" name="deleteDriver12"><i class="fa fa-trash"></i>
					Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>
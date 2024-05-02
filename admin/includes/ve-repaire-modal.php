<!-- Add Vehicle -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Vehicle Repaires</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="vehicleRepaire_add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Repaire Date :</label>
                  	<div class="col-sm-9">
						<input type="date" id="repaireDate" class="form-control" name="repaireDate" required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label"> Vehicle Number :</label>
                  	<div class="col-sm-9">
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
				<label for="categoryName" class="col-sm-3 control-label">LF Number :</label>
					<div class="col-sm-9">
                    	<input type="text" id="lfNumber" class="form-control" name="lfNumber" placeholder=" Write Expenses Name " required>
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Particulars :</label>
					<div class="col-sm-9">
                    	<input type="text" id="particulars" class="form-control" name="particulars" placeholder=" Expenses Amount " required>
					</div>
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label"> Repaire Type :</label>
                  	<div class="col-sm-9">
						<select class="form-control" id="" name="RepaireType">
							<option value="" selected>~~ Select Repaire Type ~~</option>
							<option value="Maintenance">Maintenance</option>
							<option value="Repair">Repair</option>
							<option value="Lubricant">Lubricant</option>
							<option value="Spare Part">Spare Part</option>
							<option value="Engine Work">Engine Work</option>
							<option value="Suspension Work">Suspension Work</option>
							
						</select>
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Amounts:</label>
					<div class="col-sm-9">
                    	<input type="text" id="expensesName" class="form-control" name="Repamount" required>
					</div>
				</div>
			
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="addVeRepaire"><i class="fa fa-save"> </i> Add Vehicle Repaire </button>
            	</form>
          	</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Vehicle -->
<div class="modal fade" id="editVehicleRep">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Vehicle Repaires</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="vehicleRepaire_add.php" enctype="multipart/form-data">
          		<input type="hidden" id="editid" name="id">
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Repaire Date :</label>
                  	<div class="col-sm-9">
						<input type="date" id="editrepaire_date" class="form-control" name="repaireDate" required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label"> Vehicle Number :</label>
                  	<div class="col-sm-9">
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
				<label for="categoryName" class="col-sm-3 control-label">LF Number :</label>
					<div class="col-sm-9">
                    	<input type="text" id="editlf_number" class="form-control" name="lfNumber" placeholder=" Write Expenses Name " required>
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Particulars :</label>
					<div class="col-sm-9">
                    	<input type="text" id="editparticulars" class="form-control" name="particulars" placeholder=" Expenses Amount " required>
					</div>
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label"> Repaire Type :</label>
                  	<div class="col-sm-9">
						<select class="form-control" id="editrepaire_type" name="RepaireType">
							<option value="" selected>~~ Select Vehicle Number ~~</option>
							<option value="Maintenance">Maintenance</option>
							<option value="Repair">Repair</option>
							<option value="greasing">greasing</option>
							
						</select>
					</div>
					
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Amounts:</label>
					<div class="col-sm-9">
                    	<input type="text" id="editamount" class="form-control" name="Repamount" required>
					</div>
				</div>
			
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="editVeRepaire"><i class="fa fa-save"> </i> Edit Vehicle Repaire </button>
            	</form>
          	</div>
			</div>
        </div>
    </div>
</div>
<!-- Vehicle Repaire Delete -->
<div class="modal fade" id="deleteVehicleRep">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="vehicleRepaire_add.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>Delete Vehicle Repaire</p>
	                	<h2 id="deletrepaire_type" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteVehicleRepaire"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Active Branch -->
<div class="modal fade" id="activeBranch">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Branch</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="branch_update.php" enctype="multipart/form-data">
          		
				<input type="hidden" id="activeid" name="id">
               
				
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Branch Name :</label>
                  	<div class="col-sm-9">
                    	<input type="text" id="activebranch_name" class="form-control" name="branchName" placeholder=" Write Branch Name " required>
					</div>
					
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Branch Code :</label>
					<div class="col-sm-5">
                    	<input type="text" id="activebranch_code" class="form-control" name="branchCode" placeholder=" Write Branch Code " required>
					</div>
					<div class="col-sm-4">
                    	<select class="form-control" id="activestatus" name="status"  required>
							<option value="" selected>~~ Select One ~~</option>
							<option value="Active">~~ Active ~~</option>
							<option value="In-Active">~~ In-Active ~~</option>
						</select>
					</div>
				</div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="activatedBranch"><i class="fa fa-save"> </i> Edit Branch</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
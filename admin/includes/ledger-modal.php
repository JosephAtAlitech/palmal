<!-- Add Ledger -->
<div class="modal fade" id="addnewVehicle">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Ledger</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="ledger-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-12">
						<label class="">Particulars:</label>
                    	<textarea type="text" id="branchName" class="form-control" name="Particulars" placeholder=" Write Particulars " required></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Repair Amount:</label>
                    	<input type="text" id="branchName" class="form-control" name="RepairAmount" placeholder=" Write Repair Amount " required>
					</div>
					<div class="col-sm-6">
						<label class="">Paid Amount:</label>
                    	<input type="text" id="branchName" class="form-control" name="PaidAmount" placeholder=" Write Paid Amount " required>
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
						<label class="">Paid Date:</label>
                    	<input type="date" id="branchName" class="form-control" name="paidDate" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addLedger"><i class="fa fa-save"> </i> Add Ledger</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Ledger -->
<div class="modal fade" id="EditLedger">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Ledger</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="ledger-add.php" enctype="multipart/form-data">
          		<input type="hidden" id="editid" name="id" >				
				<div class="form-group">
					<div class="col-sm-12">
						<label class="">Particulars:</label>
                    	<textarea type="text" id="editparticulars" class="form-control" name="Particulars" placeholder=" Write Particulars " required></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Repair Amount:</label>
                    	<input type="text" id="editrepair_amount" class="form-control" name="RepairAmount" placeholder=" Write Repair Amount " required>
					</div>
					<div class="col-sm-6">
						<label class="">Paid Amount:</label>
                    	<input type="text" id="editpaid_amount" class="form-control" name="PaidAmount" placeholder=" Write Paid Amount " required>
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
						<label class="">Paid Date:</label>
                    	<input type="date" id="editacc_paid_date" class="form-control" name="paidDate" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="editLedger"><i class="fa fa-save"> </i> Add Ledger</button>
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
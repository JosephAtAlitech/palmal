<!-- Add Diesel Reports -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Fuel Sheets</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" name="myform" id="contact_form" method="POST" action="dieselReport_add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-6">
						<select class="form-control" id="vehicleNumber" name="vehicleNumber">
							<option value="" selected>~~Vehicle Number~~</option>
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
					<div class="col-sm-6">
						<div class="input-group">
                            <input type="text" class="form-control datepick" name="dieselDate" id="dieselDate" placeholder=" Select Date Time">
                            <div class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                          </div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<select class="form-control" id="fuelType" name="fuelType">
							<option value="" selected>~~ Fuel Type ~~</option>
							<option value="43">CNG</option>
							<option value="130">Octane</option>
							<option value="109">Diesel</option>
							<option value="130">Petrol</option>
							
						</select>
						<input type="hidden" id="fuelTypeText" class="form-control" name="fuelTypeText" >
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="SlipNumber" class="form-control" name="SlipNumber" placeholder=" Enter Slip Number" required>
					</div>
				</div>
				<div class="form-group">
					
					<div class="col-sm-6">
                    	<select class="form-control" id="PumpName" name="PumpName" required>
							<option value="" selected>~~ Select Pump Name ~~</option>
							<?php
								  $sql = "SELECT id,pump_name FROM `oil_pump_name` WHERE status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['pump_name']."</option>
									";
								  }
								?>
						</select>
                    	
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="retailer_cog" class="form-control" name="EnterAmount" onkeyup="calc()" autocomplete="off" placeholder=" Enter Amount " required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                    	<input type="text" id="price_exc_vat" class="form-control" name="DieselInLitre" placeholder=" Quantity "  readonly>
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="fuelRate" class="form-control" name="fuelRate" onkeyup="calc()" placeholder=" Rate " readonly>
					</div>
					
				</div>
			<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="addDieselReports"><i class="fa fa-save"> </i> Add Fuel Sheet</button>
            	</form>
          	</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Diesel Reports -->
<div class="modal fade" id="editDieselRep">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Fuel Sheets</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" name="myformEdit" id="contact_form" method="POST" action="dieselReport_add.php" enctype="multipart/form-data">
          		<input type="hidden" id="editid" name="id" />
				<div class="form-group">
					<div class="col-sm-6">
						<select class="form-control" id="Editvehicle_no" name="vehicleNumber">
							<option value="" selected>~~Vehicle Number~~</option>
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
					<div class="col-sm-6">
						<div class="input-group">
                            <input type="text" class="form-control datepick" name="dieselDate" id="Editdiesel_date" placeholder=" Select Date Time">
                            <div class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </div>
					    </div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<input type="text" id="fuelTypeText" class="form-control EditfuelTypeText" name="fuelTypeText" readonly>
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="Editslip_number" class="form-control" name="SlipNumber" placeholder=" Enter Slip Number" required>
					</div>
				</div>
				<div class="form-group">
					
					<div class="col-sm-6">
                    	<input type="text" id="Editpump_name" class="form-control" name="PumpName" placeholder=" Pump Name " required>
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="Edittotal_amount" class="form-control" name="EnterAmount" onkeyup="calcEdit()" autocomplete="off" placeholder=" Enter Amount " required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                    	<input type="text" id="Editdiesel_litre" class="form-control" name="DieselInLitre" placeholder=" Diesel In Litre "  readonly>
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="EditfuelRate" class="form-control" name="fuelRate" onkeyup="calcEdit()" placeholder=" Rate Per litre " readonly>
					</div>
					
				</div>
			<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="updateDieselReports"><i class="fa fa-save"> </i> Update Fuel Sheet</button>
            	</form>
          	</div>
			</div>
        </div>
    </div>
</div>
<!-- Diesel Report Delete -->
<div class="modal fade" id="deleteDieselRep">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="dieselReport_add.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE DIESEL REPORT SLIP NO</p>
	                	<h2 id="deletslip_number" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteDieselRep"><i class="fa fa-trash"></i> Delete</button>
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
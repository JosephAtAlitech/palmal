<!-- Add Trip Expenses -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Trip Expenses</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="tripaddExpenses_add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Trip Number :</label>
                  	<div class="col-sm-9">
						<select class="form-control" id="tripNumber" name="tripNumber" onblur="loadPurchase()" required >
							<option value="" selected>~~ Select Trip ~~</option>
							<?php
								  $sql = "SELECT id,vehicle_no FROM `trip_sheets` WHERE status!='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>Trip Number : ".$prow['id']."</option>
									";
								  }
								?>
						</select>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Vehicle Number :</label>
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
				<label for="categoryName" class="col-sm-3 control-label">Police Expenses :</label>
					<div class="col-sm-9">
                    	<input type="text" id="PoliceExpenses" class="form-control" name="PoliceExpenses" placeholder=" Write Expenses Amount ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Toll Expenses :</label>
					<div class="col-sm-9">
                    	<input type="text" id="TollExpenses" class="form-control" name="TollExpenses" placeholder=" Write Expenses Amount ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Parking Expenses :</label>
					<div class="col-sm-9">
                    	<input type="text" id="ParkingExpenses" class="form-control" name="ParkingExpenses" placeholder=" Write Expenses Amount ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Entertainment :</label>
					<div class="col-sm-9">
                    	<input type="text" id="Entertainment" class="form-control" name="Entertainment" placeholder=" Write Expenses Amount ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Others Expenses :</label>
					<div class="col-sm-9">
                    	<input type="text" id="OthersExpenses" class="form-control" name="OthersExpenses" placeholder=" Others Expenses Amount ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Expenses Date:</label>
					<div class="col-sm-9">
                    	<input type="date" id="expensesName" class="form-control" name="ExpensesDate" required>
					</div>
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addTripExpenses"><i class="fa fa-save"> </i> Add Trip Expenses </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Trip Expenses -->
<div class="modal fade" id="editTrip">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Addeed Trip Expenses</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="tripaddExpenses_add.php" enctype="multipart/form-data">
          		<input type="hidden" id="editid" name="id" />
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Trip Number :</label>
                  	<div class="col-sm-9">
						<select class="form-control" id="editTripid" name="tripNumber">
							<option value="" selected>~~ Select Trip ~~</option>
							<?php
								  $sql = "SELECT id FROM `trip_sheets` WHERE status!='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>Trip Number ".$prow['id']."</option>
									";
								  }
								?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Vehicle Number :</label>
                  	<div class="col-sm-9">
						<select class="form-control" id="editvehicle_id" name="vehicleNumber" required>
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
				<label for="categoryName" class="col-sm-3 control-label">Police Expenses :</label>
					<div class="col-sm-9">
                    	<input type="text" id="editPoliceExpenses" class="form-control" name="PoliceExpenses" placeholder=" Write Expenses Name ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Toll Expenses :</label>
					<div class="col-sm-9">
                    	<input type="text" id="editTollExpenses" class="form-control" name="TollExpenses" placeholder=" Write Expenses Name ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Parking Expenses :</label>
					<div class="col-sm-9">
                    	<input type="text" id="editParkingExpenses" class="form-control" name="ParkingExpenses" placeholder=" Write Expenses Name ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Entertainment :</label>
					<div class="col-sm-9">
                    	<input type="text" id="editEntertainment" class="form-control" name="Entertainment" placeholder=" Write Expenses Name ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Others Expenses :</label>
					<div class="col-sm-9">
                    	<input type="text" id="editOthersExpenses" class="form-control" name="OthersExpenses" placeholder=" Others Expenses Amount ">
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Expenses Date:</label>
					<div class="col-sm-9">
                    	<input type="date" id="editexpenses_date" class="form-control" name="ExpensesDate" required>
					</div>
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="EditTripExpenses"><i class="fa fa-save"> </i> Edit Trip Expenses </button>
				</form>
				</div>
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
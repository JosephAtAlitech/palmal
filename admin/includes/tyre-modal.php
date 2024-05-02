<!-- Add Tyre -->
<div class="modal fade" id="addnewTyre">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Tyre</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="tyre-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Date:</label>
                    	<input type="date" id="" class="form-control" name="tyreDate" placeholder=" Date " required>
					</div>
					<div class="col-sm-4">
						<label class="">Select Vehicle:</label>
                    	<select class="form-control" id="tyreVehicle" name="tyreVehicle" onblur="loadPurchase()" required>
							<option>~~ Select Vehicle ~~</option>
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
					<div class="col-sm-4">
						<label class="">Select Position:</label>
						<select class="form-control" id="Tyreposition" name="Tyreposition" required>
							<option>~~ Select Position ~~</option>
							<?php
								  $sql = "SELECT * FROM `tyre_position`";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['position_name']."</option>
									";
								  }
								?>
						</select>
                    </div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Select Type:</label>
						<select class="form-control" id="" name="tyreType" required>
							<option value="" selected>~~ Select Type ~~</option>
							<option value="Used" > Used </option>
							<option value="New" > New </option>
						</select>
                   </div>
					<div class="col-sm-4">
						<label class="">Enter Tyre Number:</label>
                    	<input type="text" id="" class="form-control" name="tyreNumber" placeholder=" Enter Tyre Number " required>
					</div>
					<div class="col-sm-4">
						<label class="">Enter Tyre Brand:</label>
                    	<input type="text" id="" class="form-control" name="tyreCompany" placeholder=" Enter Tyre Company " required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Enter Tyre Serial:</label>
                    	<input type="text" id="" class="form-control" name="tyreModel" placeholder=" Enter Tyre Serial ">
					</div>
					<div class="col-sm-4">
						<label class="">Enter Tyre Cost:</label>
                    	<input type="text" id="" class="form-control" name="tyreCost" placeholder=" Enter Tyre Cost ">
					</div>
					<div class="col-sm-4">
						<label class="">Select Supervisor:</label>
						<select class="form-control" id="tyreSupervisor" name="tyreSupervisor">
							<option value="" selected>~~ Select Supervisor ~~</option>
							<?php
								  $sql = "SELECT id,helper_name FROM `helper_master` WHERE status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['helper_name']."</option>
									";
								  }
							?>
						</select>
                    </div>
					
				</div>
				
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addTyre"><i class="fa fa-save"> </i> Add Tyre </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Tyre -->
<div class="modal fade" id="EditTyre">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Tyre</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="tyre-edit.php" enctype="multipart/form-data">
          		<input type="hidden" id="tyreid" name="id">
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Date:</label>
                    	<input type="date" id="tyreDate" class="form-control" name="tyreDate" placeholder=" Date " required>
					</div>
					<div class="col-sm-4">
						<label class="">Select Vehicle:</label>
                    	<select class="form-control" id="vehicle_no" name="tyreVehicle">
							<option>~~ Select Vehicle ~~</option>
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
					<div class="col-sm-4">
						<label class="">Select Type:</label>
						<select class="form-control" id="tyre_type" name="tyreType">
							<option value="" selected>~~ Select Type ~~</option>
							<option value="Used" > Used </option>
							<option value="New" > New </option>
							<option value="Button" > Button </option>
							
						</select>
                   </div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Select Position:</label>
						<select class="form-control" id="tyre_position" name="Tyreposition">
							<option value="" selected>~~ Select Position ~~</option>
							<?php
								  $sql = "SELECT * FROM `tyre_position`";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['position_name']."</option>
									";
								  }
								?>
						</select>
                    </div>
					<div class="col-sm-4">
						<label class="">Enter Tyre Number:</label>
                    	<input type="text" id="tyre_no" class="form-control" name="tyreNumber" placeholder=" Enter Tyre Number " required>
					</div>
					<div class="col-sm-4">
						<label class="">Enter Tyre Brand:</label>
                    	<input type="text" id="tyre_company" class="form-control" name="tyreCompany" placeholder=" Enter Tyre Company " required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label class="">Enter Tyre Model:</label>
                    	<input type="text" id="tyre_model" class="form-control" name="tyreModel" placeholder=" Enter Tyre Model " required>
					</div>
					<div class="col-sm-3">
						<label class="">Enter Tyre Cost:</label>
                    	<input type="text" id="tyre_cost" class="form-control" name="tyreCost" placeholder=" Enter Tyre Cost " required>
					</div>
					<div class="col-sm-3">
						<label class="">Select Supervisor:</label>
						<select class="form-control" id="supervisor" name="tyreSupervisor">
							<option value="" selected>~~ Select Supervisor ~~</option>
							<?php
								  $sql = "SELECT id,helper_name FROM `helper_master` WHERE status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['helper_name']."</option>
									";
								  }
							?>
						</select>
                    </div>
					<div class="col-sm-3">
						<label class="">Enter Tyre Status:</label>
                    	<select class="form-control" id="tyreStatus" name="tyreStatus">
							<option value="" selected>~~ Select One ~~</option>
							<option value="Active"> Active </option>
							<option value="In-Active"> In-Active </option>
						</select>
					</div>
					
				</div>
				
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="editTyre"><i class="fa fa-save"> </i> Edit Tyre </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Tyre Activation -->
<div class="modal fade" id="ActiveTyre">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Activation...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="tyre-edit.php">
            		<input type="hidden" id="Activeid" name="id">
            		<div class="col-sm-12">
						<select class="form-control" id="ActiveStatus" name="status">
							<option value="" selected>~~ Select One ~~</option>
							<option value="Active">~~ Active ~~</option>
							<option value="In-Active">~~ In-Active ~~</option>
						</select><br><br>
                    </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="ActivationTyre"><i class="fa fa-trash"></i> Active </button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Active Driver -->
<div class="modal fade" id="activeDriver">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>In-Active to Active Added Driver</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="driver-edit.php" enctype="multipart/form-data">
          		
				<input type="hidden" id="deletid12" name="id">
               
				
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Driver Name :</label>
                  	<div class="col-sm-9">
                    	<input type="text" id="driver_name12" class="form-control" name="branchName" placeholder=" Write Branch Name " readonly>
					</div>
					
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Status Activation :</label>
					<div class="col-sm-9">
                    	<select class="form-control" id="status" name="status"  required>
							<option value="" selected>~~ Select One ~~</option>
							<option value="Active">~~ Active ~~</option>
							<option value="In-Active">~~ In-Active ~~</option>
						</select>
					</div>
				</div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="activatedDriver"><i class="fa fa-save"> </i> Edit Branch</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
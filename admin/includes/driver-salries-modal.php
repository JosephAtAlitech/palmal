<!-- Add Driver Salaries -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Driver Salaries</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" name="myform" id="contact_form" method="POST" action="driver-salaries-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Salary Month :</label>
						<select class="form-control" id="SalaryMonth" name="SalaryMonth" size='1' required>
							<option value='' selected>~~ Select Month ~~</option>
							<?php
							for ($i = 0; $i < 12; $i++) {
								$time = strtotime(sprintf('%d months', $i));   
								$label = date('F', $time);   
								$value = date('n', $time);
								echo "<option value='$label'>$label</option>";
							}
							?>
						</select>
					</div>
					<div class="col-sm-6">
						<label class="">Driver Name :</label>
						<select class="form-control" id="DriverName" name="DriverName" required>
							<option value="" selected>~~ Select Driver Name ~~</option>
							<?php
								  $sql = "SELECT id,driver_name FROM `driver_master` WHERE status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['driver_name']."</option>
									";
								  }
								?>
							
						</select>
					</div>
					
					
				</div>
				
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Total Advances(During Month):</label>
                    	<input type="text" id="TotalAdvances" class="form-control" name="TotalAdvances" onkeyup="calc()" placeholder="Total Advances(During Month)"  required>
					</div>
					<div class="col-sm-6">
						<label class="">Trip Expenses(During Month) :</label>
                    	<input type="text" id="TripExpenses" class="form-control" name="TripExpenses" onkeyup="calc()" placeholder=" Trip Expenses(During Month)" required>
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Driver Phone Bill :</label>
                    	<input type="text" id="phoneBill" class="form-control" name="phoneBill" onkeyup="calc()" placeholder=" Enter Phone Bill " required>
					</div>
					<div class="col-sm-6">
						<label class="">Salaries :</label>
                    	<input type="text" id="Salaries" class="form-control" name="Salaries"  onkeyup="calc()" placeholder=" Enter Trip Advance " required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Date :</label>
                    	<input type="date" id="branchName" class="form-control" name="salaryDate"  required>
					</div>
					<div class="col-sm-6">
						<label class="">Remaining Salaries :</label>
                    	<input type="text" id="RemainingSalaries" class="form-control" name="RemainingSalaries" placeholder=" Remaining Salaries " readonly>
					</div>
				</div>
				
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addDriverSalaries"><i class="fa fa-save"> </i> Add Driver Salary </button>
					</form>
				</div>
			</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Driver Salaries -->
<div class="modal fade" id="EditDriverSalaries">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Driver Salaries</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" name="myform" id="contact_form" method="POST" action="driver-salaries-add.php" enctype="multipart/form-data">
          		<input >
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Salary Month :</label>
						<select class="form-control" id="SalaryMonth" name="SalaryMonth" size='1' required>
							<option value='' selected>~~ Select Month ~~</option>
							<?php
							for ($i = 0; $i < 12; $i++) {
								$time = strtotime(sprintf('%d months', $i));   
								$label = date('F', $time);   
								$value = date('n', $time);
								echo "<option value='$label'>$label</option>";
							}
							?>
						</select>
					</div>
					<div class="col-sm-6">
						<label class="">Driver Name :</label>
						<select class="form-control" id="DriverName" name="DriverName" required>
							<option value="" selected>~~ Select Driver Name ~~</option>
							<?php
								  $sql = "SELECT id,driver_name FROM `driver_master` WHERE status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['driver_name']."</option>
									";
								  }
								?>
							
						</select>
					</div>
					
					
				</div>
				
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Total Advances(During Month):</label>
                    	<input type="text" id="TotalAdvances" class="form-control" name="TotalAdvances" onkeyup="calc()" placeholder="Total Advances(During Month)"  required>
					</div>
					<div class="col-sm-6">
						<label class="">Trip Expenses(During Month) :</label>
                    	<input type="text" id="TripExpenses" class="form-control" name="TripExpenses" onkeyup="calc()" placeholder=" Trip Expenses(During Month)" required>
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Driver Phone Bill :</label>
                    	<input type="text" id="phoneBill" class="form-control" name="phoneBill" onkeyup="calc()" placeholder=" Enter Phone Bill " required>
					</div>
					<div class="col-sm-6">
						<label class="">Salaries :</label>
                    	<input type="text" id="Salaries" class="form-control" name="Salaries"  onkeyup="calc()" placeholder=" Enter Trip Advance " required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Date :</label>
                    	<input type="date" id="branchName" class="form-control" name="salaryDate"  required>
					</div>
					<div class="col-sm-6">
						<label class="">Remaining Salaries :</label>
                    	<input type="text" id="RemainingSalaries" class="form-control" name="RemainingSalaries" placeholder=" Remaining Salaries " readonly>
					</div>
				</div>
				
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addDriverSalaries"><i class="fa fa-save"> </i> Add Driver Salary </button>
					</form>
				</div>
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
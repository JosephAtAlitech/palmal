<!-- Add New Customer/Supplier-->
<div class="modal fade" id="addnewUser">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New User</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" action="addCustomer.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $type; ?>" id="add_tblType" name="TblType">	
				<input type="hidden" value="" id="add_pageName" name="pageName">	
				<div class="form-group">
                  	<div class="col-sm-6">
					<label for="CustomerName">First Name </label> 
                    	<input type="text" class="form-control" id="add_customerName" name="fCustomerName" autocomplete="off" placeholder=" Insert Name ">
                  	</div>
					<div class="col-sm-6">
					<label for="ContactPerson">Last Name </label> 
                    	<input  class="form-control" id="add_contactPerson" name="lContactPerson"  autocomplete="off" placeholder="Contact Person">
                  	</div>
				</div>
				<div class="form-group">
                  	<div class="col-sm-6">
					<label for="department">Department </label> 
						<select class="form-control" id="department" name="department" required >
    						<option value='' selected>~ Select department ~</option>
    						<option value='Workshop'>Workshop</option>
							<option value='Procurement'>Procurement</option>
							<option value='Wing Head'>Wing Head</option>
							<option value='Audit Department'>Audit Department</option>
							<option value='Management'>Management</option>
							<option value='Store'>Store</option>
    					</select>
                  	</div>
					<div class="col-sm-6">
					<label for="ContactPerson">Position </label> 
						<select class="form-control" id="position" name="position" required >
    						<option value='' selected>~ Select Position ~</option>
    						<option value='Management_team'>Management Team</option>
    						<option value='Mechanic'>Mechanic</option>
							<option value='Engineer'>Engineer</option>
							<option value='Auditor'>Auditor</option>
							<option value='GM'>GM</option>
							<option value='DGM'>DGM</option>
							<option value='MD'>MD</option>
							<option value='ED'>ED</option>
							<option value='Director'>Director</option>
    					</select>
                  	</div>
				</div>
				<div class="form-group">
                  	<div class="col-sm-6">
					<label for="CustomerName">User Name </label> 
                    	<input type="text" class="form-control" id="add_customerName" name="userName" autocomplete="off" placeholder=" Insert User Name ">
                  	</div>
					<div class="col-sm-6">
					<label for="ContactPerson">Password </label> 
                    	<input  type="password" class="form-control" id="add_contactPerson" name="addPassword" placeholder=" Password "  autocomplete="off" >
                  	</div>
				</div>
				<div class="form-group">
                  	<div class="col-sm-6">
					<label for="EmailAddress"> Email Address </label> 
                    	<input type="email" class="form-control" id="add_emailAddress" name="EmailAddress" autocomplete="off" placeholder=" Valid Email Address ">
                  	</div>
					<div class="col-sm-6">
					<label for="PhoneNumber"> Phone Number </label> 
                    	<input type="text" class="form-control" id="add_phoneNumber" name="PhoneNumber" autocomplete="off" placeholder=" Valid Phone Number ">
                  	</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-6">
    					<label for="userImage"> Branch Name </label> 
                    	<select class="form-control" id="branceNumber" name="branceNumber" required >
    					<?php
    						$sql = "SELECT id,branch_name FROM `branch_master` WHERE status='Active' ORDER BY `branch_master`.`branch_name` ASC";
    						$query = $conn->query($sql);
    					
    						while($prow = $query->fetch_assoc()){
    						echo "<option value='".$prow['id']."'>".$prow['branch_name']."</option>";
    						}
    					?>
    					</select>
                  	</div>
                  	<div class="col-sm-6">
					    <label for="userImage"> Image </label> 
                    	<input type="file" class="form-control" id="userImage" name="userImage">
                  	</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addCustomer" id="btn_saveCustomer"><i class="fa fa-save"></i> Save </button>
				</div>
				</form>
			</div>
        </div>
    </div>
</div>

<!-- Edit New Customer/Supplier-->
<div class="modal fade" id="EditUser">
    <div class="modal-dialog" style="width: 60%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit New User</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="edit_contact_form" action="addCustomer.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" id="editid" name="uid">	
				<div class="form-group">
                  	<div class="col-sm-6">
					<label for="CustomerName">First Name </label> 
                    	<input type="text" class="form-control" id="edit_fcustomerName" name="fCustomerName" autocomplete="off" placeholder=" Insert Name ">
                  	</div>
					<div class="col-sm-6">
					<label for="ContactPerson">Last Name </label> 
                    	<input  class="form-control" id="edit_lcustomerName" name="lContactPerson"  autocomplete="off" placeholder="Contact Person">
                  	</div>
				</div>
				<div class="form-group">
                  	<div class="col-sm-6">
					<label for="department">Department </label> 
						<select class="form-control" id="edit_department" name="department" required >
    						<option value='' selected>~ Select department ~</option>
    						<option value='Workshop'>Workshop</option>
							<option value='Procurement'>Procurement</option>
							<option value='Wing Head'>Wing Head</option>
							<option value='Audit Department'>Audit Department</option>
							<option value='Management'>Management</option>
							<option value='Store'>Store</option>
    					</select>
                  	</div>
					<div class="col-sm-6">
					<label for="ContactPerson">Position </label> 
						<select class="form-control" id="edit_position" name="position" required >
    						<option value=''>~ Select Position ~</option>
    						<option value='Management_team'>Management Team</option>
    						<option value='Mechanic'>Mechanic</option>
							<option value='Engineer'>Engineer</option>
							<option value='Auditor'>Auditor</option>
							<option value='GM'>GM</option>
							<option value='DGM'>DGM</option>
							<option value='MD'>MD</option>
							<option value='ED'>ED</option>
							<option value='Director'>Director</option>
    					</select>
                  	</div>
				</div>
				<div class="form-group">
                  	<div class="col-sm-6">
					<label for="CustomerName">User Name </label> 
                    	<input type="text" class="form-control" id="editUname1" name="userName" autocomplete="off" placeholder=" Insert User Name " readonly>
                  	</div>
					<div class="col-sm-6">
					<label for="EmailAddress"> Email Address </label> 
                    	<input type="email" class="form-control" id="editemailAddress" name="EmailAddress" autocomplete="off" placeholder=" Valid Email Address ">
                  	</div>
				</div>
				<div class="form-group">
                  	
					<div class="col-sm-6">
					<label for="PhoneNumber"> Phone Number </label> 
                    	<input type="text" class="form-control" id="edit_phoneNumber" name="PhoneNumber" autocomplete="off" placeholder=" Valid Phone Number ">
                  	</div>
				    <div class="col-sm-6">
    					<label for="userImage"> Branch Name </label> 
                    	<select class="form-control" id="edit_branceNumber" name="branceNumber" required >
    					<?php
    						$sql = "SELECT id,branch_name FROM `branch_master` WHERE status='Active' ORDER BY `branch_master`.`branch_name` ASC";
    						$query = $conn->query($sql);
    					
    						while($prow = $query->fetch_assoc()){
    						echo "<option value='".$prow['id']."'>".$prow['branch_name']."</option>";
    						}
    					?>
    					</select>
                  	</div>
                  	
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="updateCustomer" id="btn_saveCustomer"><i class="fa fa-save"></i> Update User </button>
				</div>
				</form>
			</div>
        </div>
    </div>
</div>

<!-- Vehicle Delete -->
<div class="modal fade" id="deleteUser">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="addCustomer.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE User NAME</p>
	                	<h2 id="deletusername" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteUser"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Change Password -->
<div class="modal fade" id="changePassword">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Change Password...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="addCustomer.php">
            		<input type="hidden" id="chdeletid" name="id">
            		<div class="form-group">
					<div class="col-sm-12">
					<label for="ContactPerson">Password </label> 
                    	<input  type="password" class="form-control" id="add_contactPerson" name="addPassword" placeholder=" Password "  autocomplete="off" required >
                  	</div>
				</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="ChangePassword12"><i class="fa fa-key"></i> ChangePassword </button>
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
          		
				<input type="text" id="activeVehicleid" name="id">
               
				
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
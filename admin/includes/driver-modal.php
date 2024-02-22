<!-- Add Driver -->
<div class="modal fade" id="addnewDriver">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Driver</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="driver-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Driver Name:</label>
                    	<input type="text" id="vehicleNumbersdfs" class="form-control" name="DriverName" placeholder=" Driver Name " required>
					</div>
					<div class="col-sm-4">
						<label class="">Driver Phone Number:</label>
                    	<input type="text" id="PhoneCheck" class="form-control" name="PhoneNumber" onBlur="phoneAvailability()" placeholder=" Phone Number " required>
						<span id="phone-availability-status"></span>
					</div>
					<div class="col-sm-4">
						<label class="">Driver Alternate Number:</label>
                    	<input type="text" id="branchName" class="form-control" name="AlternateNumber" placeholder=" Alternate Phonre Number ">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Driver License Number:</label>
                    	<input type="text" id="LicenceCheck" class="form-control" name="DriverLicenceNumber" onBlur="licenceAvailability()" placeholder=" Write Driver Licence Number ">
						<span id="licence-availability-status"></span>
					</div>
					<div class="col-sm-4">
						<label class="">Driver License Expire Date:</label>
                    	<input type="date" id="branchName" class="form-control" name="DriverLicenceExpireDate" placeholder=" Write Engin Number ">
					</div>
					<div class="col-sm-4">
						<label class="">Upload Driver License:</label>
                    	<input type="file" id="RegistrationCirtificate" class="form-control" name="UploadDriverLicence" placeholder=" Registration Cirtificate ">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Upload Profile Image:</label>
                    	<input type="file" id="Insurancecertificate" class="form-control" name="driverImage" placeholder=" Insurance certificate " >
					</div>
					<div class="col-sm-4">
						<label class="">Upload (NID Card):</label>
                    	<input type="file" id="branchName" class="form-control" name="AadharCard" placeholder=" Insurance Start Date ">
					</div>
					<div class="col-sm-4">
                    	<input type="hidden" id="branchName" class="form-control" name="BankAccounts" placeholder=" Insurance End Date " >
					</div>
					<div class="col-sm-4">
						<label class="">Driver salaries:(Optional)</label>
                    	<input type="text" id="driverSalaries" class="form-control" name="driverSalaries"  placeholder=" Write Driver Salaries ">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Phone Limits:</label>
                    	<input type="text" id="DriverPhoneLimit" class="form-control" name="DriverPhoneLimit"  placeholder=" Write Driver Phone Limit ">
						
					</div>
					
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" id="submit-button" name="addDricver"><i class="fa fa-save"> </i> Add Driver</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Vehicle -->
<div class="modal fade" id="EditDriver">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Driver</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="driver-edit.php" enctype="multipart/form-data">
          		<input type="hidden" id="edidrivertid" name="id"/>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Driver Name:</label>
                    	<input type="text" id="driver_name" class="form-control" name="DriverName" placeholder=" Driver Name ">
					</div>
					<div class="col-sm-4">
						<label class="">Driver Phone Number:</label>
                    	<input type="text" id="PhoneNumber" class="form-control" name="PhoneNumber" placeholder=" Phone Number ">
						
					</div>
					<div class="col-sm-4">
						<label class="">Driver Alternate Number:</label>
                    	<input type="text" id="alter_phone" class="form-control" name="AlternateNumber" placeholder=" Alternate Phonre Number ">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Driver Licence Number:</label>
                    	<input type="text" id="editDriverLicenceNumber" class="form-control" name="DriverLicenceNumber" placeholder=" Write Driver Licence Number ">
					</div>
					<div class="col-sm-4">
						<label class="">Driver Licence Expire Date:</label>
                    	<input type="date" id="licence_exp_date" class="form-control" name="DriverLicenceExpireDate" placeholder=" Write Engin Number ">
					</div>
					<div class="col-sm-4">
						<label class="">Driver salaries:(Optional)</label>
                    	<input type="text" id="Editdriver_salaries" class="form-control" name="driverSalaries"  placeholder=" Write Driver Salaries ">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3">
						<label class="">Upload Driver Licence:</label>
                    	<input type="file" id="RegistrationCirtificate" class="form-control" name="UploadDriverLicence" placeholder=" Registration Cirtificate ">
						<div id="dri_licence_image"></div>
					</div>
					<div class="col-sm-3">
						<label class="">Uploda Image:</label>
                    	<input type="file" id="Insurancecertificate" class="form-control" name="driverImage" placeholder=" Insurance certificate ">
						<div id="dri_image"></div>
					</div>
					<div class="col-sm-3">
						<label class="">Upload (NID Card):</label>
                    	<input type="file" id="branchName" class="form-control" name="AadharCard" placeholder=" Insurance Start Date ">
						<div id="drice_aadhar_card"></div>
					</div>
					<input type="hidden" id="branchName" class="form-control" name="BankAccounts" placeholder=" Insurance End Date ">
						
					<div class="col-sm-3">
						<label class="">Phone Limits:</label>
                    	<input type="text" id="Editdriver_phone_limit" class="form-control" name="DriverPhoneLimit"  placeholder=" Write Driver Phone Limit ">
						
					</div>
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="editDricver"><i class="fa fa-save"> </i> Add Driver</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
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
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteDriver12"><i class="fa fa-trash"></i> Delete</button>
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
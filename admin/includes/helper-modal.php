<!-- Add Helper -->
<div class="modal fade" id="addnewhelper">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Helper</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="helper-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Helper Name:</label>
                    	<input type="text" id="vehicleNumbersdfs" class="form-control" name="helperName" placeholder=" helperName " required>
					</div>
					<div class="col-sm-4">
						<label class="">Address:</label>
                    	<input type="text" id="branchName" class="form-control" name="address" placeholder=" address " required>
					</div>
					<div class="col-sm-4">
						<label class="">Phone Number:</label>
                    	<input type="text" id="PhoneCheck" class="form-control" name="PhonreNumber" onBlur="phoneAvailability()" placeholder=" PhonreNumber " required>
						<span id="phone-availability-status"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Status:</label>
						<select class="form-control" id="" name="status" required>
							<option value="" selected>~~ Select Type ~~</option>
							<option value="vf-tracker"> vf-tracker </option>
							<option value="generator"> generator </option>
							<option value="boiler"> boiler </option>
						</select>
                    </div>
					<div class="col-sm-4">
						<label class="">Upload(Photo):</label>
                    	<input type="file" id="branchName" class="form-control" name="helperPhoto" placeholder=" helperPhoto ">
					</div>
					<div class="col-sm-4">
						<label class="">Upload National ID:</label>
                    	<input type="file" id="RegistrationCirtificate" class="form-control" name="idPhoto" placeholder=" idPhoto ">
					</div>
				</div>
				
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" id="submit-button" name="addHelper"><i class="fa fa-save"> </i> Add Helper </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Helper -->
<div class="modal fade" id="EditHelper">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Helper</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="helper-edit.php" enctype="multipart/form-data">
          		<input type="hidden" id="helperid" name="id" >
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Helper Name:</label>
                    	<input type="text" id="helper_name" class="form-control" name="helperName" placeholder=" Helper Name " required>
					</div>
					<div class="col-sm-4">
						<label class="">Address:</label>
                    	<input type="text" id="address12" class="form-control" name="address" placeholder=" helper address " required>
					</div>
					<div class="col-sm-4">
						<label class="">Phone Number:</label>
                    	<input type="number" id="PhoneNumber" class="form-control" name="PhonreNumber" placeholder=" Phonre Number " required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Status:</label>
						<select class="form-control" id="status" name="status">
							<option value="" selected>~~ Select One ~~</option>
							<option value="" selected>~~ Select Type ~~</option>
							<option value="vf-tracker"> vf-tracker </option>
							<option value="generator"> generator </option>
							<option value="boiler"> boiler </option>
						</select>
                    </div>
					<div class="col-sm-4">
						<label class="">Upload(Photo):</label>
                    	<input type="file" id="branchName" class="form-control" name="helperPhoto" placeholder=" helperPhoto ">
						<div id="helper_photo_image"></div>
					</div>
					<div class="col-sm-4">
						<label class="">Upload Ntional ID:</label>
                    	<input type="file" id="RegistrationCirtificate" class="form-control" name="idPhoto" placeholder=" idPhoto ">
						<div id="helper_id_copy"></div>
					</div>
				</div>
				
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="editHelper"><i class="fa fa-save"> </i> Update Helper </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Helper Delete -->
<div class="modal fade" id="activeHelper">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Activation...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="helper-edit.php">
            		<input type="hidden" id="activeid" name="id">
            		<div class="col-sm-12">
						<select class="form-control" id="activestatus" name="status">
							<option value="" selected>~~ Select One ~~</option>
							<option value="Active">~~ Active ~~</option>
							<option value="In-Active">~~ In-Active ~~</option>
						</select>
                    </div><br>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="ActiveHelper12"><i class="fa fa-trash"></i> Active </button>
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
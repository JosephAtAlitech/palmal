<!-- Add new Party -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Party</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="party-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Company Name</label>
                    	<input type="text" id="" class="form-control" name="companyName" placeholder=" Company name ">
					</div>
					<div class="col-sm-6">
						<label class="">Contact Person</label>
                    	<input type="text" id="" class="form-control" name="contactPerson" placeholder=" Contact Person "  required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Phone</label>
                    	<input type="text" id="" class="form-control" name="phoneNumber" placeholder=" Phone Number "  required>
					</div>
					<div class="col-sm-6">
						<label class="">Address</label>
                    	<input type="text" id="" class="form-control" name="Address" placeholder=" Company address "  required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addparty"><i class="fa fa-save"> </i> Add Party </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Party -->
<div class="modal fade" id="EditParty">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Party</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="party-add.php" enctype="multipart/form-data">
          		<input type="hidden" id="editid" name="id"/>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Company Name</label>
                    	<input type="text" id="Editcompany_name" class="form-control" name="companyName" placeholder=" Company name ">
					</div>
					<div class="col-sm-6">
						<label class="">Conatact Person</label>
                    	<input type="text" id="Editcontact_person" class="form-control" name="contactPerson" placeholder=" Contact Person "  required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label class="">Phone</label>
                    	<input type="text" id="Editphone" class="form-control" name="phoneNumber" placeholder=" Phone Number "  required>
					</div>
					<div class="col-sm-6">
						<label class="">Address</label>
                    	<input type="text" id="Editaddress" class="form-control" name="Address" placeholder=" Company address "  required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="Editparty"><i class="fa fa-save"> </i> Edit Party </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Vehicle Delete -->
<div class="modal fade" id="deleteParty">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="party-add.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE PARTY NAME</p>
	                	<h2 id="Deletecompany_name" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteParty"><i class="fa fa-trash"></i> Delete</button>
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
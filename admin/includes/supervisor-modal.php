<!-- Add Supervisor -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Supervisor</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="supervisor_update.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Supervisor Name :</label>
                  	<div class="col-sm-9">
                    	<input type="text" id="locationSupervisor" class="form-control" name="locationSupervisor" placeholder=" Write Supervisor Name " required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Phone Number :</label>
                  	<div class="col-sm-9">
                    	<input type="text" id="PhoneNumber" class="form-control" name="PhoneNumber" placeholder=" Write Phone Number " required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Status :</label>
                  	<div class="col-sm-9">
                    	<select class="form-control" name="status" required>
							<option value="" selected>~~ Select One ~~</option>
							<option value="Active"> Active </option>
							<option value="In-Active">In-Active</option>
						</select>
					</div>
					
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addSupervisor"><i class="fa fa-save"> </i> Add Supervisor</button>
				</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Supervisor -->
<div class="modal fade" id="editSupervisor">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Supervisor</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="supervisor_update.php" enctype="multipart/form-data">
          		
				<input type="hidden" id="editid" name="id">
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Supervisor Name :</label>
                  	<div class="col-sm-9">
                    	<input type="text" id="editsupervisor_name" class="form-control" name="locationSupervisor" placeholder=" Write Supervisor Name " required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Phone Number :</label>
                  	<div class="col-sm-9">
                    	<input type="text" id="editPhone" class="form-control" name="PhoneNumber" placeholder=" Write Phone Number " required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Status :</label>
                  	<div class="col-sm-9">
                    	<select class="form-control" id="editstatus" name="status">
							<option value="" selected>~~ Select One ~~</option>
							<option value="Active"> Active </option>
							<option value="In-Active">In-Active</option>
						</select>
					</div>
					
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="EditSupervisor"><i class="fa fa-save"> </i> Edit Branch</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Supervisor Delete -->
<div class="modal fade" id="deleteSupervisor">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="supervisor_update.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE BRANCH NAME</p>
	                	<h2 id="deletsupervisor_name" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteSupervisor"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Active Location -->
<div class="modal fade" id="activeSupervisor">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Supervisor</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="supervisor_update.php" enctype="multipart/form-data">
          		
				<input type="text" id="Exdeletid" name="id">
               
				
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Supervisor Name :</label>
                  	<div class="col-sm-5">
                    	<input type="hidden" id="Exsupervisor_name" class="form-control" name="branchName" placeholder=" Write Branch Name " required>
					</div>
					<div class="col-sm-4">
                    	<select class="form-control" id="Exactivestatus" name="status"  required>
							<option value="" selected>~~ Select One ~~</option>
							<option value="Active">~~ Active ~~</option>
							<option value="In-Active">~~ In-Active ~~</option>
						</select>
					</div>
					
				</div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="activatedSupervisor"><i class="fa fa-save"> </i> Edit Branch</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
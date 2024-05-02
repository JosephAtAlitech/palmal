<!-- Add Location -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Location</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="location_add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Location Name :</label>
                  	<div class="col-sm-9">
                    	<input type="text" id="locationName" class="form-control" name="locationName" placeholder=" Write Location Name " required>
					</div>
					
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addLocation"><i class="fa fa-save"> </i> Add Location</button>
				</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Branch -->
<div class="modal fade" id="editLocation">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Location</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="location_update.php" enctype="multipart/form-data">
          		
				<input type="hidden" id="editid" name="id">
               
				
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Location Name :</label>
                  	<div class="col-sm-9">
                    	<input type="text" id="editLocation_name" class="form-control" name="editLocation_name" placeholder=" Write Location Name " required>
					</div>
					
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="EditLocation"><i class="fa fa-save"> </i> Edit Branch</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Location Delete -->
<div class="modal fade" id="deleteLocation">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="location_update.php">
            		<input type="text" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE BRANCH NAME</p>
	                	<h2 id="deletbranch_name" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteLocation"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Active Location -->
<div class="modal fade" id="activeLocation">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Location</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="location_update.php" enctype="multipart/form-data">
          		
				<input type="text" id="activeid" name="id">
               
				
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Branch Name :</label>
                  	<div class="col-sm-5">
                    	<input type="hidden" id="activebranch_name" class="form-control" name="branchName" placeholder=" Write Branch Name " required>
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
            	<button type="submit" class="btn btn-primary btn-flat" name="activatedLocation"><i class="fa fa-save"> </i> Edit Branch</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
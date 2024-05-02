<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Category</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="category_add.php">
          		<div class="form-group">
                  	<label for="Categoryname" class="col-sm-3 control-label">Category Name</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="Categoryname" name="Categoryname" placeholder=" Category name " required>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="Categorytype" class="col-sm-3 control-label">Category Type</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="Categorytype" name="Categorytype"  required>
							<option value="" selected>- Select One -</option>
							<option value="Weapons">Weapons</option>
							<option value="Bullets">Bullets</option>
						</select>
                  	</div>
                </div>
				<div class="form-group">
                  	<label for="CategoryStatus" class="col-sm-3 control-label">Status</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="CategoryStatus" name="CategoryStatus"  required>
							<option value="" selected>- Select One -</option>
							<option value="Available">Available</option>
							<option value="Not Available">Not Available</option>
						</select>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="comments" class="col-sm-3 control-label">Comments</label>

                    <div class="col-sm-9">
                      <textarea type="text" class="form-control" id="comments" name="comments" placeholder=" Write about category " ></textarea>
                    </div>
                </div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="addCategory"><i class="fa fa-save"></i> Save </button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="editCategories">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Category</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="category_edit.php">
				<input type="hidden" id="caid" name="id">
          		<div class="form-group">
                  	<label for="Categoryname" class="col-sm-3 control-label">Category Name</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="categories_name" name="Categoryname" placeholder=" Category name " required>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="Categorytype" class="col-sm-3 control-label">Category Type</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="categories_type" name="Categorytype"  required>
							<option value="" selected>- Select One -</option>
							<option value="Weapons">Weapons</option>
							<option value="Bullets">Bullets</option>
						</select>
                  	</div>
                </div>
				<div class="form-group">
                  	<label for="CategoryStatus" class="col-sm-3 control-label">Status</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="status" name="CategoryStatus"  required>
							<option value="" selected>- Select One -</option>
							<option value="Available">Available</option>
							<option value="Not Available">Not Available</option>
						</select>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="comments" class="col-sm-3 control-label">Comments</label>

                    <div class="col-sm-9">
                      <textarea type="text" class="form-control" id="cacomments" name="comments" placeholder=" Write about category " ></textarea>
                    </div>
                </div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="EditCategory"><i class="fa fa-save"></i> Save </button>
            	</form>
          	</div>
        </div>
    </div>
</div>
<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="company_delete.php">
            		<input type="hidden" id="del_comid" name="id">
            		<div class="text-center">
	                	<p>DELETE POSITION</p>
	                	<h2 id="del_company" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     
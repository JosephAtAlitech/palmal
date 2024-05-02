<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Brands</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="brands_add.php">
          		<div class="form-group">
                  	<label for="brandname" class="col-sm-3 control-label">Brand Name</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="brandname" name="brandname" placeholder=" Brand name " required>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="brandtype" class="col-sm-3 control-label">Brand Type</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="brandtype" name="brandtype"  required>
							<option value="" selected>- Select One -</option>
							<option value="Weapons">Weapons</option>
							<option value="Bullets">Bullets</option>
						</select>
                  	</div>
                </div>
				<div class="form-group">
                  	<label for="country" class="col-sm-3 control-label">Country</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="country" name="country" placeholder=" Country " required>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="firmtype" class="col-sm-3 control-label">Status</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="brandStatus" name="brandStatus"  required>
							<option value="" selected>- Select One -</option>
							<option value="Available">Available</option>
							<option value="Not Available">Not Available</option>
						</select>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="Address" class="col-sm-3 control-label">Comments</label>

                    <div class="col-sm-9">
                      <textarea type="text" class="form-control" id="address" name="comments" placeholder=" Write about brands " ></textarea>
                    </div>
                </div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="addBrands"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="editBrand">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Brand</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="brands_edit.php">
            	<input type="hidden" id="Brid" name="id">
          		<div class="form-group">
                  	<label for="brandname" class="col-sm-3 control-label">Brand Name</label>
					<div class="col-sm-9">
                    	<input type="text" class="form-control" id="brand_name" name="brandname" placeholder=" Brand name " required>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="brandtype" class="col-sm-3 control-label">Brand Type</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="brand_type" name="brandtype"  required>
							<option value="" selected>- Select One -</option>
							<option value="Weapons">Weapons</option>
							<option value="Bullets">Bullets</option>
						</select>
                  	</div>
                </div>
				<div class="form-group">
                  	<label for="country" class="col-sm-3 control-label">Country</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="brcountry" name="country" placeholder=" Country " required>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="firmtype" class="col-sm-3 control-label">Status</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="brstatus" name="brandStatus"  required>
							<option value="" selected>- Select One -</option>
							<option value="Available">Available</option>
							<option value="Not Available">Not Available</option>
						</select>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="Address" class="col-sm-3 control-label">Comments</label>

                    <div class="col-sm-9">
                      <textarea type="text" class="form-control" id="brcomments" name="comments" placeholder=" Write about brands " ></textarea>
                    </div>
                </div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="addBrands"><i class="fa fa-save"></i> Save</button>
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


     
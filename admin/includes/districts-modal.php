<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Districts</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="districts_add.php">
          		<div class="form-group">
                  	<label for="division" class="col-sm-3 control-label">Divisions</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="division" name="division"  required>
							<option value="" selected>~~ Select One ~~</option>
							<option value="Barishal "> Barishal </option>
							<option value="Chittagong"> Chittagong </option>
							<option value="Dhaka"> Dhaka </option>
							<option value="Mymensingh"> Mymensingh </option>
							<option value="Khulna"> Khulna </option>
							<option value="Rajshahi"> Rajshahi </option>
							<option value="Rangpur"> Rangpur </option>
							<option value="Rangpur"> Sylhet </option>
						</select>
                  	</div>
                </div>
				<div class="form-group">
                  	<label for="Districtname" class="col-sm-3 control-label">District Name</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="District_name" name="Districtname" placeholder=" District name " required>
                  	</div>
				</div>
                <div class="form-group">
                    <label for="Address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea type="text" class="form-control" id="Address" name="Address" placeholder=" Write about districts " ></textarea>
                    </div>
                </div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="addDistricts"><i class="fa fa-save"></i> Save </button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Add -->
<div class="modal fade" id="editDistricts">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Districts</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="districts_edit.php">
				<input type="hidden" id="disid" name="id">
          		<div class="form-group">
                  	<label for="division" class="col-sm-3 control-label">Divisions</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="disdivision" name="division"  required>
							<option value="" selected>~~ Select One ~~</option>
							<option value="Barishal "> Barishal </option>
							<option value="Chittagong"> Chittagong </option>
							<option value="Dhaka"> Dhaka </option>
							<option value="Mymensingh"> Mymensingh </option>
							<option value="Khulna"> Khulna </option>
							<option value="Rajshahi"> Rajshahi </option>
							<option value="Rangpur"> Rangpur </option>
							<option value="Rangpur"> Sylhet </option>
						</select>
                  	</div>
                </div>
				<div class="form-group">
                  	<label for="Districtname" class="col-sm-3 control-label">District Name</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="districts" name="Districtname" placeholder=" District name " required>
                  	</div>
				</div>
                <div class="form-group">
                    <label for="Address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea type="text" class="form-control" id="address" name="Address" placeholder=" Write about category " ></textarea>
                    </div>
                </div>
			</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="EditDistricts"><i class="fa fa-save"></i> Save </button>
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


     
<!-- Add -->
<div class="modal fade" id="addnewWorkshop">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Workshop </b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="form_addWarehouse" method="POST">
				<div class="form-group">
                  	<label for="UnitName" class="col-sm-3 control-label">
                  	Workshop Name
                  	</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="warehouseName" name="warehouseName" onblur="manageAvailability()" placeholder=" Warehouse Name ">
						<span id="manage-availability-status"></span>
					</div>
				</div>
                <div class="form-group">
                  	<label for="warehouse_type" class="col-sm-3 control-label">Workshop Type</label>
                  	<div class="col-sm-9">
                    	<select type="text" class="form-control" id="warehouse_type" name="warehouse_type" placeholder=" Warehouse Type ">
						<option value="" selected>~ Select Workshop Type ~</option>
                            <option value="Passenger">Passenger</option>
                            <option value="Commercial">Commercial</option>
							<option value="Both">Both</option>
                        </select>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="warehouse_type" class="col-sm-3 control-label">Type</label>
                  	<div class="col-sm-9">
                    	<select type="text" class="form-control" id="position_type" name="position_type" placeholder=" Type ">
						<option value="" selected>~ Select Type ~</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="address" class="col-sm-3 control-label">Address</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="address" name="address" placeholder=" Description ">
                  	</div>
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addUnit" id="btn_saveUnit"><i class="fa fa-save"></i> Save </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Add and Edit -->
<div class="modal fade" id="editWarehouseModal">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Workshop </b></h4>
          	</div>
          	<div class="modal-body">
          	    <div id="editLoader" style="display:none; text-align:center;" class="col-md-12"><i class='fa fa-spinner fa-spin' style='font-size:50px;color:green'></i></div>
            	<form class="form-horizontal" method="POST" id="form_editUnit">
				<input type="hidden" id="edit_id" name="edit_id">
                <div class="form-group">
                  	<label for="UnitName" class="col-sm-3 control-label">
                  	Workshop Name
                  	</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_warehouseName" name="edit_warehouseName" onblur="manageAvailability()" placeholder=" Warehouse Name ">
						<span id="manage-availability-status"></span>
					</div>
				</div>
                <div class="form-group">
                  	<label for="warehouse_type" class="col-sm-3 control-label">Warehouse Type</label>
                  	<div class="col-sm-9">
                    	<select type="text" class="form-control" id="edit_warehouse_type" name="edit_warehouse_type" placeholder=" Warehouse Type ">
						<option value="" selected>~ Select Workshop Type ~</option>
                            <option value="Passenger">Passenger</option>
                            <option value="Commercial">Commercial</option>
							<option value="Both">Both</option>
                        </select>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="warehouse_type" class="col-sm-3 control-label">Type</label>
                  	<div class="col-sm-9">
                    	<select type="text" class="form-control" id="edit_position_type" name="edit_position_type" placeholder=" Type ">
						<option value="" selected>~ Select Type ~</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                  	</div>
				</div>
				<div class="form-group">
                  	<label for="address" class="col-sm-3 control-label">Address</label>
                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_address" name="edit_address" placeholder=" Description ">
                  	</div>
				</div>
				<div class="form-group">
                <label for="address" class="col-sm-3 control-label">Address</label>
					<div class="col-sm-9">
                    
						<select class="form-control" id="edit_status" name="edit_status">
							<option value="Active">Active</option>
							<option value="In-Active">In-Active</option>
						</select>
					</div>
				</div>
		
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="editUnit" id="btn_updateUnit"><i class="fa fa-save"></i> Save </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Add Location -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Pump Information</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="pump-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-6">
                    	<input type="text" id="pumpName" class="form-control" name="pumpName" placeholder=" Write Pump Name " required>
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="pumpAddress" class="form-control" name="pumpAddress" placeholder=" Write Pump Address " required>
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                    	<input type="text" id="contactPerson" class="form-control" name="contactPerson" placeholder=" Write Contacat Person " >
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="phoneNumber" class="form-control" name="phoneNumber" placeholder=" Write Contact Number " >
					</div>
					
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="addPumpName"><i class="fa fa-save"> </i> Save </button>
				</form>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Branch -->
<div class="modal fade" id="editPump">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Location</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="pump-add.php" enctype="multipart/form-data">
          		
				<input type="hidden" id="editid" name="id">
               
				
				<div class="form-group">
					<div class="col-sm-6">
                    	<input type="text" id="editPump_name" class="form-control" name="pumpName" placeholder=" Write Pump Name " required>
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="editpumpAddress" class="form-control" name="pumpAddress" placeholder=" Write Pump Address " required>
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-6">
                    	<input type="text" id="editcontactPerson" class="form-control" name="contactPerson" placeholder=" Write Contacat Person " >
					</div>
					<div class="col-sm-6">
                    	<input type="text" id="editphoneNumber" class="form-control" name="phoneNumber" placeholder=" Write Contact Number " >
					</div>
					
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="editPumpNmae"><i class="fa fa-save"> </i> Edit Pump</button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Location Delete -->
<div class="modal fade" id="deletePump">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="pump-add.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE PUMP NAME</p>
	                	<h2 id="deletbranch_name" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deletePump"><i class="fa fa-trash"></i> Delete</button>
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
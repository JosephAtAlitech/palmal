<!-- Edit Vehicle -->
<div class="modal fade" id="adjustVehicleRequisitionModal">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Requisition Adjustment</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="requisitionSheetAction.php" enctype="multipart/form-data">
          		<input type="hidden" id="editid" name="id">
				<!-- <div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Requisition id:</label>
                  	<div class="col-sm-9">
						<input type="date" id="editrepaire_date" class="form-control" name="repaireDate" required>
					</div>
					
				</div> -->
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label"> Vehicle Number :</label>
                  	<div class="col-sm-9">
						<select class="form-control" id="adjustvehicle_no" name="vehicleNumber" required>
							<option value="" selected>~~ Select Vehicle Number ~~</option>
							<?php
								  $sql = "SELECT id,vehicle_number FROM `vehicle_master` WHERE delete_status='Active' ORDER BY `id`  DESC";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['vehicle_number']."</option>
									";
								  }
								?>
						</select>
					</div>
					
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Documentation period:</label>
					<div class="col-sm-9">
					<div class="col-sm-9">
						<select class="form-control" id="adjustvehicle_no" name="vehicleNumber" required>
							<option value="" selected>~~ from ~~</option>
							<?php
								  $sql = "SELECT id,vehicle_documents_proposal.entry_date FROM  'vehicle_documents_proposal' WHERE status='Active'";
								  $query = $conn->query($sql);
								  while($prow = $query->fetch_assoc()){
									echo "
									  <option value='".$prow['id']."'>".$prow['vehicle_number']."</option>
									";
								  }
								?>
						</select>
					</div>
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">created At :</label>
					<div class="col-sm-9">
                    <input type="date" id="editrepaire_date" class="form-control" name="repaireDate" required>
					</div>
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label"> created By:</label>
                    <div class="col-sm-9">
                    <input type="text" id="editparticulars" class="form-control" name="particulars" placeholder=" created By: " required>	
				    </div>
                </div>
			
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="adjustvehicalreq"><i class="fa fa-save"> </i> Adjust Vehicle requisition </button>
            	</form>
          	</div>
			</div>
        </div>
    </div>
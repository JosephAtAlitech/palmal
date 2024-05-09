<div class="modal fade" id="adjustVehicleRequisitionModal">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Requisition Adjustment</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="vehicleRepaire_add.php" enctype="multipart/form-data">
          		<input type="hidden" id="editid" name="id">
				
				<div class="form-group">
					<label for="vehical_no" class="col-sm-3 control-label"> Vehicle Number :</label>
                  	<div class="col-sm-9">
						<input readonly  id="editvehicle_no">
					</div>
					
				</div>
				<div class="form-group">
				<label for="doctime" class="col-sm-3 control-label">Document time</label>
					<div class="col-sm-5">
				
						<label for="timefrom"  class=" control-label">From :</label>
                    	<input readonly  id="doctimefrom">
												
						<label for="timeto" class="col-sm-3 control-label">To :</label>
                    	<input readonly id="timeto">
			
					     
					</div>
				</div>
				<div class="form-group">
		
					<div class="col-sm-9 container-fluid">
						<div>
													<label for="fethofficefee" >Office fee</label>
													<input readonly id="fethofficefee">
													</div>
													<div>
													<label for="fethtokenfee">Token Fee</label>
													<input readonly id="fethtokenfee">
													</div>
													<div>
													<label for="fethotherfee">Others Fee</label>
													<input readonly id="fethotherfee">
													</div>
													<div>
													<label for="grandtotal">Total</label>
													<input readonly id="grandtotal">
													</div>
											
					</div>
				</div>
			
				<div class="form-group">
				<label for="adjustdamount" class="col-sm-3 control-label"> Adjusted Amount:</label>
					<div class="col-sm-6">
                    	<input type="number" id="editamount" class="form-control" name="Repamount" required>
					</div>
				</div>
			
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat savepaymentadjust" name=""><i class="fa fa-save"> </i> submit </button>
            	</form>
          	</div>
			</div>
        </div>
    </div>
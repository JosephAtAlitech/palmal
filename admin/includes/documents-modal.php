<!-- Add Vehicle Documents-->
<div class="modal fade" id="addnewDocument">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Document</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="document-add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<div class="col-sm-6">
					<select class="form-control" id="vehicleNumber" name="vehicleNumber" required>
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
					<div class="col-sm-6">
					<select class="form-control" id="type" name="type" required>
						<option value="" selected>~~ Select Type ~~</option>
						<option value="regType">Registration</option>
						<option value="taxType">Tax Token</option>
						<option value="insuType">Insurance</option>
						<option value="RouteType">Route Permit</option>
						<option value="fitnessType">Fitness Certificate</option>
					</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Certificate:</label>
                    	<input type="file" id="certificate" class="form-control" name="certificate" placeholder=" Registration Cirtificate ">
						<span id="EditCirtificate"></span>
					</div>
					<div class="col-sm-2">
						<label class="">Start Date:</label>
                    	<input type="date" id="startDate" class="form-control" name="startDate" placeholder=" Registration Start Date ">
					</div>
					<div class="col-sm-2">
						<label class="">End Date:</label>
                    	<input type="date" id="endDate" class="form-control" name="endDate" placeholder=" Registration End Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Office Fee:</label>
                    	<input type="text" id="officeFee" class="form-control" name="officeFee" placeholder=" Fee ">
					</div>
					<div class="col-sm-2">
						<label class="">Token Fee:</label>
                    	<input type="text" id="tokenFee" class="form-control" name="tokenFee" placeholder=" Fee ">
					</div>
					
				</div>
				
				
				<button type="submit" class="btn btn-primary btn-flat" id="submit-button" name="addVehicleDocuments"><i class="fa fa-save"> </i> Add Document</button>
				
				<button type="submit" class="btn btn-primary btn-flat" id="update-button" name="updateVehicleDocuments"><i class="fa fa-save"> </i> Update Document</button>
				
				<table class="table">
					<thead>
						<th>Sl.</th>
						<th>Certificate</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Office Fee</th>
						<th>Token Fee</th>
						<th>Status</th>
						<th>Action</th>
					<thead>
					<tbody id="typeDetails"></tbody>
				</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Edit Vehicle -->
<div class="modal fade" id="EditVehicleDocuments">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Vehicle</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="document-edit.php" enctype="multipart/form-data">
          		<input type="hidden" id="editDocid" name="id">
				<div class="form-group">
					<div class="col-sm-6">
					<select class="form-control" id="EditVehicle_number" name="vehicleNumber" readonly>
						<?php
							  $sql = "SELECT id,vehicle_number FROM `vehicle_master` WHERE delete_status='No' ORDER BY `id`  DESC";
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
					<div class="col-sm-4">
						<label class="">Registration Certificate:</label>
                    	<input type="file" id="RegistrationCirtificate" class="form-control" name="RegistrationCirtificate" placeholder=" Registration Cirtificate ">
						<span id="RegistrationCirtificate12"></span>
					</div>
					<div class="col-sm-2">
						<label class="">Registration Start Date:</label>
                    	<input type="date" id="Editre_start_date" class="form-control" name="RegistrationStartDate" placeholder=" Registration Start Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Registration End Date:</label>
                    	<input type="date" id="Editre_end_date" class="form-control" name="RegistrationEndDate" placeholder=" Registration End Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Office Fee:</label>
                    	<input type="text" id="Editregoffice_fee" class="form-control" name="regOfficeFee" placeholder=" Fee ">
					</div>
					<div class="col-sm-2">
						<label class="">Token Fee:</label>
                    	<input type="text" id="Editregtoken_fee" class="form-control" name="regTokenFee" placeholder=" Fee ">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Tax Token:</label>
                    	<input type="file" id="TaxTokenCertificate" class="form-control" name="TaxTokenCirtificate" placeholder=" Registration Cirtificate ">
						<span id="EdittaxToken"></span>
					</div>
					<div class="col-sm-2">
						<label class="">Tax Token Start Date:</label>
                    	<input type="date" id="Edittat_start_date" class="form-control" name="TaxTokenStartDate" placeholder=" Registration Start Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Tax Token End Date:</label>
                    	<input type="date" id="Edittat_end_date" class="form-control" name="TaxTokenEndDate" placeholder=" Registration End Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Office Fee:</label>
                    	<input type="text" id="Edittaxoffice_fee" class="form-control" name="taxTokenOfficeFee" placeholder=" Fee ">
					</div>
					<div class="col-sm-2">
						<label class="">Token Fee:</label>
                    	<input type="text" id="Edittaxtoken_fee" class="form-control" name="taxTokenTokenFee" placeholder=" Fee ">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Insurance Certificate:</label>
                    	<input type="file" id="InsuranceCertificate" class="form-control" name="Insurancecertificate" placeholder=" Insurance certificate">
						<span id="Insurancecertificate12"></span>
					</div>
					<div class="col-sm-2">
						<label class="">Insurance Start Date:</label>
                    	<input type="date" id="Editins_start_date" class="form-control" name="InsuranceStartDate" placeholder=" Insurance Start Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Insurance End Date:</label>
                    	<input type="date" id="Editins_end_date" class="form-control" name="InsuranceEndDate" placeholder=" Insurance End Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Office Fee:</label>
                    	<input type="text" id="Editinsoffice_fee" class="form-control" name="insOfficeFee" placeholder=" Fee ">
					</div>
					<div class="col-sm-2">
						<label class="">Token Fee:</label>
                    	<input type="text" id="Editinstoken_fee" class="form-control" name="insTokenFee" placeholder=" Fee ">
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Route Permit Certificate:</label>
                    	<input type="file" id="PermitCirtificate" class="form-control" name="PermitCirtificate" placeholder=" Permit Cirtificate ">
						<span id="PermitCirtificate12"></span>
					</div>
					<div class="col-sm-2">
						<label class="">Route Permit Start Date:</label>
                    	<input type="date" id="Editrop_start_date" class="form-control" name="PermitStartDate" placeholder=" Permit Start Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Route Permit End Date:</label>
                    	<input type="date" id="Editrop_end_date" class="form-control" name="PermitEndDate" placeholder=" Permit End Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Office Fee:</label>
                    	<input type="text" id="Editroutoffice_fee" class="form-control" name="routOfficeFee" placeholder=" Fee ">
					</div>
					<div class="col-sm-2">
						<label class="">Token Fee:</label>
                    	<input type="text" id="Editrouttoken_fee" class="form-control" name="routTokenFee" placeholder=" Fee ">
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label class="">Fitness Certificate:</label>
                    	<input type="file" id="PollutionCirtificate" class="form-control" name="PollutionCirtificate" placeholder=" Pollution ">
						<span id="PollutionCirtificate12"></span>
					</div>
					<div class="col-sm-2">
						<label class="">Fitness Start Date:</label>
                    	<input type="date" id="Editfic_start_date" class="form-control" name="PollutionStartDate" placeholder=" Pollution Start Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Fitness End Date:</label>
                    	<input type="date" id="Editfic_end_date" class="form-control" name="PollutionEndDate" placeholder=" Pollution End Date ">
					</div>
					<div class="col-sm-2">
						<label class="">Office Fee:</label>
                    	<input type="text" id="Editfitoffice_fee" class="form-control" name="fitnessOfficeFee" placeholder=" Fee ">
					</div>
					<div class="col-sm-2">
						<label class="">Token Fee:</label>
                    	<input type="text" id="Editfittoken_fee" class="form-control" name="fitnessTokenFee" placeholder=" Fee ">
					</div>
				</div>
			
			
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-primary btn-flat" name="editVehicleDocument"><i class="fa fa-save"> </i> Update Documents </button>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Vehicle Delete -->
<div class="modal fade" id="deleteVehicle">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="vehicle-edit.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE VEHICLE NAME</p>
	                	<h2 id="deletvehicleNumber" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteVehicle"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
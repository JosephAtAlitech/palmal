<!-- Add Office expenses -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add New Office Expenses</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_form" method="POST" action="officeaddExpenses_add.php" enctype="multipart/form-data">
          		
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Account Head :</label>
                  	<div class="col-sm-9">
						<input type="text" id="AccountHead" class="form-control" name="AccountHead" placeholder=" Profit and Loss(Like Salaries, Rent, Electricity etc) " required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Amount :</label>
                  	<div class="col-sm-9">
						<input type="text" id="Amount" class="form-control" name="OfficeAmount" placeholder=" Enter Amount " required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Expenditure Type :</label>
                  	<div class="col-sm-9">
						<select class="form-control" id="" name="ExpenditureType" required>
							<option value="" selected>~~ Select Income OR Expenditure ~~</option>
							<option value="Income" >Income</option>
							<option value="Expenditure" >Expenditure</option>
							
						</select>
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Expenses Date :</label>
					<div class="col-sm-9">
                    	<input type="date" id="expensesName" class="form-control" name="ExpensesDate" required>
					</div>
				</div>
			
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="addOfficeExpense"><i class="fa fa-save"> </i> Add Office Expenses </button>
            	</form>
          	</div>
			</div>
        </div>
    </div>
</div>

<!-- Edit Office expenses -->
<div class="modal fade" id="editOfficeExp">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit added Office Expenses</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" id="contact_formEdit" method="POST" action="officeaddExpenses_add.php" enctype="multipart/form-data">
          		<input type="hidden" id="editid" name="id">
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Account Head :</label>
                  	<div class="col-sm-9">
						<input type="text" id="EditAccountHead" class="form-control" name="AccountHead" placeholder=" Profit and Loss(Like Salaries, Rent, Electricity etc) " required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Amount :</label>
                  	<div class="col-sm-9">
						<input type="text" id="Editamount" class="form-control" name="OfficeAmount" placeholder=" Enter Amount " required>
					</div>
					
				</div>
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Expenditure Type :</label>
                  	<div class="col-sm-9">
						<select class="form-control" id="Editacc_head_type" name="ExpenditureType" required>
							<option value="" selected>~~ Select Income OR Expenditure ~~</option>
							<option value="Income" >Income</option>
							<option value="Expenditure" >Expenditure</option>
							
						</select>
					</div>
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Expenses Date :</label>
					<div class="col-sm-9">
                    	<input type="date" id="Editexp_date" class="form-control" name="ExpensesDate" required>
					</div>
				</div>
			
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="EditOfficeExpense"><i class="fa fa-save"> </i> Add Office Expenses </button>
            	</form>
          	</div>
			</div>
        </div>
    </div>
</div>
<!-- Branch Delete -->
<div class="modal fade" id="deleteBranch">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="branch_update.php">
            		<input type="hidden" id="deletid" name="id">
            		<div class="text-center">
	                	<p>DELETE BRANCH NAME</p>
	                	<h2 id="deletbranch_name" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="deleteBranch"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Active Branch -->
<div class="modal fade" id="activeBranch">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Added Branch</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="branch_update.php" enctype="multipart/form-data">
          		
				<input type="hidden" id="activeid" name="id">
               
				
				<div class="form-group">
					<label for="categoryName" class="col-sm-3 control-label">Branch Name :</label>
                  	<div class="col-sm-9">
                    	<input type="text" id="activebranch_name" class="form-control" name="branchName" placeholder=" Write Branch Name " required>
					</div>
					
				</div>
				<div class="form-group">
				<label for="categoryName" class="col-sm-3 control-label">Branch Code :</label>
					<div class="col-sm-5">
                    	<input type="text" id="activebranch_code" class="form-control" name="branchCode" placeholder=" Write Branch Code " required>
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
            	<button type="submit" class="btn btn-primary btn-flat" name="activatedBranch"><i class="fa fa-save"> </i> Edit Branch</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
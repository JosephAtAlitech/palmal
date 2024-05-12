<div class="modal fade" id="adjustVehicleRequisitionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Requisition Adjustment</b></h4>
            </div>
            <div class="modal-body ">
                <form class="form-horizontal" id="adjustbuttonsubmit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="editid" name="editid">

                    <div class="form-group col-md-6">
                        <label> Vehicle Number :</label>
                            <input class="form-control" readonly id="editvehicle_no" name="editvehicle_no">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Document time :</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="timefrom" class="control-label">From :</label>
                                <input class="form-control" readonly id="doctimefrom" name="doctimefrom">
                            </div>
                            <div class="col-sm-6">
                                <label for="timeto" class="control-label">To :</label>
                                <input class="form-control" readonly id="timeto" name="timeto">
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="adjustdamount" class="col-sm-3 control-label">Office fee :</label>
                        <div class="col-md-4">
                            <input class="form-control" readonly id="fethofficefee" name="fethofficefee">
                        </div>
                    </div>
                    <div class=" form-group">
                        <label for="adjustdamount" class="col-sm-3 control-label">Token Fee :</label>
                        <div class="col-md-4">
                            <input class="form-control" readonly id="fethtokenfee" name="fethtokenfee">
                        </div>
                    </div>
                    <div class=" form-group">
                        <label for="adjustdamount" class="col-sm-3 control-label">Others Fee :</label>
                        <div class="col-md-4">
                            <input class="form-control" readonly id="fethotherfee" name="fethotherfee">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adjustdamount" class="col-sm-3 control-label">Total :</label>
                        <div class="col-md-4">
                            <input class="form-control" readonly id="grandtotal" name="grandtotal">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adjustdamount" class="col-sm-3 control-label"> Adjusted Amount:</label>
                        <div class="col-sm-4">
                            <input type="number" id="editamount" class="form-control" name="editamount" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adjustdamount" class="col-sm-3 control-label"> Payment Type:</label>
                        <div class="col-sm-4">
                            <select id="payment_type" class="form-control" name="payment_type">
                                <option value="payment">Payment</option>
                                <option value="paymentReceived">Payment Received</option>
                            </select>
                        </div>
                    </div>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat " name="savepaymentadjust"><i class="fa fa-save">
                    </i> submit </button>
                </form>
            </div>
        </div>
    </div>
</div>
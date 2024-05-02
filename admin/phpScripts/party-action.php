<?php
$conPrefix = '../';
include $conPrefix . 'includes/session.php';
$Date = (new DateTime())->format("Y-m-d H:i:s");
$loginID = $_SESSION['admin'];

$toDay = (new DateTime())->format("Y-m-d H:i:s");



if (isset($_POST['action'])) {
    $action = $_POST['action'];
    // Update Customer or Supplier
    if ($action == "saveCustomerSupplier") {


        $AddTblType = $_POST['TblType'];
        $AddCustomer = $_POST['CustomerName'];
        $AddEmailAddress = $_POST['EmailAddress'];
        $AddContactPerson = $_POST['ContactPerson'];
        $vendorType = $_POST['vendorType'];
        $AddPhoneNumber = $_POST['PhoneNumber'];
        $AddaltPhoneNumber = $_POST['altPhoneNumber'];
        $AddCountryName = $_POST['CountryName'];
        $AddCityName = $_POST['CityName'];
        $AddlocationArea = $_POST['LocationArea'];
        $AddCustomerType = $_POST['CustomerType'];
        $AddCustomerStatus = $_POST['CustomerStatus'];
        $AddAddress = $_POST['Address'];
        $partyCode = 0;

        $sql = "SELECT LPAD(max(partyCode)+1, 6, 0) as partyCode from tbl_party";
		$query = $conn->query($sql);
		while ($prow = $query->fetch_assoc()) {
			$partyCode = $prow['partyCode'];
		}
		if($partyCode == ""){
		    $partyCode = "000001";
		}

        try {
            $conn->begin_transaction();
            $sql = "INSERT INTO tbl_party (partyName, tblCountry, tblCity, locationArea, partyAddress, vendor_type, partyCode, partyType, contactPerson, partyPhone, partyAltPhone, partyEmail, remarks, status, tblType, createdDate, createdBy) 
                        VALUES ('$AddCustomer','$AddCountryName','$AddCityName','$AddlocationArea','$AddAddress','$vendorType','$partyCode','$AddCustomerType','$AddContactPerson','$AddPhoneNumber','$AddaltPhoneNumber','$AddEmailAddress','Test','Active','Suppliers','$toDay','$loginID')";

            $query = $conn->query($sql);
            if ($query) {
                $conn->commit();
                echo json_encode('success');
            } else {
                $conn->rollback();
                echo json_encode($conn->error . $sql);
            }
        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }

    }
    // Update Customer or Supplier
    else if ($action == "updateCustomerSupplier") {
        $AddTblType = $_POST['TblType'];
        $TblUid = $_POST['TblUid'];
        $AddCustomer = $_POST['CustomerName'];
        $AddEmailAddress = $_POST['EmailAddress'];
        $AddContactPerson = $_POST['ContactPerson'];
        $AddPhoneNumber = $_POST['PhoneNumber'];
        $AddaltPhoneNumber = $_POST['altPhoneNumber'];
        $AddCountryName = $_POST['CountryName'];
        $AddCityName = $_POST['CityName'];
        $AddLocationArea = $_POST['LocationArea'];
        $AddCustomerType = $_POST['CustomerType'];
        $AddCustomerStatus = $_POST['CustomerStatus'];
        $AddCreditLimit = $_POST['CreditLimit'];
        $AddAddress = $_POST['Address'];
        $CustomerSalesType = $_POST['CustomerSalesType'];

        $partyCode = 0;
        try {
            $conn->begin_transaction();
            $sql = "UPDATE tbl_party set partyName='$AddCustomer',tblCountry='$AddCountryName',tblCity='$AddCityName',locationArea='$AddLocationArea',partyAddress='$AddAddress',partyCode='$partyCode',partyType='$AddCustomerType',contactPerson='$AddContactPerson',partyPhone='$AddPhoneNumber',partyAltPhone='$AddaltPhoneNumber',partyEmail='$AddEmailAddress',remarks='',status='$AddCustomerStatus',tblType='$AddTblType',userType='',lastUpdatedDate='$toDay',lastUpdatedBy='$loginID' where id='$TblUid'";
            $query = $conn->query($sql);
            if ($query) {
                $conn->commit();
                echo json_encode('success');
            } else {
                $conn->rollback();
                echo json_encode($conn->error . $sql);
            }
        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
    } 
    else if ($action == 'getPartyRow') {
        $id = $_POST['id'];
       // $partyType = $_POST['type'];
        $sql = "SELECT * FROM tbl_party WHERE id = $id";
        
        
        $query = $conn->query($sql);
        if($query){
            $row = $query->fetch_assoc();
            echo json_encode($row);
        }else{
            echo json_encode($conn->error);
        }
       
    }
    else if ($action == 'openingDue') {
        $id = $_GET['id'];
        $sql = "SELECT id,partyName,tblCountry,tblCity,locationArea,partyAddress,partyType,contactPerson,partyPhone,partyAltPhone,partyEmail,remarks,status,creditLimit,tblType,customerSalesType,
                party_name_bangla,contact_person_bangla,contact_number_bangla,location_bangla,party_address_bangla, opening_due
                FROM tbl_party WHERE id = '$id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        echo json_encode($row);
    }
    else if ($action == 'UpdateOpeningDue') {
        $partyId = $_POST['partyId'];
        //$party = Party::find($request->partyId);
        $sql = "SELECT * FROM `tbl_party` WHERE id='$partyId' AND status='Active'";
        $result = $conn->query($sql);
        $i = 1;
        $output = array('data' => array());
        while ($row = $result->fetch_array()) {
            $partyName = $row['id'];
            $tblType = $row['tblType'];
        }


        $openingDue = floatval($_POST['openingDue']);
        $dueType = $_POST['dueType'];


        $sql = "SELECT LPAD(IFNULL(max(voucherNo),0)+1, 6, 0) as voucherCode FROM tbl_paymentVoucher WHERE tbl_partyId='$partyName' AND customerType = '$tblType'";
        $query = $conn->query($sql);
        while ($prow = $query->fetch_assoc()) {
            $voucherNo = $prow['voucherCode'];
        }
        if ($voucherNo == "") {
            $voucherNo = "000001";
        }

        if ($tblType == 'Customers') {
            if ($dueType == 'due') {

                $sql = "UPDATE `tbl_party` SET `opening_due` = '$openingDue' WHERE `tbl_party`.`id` = '$partyId'";

                if ($conn->query($sql)) {

                    $sql = "INSERT INTO tbl_paymentVoucher(tbl_partyId, amount, entryBy, paymentMethod, paymentDate, type, remarks, voucherType, voucherNo,entryDate) 
                           VALUES ('$partyName','$openingDue','$loginID','Cash','$toDayDate','partyPayable','Voucher Entry Opening Due','PartySale','$voucherNo','$toDay')";
                    $conn->query($sql);
                    echo json_encode('Success');
                }
            } else {
                $sql = "UPDATE `tbl_party` SET `opening_due` = '-$openingDue' WHERE `tbl_party`.`id` = '$partyId'";

                if ($conn->query($sql)) {

                    $sql = "INSERT INTO tbl_paymentVoucher(tbl_partyId, amount, entryBy, paymentMethod, paymentDate, type, remarks, voucherType, voucherNo,entryDate) 
                VALUES ('$partyName','$openingDue','$loginID','Cash','$toDayDate','paymentReceived','Voucher Entry Opening Due','PartySale','$voucherNo','$toDay')";
                    $conn->query($sql);
                    echo json_encode('Success');
                }
            }
        } else {
            if ($dueType == 'due') {
                $sql = "UPDATE `tbl_party` SET `opening_due` = '$openingDue' WHERE `tbl_party`.`id` = '$partyId'";

                if ($conn->query($sql)) {

                    $sql = "INSERT INTO tbl_paymentVoucher(tbl_partyId, amount, entryBy, paymentMethod, paymentDate, type, remarks, voucherType, voucherNo,entryDate) 
                VALUES ('$partyName','$openingDue','$loginID','Cash','$toDayDate','payable','Voucher Entry Opening Due','Local Purchase','$voucherNo','$toDay')";
                    $conn->query($sql);
                    echo json_encode('Success');
                }
            } else {
                $sql = "UPDATE `tbl_party` SET `opening_due` = '-$openingDue' WHERE `tbl_party`.`id` = '$partyId'";

                if ($conn->query($sql)) {

                    $sql = "INSERT INTO tbl_paymentVoucher(tbl_partyId, amount, entryBy, paymentMethod, paymentDate, type, remarks, voucherType, voucherNo,entryDate) 
                VALUES ('$partyName','$openingDue','$loginID','Cash','$toDayDate','payment','Voucher Entry Opening Due','Local Purchase','$voucherNo','$toDay')";
                    $conn->query($sql);
                    echo json_encode('Success');
                }
            }

        }
    }else if ($action == 'deleteParty') {
        $id = $_POST['id'];
       // $partyType = $_POST['type'];
        $sql = "UPDATE  tbl_party set deleted = 'Yes' WHERE id = $id";

        $query = $conn->query($sql);
        if($query){
           
            echo json_encode('success');
        }else{
            echo json_encode($conn->error);
        }
       
    }

} else {

    $sql = "SELECT `id`,`partyName`,`partyAddress`,`partyCode`,`contactPerson`,tblCity,locationArea,`partyPhone`,partyAltPhone,`partyEmail`,`status`,`creditLimit`,`tblType`,customerSalesType,`userType`,createdDate,lastUpdatedDate,
    party_name_bangla,contact_person_bangla,contact_number_bangla,location_bangla,party_address_bangla,opening_due FROM `tbl_party` 
    WHERE (tblType<>'Customers' AND tblType<>'Investor' AND tblType<>'Employee') AND deleted='No' ORDER BY id DESC";

    $result = $conn->query($sql);
    $output = array('data' => array());
   // if ($result->num_rows > 0) {
        $unitStatus = "";
        $i = 1;
        while ($row = $result->fetch_array()) {
            $unitId = $row['id'];
            // active 
            if ($row['status'] == 'Active') {
                // activate status
                $unitStatus = "<label class='label label-success'>" . $row['status'] . "</label>";
            } else {
                // deactivate status
                $unitStatus = "<label class='label label-danger'>" . $row['status'] . "</label>";
            }
            $action =  '<div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                         <i class="fa fa-gear tiny-icon"></i>  <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                                <li><a onclick="editCustomerSupplier(' . $row['id'] . ')"><i class="fa fa-edit"></i> Edit</a></li>
                                <li><a class="btn" onclick="confirmDelete(' . $row['id'] . ')" ><i class="fa fa-edit"></i> Delete </a></li>
                            </ul> 
                        </div>';
            $output['data'][] = array(
                $i++,
                $row['createdDate'] ,
                $row['partyName'],
                $row['contactPerson'],
                '<div style="text-align:center;">' . $row['partyPhone'] . '<br>' . $row['partyAltPhone'] . '</div>',
                $row['tblCity'],
                $row['locationArea'],
                $unitStatus ,
                $action
            );
        } // /while 
   // }// if num_rows

    $conn->close();

    echo json_encode($output);
}


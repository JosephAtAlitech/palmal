<?php
$conPrefix = '../';
include $conPrefix . 'includes/session.php';
$Date = (new DateTime())->format("Y-m-d H:i:s");
$loginID = $_SESSION['admin'];

$toDay = (new DateTime())->format("Y-m-d H:i:s");



if (isset($_POST['action'])) {
    $action = $_POST['action'];
    // Update Customer or Supplier
    if ($action == "savePoliceExp") {


        $vehicle = $_POST['vehicle'];
        $driver_id = $_POST['driver_id'];
        $branch_id = $_POST['branch_id'];
        $case_id = $_POST['case_id'];
        $receptable_amount = $_POST['receptable_amount'];
        $non_receptable_amount = $_POST['non_receptable_amount'];
        $total_amount = $receptable_amount + $non_receptable_amount;
        $settle_date = $_POST['settle_date'];
        $reason = $_POST['reason'];
        $remarks = $_POST['remarks'];



        try {
            $conn->begin_transaction();
            $sql = "INSERT INTO tbl_traffic_case_exp (vehicle_id, branch_id, driver_id, case_id, receptable_amount, non_receptable_amount, total_amount, occurrence_date, reason, remarks, created_date, created_by) 
                        VALUES ('$vehicle','$branch_id','$driver_id','$case_id','$receptable_amount','$non_receptable_amount','$total_amount','$settle_date','$reason','$remarks','$toDay','$loginID')";

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
    else if ($action == "updatePoliceExpanse") {
        $id = $_POST['id'];

        $vehicle = $_POST['vehicle'];
        $driver_id = $_POST['driver_id'];
        $branch_id = $_POST['branch_id'];
        $case_id = $_POST['case_id'];
        $receptable_amount = $_POST['receptable_amount'];
        $non_receptable_amount = $_POST['non_receptable_amount'];
        $total_amount = $receptable_amount + $non_receptable_amount;
        $settle_date = $_POST['settle_date'];
        $reason = $_POST['reason'];
        $remarks = $_POST['remarks'];


        try {
            $conn->begin_transaction();
            $sql = "UPDATE tbl_traffic_case_exp set vehicle_id='$vehicle',branch_id='$branch_id',driver_id='$driver_id',case_id='$case_id',receptable_amount='$receptable_amount',non_receptable_amount='$non_receptable_amount',total_amount='$total_amount',occurrence_date='$settle_date',reason='$reason',remarks='$remarks',updated_date='$toDay',updated_by='$loginID' where id='$id'";
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
    } else if ($action == 'getExpenseRow') {
        $id = $_POST['id'];
        $sql = "SELECT tbl_traffic_case_exp.*,  driver_master.id as d_id,driver_master.driver_name ,vehicle_master.vehicle_number ,vehicle_master.employee_name, branch_master.id as b_id, branch_master.branch_name FROM `tbl_traffic_case_exp` 
        inner join vehicle_master on tbl_traffic_case_exp.vehicle_id = vehicle_master.id 
        left outer join driver_master on vehicle_master.driver_id = driver_master.id 
        left outer join branch_master on vehicle_master.branch_status = branch_master.id 
        WHERE  tbl_traffic_case_exp.deleted='No' AND tbl_traffic_case_exp.id = $id";


        $query = $conn->query($sql);
        if ($query) {
            $row = $query->fetch_assoc();
            echo json_encode($row);
        } else {
            echo json_encode($conn->error);
        }

    } else if ($action == 'getVehicleInfo') {
        $vehicle = '0';
        if (isset($_POST['vehicle'])) {
            $vehicle = $_POST['vehicle'];
        }

        if ($vehicle == '0') {
            echo json_encode("");
            return;
        } else {
            $sql = "SELECT vehicle_master.vehicle_number ,vehicle_master.employee_name, driver_master.driver_name ,driver_master.id as d_id, branch_master.branch_name , branch_master.id as b_id  FROM vehicle_master
            left outer join driver_master on vehicle_master.driver_id = driver_master.id 
            left outer join branch_master on vehicle_master.branch_status = branch_master.id 
            WHERE vehicle_master.id = $vehicle";

            $query = $conn->query($sql);
            if ($query) {
                $row = $query->fetch_assoc();
                echo json_encode($row);
            } else {
                echo json_encode($conn->error);
            }
        }

    } else if ($action == 'deleteExp') {
        $id = $_POST['id'];

        $sql = "UPDATE  tbl_traffic_case_exp set deleted = 'Yes' WHERE id = $id";

        $query = $conn->query($sql);
        if ($query) {
            echo json_encode('success');
        } else {
            echo json_encode($conn->error);
        }
    }
    else if ($action == 'extractDate') {
        $yearMonth = $_POST["monthAndYear"];
        // $selectedDate = new DateTime($yearMonth); // Create DateTime object from selected value
        // $year = $selectedDate->format('Y');
        // $month = $selectedDate->format('m');
        echo json_encode($yearMonth);
    }
} else {

    $sql = "SELECT tbl_traffic_case_exp.*,  driver_master.id as d_id,driver_master.driver_name ,vehicle_master.vehicle_number ,vehicle_master.employee_name, branch_master.id as b_id, branch_master.branch_name FROM `tbl_traffic_case_exp` 
            inner join vehicle_master on tbl_traffic_case_exp.vehicle_id = vehicle_master.id 
            left outer join driver_master on vehicle_master.driver_id = driver_master.id 
            left outer join branch_master on vehicle_master.branch_status = branch_master.id 
            WHERE  tbl_traffic_case_exp.deleted='No' ORDER BY tbl_traffic_case_exp.id DESC";

    $result = $conn->query($sql);
    $output = array('data' => array());

    $i = 1;
    while ($row = $result->fetch_array()) {

        $action = '<div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                         <i class="fa fa-gear tiny-icon"></i>  <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                                <li><a onclick="editExp(' . $row['id'] . ')"><i class="fa fa-edit"></i> Edit</a></li>
                                <li><a class="btn" onclick="confirmDelete(' . $row['id'] . ')" ><i class="fa fa-edit"></i> Delete </a></li>
                            </ul> 
                        </div>';
        $output['data'][] = array(
            $i++,
            $row['vehicle_number'],
            $row['driver_name'],
            $row['branch_name'],
            $row['employee_name'],
            $row['case_id'],
            $row['receptable_amount'],
            $row['non_receptable_amount'],
            $row['total_amount'],
            $row['occurrence_date'],
            $row['reason'],
            $row['remarks'],
            $action
        );
    } //while 

    $conn->close();

    echo json_encode($output);
}


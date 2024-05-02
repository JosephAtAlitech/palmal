<?php
$conPrefix = '../';
include $conPrefix . 'includes/session.php';
$Date = (new DateTime())->format("Y-m-d H:i:s");
$loginID = $_SESSION['admin'];

if (isset($_POST["Action"])) {
    if ($_POST["Action"] == "warehouseAdd") {
        $Name = $_POST["warehouseName"];
        $address = $_POST["address"];
        $type = $_POST["warehouse_type"];
        $position_type = $_POST["position_type"];
   
        try {
            $conn->begin_transaction();
     
           $sql = "INSERT INTO tbl_warehouse (wareHouseName, wareHouseAddress,type, position_type, status, created_by, created_date) 
				   VALUES ('$Name', '$address', '$type','$position_type', 'Active', '$loginID','$Date')";
            $query = $conn->query($sql);
            if ($query) {
                $conn->commit();
                echo 'success';
            } else {
                $conn->rollback();
                echo json_encode($conn->error . $sql);
            }
        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
    } else if ($_POST["Action"] == "updateWatehouse") {
        $id = $_POST["id"];
        $warehouseName = $_POST["warehouseName"];
        $address = $_POST["address"];
        $warehouse_type = $_POST["warehouse_type"];
        $status = $_POST["status"];
        $position_type = $_POST["position_type"];
      
        try {
            $conn->begin_transaction();

            $sql = "UPDATE tbl_warehouse SET wareHouseName = '$warehouseName' , wareHouseAddress = '$address' ,type = '$warehouse_type' , position_type = '$position_type' , status = '$status' WHERE tbl_warehouse.id = $id";
            $query = $conn->query($sql);

            $conn->commit();
            echo 'success';

        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
        $conn->close();
        
    } else if ($_POST["Action"] == "getWarehouseRow") {

        $id = $_POST["id"];
        
        $sql = "SELECT tbl_warehouse.* from tbl_warehouse 
                where tbl_warehouse.deleted ='No' and tbl_warehouse.id = $id";
        $query = $conn->query($sql);
        if ($query) {
            $row = $query->fetch_assoc();
            echo json_encode($row);
        } else {
            echo json_encode($conn->error . $sql);
        }
    }else if($_POST["Action"] == "checkAvailability"){
        $name = $_POST['name'];
        $sql = "SELECT id FROM tbl_warehouse where deleted='No' and wareHouseName='$name'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        if($row>0) {
            echo "Already used";
        }else{
        	  echo "Available";
        }
    } 
    
    else if ($_POST["Action"] == "deleteWarehouse") {
        $id = $_POST["id"];
      
      
        try {
            $conn->begin_transaction();

            $sql = "UPDATE tbl_warehouse SET deleted = 'Yes'  WHERE tbl_warehouse.id = $id";
            $query = $conn->query($sql);

            $conn->commit();
            echo json_encode('success');

        } catch (Exception $e) {
            $conn->rollback();
            echo $conn->error . $e;
        }
        $conn->close();
    }
} else {
    $sql = "SELECT tbl_warehouse.* FROM `tbl_warehouse`
    	 where tbl_warehouse.deleted = 'No' ORDER BY id  DESC";
    $query = $conn->query($sql);
    $i = 1;
    $output = array('data' => array());
   
    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $status = $row['status'];
        $button = ' <div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-gear tiny-icon"></i>  <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                    <li><a href="#" onclick="editWarehouse(' . $id . ')"><i class="fa fa-edit"></i> Edit Warehouse</a></li>
       
                    <li><a href="#" onclick="confirmDelete(' . $id . ')"><i class="fa fa-trash"></i> Delete</a></li>
                </ul>
                </div>';
        if ($status == 'Pending') {
            $badge = '<span class="label label-info">' . $status . '</span>';
        } else {
            $badge = '<span class="label label-default">' . $status . '</span>';
        }
        $output['data'][] = array(
            $i++,
            $row['wareHouseName'],
            $row['wareHouseAddress'] ,
            $row['type'] ,
            $status = $row['status'],
            $button
        );
    }
    echo json_encode($output);
}

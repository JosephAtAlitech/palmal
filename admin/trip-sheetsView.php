<?php include 'includes/session.php';

date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime())->format("m/d/Y H:i:s");
$toDayTime = date('m/d/Y h:i:s A', strtotime($toDay));
$previousDate = date('Y-m-d', strtotime('-1 days')).'08:00:00';

/*
date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime())->format("m/d/Y H:i:s");
$toDayTime = date('m/d/Y h:i:s A', strtotime($toDay));
$previousDate = date('Y-m-d', strtotime('-1 days')).'08:00:00';
*/

/*if($_SESSION['admin'] == "1") { 
		if($_GET['sortData'] == "0,0")
		{			
		$sql = "SELECT trip_sheets.id,trip_sheets.create_date,trip_sheets.trip_number,trip_sheets.vehicle_no,trip_sheets.vft_vehicle_no,vehicle_master.vehicle_number,trip_sheets.from_location,trip_sheets.to_location,trip_sheets.tc_number,
				trip_sheets.bags,trip_sheets.weight,trip_sheets.rate_per_ton,trip_sheets.freight_amount,trip_sheets.party_id,trip_sheets.driver_id,trip_sheets.travel_distance,trip_sheets.vft_km,
				trip_sheets.fuel_issue,trip_sheets.vft_fuel,trip_sheets.trip_advance,trip_sheets.supervisor_id,supervisor_master.supervisor_name,trip_sheets.trip_start_date,trip_sheets.trip_end_date
				FROM `trip_sheets` 
				LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
				LEFT JOIN supervisor_master ON supervisor_master.id=trip_sheets.supervisor_id
				WHERE trip_sheets.status!='In-Active' AND trip_sheets.create_date BETWEEN '".$dates[0]."' AND '".$dates[1]."' ORDER BY trip_sheets.id  DESC";
		}else{
			$dates = explode(",",$_GET['sortData']);
			$sql = "SELECT trip_sheets.id,trip_sheets.create_date,trip_sheets.trip_number,trip_sheets.vehicle_no,trip_sheets.vft_vehicle_no,vehicle_master.vehicle_number,trip_sheets.from_location,trip_sheets.to_location,trip_sheets.tc_number,
				trip_sheets.bags,trip_sheets.weight,trip_sheets.rate_per_ton,trip_sheets.freight_amount,trip_sheets.party_id,trip_sheets.driver_id,trip_sheets.travel_distance,trip_sheets.vft_km,
				trip_sheets.fuel_issue,trip_sheets.vft_fuel,trip_sheets.trip_advance,trip_sheets.supervisor_id,supervisor_master.supervisor_name,trip_sheets.trip_start_date,trip_sheets.trip_end_date
				FROM `trip_sheets` 
				LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
				LEFT JOIN supervisor_master ON supervisor_master.id=trip_sheets.supervisor_id
				WHERE trip_sheets.status!='In-Active' AND trip_sheets.chalan_date BETWEEN '".$dates[0]."' AND '".$dates[1]."'
				ORDER BY trip_sheets.id  DESC";
		}
	/*} 
	else{
	    $dates = explode(",",$_GET['sortData']);
	    $sql = "SELECT trip_sheets.id,trip_sheets.create_date,trip_sheets.trip_number,trip_sheets.vehicle_no,trip_sheets.vft_vehicle_no,vehicle_master.vehicle_number,trip_sheets.from_location,trip_sheets.to_location,trip_sheets.tc_number,
				trip_sheets.bags,trip_sheets.weight,trip_sheets.rate_per_ton,trip_sheets.freight_amount,trip_sheets.party_id,trip_sheets.driver_id,trip_sheets.travel_distance,trip_sheets.vft_km,
				trip_sheets.fuel_issue,trip_sheets.vft_fuel,trip_sheets.trip_advance,trip_sheets.supervisor_id,supervisor_master.supervisor_name,trip_sheets.trip_start_date,trip_sheets.trip_end_date
				FROM `trip_sheets` 
				LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
				LEFT JOIN supervisor_master ON supervisor_master.id=trip_sheets.supervisor_id
				WHERE trip_sheets.createdBy='".$_SESSION['admin']."' and trip_sheets.status!='In-Active' AND trip_sheets.chalan_date BETWEEN '".$dates[0]."' AND '".$dates[1]."'
				ORDER BY `trip_sheets`.`trip_number`  DESC";
	} 
   

*/

        $sql="SELECT id,branch_id FROM `admin` WHERE id='".$_SESSION['admin']."' AND deleted='On'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_array()) {
            $BraId=$row['branch_id'];
        }
        

	if($_SESSION['admin'] == "1") {
		$dates = explode(",",$_GET['sortData']);
		$sql = "SELECT trip_sheets.id,trip_sheets.create_date,trip_sheets.trip_number,branch_master.branch_name,trip_sheets.vehicle_no,trip_sheets.vft_vehicle_no,vehicle_master.vehicle_number,trip_sheets.from_location,trip_sheets.to_location,trip_sheets.tc_number,
				trip_sheets.bags,trip_sheets.weight,trip_sheets.rate_per_ton,trip_sheets.freight_amount,trip_sheets.party_id,trip_sheets.driver_id,trip_sheets.travel_distance,trip_sheets.vft_km,
				trip_sheets.fuel_issue,trip_sheets.vft_fuel,trip_sheets.trip_advance,trip_sheets.supervisor_id,supervisor_master.supervisor_name,trip_sheets.trip_start_date,trip_sheets.trip_end_date
				FROM `trip_sheets` 
				LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
				LEFT JOIN supervisor_master ON supervisor_master.id=trip_sheets.supervisor_id
                LEFT JOIN branch_master ON branch_master.id=trip_sheets.from_location
				WHERE trip_sheets.status!='In-Active' AND trip_sheets.create_date BETWEEN '".$dates[0]."' AND '".$dates[1]."' ORDER BY trip_sheets.id  DESC";
	}else{
	    $dates = explode(",",$_GET['sortData']);
		$sql = "SELECT trip_sheets.id,trip_sheets.create_date,trip_sheets.trip_number,branch_master.branch_name,trip_sheets.vehicle_no,trip_sheets.vft_vehicle_no,vehicle_master.vehicle_number,trip_sheets.from_location,trip_sheets.to_location,trip_sheets.tc_number,
				trip_sheets.bags,trip_sheets.weight,trip_sheets.rate_per_ton,trip_sheets.freight_amount,trip_sheets.party_id,trip_sheets.driver_id,trip_sheets.travel_distance,trip_sheets.vft_km,
				trip_sheets.fuel_issue,trip_sheets.vft_fuel,trip_sheets.trip_advance,trip_sheets.supervisor_id,supervisor_master.supervisor_name,trip_sheets.trip_start_date,trip_sheets.trip_end_date
				FROM `trip_sheets` 
				LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
				LEFT JOIN supervisor_master ON supervisor_master.id=trip_sheets.supervisor_id
                LEFT JOIN branch_master ON branch_master.id=trip_sheets.from_location
				WHERE trip_sheets.from_location='".$BraId."' and trip_sheets.status!='In-Active' AND trip_sheets.create_date BETWEEN '".$dates[0]."' AND '".$dates[1]."' ORDER BY trip_sheets.id  DESC";
	}
					
    $result = $conn->query($sql);
	
    $i=1;
    $output = array('data' => array());
    while ($row = $result->fetch_array()) {
       if($row['travel_distance'] != ''){
           $travelDistance = 'Travel : '.$row['travel_distance'].' Km';
        }else{
           $travelDistance='';  
        }
        if($row['vft_km'] != ''){
          $vftKm = 'VFT : '.$row['vft_km'].' Km';
        }else{
          $vftKm = '';
        }
        if($row['fuel_issue'] !=''){
            $fuel_issue = 'Fuel : '.$row['fuel_issue'].' L';
        }else{
            $fuel_issue = '';
        }
        if($row['vft_fuel'] != ''){
            $vft_fuel = 'VFT : '.$row['vft_fuel']. ' L';
        }else{
            $vft_fuel = '';
        }
        if($row['trip_start_date'] !=''){
            $trip_start_date = 'TrS : '.$row['trip_start_date'];
        }else{
            $trip_start_date = '';
        }
        if($row['trip_end_date'] !=''){
            $trip_end_date ='TrE : '.$row['trip_end_date'];
        }else{
            $trip_end_date ='';
        }
        /*
            //$travelDistance.'<br>'.$vftKm,
            //$fuel_issue.'<br>'.$vft_fuel,
            //$trip_start_date.'<br>'.$trip_end_date,
        */
        $button = '	<div class="btn-group">
						<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-gear tiny-icon"></i>  <span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
						    <li><a  href="#" onclick="EditTripSheet(\''.$row['id'].'\')" ><i class="fa fa-edit"></i>Edit Trip Sheet</a></li>
						    <li><a  href="#" onclick="deleteTrip(\''.$row['id'].'\')" ><i class="fa fa-trash"></i> Delete Trip </a></li>
						';
						if($_SESSION['admin'] == "1"){					
							
						}
		$button .=	    '</ul>
					</div>';
        $output['data'][] = array(
            $i++,
            $row['create_date'],
            $row['trip_number'].'<br>'.$row['branch_name'],
            $row['vehicle_number'].'<br>VFT ID :'.$row['vft_vehicle_no'],
            $travelDistance.'<br>'.$vftKm,
            $fuel_issue.'<br>'.$vft_fuel,
            $trip_start_date.'<br>'.$trip_end_date,
            $button
        );
    } // /while 
    echo json_encode($output);    

?>
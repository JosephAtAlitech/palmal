<?php include 'includes/session.php'; ?>
<style>
    .sclass1{text-align: right;}
</style>
<?php
if(isset($_POST['startDate']))
//if(isset($_POST['EmpName']))
{
	$vehicleNumber=$_POST['cName'];
	$fName=$_POST['fName'];
	$Ds=$_POST['startDate'];
	$De=$_POST['endtDate'];
	//$EmpName=$_POST['EmpName'];
?>
	<br><br>
	<table class="table table-bordered">
                <thead>
				<tr style="background: #3f3e93;color: white;">
					<th class="hidden"></th>
					<th>id</th>
					<th>Vehecle Number</th>
					<th>Trip Number</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Estimated KM</th>
					<th>VFT KM</th>
					<th>Fuel Issue</th>
					<th>VFT Issue</th>
				</tr>
                </thead>
                <tbody>
                  <?php
					if($vehicleNumber!=''){
						$sql = "SELECT trip_sheets.id,trip_sheets.trip_number,trip_sheets.vehicle_no,vehicle_master.vehicle_number,vehicle_master.branch_status,trip_sheets.travel_distance,trip_sheets.fuel_issue,trip_sheets.vft_km,
								trip_sheets.vft_fuel,trip_sheets.trip_start_date,trip_sheets.trip_end_date
								FROM `trip_sheets`
								LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no AND vehicle_master.delete_status='Active'
								WHERE trip_sheets.vehicle_no='".$vehicleNumber."' AND vehicle_master.branch_status='".$fName."' AND trip_sheets.create_date BETWEEN '".$Ds."' AND '".$De."'
								ORDER BY `trip_sheets`.`id`  DESC";
                    }
					else{
						$sql = "SELECT trip_sheets.id,trip_sheets.trip_number,trip_sheets.vehicle_no,vehicle_master.vehicle_number,vehicle_master.branch_status,trip_sheets.travel_distance,trip_sheets.fuel_issue,trip_sheets.vft_km,
								trip_sheets.vft_fuel,trip_sheets.trip_start_date,trip_sheets.trip_end_date
								FROM `trip_sheets`
								LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no AND vehicle_master.delete_status='Active'
								WHERE vehicle_master.branch_status='".$fName."' AND trip_sheets.create_date BETWEEN '".$Ds."' AND '".$De."'
								ORDER BY `trip_sheets`.`id`  DESC";
						
					}
					$query = $conn->query($sql);
					$idNo=1;
					$totalTravel=0;
					$totalvftkm=0;
					$totalfuelissue=0;
					$totalvftfuel=0;
                    while($row = $query->fetch_assoc()){
						$totalTravel+=floatval($row['travel_distance']);
						$totalvftkm+=floatval($row['vft_km']);	
						$totalfuelissue+=floatval($row['fuel_issue']);
						$totalvftfuel+=floatval($row['vft_fuel']);
						
						if($row['fuel_issue']==''){
						    $fuel_issue=0;
						    $vft_fuel=0;
						}else{
						    $fuel_issue=floatval($row['fuel_issue']);
						    $vft_fuel=floatval($row['vft_fuel']);
						}
					
						
                      echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$idNo++."</td>
							<td>".$row['vehicle_number']."</td>
							<td>".$row['trip_number']."</td>
							<td>".$row['trip_start_date']."</td>
							<td>".$row['trip_end_date']."</td>
							<td class='sclass1'>".$row['travel_distance']." km</td>
							<td class='sclass1'>".floatval($row['vft_km'])." Km</td>
							<td class='sclass1'>".$fuel_issue." L</td>
							<td class='sclass1'>".$vft_fuel." L</td>
						</tr>
						";
                    }
					echo "
					<tr><td></td><td></td><td></td><td></td><td>Total</td><td class='sclass1'>".$totalTravel." km</td><td class='sclass1'>".$totalvftkm." km</td><td class='sclass1'>".$totalfuelissue." L</td><td class='sclass1'>".$totalvftfuel." L</td></tr>
					
					<a href='vehicleWiseCostingViewPdf.php?vId=".$vehicleNumber."&ds=".$Ds."&de=".$De."' target='_blank' title='Issue Details' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat' style='background: white;color: blue;margin-bottom: 3%;'><i class='fa fa-print'> Vehicle Wise Fuel Costing Print Reports </i></a>
					";
				  ?>
                </tbody>
              </table>
<?php } ?>
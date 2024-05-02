<?php include 'includes/session.php'; ?>
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
<style>
    .citiestd12 {text-align: right;}
    .citiestd13 {text-align: right}
    .citiestd14 {text-align: center;}
    
</style>
	<br><br>
	<table class="table table-bordered">
                <thead>
                    
    				<tr style="background: #3f3e93;color: white;">
    				    <?php if($vehicleNumber!=''){?>
        				    <th class="hidden"></th>
        					<th>id</th>
        					<th>Date</th>
        					<th>Vehecle Number</th>
        					<th>Trip No</th>
        					<th>Estimated Km</th>
        					<th>VFT KM</th>
        					<th>Fuel issue</th>
        					
    					<?php }else{ ?>
    					    <th class="hidden"></th>
        					<th>id</th>
        					<th>Date</th>
        					<th>Vehecle Number</th>
        					<th>Total Trip</th>
        					<th>Total Estimated Km</th>
        					<th>Total VFT KM</th>
        					<th>Total Fuel</th>
    					 <?php }?>
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
						$sql = "SELECT trip_sheets.id,COUNT(trip_sheets.trip_number) AS TotalTrip,trip_sheets.vehicle_no,vehicle_master.vehicle_number,vehicle_master.branch_status,SUM(trip_sheets.travel_distance) estimatedKm,SUM(trip_sheets.fuel_issue) AS TotalFuelIssue,SUM(trip_sheets.vft_km) AS TotalvftKm,trip_sheets.vft_fuel,trip_sheets.trip_start_date,trip_sheets.trip_end_date
                        FROM `trip_sheets`
                        LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no AND vehicle_master.delete_status='Active'
                        WHERE vehicle_master.branch_status='".$fName."' AND trip_sheets.create_date BETWEEN '".$Ds."' AND '".$De."'
                        GROUP BY trip_sheets.vehicle_no ORDER BY `trip_sheets`.`id`  DESC";
						
						
					}
					$query = $conn->query($sql);
					$idNo=1;
					$slNo=1;
					$totalTravel=0;
					$totalvftkm=0;
					$totalfuelissue=0;
					$totalvftfuel=0;
					$TotalFuelIssue=0;
					
					while($row = $query->fetch_assoc()){
					    $idNo++;
                        if($vehicleNumber!=''){
                            $totalTravel+=floatval($row['travel_distance']);
    						$totalfuelissue+=floatval($row['fuel_issue']);
    						$totalvftkm+=floatval($row['vft_km']);
    						$TotalTrip=$row['trip_number'];
    						$estimatedKm=$row['travel_distance'];
    						$TotalvftKm=$row['vft_km'];
    						if($row['fuel_issue']==''){
    						    $TotalFuelIssue=0;
    						}else{
    						    $TotalFuelIssue=$row['fuel_issue'];
    						}
                        }else{
    						$totalTravel+=floatval($row['estimatedKm']);
    						$totalfuelissue+=floatval($row['TotalFuelIssue']);
    						$totalvftkm+=floatval($row['TotalvftKm']);
    						$idNo+=$row['TotalTrip']+1;
    						$TotalTrip=$row['TotalTrip'];
    						$estimatedKm=$row['estimatedKm'];
    						$TotalvftKm=$row['TotalvftKm'];
    						
    						if($row['TotalFuelIssue']==''){
    						    $TotalFuelIssue=0;
    						}else{
    						    $TotalFuelIssue=$row['TotalFuelIssue'];
    						}
                        }
                      echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$slNo++."</td>
							<td>".date('d-m-Y',strtotime($Ds))." To ".date('d-m-Y',strtotime($De))."</td>
							<td>".$row['vehicle_number']."</td>
							<td class='citiestd12'>".$TotalTrip."</td>
							<td class='citiestd12'>".$estimatedKm." km</td>
							<td class='citiestd12'>".$TotalvftKm." km</td>
							<td class='citiestd12'>".$TotalFuelIssue." L</td>
						</tr>
						";
                    }
					echo "
					<tr><td></td><td></td><td class='citiestd14' >Total</td><td class='citiestd13'>".($idNo-1)."</td><td class='citiestd13'>".$totalTravel." km</td><td class='citiestd13'>".$totalvftkm." km</td><td class='citiestd13'>".$totalfuelissue." L</td></tr>
					
					<a href='vehicleSummaeryViewPdf.php?brID=".$fName."&vId=".$vehicleNumber."&ds=".$Ds."&de=".$De."' target='_blank' title='Issue Details' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat' style='background: white;color: blue;margin-bottom: 3%;'><i class='fa fa-print'> Vehicle Wise Summary Reports </i></a>
					";
				  ?>
                </tbody>
              </table>
<?php } ?>
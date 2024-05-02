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
	<br><br>
	<table class="table table-bordered">
                <thead>
				<tr style="background: #3f3e93;color: white;">
					<th class="hidden"></th>
					<th>id</th>
					<th>Vehecle Number</th>
					<th>Date</th>
					<th>Pump Name</th>
					<th>Fuel Type</th>
					<th>Liter</th>
					<th>Price Liter</th>
					<th>Amount</th>
				</tr>
                </thead>
                <tbody>
                  <?php
					if($vehicleNumber!=''){
						$sql = "SELECT diesel_reports.id,diesel_reports.diesel_date,diesel_reports.vehicle_no,vehicle_master.vehicle_number,diesel_reports.diesel_type,diesel_reports.diesel_litre,diesel_reports.litre_price,diesel_reports.total_amount,diesel_reports.pump_name,diesel_reports.slip_number,vehicle_master.branch_status  
							FROM `diesel_reports` 
							LEFT JOIN vehicle_master ON vehicle_master.id=diesel_reports.vehicle_no
							WHERE vehicle_master.branch_status='".$fName."' AND diesel_reports.vehicle_no='".$vehicleNumber."' AND diesel_reports.delete_status='' AND diesel_reports.diesel_date BETWEEN '".$Ds."' AND '".$De."'";
                    }
					else{
						$sql = "SELECT diesel_reports.id,diesel_reports.diesel_date,diesel_reports.vehicle_no,vehicle_master.vehicle_number,diesel_reports.diesel_type,diesel_reports.diesel_litre,diesel_reports.litre_price,diesel_reports.total_amount,diesel_reports.pump_name,diesel_reports.slip_number,vehicle_master.branch_status  
							FROM `diesel_reports` 
							LEFT JOIN vehicle_master ON vehicle_master.id=diesel_reports.vehicle_no
							WHERE vehicle_master.branch_status='".$fName."' AND diesel_reports.delete_status='' AND diesel_reports.diesel_date BETWEEN '".$Ds."' AND '".$De."'";
						
					}
					
					
					$query = $conn->query($sql);
					$idNo=1;
					$totalAmount=0;
                    while($row = $query->fetch_assoc()){
						$totalAmount+=$row['total_amount'];
						
                      echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$idNo++."</td>
							<td>".$row['vehicle_number']."</td>
							<td>".$row['diesel_date']."</td>
							<td>".$row['pump_name']." <br>".$row['slip_number']."</td>
							<td>".$row['diesel_type']."</td>
							<td>".$row['diesel_litre']."</td>
							<td>".$row['litre_price']."</td>
							<td>".$row['total_amount']."</td>
							
                        </tr>
						";
                    }
					echo "
					<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>Total</td><td>".$totalAmount."</td></tr>
					
					<a href='vehicleWiseCostingViewPdf.php?vId=".$vehicleNumber."&ds=".$Ds."&de=".$De."' target='_blank' title='Issue Details' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat' style='background: white;color: blue;margin-bottom: 3%;'><i class='fa fa-print'> Vehicle Wise Fuel Costing Print Reports </i></a>
					";
				  ?>
                </tbody>
              </table>
<?php } ?>
<?php include 'includes/session.php'; ?>
<?php
if(isset($_POST['startDate']))
//if(isset($_POST['EmpName']))
{
	$tripNumber=$_POST['cName'];
	
	//$EmpName=$_POST['EmpName'];
?>
	<br><br>
	<table class="table table-bordered">
                <thead>
				<tr style="background: #3f3e93;color: white;">
					<th class="hidden"></th>
					<th>id</th>
					<th>Vehicle Number</th>
					<th>Date</th>
					<th>From</th>
					<th>To</th>
					<th>Party Name</th>
					<th>Driver Name</th>
					<th>Helper Name</th>
					<th>Freight Amount</th>
					<th>Trip Cost</th>
					
				</tr>
                </thead>
                <tbody>
                  <?php
					$sql = "SELECT trip_sheets.id,trip_sheets.trip_number,vehicle_master.vehicle_number,trip_sheets.from_location,trip_sheets.to_location,party_name.company_name, driver_master.driver_name,
							helper_master.helper_name,trip_sheets.trip_start_date,trip_sheets.freight_amount,
							SUM(trip_sheets.loading_expenses+trip_sheets.unloading_expenses+ trip_sheets.driver_salary+trip_sheets.helper_salary+trip_sheets.others_expenses +trip_expenses.police_exp+trip_expenses.toll_exp+trip_expenses.parking_exp+trip_expenses.entertainment+trip_expenses.others_exp) AS tripSheetCost 
							FROM `trip_sheets` 
							LEFT JOIN party_name ON party_name.id=trip_sheets.party_id
							LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
							LEFT JOIN driver_master ON driver_master.id=trip_sheets.driver_id
							LEFT JOIN helper_master ON helper_master.id=trip_sheets.helper_id
                            LEFT JOIN trip_expenses ON trip_expenses.trip_no=trip_sheets.trip_number
                            WHERE trip_sheets.trip_number='".$tripNumber."' ";
                     $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						//$fid=$row['firm_id'];
						//$pcnid=$row['pcn_no'];
						//$pcnid=$row['we_product_quantity']-$row['re_weQuantity'];
						//$pcnid12=$row['bu_product_quantity']-$row['re_buQuantity'];
						//$image_name=$row["re_status"];
						//$did12+=$did;
						$trip_number=$row['trip_number'];
                      echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$idNo++."</td>
							<td>".$row['vehicle_number']."</td>
							<td>".$row['trip_start_date']."</td>
							<td>".$row['from_location']."</td>
							<td>".$row['to_location']."</td>
							<td>".$row['company_name']."</td>
							<td>".$row['driver_name']."</td>
							<td>".$row['helper_name']."</td>
							<td>".$row['freight_amount']."</td>
							<td>".$row['tripSheetCost']."</td>
							
                        </tr>
						";
                    }
					echo "
					<a href='tripWiseCostingViewPdf.php?tripId=".$trip_number."' target='_blank' title='Issue Details' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat' style='background: white;color: blue;margin-bottom: 3%;'><i class='fa fa-print'> Trip Wise Costing Print Reports </i></a>
					";
				  ?>
                </tbody>
              </table>
<?php } ?>
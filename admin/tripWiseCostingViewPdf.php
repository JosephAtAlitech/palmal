<?php ob_start();
include 'includes/session.php';
$tripId = $_GET['tripId'];

//$ym = date("Y-m", strtotime($id));	
	date_default_timezone_set("Asia/Dhaka");
	require_once('../tcpdf/tcpdf.php');
		
		// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
		
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Vf Tracker - ACK');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();
    $content = ''; 
	$sql = "SELECT * FROM `admin` where id='".$_SESSION['admin']."'";
			
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			$id=$row['id'];
			$firstname=$row['firstname'];
			$lastname=$row['lastname'];
		}
    $content .= '<style>p{color:black;font-size: 8px;}
			.cities {background-color: gray;color: white;text-align: center;padding: 30px;}
			.citiestd {background-color: yellow;color: black;text-align: center;}
			.citiestd12 {background-color: gray;color: white;text-align: center;font-size: 8px;}
			.citiestd13 {background-color: orange;color: white;text-align: center;}
			.citiestd11 {font-size: 9px;}
			span{font-size: 9px;}
			h2{font-size: 18px;text-align:center;}
		</style>';
		$pdf->Image('../images/ezzy-tracker-logo.png', 15, 10, 175, 17);
		
			$sql = "SELECT trip_sheets.id,trip_sheets.trip_number as trNo,vehicle_master.vehicle_number,trip_sheets.from_location,trip_sheets.to_location,party_name.company_name, driver_master.driver_name,
				helper_master.helper_name,trip_sheets.trip_start_date,trip_sheets.freight_amount
				
				FROM `trip_sheets` 
				LEFT JOIN party_name ON party_name.id=trip_sheets.party_id
				LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
				LEFT JOIN driver_master ON driver_master.id=trip_sheets.driver_id
				LEFT JOIN helper_master ON helper_master.id=trip_sheets.helper_id
                WHERE trip_sheets.trip_number='".$tripId."' GROUP by trip_sheets.trip_number";
		
		$query = $conn->query($sql);
		$idNo=1;
		$weQuantity =0;
		while($row = $query->fetch_assoc()){
			$trNo=$row['trNo'];
			$vehicle_number=$row['vehicle_number'];
			$from_location=$row['from_location'];
			$to_location=$row['to_location'];
			$company_name=$row['company_name'];
			
			$driver_name=$row['driver_name'];
			$helper_name=$row['helper_name'];
			$trip_start_date=$row['trip_start_date'];
			$freight_amount=$row['freight_amount'];
			
		}
		$content .=' <br><br><br><br><br>
		<div class="cities"> Vehicle Wise Costing History </div> <br>
			
		<table border="" cellspacing="0" cellpadding="3">

            <tr>
				<td width="35%" class="citiestd11">Trip No :<font color="gray" class="supAddressFont">'.$trNo.'</font><br>Vehicle No :<font color="gray" class="supAddressFont"> '.$vehicle_number.'</font><br>Location :<font color="gray" class="supAddressFont"> '.$from_location.' to '.$to_location.'</font></td>
				<td width="35%" class="citiestd11">Trip Date :<font color="gray">'.$trip_start_date.'</font><br>Company Name :<font color="gray">'.$company_name.'</font><br>Freight Amount :<font color="gray">'.$freight_amount.'</font></td>
				<td width="30%" class="citiestd11">Driver Name :<font color="gray">'.$driver_name.'</font><br>Helper Name :<font color="gray">'.$helper_name.'</font></td>
			</tr>
			</table> <br><br>
	
			
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="10%">loading Exp</th>
				<th class="citiestd11" width="10%">unloading Exp</th>
				<th class="citiestd11" width="10%">Driver salary</th>
				<th class="citiestd11" width="10%">Helper salary</th>
		
				<th class="citiestd11" width="10%">Police Exp</th>
				<th class="citiestd11" width="10%">Toll Exp</th>
				<th class="citiestd11" width="10%">Parking Exp</th>
				<th class="citiestd11" width="10%">Entertainment</th>
				<th class="citiestd11" width="10%">Others Exp</th>
				<th class="citiestd11" width="10%">Total</th>
				
			</tr>';
			$sql = "SELECT trip_sheets.id,trip_sheets.trip_number,vehicle_master.vehicle_number,trip_sheets.from_location,trip_sheets.to_location,trip_sheets.trip_start_date,trip_sheets.freight_amount,
							trip_sheets.loading_expenses,trip_sheets.unloading_expenses, trip_sheets.driver_salary,trip_sheets.helper_salary,trip_sheets.others_expenses ,trip_expenses.police_exp,trip_expenses.toll_exp,trip_expenses.parking_exp,trip_expenses.entertainment,trip_expenses.others_exp
							FROM `trip_sheets` 
							LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
							LEFT JOIN trip_expenses ON trip_expenses.trip_no=trip_sheets.trip_number
                            WHERE trip_sheets.trip_number='".$tripId."' GROUP by trip_sheets.trip_number";
		
		$query = $conn->query($sql);
		$weQuantity=0;
		$i=0;
		$weQuantitybu=0;
		$weQuantitybu12=0;
		while($row12 = $query->fetch_assoc()){
		
			
			$i++;
			$expCost= $row12['others_expenses']+$row12['others_exp'];
			$totalCost=$row12['loading_expenses']+$row12['unloading_expenses']+$row12['driver_salary']+$row12['helper_salary']+$row12['police_exp']+$row12['toll_exp']+$row12['parking_exp']+$row12['entertainment']+$expCost;
			$total=$row12['units']*$row12['quantity'];
			$grandTotal+=$total;
			$content .= '<tr>
						<td class="citiestd11">'.$row12['loading_expenses'].'</td>
						<td class="citiestd11">'.$row12['unloading_expenses'].'</td>
		                <td class="citiestd11">'.$row12['driver_salary'].'</td>
						<td class="citiestd11">'.$row12['helper_salary'].'</td>
						<td class="citiestd11">'.$row12['police_exp'].'</td>
						<td class="citiestd11">'.$row12['toll_exp'].'</td>
						<td class="citiestd11">'.$row12['parking_exp'].'</td>
						<td class="citiestd11">'.$row12['entertainment'].'</td>
						<td class="citiestd11">'.$expCost.'</td>
						<td class="citiestd11">'.$totalCost.'</td>
						
						
					</tr>
					
					';
					
			}	
			
			$content .= '
			<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$totalCost.'</td></tr>
		</table><br><br>';
			
		
			$content .='
			
				<table>
					
					<tr>
						<td width="59.7%"></td>
						<td width="40.3%">Total Freight Amount : '.$freight_amount.'</td>
					</tr>
					<tr>
						<td width="62%"></td>
						<td width="39.7%">Total Trip Expense : '.$totalCost.'</td>
					</tr>
					
					
				</table>
			';
		$content .= '<style>
						.shoaib{width:33.3%;height: 50px;padding: 60px;border: 1px dotted gray;}
						span{text-align: center;color: gray;font-size: 10px;margin-top: 10%;}
					</style>
					
					</table><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<table>
						<tr>
							<td width="70%"><pre>-------------------------------</pre>Checked by<br>(Sign With date)</td>
							<td width="30%"><pre>-------------------------------</pre>Print/Review by<br>(Sign With date)</td>
						</tr>
						
				</table>
			';
	$pdf->writeHTML($content);  
    ob_end_clean();
	$pdf->Output('schedule.pdf', 'I');
    ob_end_flush();
?>
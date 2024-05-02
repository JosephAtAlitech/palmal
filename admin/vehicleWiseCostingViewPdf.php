<?php ob_start();
include 'includes/session.php';
$vId = $_GET['vId'];
$ds = $_GET['ds'];
$de = $_GET['de'];
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
    $pdf->SetTitle('VFT-Palmal Reports System');  
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
			.citiestd11 {text-align: center;font-size: 8px;}
			.citiestd14 {text-align: center;font-size: 8px;}
			span{text-align: right;font-size: 9px;}
			h2{font-size: 18px;text-align:center;}
		</style>';
		$pdf->Image('../images/ezzy-tracker-logo.png', 15, 10, 175, 17);
		
			$sql = "SELECT vehicle_master.vehicle_number
							FROM `trip_sheets` 
							LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
							WHERE trip_sheets.vehicle_no='".$vId."'";
		
		$query = $conn->query($sql);
		$idNo=1;
		$weQuantity =0;
		while($row = $query->fetch_assoc()){
			$vehicleNumber=$row['vehicle_number'];
		}
		$content .=' <br><br><br><br><br>
		<div class="cities"> Vehicle Wise Costing History </div>
			
		<table border="0" cellspacing="0" cellpadding="3">

			<tr>
				<td width="50%">
					Vehecle Number :<font color="gray"> '.$vehicleNumber.'</font><br>Start Date :<font color="gray">  '.$ds.' </font><br>End Date :<font color="gray">  '.$de.' </font>
				</td>
				<td width="50%">
					Report Generate Date :<font color="gray">  '.date("Y-m-d h:i:s a").' </font>
				</td>
			</tr>
		</table> <br><br>
		Vehecle Costing History Information :<br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="6%">Id</th>
				<th class="citiestd11" width="6%">TripId</th>
				<th class="citiestd11" width="10%">Date</th>
				<th class="citiestd11" width="20%">Supervisor</th>
				<th class="citiestd11" width="10%">Party Name</th>
				<th class="citiestd11" width="8%">Trip Advance</th>
				<th class="citiestd11" width="8%">Load Expense</th>
				<th class="citiestd11" width="8%">UnLoad Expense</th>
				<th class="citiestd11" width="8%">Driver Salary</th>
				<th class="citiestd11" width="8%">Helper Salary</th>
				<th class="citiestd11" width="8%">Total</th>
			</tr>';
			$sql = "SELECT trip_sheets.id,trip_sheets.trip_number,vehicle_master.vehicle_number,trip_sheets.from_location,trip_sheets.to_location,party_name.company_name,driver_master.driver_name,
					helper_master.helper_name,trip_sheets.trip_start_date,trip_sheets.trip_advance,trip_sheets.loading_expenses,trip_sheets.unloading_expenses,trip_sheets.driver_salary,trip_sheets.helper_salary 
							FROM `trip_sheets` 
							LEFT JOIN party_name ON party_name.id=trip_sheets.party_id
							LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no
							LEFT JOIN driver_master ON driver_master.id=trip_sheets.driver_id
							LEFT JOIN helper_master ON helper_master.id=trip_sheets.helper_id
							WHERE trip_sheets.vehicle_no='".$vId."' and trip_sheets.trip_start_date BETWEEN '".$ds."' AND '".$de."' GROUP by trip_sheets.trip_number";
		
		$query = $conn->query($sql);
		$idNo=1;
		$weQuantity =0;
		while($row12 = $query->fetch_assoc()){
			
			$total =$row12['loading_expenses']+$row12['unloading_expenses']+$row12['driver_salary']+$row12['helper_salary'];
			//$bu_quantity =$row12['bu_quantity'];
			$weQuantity += $total;
			$tripAadv=$row12['trip_advance'];
			//$weQuantitybu += $we_quantity;
			//$weQuantitybu12 += $bu_quantity;
			
			$content .= '<tr>
						<td class="citiestd11">'.$idNo++.'</td>
						<td class="citiestd11">'.$row12['trip_number'].'</td>
						<td class="citiestd11">'.$row12['trip_start_date'].'<br>'.$row12['from_location'].' to '.$row12['to_location'].'</td>
						<td class="citiestd11">Dname : '.$row12['driver_name'].'<br>Hname: '.$row12['helper_name'].'</td>
						<td class="citiestd11">'.$row12['company_name'].'</td>
						<td class="citiestd12">'.$row12['trip_advance'].'</td>
						<td class="citiestd12">'.$row12['loading_expenses'].'</td>
						<td class="citiestd12">'.$row12['unloading_expenses'].'</td>
						<td class="citiestd12">'.$row12['driver_salary'].'</td>
						<td class="citiestd12">'.$row12['helper_salary'].'</td>
						<td class="citiestd11">'.$total.'</td>
						</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity.'</td></tr>
		</table><br><br>';
		
		$content .='
					Other Expenses :<br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="10%">Id</th>
				<th class="citiestd11" width="12%">TripId</th>
				<th class="citiestd11" width="13%">Police Exp</th>
				<th class="citiestd11" width="13%">Toll Exp</th>
				<th class="citiestd11" width="13%">Parking Exp</th>
				<th class="citiestd11" width="13%">Entertainment</th>
				<th class="citiestd11" width="13%">Others Exp</th>
				<th class="citiestd11" width="13%">Total</th>
			</tr>';
			$sql = "SELECT trip_expenses.id,trip_expenses.trip_no,vehicle_master.vehicle_number,trip_expenses.police_exp,trip_expenses.toll_exp,
					trip_expenses.parking_exp,trip_expenses.entertainment,trip_expenses.others_exp
					FROM `trip_expenses` 
					LEFT JOIN vehicle_master ON vehicle_master.id=trip_expenses.vehicle_id
					WHERE trip_expenses.vehicle_id='".$vId."'";
		
		$query = $conn->query($sql);
		$idNo=1;
		$weQuantity12 =0;
		while($row123 = $query->fetch_assoc()){
			
			$total =$row123['police_exp']+$row123['toll_exp']+$row123['parking_exp']+$row123['entertainment']+$row123['others_exp'];
			//$bu_quantity =$row12['bu_quantity'];
			$weQuantity12 += $total;
			//$weQuantitybu += $we_quantity;
			//$weQuantitybu12 += $bu_quantity;
			
			$content .= '<tr>
						<td class="citiestd11">'.$idNo++.'</td>
						<td class="citiestd11">'.$row123['trip_no'].'</td>
						<td class="citiestd12">'.$row123['police_exp'].'</td>
						<td class="citiestd12">'.$row123['toll_exp'].'</td>
						<td class="citiestd12">'.$row123['parking_exp'].'</td>
						<td class="citiestd12">'.$row123['entertainment'].'</td>
						<td class="citiestd12">'.$row123['others_exp'].'</td>
						<td class="citiestd11">'.$total.'</td>
						</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td></td><td></td><td></td><td></td><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity12.'</td></tr>
		</table><br><br>';
			
		
			$content .='
			
				<table>
					
					<tr>
						<td width="59.7%"></td>
						<td width="40.3%">Total Trip Sheet Cost : '.$weQuantity.'</td>
					</tr>
					<tr>
						<td width="62%"></td>
						<td width="39.7%">Total Trip Expense : '.$weQuantity12.'</td>
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
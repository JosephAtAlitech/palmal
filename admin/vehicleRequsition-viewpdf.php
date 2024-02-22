<?php ob_start();
include 'includes/session.php';
$reqId = $_GET['reqId'];
//$ym = date("Y-m", strtotime($id));	
date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime($test))->format("Y-m-d H:i:s");
$todayDate = date('Y-m-d h:i:s A',strtotime($toDay));
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
    $pdf->SetTitle('Vf - Tracker Management Bangladesh');  
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
			.citiestd12 {background-color: gray;color: white;text-align: center;}
			.citiestd13 {background-color: orange;color: white;text-align: center;}
			.citiestd11 {font-size: 9px;text-align: left;}
			.citiestd14 {font-size: 9px;text-align: left;}
			.citiestd15 {font-size: 9px;text-align: left;}
			.citiestd16 {font-size: 9px;color:gray;text-align: left;}
			.citiestd17 {font-size: 9px;text-align: left;padding-top: 3%;}
			.citiestd18 {font-size: 8px;text-align: left;padding-top: 3%;}
			.citiestd19 {font-size: 8px;text-align: right;padding-top: 3%;}
			span{font-size: 9px;}
			h2{font-size: 18px;text-align:center;}
		</style>';
		$pdf->Image('../images/ezzy-tracker-logo.png', 15, 10, 175, 17);
		$content .=' <br><br>
      	<p align="center">'.$firstname.' '.$lastname.', Bangladesh
		</p><br>
		<div class="cities"> Vehicle Documents Requsition ID# '.$reqId.' </div> <br>
		
		<table border="" cellspacing="0" cellpadding="3">

			<tr>
				<td width="70%" class="citiestd11">Company Name :<font color="gray">  '.$firstname.' '.$lastname.' Bangladesh</font></td>
				<td width="30%" class="citiestd14">Print Date :<font color="gray">'.$todayDate.'</font><br>Printed By :<font color="gray">'.$firstname.' '.$lastname.'</font></td>
			</tr>
		</table>
		<h3>Documents Requsition History: </h3><br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		<tr>
			<th class="citiestd11" width="6%">SL#</th>
			<th class="citiestd11" width="14%">Date</th>
			<th class="citiestd11" width="17%">Vehicle Information</th>
			<th class="citiestd11" width="15%">Documents Type</th>
			<th class="citiestd11" width="12%">Office Fee</th>
			<th class="citiestd11" width="12%">Token Fee</th>
			<th class="citiestd11" width="12%">Others Fee</th>
			<th class="citiestd11" width="12%">Total</th>
		</tr>
		';
			$sql = "SELECT vehicle_documents_proposal.id,vehicle_documents_proposal.req_id,vehicle_master.vehicle_number,vehicle_master.chasis_number,vehicle_master.engin_number,manufacturer_name.name,vehicle_documents_proposal.type,
				vehicle_documents_proposal.office_fee,vehicle_documents_proposal.token_fee,vehicle_documents_proposal.others_fee,
				vehicle_documents_proposal.entry_date
				FROM `vehicle_documents_proposal`
				LEFT JOIN vehicle_master ON vehicle_master.id=vehicle_documents_proposal.vehicle_id
				LEFT JOIN manufacturer_name ON manufacturer_name.id=vehicle_master.makers_name
				WHERE vehicle_documents_proposal.req_id='".$reqId."'";
		
		$query = $conn->query($sql);
		while($row12 = $query->fetch_assoc()){
			$i++;
			$totalAmount=$row12['office_fee']+$row12['token_fee']+$row12['others_fee'];
			$grandTotal+=$totalAmount;
			$totaloffe+=$row12['office_fee'];
			$totaltoken+=$row12['token_fee'];
			$totalother+=$row12['others_fee'];
			
			if($row12['type']=='regType'){
			    $type = 'Registration Certificate';
			}
			else if($row12['type']=='taxType'){
			    $type = 'Tex Token';
			}
			else if($row12['type']=='insuType'){
			    $type = 'Insurance Certificate';
			}
			else if($row12['type']=='RouteType'){
			    $type = 'Route Permit';
			}
			else if($row12['type']=='fitnessType'){
			    $type = 'Fitness Certificate';
			}
			
			$content .= '<tr>
						<td class="citiestd18">'.$i.'</td>
						<td class="citiestd18">'.$row12['entry_date'].'</td>
						<td class="citiestd18">'.$row12['vehicle_number'].' - '.$row12['name'].'<br>'.$row12['chasis_number'].'<br>'.$row12['engin_number'].'</td>
						<td class="citiestd18">'.$type.'</td>
						<td class="citiestd19">'.$row12['office_fee'].'</td>
						<td class="citiestd19">'.$row12['token_fee'].'</td>
						<td class="citiestd19">'.$row12['others_fee'].'</td>
						<td class="citiestd19">'.$totalAmount.'</td>
					</tr>
					
					';
					
			}
			$content .= '
			<tr><td></td><td></td><td></td><td>Total</td><td class="citiestd19">'.$totaloffe.'</td><td class="citiestd19">'.$totaltoken.'</td><td class="citiestd19">'.$totalother.'</td><td class="citiestd19">'.$grandTotal.'</td></tr>
		</table><br><br>';
		
			
		$content .= '<style>
						.shoaib{width:33.3%;height: 50px;padding: 60px;border: 1px dotted gray;}
						span{text-align: center;color: gray;font-size: 10px;margin-top: 10%;}
					</style>
					
					
					<table><br><br><br><br>
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
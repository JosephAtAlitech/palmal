<?php ob_start();
include 'includes/session.php';
$id = $_GET['id'];
//$ym = date("Y-m", strtotime($id));	
date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime())->format("Y-m-d H:i:s");
$todayDate = date('Y-m-d h:i:s A', strtotime($toDay));
require_once('../tcpdf/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{
	//Page header
	public function Header()
	{
		// Logo
		$image_file = K_PATH_IMAGES . 'logo_example.jpg';
		$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer()
	{
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Vf - Palmal Management Bangladesh');
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 11);
$pdf->AddPage();
$content = '';
$sql = "SELECT * FROM `admin` where id='" . $_SESSION['admin'] . "'";

$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
	$id = $row['id'];
	$firstname = $row['firstname'];
	$lastname = $row['lastname'];
}
$content .= '<style>
                p{color:black;font-size: 8px;}
				.cities {background-color: gray;color: white;text-align: center;padding: 30px;}
				.citiestd {background-color: yellow;color: black;text-align: center;}
				.citiestd11 {font-size: 7px;text-align: left;}
				.citiestd12 {font-size: 7px;text-align: right;}
				.citiestd13 {font-size: 7px;text-align: center;}
				
				.citiestd14 {font-size: 9px;text-align: left;}
				.citiestd15 {font-size: 9px;text-align: left;}
				.citiestd16 {font-size: 9px;color:gray;text-align: left;}
				.citiestd17 {font-size: 9px;text-align: left;padding-top: 3%;}
				.citiestd18 {font-size: 9px;color:gray;text-align: left;padding-top: 3%;}
				.caption { background-color: gray;}
				span{font-size: 9px;}
				h2{font-size: 18px;text-align:center;}
		    </style>';
$pdf->Image('../images/ezzy-tracker-logo.png', 15, 10, 175, 17);
$content .= ' <br><br>
      	<p align="center"></p><br>
		<div class="cities"> Bill Challan </div> <br>
		<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td width="70%" class="citiestd11"></td>
				<td width="30%" class="citiestd14">Print Date :<font color="gray">' . $todayDate . '</font><br>Printed By :<font color="gray">' . $firstname . ' ' . $lastname . '</font></td>
			</tr>
		</table>
		<h3>Bill Challan Information: </h3><br><br>
		<table cellspacing="0" cellpadding="3">';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT tbl_token.* ,vehicle_master.vehicle_number, m.firstname m_name, e.firstname e_name from tbl_token 
			left outer join admin as m on tbl_token.mechanic_id = m.id
			left outer join vehicle_master  on tbl_token.vehicle_id = vehicle_master.id
			join admin as e on tbl_token.engineer_id = e.id
			WHERE tbl_token.id =  $id  ORDER BY id DESC";

	$query = $conn->query($sql);
	$row12 = $query->fetch_assoc();
	$token_title = $row12['token_title'];
	$token_details = $row12['token_details'];
	$m_name = $row12['m_name'];
	$e_name = $row12['e_name'];
	$status = $row12['status'];
	$vehicle_number = $row12['vehicle_number'];
	$token_date = $row12['token_date'];
	$content .= "<tr>
                    <td width='25%' class='citiestd15'>Requisition No <br>Token title<br>Mechanic Name<br>Engineer Name</td>
                    <td width='25%' class='citiestd16'>: " . $row12['token_no'] . "<br>: " . $token_title . " L<br>: " . $m_name . "<br>: " . $e_name . "
                    </td>

                    <td width='15%' class='citiestd15'>VehicleNumber <br>Token details <br>Status  <br>Create Date</td>
                    <td width='35%' class='citiestd16'>:".$vehicle_number." <br>:" . $token_details . " <br>: " . $status . "<br>: " . $token_date . "</td>
                    </tr></table> <hr><br><br>";
	$content .= '	<br><br>Requisition information :<br><br>
					<table border="1" cellspacing="0" cellpadding="3">
					<thead>
						<tr>
							<th class="citiestd11" width="6%">SL#</th>
							<th class="citiestd11" width="44%">Product Information</th>
							<th class="citiestd11" width="20%">Specification</th>
							<th class="citiestd11" width="10%">Qty</th>
							<th class="citiestd11" width="20%">Remarks</th>
						</tr>
					</thead>
				    <tbody>';
	$sql = "SELECT tbl_token_requisition.*  FROM  tbl_token_requisition 
		    WHERE tbl_token_requisition.tbl_token_id = '" . $id . "' AND deleted ='No' ORDER BY id DESC";
	$query = $conn->query($sql);
	$i = 1;
	while ($row12 = $query->fetch_assoc()) {
		$content .= '<tr>
					    <td class="citiestd11" width="6%">' . $i++ . '</td>
						<td class="citiestd11" width="44%">' . $row12['req_product'] . '</td>
						<td class="citiestd11" width="20%">' . $row12['Spec'] . '</td>
						<td class="citiestd11" width="10%">' . $row12['qty'] . ' ' . $row12['unit'] . '</td>
						<td class="citiestd11" width="20%">' . $row12['remarks'] . '</td>
					</tr>';
	}
	$content .= '</tbody></table>';
	$content .= '<br><br>	Requiisition information :<br><br>';

	$sql0 = "SELECT tbl_quotation_details.* , admin.firstname FROM  tbl_quotation_details 
			join tbl_quotation on tbl_quotation_details.tbl_quotation_id = tbl_quotation.id
			join admin on tbl_quotation.quote_by_id = admin.id
			WHERE tbl_quotation.tbl_token_id =  $id ORDER BY tbl_quotation_details.id DESC limit 1";
	$query0 = $conn->query($sql0);

	$row1 = $query0->fetch_assoc();

	$sql1 = "SELECT DISTINCT tbl_quotation_details.tbl_quotation_id FROM  tbl_quotation_details 
			join tbl_quotation on tbl_quotation_details.tbl_quotation_id = tbl_quotation.id
			WHERE tbl_quotation.tbl_token_id =  $id  ORDER BY tbl_quotation_details.id DESC";
	$query1 = $conn->query($sql1);

	while ($row10 = $query1->fetch_assoc()) {
		$quoteId = $row10['tbl_quotation_id'];

		$sql = "SELECT tbl_quotation_details.*,tbl_party.partyName,tbl_party.partyAddress,tbl_party.partyPhone  
                FROM  tbl_quotation_details 
                LEFT JOIN tbl_quotation on tbl_quotation_details.tbl_quotation_id = tbl_quotation.id
                LEFT JOIN tbl_party on tbl_quotation.supplier_id = tbl_party.id 
				WHERE tbl_quotation.tbl_token_id =  $id and tbl_quotation_details.tbl_quotation_id = $quoteId ORDER BY tbl_quotation_details.id DESC";
		$query = $conn->query($sql);
		
		$sqlPartyName = "SELECT tbl_party.partyName,tbl_party.partyAddress,tbl_party.partyPhone  
                FROM  tbl_quotation_details 
                LEFT JOIN tbl_quotation on tbl_quotation_details.tbl_quotation_id = tbl_quotation.id
                LEFT JOIN tbl_party on tbl_quotation.supplier_id = tbl_party.id 
				WHERE tbl_quotation.tbl_token_id =  $id and tbl_quotation_details.tbl_quotation_id = $quoteId ORDER BY tbl_quotation_details.id DESC";
				
				
		$content .= '<table border="1" cellspacing="0" cellpadding="3">';
		
		$queryPartyName = $conn->query($sqlPartyName);
		while ($rowParty = $queryPartyName->fetch_assoc()) {
		    $partyName = $rowParty['partyName'].'| Contact : '.$rowParty['partyPhone'].'<br> Address : '.$rowParty['partyAddress'];
		    
		}
		$content .= '<caption class="citiestd11"> Supplier Name: ' . $partyName . '</caption><br>';
		$content .= '<thead>
						<tr>
							<th class="citiestd13" width="6%">SL#</th>
							<th class="citiestd13" width="40%" >Product Name</th>
							<th class="citiestd13" width="10%" >Qty</th>
							<th class="citiestd13" width="20%" >Group Name</th>
							<th class="citiestd13" width="10%" >Unit</th>
							<th class="citiestd13" width="14%" >Total</th>
						</tr>
					</thead>
					<tbody>';
		$i = 1;
        $unitTotal = 0;
        $unitTotalunit_price =0;
        $unitTotaltotal_amount =0;
        $unitTotalwing_head_unit_price =0;
        $unitTotalwing_head_total_amount =0;
        $unitTotalaudit_unit_price =0;
        $unitTotalaudit_total_amount =0;
		while ($row12 = $query->fetch_assoc()) {
		    
			$unitTotal+=(int)$row12['qty'];
		    $unitTotalunit_price+=(int)$row12['unit_price'];
		    $unitTotaltotal_amount+=(int)$row12['total_amount'];
		    $unitTotalwing_head_unit_price+=(int)$row12['wing_head_unit_price'];
		    $unitTotalwing_head_total_amount+=(int)$row12['wing_head_total_amount'];
		    $unitTotalaudit_unit_price+=(int)$row12['audit_unit_price'];
		    $unitTotalaudit_total_amount+=(int)$row12['audit_total_amount'];
			$content .= '<tr>
						<td class="citiestd13" width="6%">' . $i++ . '</td>
						<td class="citiestd11" width="40%">' . $row12['Product_name'] . '</td>
						<td class="citiestd13" width="10%">' . $row12['qty'] . ' ' . $row12['unit'] . '</td>
						<td class="citiestd12" width="20%">' . $row12['quotation_group_name'] . ' </td>
						<td class="citiestd12" width="10%">' . $row12['audit_unit_price'] . ' </td>
						<td class="citiestd12" width="14%">' . $row12['audit_total_amount'] . '</td>
	                </tr>
	                
	                ';
		}
		$content .= '
		<tr><td></td><td class="citiestd13">Total</td><td class="citiestd13">'.$unitTotal.'</td><td></td><td></td><td class="citiestd12">'.number_format($unitTotaltotal_amount,2).'</td><td></td><td class="citiestd12">'.number_format($unitTotalwing_head_total_amount,2).'</td><td></td><td class="citiestd12">'.number_format($unitTotalaudit_total_amount,2).'</td></tr>
		</tbody></table><br><br><br>';
	}
} else {
	$content .= "<h3>Unauthorized Requisition Number.</h3>";
}

$content .= "<style>
				span{text-align: center;color: gray;font-size: 10px;margin-top: 10%;}
			</style>
			<table><br><br><br><br>
				<tr>
					<td width='70%'><pre>-------------------------------</pre>Checked by<br>(Sign With date)</td>
					<td width='30%'><pre>-------------------------------</pre>Print/Review by<br>(Sign With date)</td>
				</tr>
			</table>";

$pdf->writeHTML($content);
ob_end_clean();
$pdf->Output('schedule.pdf', 'I');
ob_end_flush();
?>
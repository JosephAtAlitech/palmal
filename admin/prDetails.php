<?php ob_start();
include 'includes/session.php';
$id = $_GET['id'];
//$quote_id = $_GET['quote_id'];
//$ym = date("Y-m", strtotime($id));	
date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime())->format("Y-m-d H:i:s");
$todayDate = date('Y-m-d h:i:s A', strtotime($toDay));
require_once ('../tcpdf/tcpdf.php');

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
$pdf->SetTitle('Vf - Tracker Management Bangladesh');
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
$firstname = '';
$lastname = '';
$sql = "SELECT tbl_quotation.id, tbl_token.token_title ,tbl_token.id  as token_id , tbl_party.partyName,tbl_party.partyAddress,tbl_party.partyPhone FROM `tbl_quotation` 
		JOIN tbl_token on tbl_quotation.tbl_token_id = tbl_token.id
		LEFT JOIN tbl_party on tbl_quotation.supplier_id = tbl_party.id
		WHERE tbl_quotation.deleted = 'No' and tbl_token.id = $id ORDER BY tbl_quotation.id  DESC";

$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
	$id = $row['id'];
	$partyName = $row['partyName'] . '<br>Contact : ' . $row['partyPhone'] . '<br>Address : ' . $row['partyAddress'];
}
$content .= '<style>
                p{color:black;font-size: 8px;}
				.cities {background-color: gray;color: white;text-align: center;padding: 30px;}
				.citiestd {background-color: yellow;color: black;text-align: center;}
				.citiestd12 {background-color: gray;color: white;text-align: center;}
				.citiestd13 {background-color: orange;color: white;text-align: center;}
				.citiestd11 {font-size: 9px;text-align: left;}
				.citiestd14 {font-size: 9px;text-align: left;}
				.citiestd15 {font-size: 7px;text-align: left;}
				.citiestd16 {font-size: 7px;text-align: right;}
				.citiestd17 {font-size: 7px;text-align: center;}
				.citiestd18 {font-size: 9px;color:gray;text-align: left;}
				.citiestd19 {font-size: 9px;text-align: right;}
				.caption { background-color: gray;}
				span{font-size: 9px;}
				h2{font-size: 18px;text-align:center;}
		    </style>';
$pdf->Image('../images/ezzy-tracker-logo.png', 15, 10, 175, 17);
$content .= ' <br><br>
      	<p align="center"></p><br>
		<div class="cities"> Pre Requisition </div> <br>
		<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td width="70%" class="citiestd14">Supplier Name :<font color="gray">  ' . $partyName . '</font></td>
				<td width="30%" class="citiestd14">Print Date :<font color="gray">' . $todayDate . '</font><br>Printed By :<font color="gray">' . $firstname . ' ' . $lastname . '</font></td>
			</tr>
		</table>
		<h3>Service Information: </h3><br><br>
		<table  cellspacing="0" cellpadding="3">';

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
	$content .= '<tr>
					<td width="15%" class="citiestd11">Service No <br>Service title<br>Mechanic Name<br>Engineer Name</td>
					<td width"40%" class="citiestd11">: ' . $row12['token_no'] . '<br>: ' . $token_title . '<br>: ' . $m_name . '<br>: ' . $e_name . '</td>

					<td  class="citiestd11" width="15%">VehicleNumber <br>Service details <br>Status  <br>Create Date</td>
					<td class="citiestd11">:' . $vehicle_number . '<br>:' . $token_details . '<br>: ' . $status . '<br>: ' . $token_date . '</td>
					</tr></table> <hr><br><br>';


	$sql = "SELECT tbl_quotation_details.*  FROM  tbl_quotation_details 
				join tbl_quotation on tbl_quotation_details.tbl_quotation_id = tbl_quotation.id
				WHERE tbl_quotation.tbl_token_id = $id  
				ORDER BY tbl_quotation_details.id DESC";

	$query = $conn->query($sql);
	$content .= '<br><br>	Quotation Details :<br><br>';
	$content .= '<table border="1" cellspacing="0" cellpadding="3" >
		            <thead>
						<tr>
							<th class="citiestd17" width="5%" >SL#</th>
							<th class="citiestd17" width="40%" >Product Name</th>
							<th class="citiestd17" width="15%" >Group Name</th>
							<th class="citiestd17" width="15%"  >Qty</th>
							<th class="citiestd17" width="10%"  >Unit price</th>
							<th class="citiestd17" width="15%"  >Total amount</th>
						</tr>
					</thead>
					<tbody>';
	$i = 1;
	$unitTotal = 0;
	$unitTotalunit_price = 0;
	$unitTotaltotal_amount = 0;
	$unitTotalwing_head_unit_price = 0;
	$unitTotalwing_head_total_amount = 0;
	$unitTotalaudit_unit_price = 0;
	$unitTotalaudit_total_amount = 0;
	while ($row123 = $query->fetch_assoc()) {
		$unitTotal += (int) $row123['qty'];
		$unitTotalunit_price += (int) $row123['unit_price'];
		$unitTotaltotal_amount += (int) $row123['total_amount'];
		$unitTotalwing_head_unit_price += (int) $row123['wing_head_unit_price'];
		$unitTotalwing_head_total_amount += (int) $row123['wing_head_total_amount'];
		$unitTotalaudit_unit_price += (int) $row123['audit_unit_price'];
		$unitTotalaudit_total_amount += (int) $row123['audit_total_amount'];
		$content .= '<tr>
						<td class="citiestd15"  width="5%">' . $i++ . '</td>
						<td class="citiestd15" width="40%">' . $row123['Product_name'] . '</td>
						<td class="citiestd17" width="15%">' . $row123['quotation_group_name'] . ' </td>
						
						<td class="citiestd17" width="15%">' . $row123['qty'] . ' ' . $row123['unit'] . '</td>
						<td class="citiestd17" width="10%">' . $row123['unit_price'] . ' </td>
						<td class="citiestd16" width="15%">' . $row123['audit_total_amount'] . '</td>
	                </tr>';
	}
	$content .= '
		<tr><td ></td><td class="citiestd17">Total</td><td class="citiestd17">' . $unitTotal . '</td><td class="citiestd16"></td><td class="citiestd16">' . number_format($unitTotalaudit_total_amount, 2) . '</td></tr>
		</tbody></table><br><br><br>';

	// $sql13 = "SELECT tbl_quotation.*  FROM  tbl_quotation
	// 		     	WHERE tbl_quotation.id =  $quote_id ";
	// $query13 = $conn->query($sql13);
	// $row13 = $query13->fetch_assoc();
	// $subtotal = $row13['total_amount'];
	// $totalDiscount = $row13['discount'];
	// $vat = $row13['Vat'];
	// $ait = $row13['Ait'];
	// $GrandTotalBlance = $row13['audit_grand_total'];
	// $content .= '
			
	// 	<table>
			
	// 		<tr>
	// 			<td width="70%" class="citiestd18"></td>
	// 			<td width="20%" class="citiestd14">Sub-Total amount :</td><td width="10%" class="citiestd19">' . number_format($unitTotalaudit_total_amount, 2) . '</td>
	// 		</tr>
	// 		<tr>
	// 			<td width="70%"></td>
	// 			<td width="20%" class="citiestd14">Discount :</td><td width="10%" class="citiestd19" >' . $totalDiscount . '</td>
	// 		</tr>
	// 		<tr>
	// 		<td width="70%"></td>
	// 		<td width="20%" class="citiestd14">Vat :</td><td width="10%" class="citiestd19" >' . $vat . '</td>
	// 	</tr>
	// 	<tr>
	// 	<td width="70%"></td>
	// 	<td width="20%" class="citiestd14">Ait :</td><td width="10%" class="citiestd19" >' . $ait . '</td>
	// </tr>
	// 		<tr>
	// 			<td width="70%"></td>
	// 			<td width="20%" class="citiestd14">Grand Total :</td><td width="10%" class="citiestd19">' . number_format($unitTotalaudit_total_amount, 2) . '</td>
	// 		</tr>
	// 		<tr>
	// 			<td width="70%"></td>
	// 			<td width="20%" class="citiestd14">Net Payable (Round) :</td><td width="10%" class="citiestd19">' . number_format(round($unitTotalaudit_total_amount), 2) . '</td>
	// 		</tr>';


} else {
	$content .= "<h3>Unauthorized Service Number.</h3>";
}

$content .= "<style>
				span{text-align: center;color: gray;font-size: 10px;margin-top: 10%;}
			</style>
			<table><br><br><br><br>
				<tr>
					<td  class='citiestd14' width='40%'><pre>-------------------------------</pre>Checked by<br>(Sign With date)</td>
					<td  class='citiestd14' width='30%'><pre>-------------------------------</pre>Print/Review by<br>(Sign With date)</td>
					<td   class='citiestd15' width='30%'><pre>-------------------------------</pre>Print/Review by<br>(Sign With date)</td>
				</tr>
			</table>";

$pdf->writeHTML($content);
ob_end_clean();
$pdf->Output('schedule.pdf', 'I');
ob_end_flush();
?>
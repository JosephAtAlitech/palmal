<?php ob_start();
include 'includes/session.php';
$month = $_GET['month'];
$year = $_GET['year'];
$vehicle = $_GET['vehicle'];
//$ym = date("Y-m", strtotime($id));	

$strDate = $year . '-' . $month . '-01';
$date = strtotime($strDate);
$monthName =  date("F", mktime(0, 0, 0, $month, 10));
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
				.caption {background-color: gray;}
				span{font-size: 9px;}
				h2{font-size: 18px;text-align:center;}
		    </style>';
$pdf->Image('../images/ezzy-tracker-logo.png', 15, 10, 175, 17);

if (isset($_GET['month'])) {
   

    // Last date of current month. 
    $lastdate = date("Y-m-t", $date);
    $content .= '<br><br><br><br>
    <h4 class="cities">Traffic Case Expenses : For the month of '.$monthName.'-'.$year.'</h4><br><table border="0" cellspacing="0" cellpadding="0" >
    <tr><td class="citiestd14">Office Memo</td><td class="citiestd19">Maintenance Division</td></tr></table><hr>';
    $content .= '<br><br><br><br><br><table border="0" cellspacing="0" cellpadding="0" >
    <tr><td class="citiestd14">Transport Department</td><td colspan="2"></td><td class="citiestd19">Prepared Date :-
    </td><td class="citiestd19">'.$toDay.'</td></tr></table><hr>';

    $sql = "SELECT tbl_traffic_case_exp.*,  driver_master.id as d_id,driver_master.driver_name ,vehicle_master.vehicle_number ,vehicle_master.employee_name, branch_master.id as b_id, branch_master.branch_name FROM `tbl_traffic_case_exp` 
    inner join vehicle_master on tbl_traffic_case_exp.vehicle_id = vehicle_master.id 
    left outer join driver_master on vehicle_master.driver_id = driver_master.id 
    left outer join branch_master on vehicle_master.branch_status = branch_master.id 
    WHERE  tbl_traffic_case_exp.deleted='No' AND tbl_traffic_case_exp.occurrence_date >= '$strDate' AND tbl_traffic_case_exp.occurrence_date <= '$lastdate'";
    if ($vehicle=='') {
        $sql .= "AND tbl_traffic_case_exp.vehicle_id = '$vehicle'";
    }
    $sql .= " ORDER BY tbl_traffic_case_exp.id DESC";

    $query = $conn->query($sql);
    $content .= '<br><br>	Police Expanse Details :<br><br>';
    $content .= '<table border="1" cellspacing="0" cellpadding="3" >
		            <thead>
						<tr>
							<th class="citiestd17" width="5%" >SL#</th>
							<th class="citiestd17" width="8%" >Vehicle No</th>
							<th class="citiestd17" width="8%" >Driver Name</th>
							<th class="citiestd17" width="8%" >Name Of Fectory</th>
							<th class="citiestd17" width="10%" >User Name</th>
                            <th class="citiestd17" width="8%" >Case ID</th>
                            <th class="citiestd17" width="10%" >Occurance Date/Settle Date</th>
                            <th class="citiestd17" width="9%" >Reason</th>
                            <th class="citiestd17" width="9%" >Remarks</th>
                            <th class="citiestd17" width="8%" >Receptable Amount</th>
                            <th class="citiestd17" width="8%" >Non Receptable Amount</th>
                            <th class="citiestd17" width="9%" >Total Amount</th>
						</tr>
					</thead>
					<tbody>';
    $i = 1;
    $total_amount = 0;
    $total_receptable_amount = 0;
    $total_non_receptable_amount = 0;

    while ($row12 = $query->fetch_assoc()) {
        $total_receptable_amount += (int) $row12['receptable_amount'];
        $total_non_receptable_amount += (int) $row12['non_receptable_amount'];
        $total_amount += (int) $row12['total_amount'];

        $content .= '<tr>
						<td class="citiestd15" width="5%">' . $i++ . '</td>
						<td class="citiestd15" width="8%">' . $row12['vehicle_number'] . '</td>
						<td class="citiestd17" width="8%">' . $row12['driver_name'] . '</td>
						<td class="citiestd17" width="8%">' . $row12['branch_name'] . ' </td>
						<td class="citiestd17" width="10%">' . $row12['employee_name'] . '</td>
                        <td class="citiestd17" width="8%">' . $row12['case_id'] . '</td>
                        <td class="citiestd17" width="10%">' . $row12['occurrence_date'] . '</td>
                        <td class="citiestd17" width="9%">' . $row12['reason'] . '</td>
                        <td class="citiestd17" width="9%">' . $row12['remarks'] . '</td>
                        <td class="citiestd16" width="8%">' . $row12['receptable_amount'] . '</td>
                        <td class="citiestd16" width="8%">' . $row12['non_receptable_amount'] . '</td>
                        <td class="citiestd16" width="9%">' . $row12['total_amount'] . '</td>
	                </tr>';
    }
    $content .= '
		<tr><td ></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td class="citiestd17">Total = </td><td class="citiestd17">' . number_format($total_receptable_amount, 2) . '</td><td class="citiestd16">' . number_format($total_non_receptable_amount, 2) . '</td><td class="citiestd16">' . number_format($total_amount, 2) . '</td></tr>
		</tbody></table><br><br><br>';

    $content .= '
			
		<table>
			<tr>
				<td width="70%"></td>
                <td width="70%" align="left" class="citiestd14">Amount In Words : <b>' . ucfirst($total_amount) . '</b></td>
			</tr></table>
		';


} else {
    $content .= "<h3>Unauthorized Request.</h3>";
}

$content .= "<style>
				span{text-align: center;color: gray;font-size: 10px;margin-top: 10%;}
			</style>
			<table><br><br><br><br>
				<tr>
					<td  class='citiestd14' width='40%'><pre>-------------------------------</pre>AGM<br><small>Transport</small></td>
					<td  class='citiestd14' width='30%'><pre>-------------------------------</pre>GM<br><small>Transport</small></td>
					<td  class='citiestd14' width='30%'><pre>-------------------------------</pre>DGM<br><small>Transport</small></td>
				</tr>
			</table>";

$pdf->writeHTML($content);
ob_end_clean();
$pdf->Output('schedule.pdf', 'I');
ob_end_flush();
?>
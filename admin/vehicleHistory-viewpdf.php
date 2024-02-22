<?php ob_start();
include 'includes/session.php';
$vid = $_GET['vid'];
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
			.citiestd18 {font-size: 9px;color:gray;text-align: left;padding-top: 3%;}
			span{font-size: 9px;}
			h2{font-size: 18px;text-align:center;}
		</style>';
		$pdf->Image('../images/ezzy-tracker-logo.png', 15, 10, 175, 17);
		$content .=' <br><br>
      	<p align="center">'.$firstname.' '.$lastname.', Bangladesh
		</p><br>
		<div class="cities"> Vehicle History </div> <br>
		
		<table border="" cellspacing="0" cellpadding="3">

			<tr>
				<td width="70%" class="citiestd11">Company Name :<font color="gray">  '.$firstname.' '.$lastname.' Bangladesh</font></td>
				<td width="30%" class="citiestd14">Print Date :<font color="gray">'.$todayDate.'</font><br>Printed By :<font color="gray">'.$firstname.' '.$lastname.'</font></td>
			</tr>
		</table>
		<h3>Vehicle Profile: </h3><br><br>
		<table  cellspacing="0" cellpadding="3">';
			$sql = "SELECT vehicle_documents_info.id,vehicle_documents_info.vehicle_id,vehicle_master.wUnitID,vehicle_master.oil_tank_capacity,vehicle_master.vehicle_number,vehicle_master.vehicle_number,branch_master.branch_name,vehicle_master.purchase_date,manufacturer_name.name,vehicle_master.year_of_manufacture,vehicle_master.chasis_number,vehicle_master.engin_number,vehicle_master.branch_status,vehicle_master.create_date,vehicle_documents_info.certificate,vehicle_documents_info.start_date,
					vehicle_documents_info.end_date,vehicle_documents_info.office_fee,vehicle_documents_info.token_fee,vehicle_documents_info.type,
					vehicle_documents_info.status 
					FROM `vehicle_documents_info`
					LEFT JOIN vehicle_master ON vehicle_master.id=vehicle_documents_info.vehicle_id
					LEFT JOIN manufacturer_name ON manufacturer_name.id=vehicle_master.makers_name
					LEFT JOIN branch_master ON branch_master.id=vehicle_master.branch_status
					WHERE vehicle_documents_info.status='Active' AND vehicle_documents_info.deleted='No' and vehicle_id='".$vid."'
					ORDER BY vehicle_documents_info.id DESC";
		
		$query = $conn->query($sql);
		while($row12 = $query->fetch_assoc()){
			$vehicle_number =$row12['vehicle_number'];
			$manufacturname =$row12['name'];
			$oil_tank_capacity = $row12['oil_tank_capacity'];
			$chasis_number = $row12['chasis_number'];
			$engin_number = $row12['engin_number'];
			$year_of_manufacture = $row12['year_of_manufacture'];
			$branch_name = $row12['branch_name'];
			$purchase_date = $row12['purchase_date'];
			$create_date = $row12['create_date'];
			
			if($row12['type']=='regType'){
				$regcertificate = $row12['certificate'];
				$start_date = $row12['start_date'];
				$end_date = $row12['end_date'];
				$office_fee = $row12['office_fee'];
				$token_fee = $row12['token_fee'];
			}
			if($row12['type']=='insuType'){
				$insucertificate = $row12['certificate'];
				$insustart_date = $row12['start_date'];
				$insuend_date = $row12['end_date'];
				$insuoffice_fee = $row12['office_fee'];
				$insutoken_fee = $row12['token_fee'];
			}
			if($row12['type']=='RouteType'){
				$routcertificate = $row12['certificate'];
				$routstart_date = $row12['start_date'];
				$routend_date = $row12['end_date'];
				$routoffice_fee = $row12['office_fee'];
				$routtoken_fee = $row12['token_fee'];
			}
			
			if($row12['type']=='fitnessType'){
				$fitcertificate = $row12['certificate'];
				$fitstart_date = $row12['start_date'];
				$fitend_date = $row12['end_date'];
				$fitoffice_fee = $row12['office_fee'];
				$fittoken_fee = $row12['token_fee'];
			}
			
			if($row12['type']=='taxType'){
				$taxcertificate = $row12['certificate'];
				$taxstart_date = $row12['start_date'];
				$taxend_date = $row12['end_date'];
				$taxoffice_fee = $row12['office_fee'];
				$taxtoken_fee = $row12['token_fee'];
			}
		}
			$content .= '<tr>
			<td width="25%" class="citiestd15">Vehicle Number<br>Fuel Capacity<br>Chasis Number<br>Engin Number<br>Manufacture</td>
			<td width="25%" class="citiestd16">: '.$vehicle_number.' / '.$manufacturname.'<br>: '.$oil_tank_capacity.' L<br>: '.$chasis_number.'<br>: '.$engin_number.'<br>: '.$year_of_manufacture.'
			</td>
			<td width="15%" class="citiestd15">Branch <br>Purchase Date <br>Insert Date</td>
			<td width="35%" class="citiestd16">: '.$branch_name.'<br>: '.$purchase_date.'<br>: '.$create_date.'</td>
			</tr>';
			
			$content .= '<tr>
			<h4>Documents Information: </h4><br>
			<td width="25%" class="citiestd15"><br>
			Registration Cirtificate:<br><br><img src="../images/registration/'.$regcertificate.'" style="width: 200px; height: 120px;"/></td>
			<td width="10%" class="citiestd17"><br><br><br><br>Start Date<br>End Date<br>Office fee<br>Token fee</td>
			<td width="15%" class="citiestd18"><br><br><br><br>: '.$start_date.'<br>: '.$end_date.'<br>: '.$office_fee.' Tk<br>: '.$token_fee.' Tk</td>
			<td width="25%" class="citiestd15"><br>
			Insurance Cirtificate:<br><br><img src="../images/registration/'.$insucertificate.'" style="width: 200px; height: 120px;"/></td>
			<td width="10%" class="citiestd17"><br><br><br><br>Start Date<br>End Date<br>Office fee<br>Token fee</td>
			<td width="15%" class="citiestd18"><br><br><br><br>: '.$insustart_date.'<br>: '.$insuend_date.'<br>: '.$insuoffice_fee.' Tk<br>: '.$insuoffice_fee.' Tk</td>
			</tr>
			<tr>
			<td width="25%" class="citiestd15"><br><br>
			Fitness Cirtificate:<br><img src="../images/registration/'.$fitcertificate.'" style="width: 200px; height: 120px;"/></td>
			<td width="10%" class="citiestd17"><br><br><br><br>Start Date<br>End Date<br>Office fee<br>Token fee</td>
			<td width="15%" class="citiestd18"><br><br><br><br>: '.$fitstart_date.'<br>: '.$fitend_date.'<br>: '.$fitoffice_fee.' Tk<br>: '.$fittoken_fee.' Tk</td>
			<td width="25%" class="citiestd15"><br><br>
			Permit Cirtificate :<br><img src="../images/registration/'.$routcertificate.'" style="width: 200px; height: 120px;"/></td>
			<td width="10%" class="citiestd17"><br><br><br><br>Start Date<br>End Date<br>Office fee<br>Token fee</td>
			<td width="15%" class="citiestd18"><br><br><br><br>: '.$routstart_date.'<br>: '.$routend_date.'<br>: '.$routoffice_fee.' Tk<br>: '.$routtoken_fee.' Tk</td>
			</tr>
			<tr>
			<td width="25%" class="citiestd15"><br><br>
			Tax Token :<br><img src="../images/registration/'.$taxcertificate.'" style="width: 200px; height: 120px;"/></td>
			<td width="10%" class="citiestd17"><br><br><br><br>Start Date<br>End Date<br>Office fee<br>Token fee</td>
			<td width="15%" class="citiestd18"><br><br><br><br>: '.$taxstart_date.'<br>: '.$taxend_date.'<br>: '.$taxoffice_fee.' Tk<br>: '.$taxtoken_fee.' Tk</td>
			</tr>';
				
			$content .= '
			
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
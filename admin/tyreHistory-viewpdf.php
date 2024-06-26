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
			.citiestd15 {font-size: 10px;text-align: left;}
			.citiestd16 {font-size: 10px;color:gray;text-align: left;}
			span{font-size: 9px;}
			h2{font-size: 18px;text-align:center;}
		</style>';
		$pdf->Image('../images/ezzy-tracker-logo.png', 80, 5, 40, 15);
		$content .=' <br><br>
      	<p align="center">'.$firstname.' '.$lastname.', Bangladesh
		</p><br>
		<div class="cities"> Tyre History </div> <br>
		
		<table border="" cellspacing="0" cellpadding="3">

			<tr>
				<td width="70%" class="citiestd11">Company Name :<font color="gray">  '.$firstname.' '.$lastname.' Bangladesh</font></td>
				<td width="30%" class="citiestd14">Print Date :<font color="gray">'.$todayDate.'</font></td>
			</tr>
		</table> <br><br>
		<h3>Tyre Profile: </h3><br><br>
		<table  cellspacing="0" cellpadding="3">';
			$sql = "SELECT tyre_master.id,tyre_master.date,tyre_master.vehicle_no,vehicle_master.vehicle_number,tyre_master.tyre_type,tyre_master.tyre_position,tyre_master.tyre_no,tyre_master.tyre_company,tyre_master.tyre_model,
                    tyre_master.tyre_cost,tyre_master.supervisor,supervisor_master.supervisor_name,tyre_master.status 
                    FROM `tyre_master`
                    LEFT JOIN vehicle_master ON vehicle_master.id=tyre_master.vehicle_no
                    LEFT JOIN supervisor_master ON supervisor_master.id=tyre_master.supervisor
                    WHERE tyre_master.id='".$vid."'";
		
		$query = $conn->query($sql);
		while($row12 = $query->fetch_assoc()){
			
			$content .= '<tr>
						<td width="25%" class="citiestd15">	
						Entry Date<br>Tyre Status<br>Tyre Type<br>Tyre Number<br>Tyre Company<br>Tyre Model<br>Tyre Cost
						
						</td>
						<td width="25%" class="citiestd16">
						: '.$row12['date'].'<br>: '.$row12['status'].'<br>: '.$row12['tyre_type'].'<br>: '.$row12['tyre_no'].'<br>: '.$row12['tyre_company'].'<br>: '.$row12['tyre_model'].'<br>: '.$row12['tyre_cost'].'
						
						</td>
						<td width="25%" class="citiestd15">	
						vehicle_number<br>Supervisor Name
						
						</td>
						<td width="25%" class="citiestd16">
						: '.$row12['vehicle_number'].'<br>: '.$row12['supervisor_name'].'
						
						</td>
						
					</tr>
					    
			</table>
					';
					
			}	
			$content .= '
			
		</table><br><br>';
		
			
		$content .= '<style>
						.shoaib{width:33.3%;height: 50px;padding: 60px;border: 1px dotted gray;}
						span{text-align: center;color: gray;font-size: 10px;margin-top: 10%;}
					</style>
					
					</table><br><br><br><br><br><br><br><br>
					
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
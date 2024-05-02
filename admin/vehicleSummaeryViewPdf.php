<?php ob_start();
include 'includes/session.php';
$vId = $_GET['vId'];
$brID = $_GET['brID'];
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
			.citiestd12 {text-align: right;font-size: 8px;}
			.citiestd13 {text-align: right;font-size: 8px;}
			.citiestd11 {text-align: center;font-size: 8px;}
			.citiestd14 {text-align: center;font-size: 8px;}
			.citiestd16 {color: black;text-align: left;font-size: 9px;}
			span{text-align: right;font-size: 9px;}
			h2{font-size: 18px;text-align:center;}
		</style>';
		$pdf->Image('../images/ezzy-tracker-logo.png', 15, 10, 175, 17);
		
			$sql = "SELECT vehicle_master.vehicle_number,vehicle_master.branch_status,branch_master.branch_name							
                    FROM `vehicle_master` 
                    INNER JOIN branch_master ON branch_master.id=vehicle_master.branch_status
					WHERE vehicle_master.branch_status='".$brID."'";
		
		$query = $conn->query($sql);
		$idNo=1;
		$weQuantity =0;
		while($row = $query->fetch_assoc()){
			$branch_name=$row['branch_name'];
		}
		$content .=' <br><br><br><br><br>
		<div class="cities"> Vehicle Wise Summary History </div>
			
		<table border="0" cellspacing="0" cellpadding="3">

			<tr>
				<td width="50%">
					<span class="citiestd16">Factory Name :</span><font color="gray"  class="citiestd11"> '.$branch_name.'</font><br><span class="citiestd16">Start Date :</span><font color="gray"  class="citiestd11">  '.$ds.' </font><br><span class="citiestd16">End Date :</span><font color="gray"  class="citiestd11">  '.$de.' </font>
				</td>
				<td width="50%">
					<span class="citiestd16">Report Print Date :</span><font color="gray"  class="citiestd11">  '.date("Y-m-d h:i:s a").' </font>
				</td>
			</tr>
		</table> ';
		$content .='<br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="10%">Id</th>
				<th class="citiestd11" width="20%">Vehecle Number</th>
				<th class="citiestd11" width="17%">Total Trip</th>
				<th class="citiestd11" width="17%">Estimated Km</th>
				<th class="citiestd11" width="17%">VFT KM</th>
				<th class="citiestd11" width="19%">Total Fuel</th>
			</tr>';
			if($vId==''){
			$sql = "SELECT trip_sheets.id,vehicle_master.branch_status,COUNT(trip_sheets.trip_number) AS TotalTrip,trip_sheets.vehicle_no,vehicle_master.vehicle_number,vehicle_master.branch_status,SUM(trip_sheets.travel_distance) estimatedKm,SUM(trip_sheets.fuel_issue) AS TotalFuelIssue,SUM(trip_sheets.vft_km) AS TotalvftKm,trip_sheets.vft_fuel,trip_sheets.trip_start_date,trip_sheets.trip_end_date
                    FROM `trip_sheets`
                    LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no AND vehicle_master.delete_status='Active'
                    WHERE vehicle_master.branch_status='".$brID."' AND trip_sheets.create_date BETWEEN '".$ds."' AND '".$de."'
                    GROUP BY trip_sheets.vehicle_no ORDER BY `trip_sheets`.`id`  DESC";
			}else{
			$sql = "SELECT trip_sheets.id,vehicle_master.branch_status,trip_sheets.trip_number,trip_sheets.vehicle_no,vehicle_master.vehicle_number,vehicle_master.branch_status,trip_sheets.travel_distance,trip_sheets.fuel_issue,trip_sheets.vft_km,trip_sheets.vft_fuel,trip_sheets.trip_start_date,trip_sheets.trip_end_date
                    FROM `trip_sheets`
                    LEFT JOIN vehicle_master ON vehicle_master.id=trip_sheets.vehicle_no AND vehicle_master.delete_status='Active'
                    WHERE trip_sheets.vehicle_no='".$vId."' AND trip_sheets.create_date BETWEEN '".$ds."' AND '".$de."'
                    ORDER BY `trip_sheets`.`id`  DESC";   
			}		
		$query = $conn->query($sql);
		$idNo=1;
		while($row = $query->fetch_assoc()){
			
			$total =0;
			        if($vId!=''){
                            $totalTravel+=floatval($row['travel_distance']);
    						$totalfuelissue+=floatval($row['fuel_issue']);
    						$totalvftkm+=floatval($row['vft_km']);
    						$TotalTripPlus=count($row['trip_number']);
    						$TotalTrip=$row['trip_number'];
    						$estimatedKm=$row['travel_distance'];
    						$TotalvftKm=$row['vft_km'];
    						if($row['fuel_issue']==''){
    						    $TotalFuelIssue=0;
    						}else{
    						    $TotalFuelIssue=$row['fuel_issue'];
    						}
                        }else{
    						$totalTravel+=floatval($row['estimatedKm']);
    						$totalfuelissue+=floatval($row['TotalFuelIssue']);
    						$totalvftkm+=floatval($row['TotalvftKm']);
    						$TotalTripPlus+=$row['TotalTrip'];
    						$TotalTrip=$row['TotalTrip'];
    						$estimatedKm=$row['estimatedKm'];
    						$TotalvftKm=$row['TotalvftKm'];
    						
    						if($row['TotalFuelIssue']==''){
    						    $TotalFuelIssue=0;
    						}else{
    						    $TotalFuelIssue=$row['TotalFuelIssue'];
    						}
                        }
			
			
			$content .= '<tr>
						<td class="citiestd11">'.$idNo++.'</td>
						<td class="citiestd11">'.$row['vehicle_number'].'</td>
						<td class="citiestd12">'.$TotalTrip.'</td>
						<td class="citiestd12">'.$estimatedKm.' km</td>
						<td class="citiestd12">'.$TotalvftKm.' km</td>
						<td class="citiestd12">'.$TotalFuelIssue.' L</td>
						</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td class="citiestd13">Total </td><td class="citiestd13">'.($idNo-1).' </td><td class="citiestd13">'.$totalTravel.' Km</td><td class="citiestd13">'.$totalvftkm.' Km</td><td class="citiestd13">'.$totalfuelissue.' L</td></tr>
		</table><br><br>';
			
		
			
		$content .= '<style>
						.shoaib{width:33.3%;height: 50px;padding: 60px;border: 1px dotted gray;}
						span{text-align: center;color: gray;font-size: 10px;margin-top: 10%;}
					</style>
					
					</table><br><br><br><br>
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
<?php ob_start();
include 'includes/session.php';
$id = $_GET['id'];
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
				.citiestd18 {font-size: 12px;color:gray;text-align: left;padding-top: 3%;}
				.caption { background-color: gray;}
				span{font-size: 9px;}
				h2{font-size: 18px;text-align:center;}
                .uline {text-decoration: underline;}
                .outerBorder{border:1px solid gray;}
		    </style>';
$pdf->Image('../images/ezzy-tracker-logo.png', 15, 10, 175, 17);
$content .= ' <br><br>
			<p align="center">	</p><br>
			<div class="cities"> Maintenance Devision </div> <br>
			<table border="0" cellspacing="0" cellpadding="3">
				<tr>
					<td width="20%" class="citiestd11"> 
					<input type="checkbox" class="citiestd18" id="vehicle1" name="vehicle1" value="CHO"><label  class="citiestd18" for="vehicle1"> CHO</label>
					</td><td width="40%" class="citiestd11"> 
					<input type="checkbox" class="citiestd18"  id="vehicle1" name="vehicle1" value="Factory"> <label class="citiestd18" for="vehicle1"> Factory</label>
					</td>
					<td width="30%" class="citiestd14">Print Date :<font color="gray">' . $todayDate . '</font><br>Printed By :<font color="gray">' . $firstname . ' ' . $lastname . '</font></td>
				</tr>
			</table>
			
			';

if (isset ($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT tbl_token.* ,vehicle_master.vehicle_number,user.firstname user_name,  m.firstname m_name, e.firstname e_name ,
    driver_master.driver_name,manufacturer_name.name,vehicle_master.maker_brand,vehicle_master.cc_brand,vehicle_master.fuel_type,vehicle_master.wings_name,vehicle_master.employee_name,vehicle_master.location,tbl_warehouse.wareHouseName,tbl_warehouse.wareHouseAddress,tbl_warehouse.type
from tbl_token 
            left outer join vehicle_master  on tbl_token.vehicle_id = vehicle_master.id
            LEFT OUTER JOIN manufacturer_name ON manufacturer_name.id=vehicle_master.makers_name
            left outer join driver_master on tbl_token.driver_id = driver_master.id
            left outer join admin as user on tbl_token.created_by = user.id
			left outer join admin as m on tbl_token.mechanic_id = m.id
            LEFT OUTER JOIN tbl_warehouse on tbl_warehouse.id=tbl_token.warehouse_id
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
    $created_date = $row12['created_date'];
    $current_mileage = $row12['current_mileage'];
    $driver_name = $row12['driver_name'];
    $user_name = $row12['user_name'];
    $problems = $row12['problems'];
    $sql2 = "SELECT  max(tbl_token.created_date) from tbl_token
    left outer join vehicle_master  on tbl_token.vehicle_id = vehicle_master.id
    where tbl_token.created_date < '$created_date' AND vehicle_master.vehicle_number = '$vehicle_number' LIMIT 1";

    $query2 = $conn->query($sql2);
    $row13 = $query2->fetch_assoc();
    $last_repair_date = $row13['created_date'];
    $content .= '<h3>Demand Letter Title : '.$row12['token_title'].'</h3><br><br><table cellspacing="0" cellpadding="3" class="outerBorder">
                <tr width="100%"  >
                    <td width="15%" class="citiestd15">Vehicle Number </td>
                    <td width="50%" class="citiestd16">: ' . $vehicle_number . ' '.$row12['name'].' '.$row12['maker_brand'].' '.$row12['cc_brand'].' CC</td>

                    <td width="15%" class="citiestd15">Date </td>
                    <td width="20%" class="citiestd16">: ' . $created_date . '</td>
                </tr>
                <tr width="100%"  >
                    <td width="15%" class="citiestd15">User Name </td>
                    <td width="50%" class"citiestd16">: ' .$row12['employee_name']. '</td>
                    
                    
                    <td width="15%" class="citiestd15">Last Repair Date </td>
                    <td width="20%" class="citiestd16">: ' . $token_date . '</td>
                </tr>
                <tr width="100%"  >
                    <td width="15%" class="citiestd15">Driver Name </td>
                    <td width="50%" class="citiestd16">: ' . $driver_name . '</td>
                    
                    <td width="15%" class="citiestd15">Current Milage </td>
                    <td width="20%" class="citiestd16">: ' . $current_mileage . '</td>
                </tr>
                <tr width="100%"  >
                    <td width="15%" class="citiestd15">Engineer Name </td>
                    <td width="50%" class="citiestd16">: ' . $e_name . ' Mechanics : ' . $m_name . '</td>
                </tr>
                </table> <br><br>';
                
    $content .= '<table  class="outerBorder"  cellspacing="0" cellpadding="3" >
                    <tr><td  class="citiestd15">Exiting Problem as we have observed: </td></tr>
                    <tr><td  class="citiestd15">' . $problems . '</td> </tr>
                </table> <br><br>';

    $content .= '<h1>For Workshop</h1>';
    $content .= '<table>
        <tr>
            <td width="70%">'.$row12['wareHouseName'].' - '.$row12['type'].' '.$row12['wareHouseAddress'].'<br><pre>____________________</pre><h4>Workshop Authority</h4><br><h4>Note:</h4></td>
          
        </tr>
    </table>';
    $content .= '</br><table>
    <tr>
        <td width="70%"><pre>____________________</pre><h4>Engine-TPT</h4></td>
        <td width="70%"><pre>____________________</pre><h4>Asst. Manager-TPT</h4></td>
      
    </tr>
    <tr>Your estimated repair cost is accepted and we are placing work order for necessary job according to your diagnosis/not accepted
    </tr>
</table><br><br><br>';
    $content .= '</br><table>
        <tr>
            <td width="70%"><pre>____________________</pre><h4>DGM/AGM-Transport</h4><br><h4>Comment on work done by machine (with amount).....................</h4></td>
          
        </tr>
    </table><br><hr>';
    $content .= '<h4>Old Spare parts to be received & acknowledge by store which will be gone under physical inventory by audit periodically</h4></br></br>';
    $content .= '<h4>Spare List</h4></br></br>';
    $content .= '</br><table>
    <tr>
        <td width="70%"><pre>____________________</pre><h4>Palmal Store</h4><br><h4>Observed on work done by user</h4></td>
      
    </tr>
</table><br>';
$content .= '<h4>As per requisition/Demand work is done/not done. Details (if any)</h4><br><h4><br><br>User Sign & Date</h4>';

} else {
    $content .= "<h3>Unauthorized Token Number.</h3>";
}



$pdf->writeHTML($content);
ob_end_clean();
$pdf->Output('schedule.pdf', 'I');
ob_end_flush();
?>
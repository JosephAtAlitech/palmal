<?php ob_start(); 
include 'includes/session.php';
$id = $_GET['id'];

$image ='';	
	require_once('tcpdf/tcpdf.php');


		// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        
       
        $image_file = 'logo_example.png';
        $this->Image($image_file, 10, 10, 15, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        
        // Position at 15 mm from bottom
        $this->SetY(-12);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Powered By Alitech. Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
    }
}

		
    //$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Duronto Shop Management System');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '', PDF_MARGIN_RIGHT);  
    $pdf->SetMargins('8', '47', '8');
    $pdf->setPrintHeader(TRUE);  
    $pdf->setPrintFooter(TRUE);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();

    $content = '<style>
				h1 {font-size: 8px;}
				</style>'; 
				$content .= '<h1>abc</h1>';
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$sql = "SELECT tbl_token.* , m.firstname m_name, e.firstname e_name from tbl_token 
							join admin as m on tbl_token.mechanic_id = m.id
							join admin as e on tbl_token.engineer_id = e.id
							WHERE id= '".$id."' ORDER BY id DESC";
				
				$query = $conn->query($sql);
				$row12 = $query->fetch_assoc();
				$token_title =$row12['token_title'];
				$token_details =$row12['token_details'];
				$m_name = $row12['m_name'];
				$e_name = $row12['e_name'];
				$create_date = $row12['created_date'];
				$content .= '<table>
				<thead><tr>a</tr><tr>a</tr><tr>a</tr><tr>a</tr><tr>a</tr>
				</thead>
				<tbody>
				<tr>
							<td width="25%" class="citiestd15">Token title </br>Token details<br>Chasis Number</br>Engin Number</br>Manufacture</td>
							<td width="25%" class="citiestd16">: '.$token_title.'</br>: '.$token_details.' L</br>: '.$m_name.'</br>: '.$e_name.'</br>: N/A
							</td>
							<td width="15%" class="citiestd15">Branch </br>Purchase Date </br>Insert Date</td>
							<td width="35%" class="citiestd16">: gghjghj</br>:hjkhjk<br>: '.$create_date.'</td>
							</tr></table></tbody>';
				}
	$pdf->writeHTML($content);  
     ob_end_clean();
	$pdf->Output('schedule.pdf', 'I');
     ob_end_flush();


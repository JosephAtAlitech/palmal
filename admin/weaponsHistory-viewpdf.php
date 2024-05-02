<?php ob_start();
include 'includes/session.php';
$catName = $_GET['catName'];
$brandId = $_GET['brandId'];
$type = $_GET['type'];
//$ym = date("Y-m", strtotime($id));	

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
    $pdf->SetTitle('Bangladesh Police - Distribute ACK');  
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
	$sql = "SELECT thana.id,thana.districts_id,districts.division,thana.phone,thana.thana_name,thana.address,thana.thana_status
			FROM `thana`
			LEFT JOIN districts ON districts.id=thana.districts_id
			WHERE thana.thana_status='Armory'";
			
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			$id=$row['id'];
			$division=$row['division'];
			$phone=$row['phone'];
			$thana_name=$row['thana_name'];
			$address=$row['address'];
			$thana_status=$row['thana_status'];
		}
    $content .= '<style>p{color:black;font-size: 8px;}
			.cities {background-color: gray;color: white;text-align: center;padding: 30px;}
			.citiestd {background-color: yellow;color: black;text-align: center;}
			.citiestd12 {background-color: gray;color: white;text-align: center;}
			.citiestd13 {background-color: orange;color: white;text-align: center;}
			.citiestd11 {text-align: center;}
			span{font-size: 9px;}
			h2{font-size: 18px;text-align:center;}
		</style>';
		$pdf->Image('../images/companylogo/BP.jpg', 85, 1, 30, 30);
		$content .=' <br><br><br>
      	<h2>Bangladesh Police</h2>
      	<p align="center">'.$thana_name." , ".$address.' - '.$division.' , '.$phone.', Bangladesh
		</p><br>
		<div class="cities"> Weapons History </div> <br>
		
		<table border="" cellspacing="0" cellpadding="3">

			<tr>
				<td width="100%">Armory Name :<font color="gray">  '.$thana_name." , ".$address.' - '.$division.','.$phone.' Bangladesh</font><br>
				Weapons Type :<font color="gray">  '.$catName.' / '.$type.'</font></td>
			</tr>
		</table> <br><br>
		<u> Weapons History </u><br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="8%">Id</th>
				<th class="citiestd11" width="12%">Type</th>
				<th class="citiestd11" width="20%">Categories</th>
				<th class="citiestd11" width="20%">Brands</th>
				<th class="citiestd11" width="15%">Body No</th>
				<th class="citiestd11" width="15%">Name</th>
				<th class="citiestd11" width="10%">Quantity</th>
				
			</tr>';
			$sql = "SELECT product.id,product.type,product.body_no,product.we_name,product.bu_name,product.product_image,product.brand_id,product.categories_id,product.quantity AS quantity,
					brands.brand_type,brands.brand_name,categories.categories_type,categories.categories_name
							FROM `product` 
							LEFT JOIN brands ON brands.id=product.brand_id
							LEFT JOIN categories ON categories.id=product.categories_id
							where categories.categories_type='".$type."' and categories.categories_name='".$catName."'";
		
		$query = $conn->query($sql);
		while($row12 = $query->fetch_assoc()){
			
			$we_quantity =$row12['quantity'];
			//$bu_quantity =$row12['bu_quantity'];
			$weQuantity += $we_quantity;
			//$weQuantitybu += $we_quantity;
			//$weQuantitybu12 += $bu_quantity;
			
			$content .= '<tr>
						<td class="citiestd11">'.$row12['id'].'</td>
						<td class="citiestd11">'.$row12['type'].'</td>
						<td class="citiestd12">'.$row12['categories_name'].'</td>
						<td class="citiestd12">'.$row12['brand_name'].'</td>
						<td class="citiestd12">'.$row12['body_no'].'</td>
						<td class="citiestd12">'.$row12['we_name'].' '.$row12['bu_name'].'</td>
						<td class="citiestd11">'.$row12['quantity'].'</td>
						
					</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td></td><td></td><td></td><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity.'</td></tr>
		</table><br><br>';
		
			
		$content .= '<style>
						.shoaib{width:33.3%;height: 50px;padding: 60px;border: 1px dotted gray;}
						span{text-align: center;color: gray;font-size: 10px;margin-top: 10%;}
					</style>
					
					</table><br><br><br><br><br><br>
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
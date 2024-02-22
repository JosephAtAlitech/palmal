<?php ob_start();
include 'includes/session.php';
$cName=$_GET['cName'];
	$Ds=$_GET['ds'];
	$De=$_GET['de'];
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
				<td width="100%">
					Armory Name :<font color="gray">  '.$thana_name." , ".$address.' - '.$division.','.$phone.' Bangladesh</font>
					<br>Start Date :<font color="gray">  '.$Ds.' </font> To End Date :<font color="gray">  '.$De.' </font>
					<br>Report Generate Date :<font color="gray">  '.date("Y-m-d h:i:s a").' </font>
				</td>
			</tr>
		</table> <br><br>
		Weapons Information :<br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="8%">Id</th>
				<th class="citiestd11" width="15%">Type</th>
				<th class="citiestd11" width="34%">Categories</th>
				<th class="citiestd11" width="33%">Brands</th>
				<th class="citiestd11" width="10%">Quantiry</th>
				
			</tr>';
			$sql = "SELECT product.id,product.type,product.ranks,product.product_image,product.body_no,product.we_name,product.brand_id,product.categories_id,
				SUM(product.quantity) AS quantity,brands.brand_type,brands.brand_name,categories.categories_type,categories.categories_name,product.create_date
				FROM `product` 
				LEFT JOIN brands ON brands.id=product.brand_id
				LEFT JOIN categories ON categories.id=product.categories_id
				where product.type='Weapons' AND product.create_date BETWEEN '".$Ds."' AND '".$De."'
				GROUP BY categories.categories_name,product.we_name";
		
		$query = $conn->query($sql);
		$idNo=1;
		while($row12 = $query->fetch_assoc()){
			
			$we_quantity =$row12['quantity'];
			//$bu_quantity =$row12['bu_quantity'];
			$weQuantity += $we_quantity;
			//$weQuantitybu += $we_quantity;
			//$weQuantitybu12 += $bu_quantity;
			
			$content .= '<tr>
						<td class="citiestd11">'.$idNo++.'</td>
						<td class="citiestd11">'.$row12['type'].'</td>
						<td class="citiestd12">'.$row12['categories_name'].' - '.$row12['we_name'].'</td>
						<td class="citiestd12">'.$row12['brand_name'].'</td>
						<td class="citiestd11">'.$row12['quantity'].'</td>
						
					</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td></td><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity.'</td></tr>
		</table><br><br>';
		
		$content .= '
		Bullets Information :<br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="8%">Id</th>
				<th class="citiestd11" width="15%">Type</th>
				<th class="citiestd11" width="34%">Categories</th>
				<th class="citiestd11" width="33%">Brands</th>
				<th class="citiestd11" width="10%">Quantity</th>
				
			</tr>';
			$sql = "SELECT product.id,product.type,product.ranks,product.product_image,product.brand_id,product.bu_name,product.categories_id,
					SUM(product.quantity) AS quantity12,brands.brand_type,brands.brand_name,categories.categories_type,categories.categories_name,product.create_date
							FROM `product` 
							LEFT JOIN brands ON brands.id=product.brand_id
							LEFT JOIN categories ON categories.id=product.categories_id
							where product.type='Bullets' AND product.create_date BETWEEN '".$Ds."' AND '".$De."' GROUP BY categories.categories_name,product.bu_name";
		
		$query = $conn->query($sql);
		$idNo=1;
		while($row12 = $query->fetch_assoc()){
			
			$we_quantity12 =$row12['quantity12'];
			//$bu_quantity =$row12['bu_quantity'];
			$weQuantity12 += $we_quantity12;
			//$weQuantitybu += $we_quantity;
			//$weQuantitybu12 += $bu_quantity;
			
			$content .= '<tr>
						<td class="citiestd11">'.$idNo++.'</td>
						<td class="citiestd11">'.$row12['type'].'</td>
						<td class="citiestd12">'.$row12['categories_name'].' - '.$row12['bu_name'].'</td>
						<td class="citiestd12">'.$row12['brand_name'].'</td>
						<td class="citiestd11">'.$row12['quantity12'].'</td>
						
					</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td></td><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity12.'</td></tr>
		</table><br><br>';
			
		$content .= '
		Distribute Information :<br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="8%">Id</th>
				<th class="citiestd11" width="42%">Details Information</th>
				<th class="citiestd11" width="19%">DisQuantity</th>
				<th class="citiestd11" width="19%">RetQuantity</th>
				<th class="citiestd11" width="12%">Remaining</th>
				
			</tr>';
			$sql = "SELECT wepons_distribution.id,wepons_distribution.thanaid,wepons_distribution.purpose,wepons_distribution.creationDate,
							thana.thana_name,thana.phone,thana.thana_status,thana.address,wepons_wepons.name,product.ranks,brands.brand_name,categories.categories_name,categories.categories_type,
							SUM(IF(categories.categories_type='Weapons',wepons_wepons.quantity,NULL)) wequantity,
							SUM(IF(categories.categories_type='Weapons',wepons_wepons.adj_quantity,NULL)) adj_wequantit,
							SUM(IF(categories.categories_type='Bullets',wepons_wepons.quantity,NULL)) buquantity,
							SUM(IF(categories.categories_type='Bullets',wepons_wepons.adj_quantity,NULL)) adj_buquantit,
							wepons_wepons.reamrks
							FROM `wepons_distribution`
							LEFT JOIN wepons_wepons ON wepons_wepons.we_distid=wepons_distribution.id
							LEFT JOIN product ON product.id=wepons_wepons.name
							LEFT JOIN brands ON brands.id=product.brand_id
							LEFT JOIN categories ON categories.id=product.categories_id
							LEFT JOIN thana ON thana.id=wepons_distribution.thanaid
							WHERE wepons_distribution.creationDate BETWEEN '".$Ds."' AND '".$De."'
							GROUP BY wepons_distribution.thanaid";
		
		$query = $conn->query($sql);
		$idNo=1;
		while($row12 = $query->fetch_assoc()){
			
			//$we_quantity12 =$row12['quantity12'];
			//$bu_quantity =$row12['bu_quantity'];
			
			$weQuantitybu = $row12['wequantity'] - $row12['adj_wequantit'];
			$buQuantitybu = $row12['buquantity'] - $row12['adj_buquantit'];
			$weQuantity123 += $weQuantitybu;
			$buQuantity123 += $buQuantitybu;
			$totalWeapons=$weQuantity-$weQuantity123;
			$totalBullets=$weQuantity12-$buQuantity123;
			
			$content .= '<tr>
						<td class="citiestd11">'.$idNo++.'</td>
						<td class="citiestd12">'.$row12['thana_name'].' ('.$row12['thana_status'].')<br>'.$row12['address'].'<br>Phone: '.$row12['phone'].'</td>
						<td class="citiestd12">Weapons : '.$row12['wequantity'].'<br>Bullets : '.$row12['buquantity'].'</td>
                        <td class="citiestd12">Weapons : '.$row12['adj_wequantit'].'<br>Bullets : '.$row12['adj_buquantit'].'</td>
						<td class="citiestd11">'.$weQuantitybu.'<br>'.$buQuantitybu.'</td>
						
					</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td></td><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity123.'<br>'.$buQuantity123.'</td></tr>
		</table><br><br>';
			$content .='
			
				<table>
					
					<tr><br>
						<td width="57%"> </td>
						<td width="33%">Total Armory Weapons :  '.$weQuantity.'</td>
					</tr>
					<tr>
						<td width="59.7%"></td>
						<td width="40.3%">Total Armory Bullets : '.$weQuantity12.'</td>
					</tr>
					<tr>
						<td width="60.3%"></td>
						<td width="39.7%">Distribute Weapons : '.$weQuantity123.'</td>
					</tr>
					<tr>
						<td width="63%"></td>
						<td width="35%">Distribute Bullets : '.$buQuantity123.'</td>
					</tr>
					<tr>
						<td width="48%"></td>
						<td width="52%">Total Weapons Store in Armory : '.$totalWeapons.'</td>
					</tr>
					<tr>
						<td width="50.7%"></td>
						<td width="49%">Total Bullets Store in Armory : '.$totalBullets.'</td>
					</tr>
					
				</table>
			';
		$content .= '<style>
						.shoaib{width:33.3%;height: 50px;padding: 60px;border: 1px dotted gray;}
						span{text-align: center;color: gray;font-size: 10px;margin-top: 10%;}
					</style>
					
					</table><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
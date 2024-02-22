<?php ob_start();
include 'includes/session.php';
$pid = $_GET['pid'];
$thanaId = $_GET['thanaId'];
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
	$sql = "SELECT wepons_distribution.id,wepons_distribution.thanaid,wepons_distribution.creationDate,districts.division,districts.districts,wepons_distribution.purpose,wepons_distribution.creationDate,
				thana.thana_name,thana.address,wepons_wepons.name,product.ranks,brands.brand_name,categories.categories_name,categories.categories_type,SUM(wepons_wepons.quantity) AS quantity,wepons_wepons.reamrks,
				thana.phone
				FROM `wepons_distribution`
				LEFT JOIN wepons_wepons ON wepons_wepons.we_distid=wepons_distribution.id
				LEFT JOIN product ON product.id=wepons_wepons.name
				LEFT JOIN brands ON brands.id=product.brand_id
				LEFT JOIN categories ON categories.id=product.categories_id
				LEFT JOIN thana ON thana.id=wepons_distribution.thanaid
                LEFT JOIN districts ON districts.id=thana.districts_id
				WHERE wepons_distribution.thanaid='".$thanaId."' GROUP BY wepons_wepons.name LIMIT 1";
		
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			$id=$row['id'];
			$division=$row['division'];
			$districts=$row['districts'];
			$thana_name=$row['thana_name'];
			$address=$row['address'];
			$name=$row['name'];
			$phone=$row['phone'];
			$create_date=$row['creationDate'];
			//$adjustment_date=$row['adjustment_date'];
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
      	<p align="center">'.$thana_name." , ".$address.' - '.$districts.' , '.$division.', Bangladesh
		</p><br>
		<div class="cities">Weapons Distribute History </div> <br>
		
		<table border="" cellspacing="0" cellpadding="3">
			<tr>
				<td width="100%">Distribute By :<font color="gray"> '.$districts.'  Police Armory </font></td>
			</tr>
			<tr>
				<td width="100%">Received By :<font color="gray"> '.$thana_name." , ".$address.' - '.$districts.' , '.$division.', Bangladesh </font></td>
			</tr>
			<tr>
				<td width="100%">Delivery Date :<font color="gray"> '.$create_date.'</font></td>
			</tr>
		</table> <br><br>
		<u>Distribute weapons information </u><br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="13%">Date</th>
				<th class="citiestd11" width="35%">Details</th>
				<th class="citiestd11" width="42%">BodyNo</th>
				<th class="citiestd11" width="10%">Quantity</th>
				
			</tr>';
			$sql = "SELECT wepons_distribution.id,wepons_distribution.thanaid,wepons_distribution.purpose,wepons_distribution.creationDate,wepons_wepons.thana_id,
						thana.thana_name,thana.address,wepons_wepons.name,product.brand_id,product.we_name,product.bu_name,brands.brand_name,product.categories_id,categories.categories_name,product.type,wepons_wepons.quantity,wepons_wepons.body_number,wepons_wepons.reamrks
						FROM `wepons_distribution`
						LEFT JOIN wepons_wepons ON wepons_wepons.we_distid=wepons_distribution.id
						LEFT JOIN thana ON thana.id=wepons_distribution.thanaid
						LEFT JOIN product ON product.id=wepons_wepons.name
						LEFT JOIN brands ON brands.id=product.brand_id
						LEFT JOIN categories ON categories.id=product.categories_id WHERE categories.categories_type='Weapons' and wepons_distribution.thanaid='".$thanaId."' ORDER BY `product`.`type` ASC ";
		
		$query = $conn->query($sql);
		while($row12 = $query->fetch_assoc()){
			
			$we_quantity =$row12['quantity'];
			//$bu_quantity =$row12['bu_quantity'];
			$weQuantity += $we_quantity;
			//$weQuantitybu += $we_quantity;
			//$weQuantitybu12 += $bu_quantity;
			
			$content .= '<tr>
						<td class="">'.$row12['creationDate'].'</td>
						<td class="citiestd12">'.$row12['categories_name'].' - '.$row12['we_name'].' '.$row12['bu_name'].' ('.$row12['type'].') / '.$row12['brand_name'].' </td>
						<td class="citiestd12">'.$row12['body_number'].'</td>
						<td class="citiestd11">'.$row12['quantity'].'</td>
					</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity.'</td></tr>
		</table><br><br>
		<u>Distribute Bullets information </u><br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="13%">Date</th>
				<th class="citiestd11" width="77%">Details</th>
				<th class="citiestd11" width="10%">Quantity</th>
				
			</tr>';
			$sql = "SELECT wepons_distribution.id,wepons_distribution.thanaid,wepons_distribution.purpose,wepons_distribution.creationDate,wepons_wepons.thana_id,
						thana.thana_name,thana.address,wepons_wepons.name,product.brand_id,product.we_name,product.bu_name,brands.brand_name,product.categories_id,categories.categories_name,product.type,wepons_wepons.quantity,wepons_wepons.body_number,wepons_wepons.reamrks
						FROM `wepons_distribution`
						LEFT JOIN wepons_wepons ON wepons_wepons.we_distid=wepons_distribution.id
						LEFT JOIN thana ON thana.id=wepons_distribution.thanaid
						LEFT JOIN product ON product.id=wepons_wepons.name
						LEFT JOIN brands ON brands.id=product.brand_id
						LEFT JOIN categories ON categories.id=product.categories_id WHERE categories.categories_type='Bullets' and wepons_distribution.thanaid='".$thanaId."' ORDER BY `product`.`type` ASC ";
		
		$query = $conn->query($sql);
		while($row12 = $query->fetch_assoc()){
			
			$we_quantity =$row12['quantity'];
			//$bu_quantity =$row12['bu_quantity'];
			$weQuantity012 += $we_quantity;
			//$weQuantitybu += $we_quantity;
			//$weQuantitybu12 += $bu_quantity;
			
			$content .= '<tr>
						<td class="">'.$row12['creationDate'].'</td>
						<td class="citiestd12">'.$row12['categories_name'].' - '.$row12['we_name'].' '.$row12['bu_name'].' ('.$row12['type'].') / '.$row12['brand_name'].' </td>
						<td class="citiestd11">'.$row12['quantity'].'</td>
					</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity012.'</td></tr>
		</table><br><br>';
		$content .='
		<u>Adjustment weapons information </u><br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="13%">Date</th>
				<th class="citiestd11" width="35%">Details</th>
				<th class="citiestd11" width="42%">BodyNo</th>
				<th class="citiestd11" width="10%">Quantity</th>
				
			</tr>';
			$sql = "SELECT wepons_distribution.id,wepons_distribution.thanaid,wepons_distribution.purpose,wepons_wepons.adj_date,wepons_wepons.thana_id,
						thana.thana_name,thana.address,wepons_wepons.name,product.brand_id,product.we_name,product.bu_name,brands.brand_name,product.categories_id,categories.categories_name,product.type,wepons_wepons.adj_body_number,wepons_wepons.adj_quantity,wepons_wepons.adj_remarks
						FROM `wepons_distribution`
						LEFT JOIN wepons_wepons ON wepons_wepons.we_distid=wepons_distribution.id
						LEFT JOIN thana ON thana.id=wepons_distribution.thanaid
						LEFT JOIN product ON product.id=wepons_wepons.name
						LEFT JOIN brands ON brands.id=product.brand_id
						LEFT JOIN categories ON categories.id=product.categories_id WHERE categories.categories_type='Weapons' and wepons_wepons.adj_flag!='' AND wepons_distribution.thanaid='".$thanaId."' ORDER BY `product`.`type` ASC";
		
		$query = $conn->query($sql);
		while($row123 = $query->fetch_assoc()){
			
			$we_quantity123 =$row123['adj_quantity'];
			//$bu_quantity =$row12['bu_quantity'];
			$weQuantity123 += $we_quantity123;
			//$weQuantitybu += $we_quantity;
			//$weQuantitybu12 += $bu_quantity;
			
			$content .= '<tr>
						<td class="">'.$row123['adj_date'].'</td>
						<td class="citiestd12">'.$row123['categories_name'].' - '.$row123['we_name'].' '.$row123['bu_name'].' ('.$row123['type'].') / '.$row123['brand_name'].' </td>
						<td class="citiestd12">'.$row123['adj_body_number'].'</td>
						<td class="citiestd11">'.$row123['adj_quantity'].'</td>
						
					</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity123.'</td></tr>
		</table><br><br>';
		$content .='
		<u>Adjustment Bullets information </u><br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="13%">Date</th>
				<th class="citiestd11" width="77%">Details</th>
				<th class="citiestd11" width="10%">Quantity</th>
				
			</tr>';
			$sql = "SELECT wepons_distribution.id,wepons_distribution.thanaid,wepons_distribution.purpose,wepons_wepons.adj_date,wepons_wepons.thana_id,
						thana.thana_name,thana.address,wepons_wepons.name,product.brand_id,product.we_name,product.bu_name,brands.brand_name,product.categories_id,categories.categories_name,categories.categories_type,wepons_wepons.adj_body_number,wepons_wepons.adj_quantity,wepons_wepons.adj_remarks
						FROM `wepons_distribution`
						LEFT JOIN wepons_wepons ON wepons_wepons.we_distid=wepons_distribution.id
						LEFT JOIN thana ON thana.id=wepons_distribution.thanaid
						LEFT JOIN product ON product.id=wepons_wepons.name
						LEFT JOIN brands ON brands.id=product.brand_id
						LEFT JOIN categories ON categories.id=product.categories_id WHERE categories.categories_type='Bullets' and wepons_wepons.adj_flag!='' AND wepons_distribution.thanaid='".$thanaId."' ORDER BY `categories`.`categories_type` ASC";
		
		$query = $conn->query($sql);
		while($row123 = $query->fetch_assoc()){
			
			$we_quantity123 =$row123['adj_quantity'];
			//$bu_quantity =$row12['bu_quantity'];
			$weQuantity1234 += $we_quantity123;
			//$weQuantitybu += $we_quantity;
			//$weQuantitybu12 += $bu_quantity;
			
			$content .= '<tr>
						<td class="">'.$row123['adj_date'].'</td>
						<td class="citiestd12">'.$row123['categories_name'].' - '.$row123['we_name'].' '.$row123['bu_name'].' ('.$row123['categories_type'].') / '.$row123['brand_name'].' </td>
						<td class="citiestd11">'.$row123['adj_quantity'].'</td>
						
					</tr>
					
					';
					
			}	
			$content .= '
			<tr><td></td><td class="citiestd11" >Total = </td><td class="citiestd11">'.$weQuantity1234.'</td></tr>
		</table><br><br>';
		$ramining =($weQuantity-$weQuantity123);
		$raminingBullets =($weQuantity012-$weQuantity1234);
		$content .='
			
				<table>
					<tr><br>
						<td width="60%"> </td>
						<td width="30%">Delivery Weapons :  '.$weQuantity.'</td>
					</tr>
					<tr>
						<td width="62.8%"> </td>
						<td width="30%">Delivery Bullets :  '.$weQuantity012.'</td>
					</tr><br>
					<tr>
						<td width="57%"></td>
						<td width="30%">Adjustment Weapons : '.$weQuantity123.'</td>
					</tr>
					<tr>
						<td width="59.6%"></td>
						<td width="30%">Adjustment Bullets : '.$weQuantity1234.'</td>
					</tr><br>
					<tr>
						<td width="57.5%"></td>
						<td width="35%">Remaining Weapons : <b>'.$ramining.'</b></td>
					</tr>
					<tr>
						<td width="60%"></td>
						<td width="35%">Remaining Bullets : <b>'.$raminingBullets.'</b></td>
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
							<td width="70%"><pre>-------------------------------</pre>Distributed by<br>(Sign With date)</td>
							<td width="30%"><pre>-------------------------------</pre>Received by<br>(Sign With date)</td>
						</tr>
						
				</table>
			';
	$pdf->writeHTML($content);  
    ob_end_clean();
	$pdf->Output('schedule.pdf', 'I');
    ob_end_flush();
?>
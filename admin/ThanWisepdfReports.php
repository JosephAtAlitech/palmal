<?php
include 'includes/session.php';
$cName = $_GET['ThanaID'];
$Ds = $_GET['ds'];
$De = $_GET['de'];
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
	$sql = "SELECT thana.id,thana.thana_name,thana.address FROM `thana` WHERE thana.id='".$cName."' ";
		
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			$id=$row['id'];
			$firm_name=$row['thana_name'];
			$web_url=$row['address'];
			
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
      	<p align="center">House No: 214, Road No: 13,New DOHS, Mohakhali Dhaka- 1206,Bangladesh
		</p><br>
		<div class="cities"> Distribute / Adjustment Reports </div> <br>
		
		<table border="" cellspacing="0" cellpadding="3">
			<tr>
				<td width="65%">Thana Name :<font color="gray"> '.$firm_name.'</font><br>Address :<font color="gray"> '.$web_url.'</font> <br>
				
				</td>
				<td width="35%">Delivery Date :<font color="gray"> '.$Ds.'</font> To :<font color="gray"> '.$De.'</font></td>
				
			</tr>
		</table> ';
			
			$content .= ' 
			<style>p{color:black;font-size: 8px;}
			.cities {background-color: gray;color: white;text-align: center;padding: 20px;}
			span{font-size: 20px;text-align:center;}
			th{font-size: 10px;}
			td{font-size: 8px;}
			</style>
					<br><h5 align="center">Non-Adjustment Weapons Againest Distribute</h5><br>
			<table border="1" cellspacing="0" cellpadding="3">
			<tr>
				<th width="3%">id</th><th width="18%">Name</th><th width="22%">Date</th><th width="27%">Details</th><th width="10%">DQuantity</th><th width="10%">RQuantity</th><th width="10%">Status</th>
			</tr>';
			
		$sql12="SELECT soldiers_distribute.id,soldiers_distribute.police_id,soldiers_distribute.body_no,soldiers_distribute.cc_number,police_soldier.name,police_soldier.phone,soldiers_distribute.we_product_id,
					categories.categories_name,categories.categories_type,soldiers_distribute.we_product_quantity,soldiers_distribute.bu_product_id,categoriesBU.categories_type AS buType,
					categoriesBU.categories_name AS proBulletName,soldiers_distribute.bu_product_quantity,soldiers_distribute.purpose,soldiers_distribute.distribute_dateTime,		soldiers_distribute.adjust_dateTime,soldiers_distribute.logid,soldiers_distribute.re_status,soldiers_distribute.re_weQuantity,soldiers_distribute.re_buQuantity,
					soldiers_distribute.re_comments,soldiers_distribute.re_date
					FROM `soldiers_distribute`
					LEFT JOIN police_soldier ON police_soldier.police_id=soldiers_distribute.police_id
					LEFT JOIN categories ON categories.id=soldiers_distribute.we_product_id
					LEFT JOIN categories AS categoriesBU ON categoriesBU.id=soldiers_distribute.bu_product_id
					WHERE soldiers_distribute.logid='".$cName."' AND soldiers_distribute.re_status='' AND soldiers_distribute.distribute_dateTime BETWEEN '".$Ds."' AND '".$De."' ORDER BY `soldiers_distribute`.`id` DESC";
		$query12 = $conn->query($sql12);
			$sum=0;
			$sumbill_claim=0;
			$did=1;
			$did12=0;
			while($row12 = $query12->fetch_assoc())
			{
				//$total=$row12['amount'];
				//$debitsum += $total;
				$image_name=$row["re_status"];
				$did12+=$did;
				$content .= '<tr>
					<td width="3%">'.$did12.'</td>
					<td width="18%">'.$row12['name'].'<br>Pcode : '.$row12['police_id'].'<br>Phone: '.$row12['phone'].'<br>CC No: '.$row12['cc_number'].' </td>
					<td width="22%">Ddate : '.$row12['distribute_dateTime'].'<br>Adate : '.$row12['adjust_dateTime'].'</td>
					<td width="27%">'.$row12['categories_name'].' ('.$row12['categories_type'].')<br>BodyNo: '.$row12['body_no'].'<br>'.$row12['proBulletName'].' ('.$row12['buType'].')</td>
					<td width="10%">'.$row12['we_product_quantity'].'<br>'.$row12['bu_product_quantity'].'</td>
					<td width="10%">'.$row12['re_weQuantity'].'<br>'.$row12['re_buQuantity'].'</td>
					<td width="10%">Running</td>
				</tr>';
					
			}	
			
		$content .= '</table>';
		
		$content .= ' 
			<style>p{color:black;font-size: 8px;}
			.cities {background-color: gray;color: white;text-align: center;padding: 20px;}
			span{font-size: 20px;text-align:center;}
			th{font-size: 10px;}
			td{font-size: 8px;}
			</style>
					<br><h5 align="center">Adjustment Weapons Againest Distribute</h5><br>
			<table border="1" cellspacing="0" cellpadding="3">
			<tr>
				<th width="3%">id</th><th width="18%">Name</th><th width="22%">Date</th><th width="27%">Details</th><th width="10%">DQuantity</th><th width="10%">RQuantity</th><th width="10%">Status</th>
			</tr>';
			
		$sql12="SELECT soldiers_distribute.id,soldiers_distribute.police_id,soldiers_distribute.body_no,soldiers_distribute.cc_number,police_soldier.name,police_soldier.phone,soldiers_distribute.we_product_id,
					categories.categories_name,categories.categories_type,soldiers_distribute.we_product_quantity,soldiers_distribute.bu_product_id,categoriesBU.categories_type AS buType,
					categoriesBU.categories_name AS proBulletName,soldiers_distribute.bu_product_quantity,soldiers_distribute.purpose,soldiers_distribute.distribute_dateTime,		soldiers_distribute.adjust_dateTime,soldiers_distribute.logid,soldiers_distribute.re_status,soldiers_distribute.re_weQuantity,soldiers_distribute.re_buQuantity,
					soldiers_distribute.re_comments,soldiers_distribute.re_date
					FROM `soldiers_distribute`
					LEFT JOIN police_soldier ON police_soldier.police_id=soldiers_distribute.police_id
					LEFT JOIN categories ON categories.id=soldiers_distribute.we_product_id
					LEFT JOIN categories AS categoriesBU ON categoriesBU.id=soldiers_distribute.bu_product_id
					WHERE soldiers_distribute.logid='".$cName."' AND soldiers_distribute.re_status!=''  AND soldiers_distribute.distribute_dateTime BETWEEN '".$Ds."' AND '".$De."' ORDER BY `soldiers_distribute`.`id` DESC";
		$query12 = $conn->query($sql12);
			$sum=0;
			$sumbill_claim=0;
			$did=1;
			$did12=0;
			while($row12 = $query12->fetch_assoc())
			{
				//$total=$row12['amount'];
				//$debitsum += $total;
				$image_name=$row["re_status"];
				$did12+=$did;
				$content .= '<tr>
					<td width="3%">'.$did12.'</td>
					<td width="18%">'.$row12['name'].' <br>Pcode : '.$row12['police_id'].' <br>Phone '.$row12['phone'].'<br>CC No : '.$row12['cc_number'].' </td>
					<td width="22%">Ddate : '.$row12['distribute_dateTime'].'<br>Adate : '.$row12['adjust_dateTime'].'<br>Rdate : '.$row12['re_date'].'</td>
					<td width="27%">'.$row12['categories_name'].' ('.$row12['categories_type'].')<br>Body No'.$row12['body_no'].'<br>'.$row12['proBulletName'].' ('.$row12['buType'].')</td>
					<td width="10%">'.$row12['we_product_quantity'].'<br>'.$row12['bu_product_quantity'].'</td>
					<td width="10%">'.$row12['re_weQuantity'].'<br>'.$row12['re_buQuantity'].'</td>
					<td width="10%">Closed</td>
				</tr>';
					
			}	
			
		$content .= '</table>';
		
			//$total_cost=$Cashsum + $debitsum;
			
		//$content .= '<table>		
					
					
					//<tr><br><br>
						//<td width="65.1%"></td>
						//<td width="30%">Total Debit Cost : </td>
					//</tr>
					//<tr>
						//<td width="62.3%"></td>
						//<td width="35%">Total Cash Advance : </td>
					//</tr>
					//<tr>
						//<td width="69.3%"></td>
						//<td width="40%">Total Cost : </td>
					//</tr>
					//</table>
			//';
			
					
				
				
    $pdf->writeHTML($content);  
    ob_end_clean();
	$pdf->Output('schedule.pdf', 'I');
?>

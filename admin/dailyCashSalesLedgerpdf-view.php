<?php ob_start(); //$conPrefix = '';
include 'includes/session.php';
$partyId = $_GET['spId'];
$sDate = $_GET['sDate'];
$eDate = $_GET['eDate'];

	require_once('tcpdf/tcpdf.php');
		
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
    $pdf->SetTitle('Duronto Shop Management System');  
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
    $content = '<style>
				.supAddress {font-size: 8px;}
				.supAddressFont {font-size: 8px;}
				</style>'; 
	$sql = "SELECT * FROM `tbl_walkin_customer` WHERE id='".$partyId."'";
		
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
			$partyName=$row['customerName'];
			$partyAddress=$row['customerAddress'];
			$partyPhone=$row['phoneNo'];
			$partyEmail=$row['contactEmail']; 
			
			
			  
		}
    $content .= '<style>
            p{color:black;font-size: 8px;text-align:center;}
			.cities {background-color: gray;color: white;text-align: center;padding: 30px;}
			.citiestd {background-color: yellow;color: black;text-align: center;}
			.citiestd12 {background-color: gray;color: white;text-align: center; font-size: 9px;}
			.citiestd13 {background-color: gray;color: white;text-align: center;font-size: 10px;padding: 30px;}
			.citiestd14 {text-align: right;font-size: 8px;}
			.citiestd15 {font-size: 8px;}
			.citiestd16 {text-align: right;font-size: 8px;}
			.citiestd17 {text-align: center;font-size: 8px;}
			.citiestd18 {text-align: left;font-size: 8px;}
			.citiestd11 {text-align: center;font-size: 8px;}
			span{font-size: 9px;}
			h2{font-size: 18px;text-align:center;}
		</style>';
		$pdf->Image('images/companylogo/Jafree.jpg', 85, 3,40, 15);
		$content .='<br>
		<p> 212, Jubilee Road, Chittagong-4000, Bangladesh.Tel:031-617505,615062 Mobile: 01973105100,01711-325119<br>E-mail:info@jafreetraders.com</p>
		<div class="citiestd13"> Walkin Customer Ledger Information </div>
		<table border="1" cellspacing="0" cellpadding="3">
			<tr>
				<td width="75%" class="supAddress">Customer Name :<font color="gray" class="supAddressFont">'.$partyName.'</font><br>Customer Address :<font color="gray" class="supAddressFont">'.$partyAddress.'</font><br>Phone :<font color="gray" class="supAddressFont">'.$partyPhone.'</font><br>Email :<font color="gray" class="supAddressFont">'.$partyEmail.'</font></td>
				<td width="25%" style="border: 1px solid gray;font-size: 8px;" ><span class="citiestd11">Start Date: '.$sDate.'</span><br><span class="citiestd11">End Date: '.$eDate.'</span><br><span class="citiestd11">Print Date: ' . date("Y-m-d") .'</span></td>
			</tr>
			<tr>
				<td width="100%">Del. Date :<font color="gray"></font> Adj. Date :<font color="gray"></font> Ret. Date :<font color="gray"></td>
			</tr>
		</table>
		<br><br>
		<table border="1" cellspacing="0" cellpadding="3">
		
			<tr>
				<th class="citiestd11" width="6%">SL#</th>
				<th class="citiestd11" width="19%">Date</th>
				<th class="citiestd11" width="15%">Particulars</th>
				<th class="citiestd11" width="15%">Vch Type</th>
				<th class="citiestd11" width="15%">Vch No</th>
				<th class="citiestd11" width="15%">Debit</th>
				<th class="citiestd11" width="15%">Credit</th>
				
			</tr>';
			
			$blance=0;
			
            $sql="SELECT Sum(CASE tbl_paymentVoucher.type 
                                       WHEN 'partyPayable' THEN tbl_paymentVoucher.amount
                                       WHEN 'paymentReceived' THEN -tbl_paymentVoucher.amount 
                                       WHEN 'adjustment' THEN  tbl_paymentVoucher.amount
                                       WHEN 'payable' THEN -tbl_paymentVoucher.amount 
                                       WHEN 'payment' THEN tbl_paymentVoucher.amount
                                       WHEN 'paymentAdjustment' THEN -tbl_paymentVoucher.amount 
                                       END) AS total, 'Opening Balance' AS type, deleted, 'Before' AS paymentDate
                FROM tbl_paymentVoucher 
                WHERE tbl_partyId = '$partyId' AND customerType = 'WalkinCustomer' AND deleted = 'No' AND  paymentDate < '$sDate'";    
                
                
			$query = $conn->query($sql);
		    while($row = $query->fetch_assoc()){
			$openingBalance=$row['total']; 
			}
			/*Eikhane sql theke loop diye opening balance ta ekta variable er modhe dhore niba*/
			//$openingBalance = "0";
			
			if($openingBalance >= 0){
			    $dr = $openingBalance;
			   // $balance = $balance + $dr; 
			    $cr = '';
			}else{
			    $dr = '';
			    $cr = $openingBalance*(-1);
			    //$balance = $balance - $dr;
			}
			
			
			$content .='<tr>
                        <td class="citiestd11">1</td>			
                        <th colspan="4" class="citiestd11">Opening Balance Before '.$sDate.'</th>
                        <td class="citiestd11">'.$dr.'</td>
                        <td class="citiestd11">'.$cr.'</td>
                    </tr>';
		
			/*$sql = "SELECT tbl_paymentVoucher.amount, voucherType, tbl_paymentVoucher.type, tbl_paymentVoucher.deleted, tbl_paymentVoucher.remarks, ifnull(ifnull(ifnull(tbl_sales.salesOrderNo, tbl_purchase.purchaseOrderNo), tbl_purchase_return.purchaseReturnOrderNo), tbl_sales_return.salesReturnOrderNo) as voucherNo, 
			        (CASE  WHEN tbl_paymentVoucher.paymentMethod = 'CHEQUE' THEN tbl_paymentVoucher.chequeIssueDate 
                                           ELSE tbl_paymentVoucher.paymentDate
                                           END) AS paymentDate
                    FROM tbl_paymentVoucher 
                    LEFT OUTER JOIN tbl_purchase ON tbl_paymentVoucher.tbl_purchaseId = tbl_purchase.id AND tbl_purchase.deleted = 'No'
                    LEFT OUTER JOIN tbl_sales ON tbl_paymentVoucher.tbl_sales_id = tbl_sales.id AND tbl_sales.deleted = 'No'
                    LEFT OUTER JOIN tbl_purchase_return ON tbl_paymentVoucher.tbl_purchase_return_id = tbl_purchase_return.id AND tbl_purchase_return.deleted = 'No'
                    LEFT OUTER JOIN tbl_sales_return ON tbl_paymentVoucher.tbl_sales_return_id = tbl_sales_return.id AND tbl_sales_return.deleted = 'No'
                    WHERE tbl_partyId = '".$partyId."' AND (CASE  WHEN tbl_paymentVoucher.paymentMethod = 'CHEQUE' THEN tbl_paymentVoucher.chequeIssueDate 
                                                               ELSE tbl_paymentVoucher.paymentDate
                                                               END) BETWEEN '".$sDate."' AND '".$eDate."'
                    ORDER BY CASE  WHEN tbl_paymentVoucher.paymentMethod = 'CHEQUE' THEN tbl_paymentVoucher.chequeIssueDate 
                                                               ELSE tbl_paymentVoucher.paymentDate
                                                               END, tbl_paymentVoucher.entryDate";*/
            $sql="SELECT amount, voucherType, type, deleted, remarks, voucherNo, (CASE  WHEN paymentMethod = 'CHEQUE' THEN chequeIssueDate 
                                           ELSE paymentDate
                                           END) AS paymentDate
FROM tbl_paymentVoucher 
WHERE tbl_partyId = '".$partyId."' AND customerType = 'WalkinCustomer' AND (CASE  WHEN paymentMethod = 'CHEQUE' THEN chequeIssueDate 
                                           ELSE paymentDate
                                           END) BETWEEN '".$sDate."' AND '".$eDate."'
ORDER BY CASE  WHEN paymentMethod = 'CHEQUE' THEN chequeIssueDate 
                                           ELSE paymentDate
                                           END, entryDate";
		
		$query = $conn->query($sql);
		$weQuantity=0;
		$i=1;
		$weQuantitybu=0;
		$weQuantitybu12=0;
		while($row12 = $query->fetch_assoc()){
			$i++;
			$dr='';
			$cr='';
			$type=$row12['type'];
			
    		    if($type=='partyPayable'){
    		        $cr=$row12['amount'];
    		        $dr = '';
    		        //$balance = $balance + $cr;
    		    }
    		    else if($type=='payment'){
    		        $cr=$row12['amount'];
    		        $dr = '';
    		        //$balance = $balance + $cr;
    		    }
    		    else if($type=='adjustment'){
    		        $cr=$row12['amount'];
    		        $dr = '';
    		        //$balance = $balance + $cr;
    		    }
    		    else if($type=='paymentReceived'){
    		        $dr=$row12['amount'];
    		        $cr = '';
    		        //$balance = $balance - $dr;
    		    }
    		    else if($type=='payable'){
    		        $dr=$row12['amount'];
    		        $cr = '';
    		       // $balance = $balance - $dr;
    		    }
    		    else if($type=='paymentAdjustment'){
    		        $dr=$row12['amount'];
    		        $cr = '';
    		       // $balance = $balance - $dr;
    		    }
		        $drTotal+=$dr;
		        $crTotal+=$cr;
		        $closingBlance=$drTotal-$crTotal;
		        $trialBalance=$closingBlance+$crTotal;
			$content .= '<tr>
						<td class="citiestd11">'.$i.'</td>
						<td class="citiestd11">'.$row12['paymentDate'].'</td>
    					<td class="citiestd11">'.$row12['voucherType'].'</td>
    					<td class="citiestd11">'.$row12['type'].'</td>
    					<td class="citiestd11">'.$row12['voucherNo'].'</td>
    					<td class="citiestd11">'.$dr.'</td>
    					<td class="citiestd11">'.$cr.'</td>
					</tr>
					
					';
					
			}
			$content .= '
			<tr><td></td><th colspan="4" class="citiestd11"> Total Blance </th><td class="citiestd11">'.number_format($drTotal,2).'</td><td class="citiestd11">'.number_format($crTotal,2).'</td></tr>
			<tr><td></td><th colspan="4" class="citiestd11"> <b>Closing Blance</b> </th><td class="citiestd11"></td><td class="citiestd11"><b>'.number_format($closingBlance,2).'</b></td></tr>
			<tr><td></td><th colspan="4" class="citiestd11">  </th><td class="citiestd11">'.number_format($drTotal,2).'</td><td class="citiestd11">'.number_format($trialBalance,2).'</td></tr>
		    </table><br><br><br><br>
		';
		
			$content .='
			
				
				<table>
					
					<tr>
						<th class="citiestd15">--------------------------------------</th><th class="citiestd17">----------------</th><th class="citiestd16">----------------------------</th>
						
					</tr>
					<tr>
						<td class="citiestd15" > Walkin Coustomer Signature </td><td class="citiestd17"> Checked By </td><td class="citiestd16"> Authorized Signature </td>
						
					</tr>
					
				</table>
			';
		
	$pdf->writeHTML($content);  
    ob_end_clean();
	$pdf->Output('schedule.pdf', 'I');
    ob_end_flush();
?>
<?php
include 'includes/session.php';
$id = $_GET['id'];
	

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Ezzy Group - Employee Profile');  
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
	$sql = "SELECT *, employees.id as empid FROM employees LEFT JOIN position ON position.id=employees.position_id 
		LEFT JOIN schedules ON schedules.id=employees.schedule_id LEFT JOIN company ON company.id=employees.firm_id 
		LEFT JOIN department ON department.id=employees.department_id WHERE employees.id = '$id'";
		
		$query = $conn->query($sql);
		while($row = $query->fetch_assoc()){
				$employee_id=$row['employee_id'];
				$fname=$row['firstname'];
				$lname=$row['lastname'];
				$firm_name=$row['firm_name'];
				$web_url=$row['web_url'];
				$department_name=$row['department_name'];
				$description=$row['description'];
				$phone=$row['phone'];
				$alt_phone=$row['alt_phone'];
				$email=$row['email'];
				$alt_email=$row['alt_email'];
				$photo=$row['photo'];
				$employee_status=$row['employee_status'];
				$employee_type=$row['employee_type'];
				$marital_status=$row['marital_status'];
				$nid=$row['nid'];
				$nationality=$row['nationality'];
				$gender=$row['gender'];
				$blood_group=$row['blood_group'];
				$religion=$row['religion'];
				$present_address=$row['present_address'];
				$parmanent_address=$row['parmanent_address'];
				$father_name=$row['father_name'];
				$mother_name=$row['mother_name'];
				$spouse_name=$row['spouse_name'];
				$bank_name=$row['bank_name'];
				$branch_name=$row['branch_name'];
				$account_number=$row['account_number'];
				$created_on=$row['created_on'];
				$bonding_year=$row['bonding_year'];
				$birthdate=$row['birthdate'];
				
		}
    $content .= '
      	<h2 align="center"><font color="green">'.$firm_name.' </font> A concern of <font color="gray">Ezzy Group</font></h2>
      	<h5 align="center">House No: 214, Road No: 13,New DOHS, Mohakhali Dhaka- 1206 <br> 
		Phone No: +88-02-8711879-80 Fax: +88-02-8714623 <br>Email: info@ ezzyautomations.com / support@ezzyautomations.com <br>Website: www.ezzygroup.net / <font color="green">'.$web_url.' </font>
		<br><hr>
		</h5>
		
		<table border="" cellspacing="0" cellpadding="3">
			<tr>
				<td width="20%"><img src="../images/'.$photo.'" width="110px" height="100px"></td>
				<td width="80%">Employee Status :<font color="gray"> '.$employee_status.' </font><br>
				Name :<font color="gray"> '.$fname." ".$lname. "  (".$employee_id.')</font><br>
				Department : <font color="gray">'.$department_name.' </font><br>
				Position : <font color="gray"> '.$description.'</font><br>
				Phone : <font color="gray">'.$phone." / ".$alt_phone.'</font><br>
				Email : <font color="gray">'.$email." / ".$alt_email.'</font>
				</td>
			</tr>	
		</table>
		
      	<table border="" cellspacing="0" cellpadding="3"><br><br>
			<tr>  
				<td width="18%" >Employee Type : </td>
				<td width="32%"><font color="gray">'.$employee_type.'</font></td>
				<td width="22%"></td>
				<td width=""></td>
			</tr>
			<tr>  
				<td>Hire Date : </td>
				<td><font color="gray">'.$created_on.'</font></td>
				<td>Date of Birth : </td>
				<td><font color="gray">'.$birthdate.'</font></td>
				
			</tr>
			<tr>  
				<td>Nationality : </td>
				<td><font color="gray">'.$nationality.'</font></td>
				<td>Gender: </td>
				<td><font color="gray">'.$gender.'</font></td>
			</tr>
			<tr>  
				<td>NID : </td>
				<td><font color="gray">'.$nid.'</font></td>
				<td>Blood Group : </td>
				<td><font color="gray">'.$blood_group.'</font></td>
			</tr>
			<tr>  
				<td>Present Address: </td>
				<td><font color="gray">'.$present_address.'</font></td>
				<td>Parmanent Address : </td>
				<td><font color="gray">'.$parmanent_address.'</font></td>
			</tr>
			<tr>  
				<td>Father name: </td>
				<td><font color="gray">'.$father_name.'</font></td>
				<td>Mother Name : </td>
				<td><font color="gray">'.$mother_name.'</font></td>
			</tr>
			<tr>  
				<td>Marital status: </td>
				<td><font color="gray">'.$marital_status.'</font></td>
				<td>Spouse Name : </td>
				<td><font color="gray">'.$spouse_name.'</font></td>
			</tr>
			<tr>  
				<td>Bank Name: </td>
				<td><font color="gray">'.$bank_name.'</font></td>
				<td>Branch Name : </td>
				<td><font color="gray">'.$branch_name.'</font></td>
			</tr>
			<tr>  
				<td>A/C Number: </td>
				<td><font color="gray">'.$account_number.'</font></td>
				<td>Bonding Year : </td>
				<td><font color="gray">'.$bonding_year.'</font></td>
			</tr>
			
		</table>	
      ';  
    
    $pdf->writeHTML($content);  
    $pdf->Output('schedule.pdf', 'I');

?>
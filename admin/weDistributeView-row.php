<?php 
	include 'includes/session.php';
	
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		//$ym = date("Y-m", strtotime($id));
		$sql = "SELECT wepons_distribution.id,wepons_distribution.thanaid,wepons_distribution.purpose,wepons_distribution.creationDate,
				thana.thana_name,thana.address,wepons_wepons.name,product.ranks,brands.brand_name,categories.categories_name,categories.categories_type,SUM(wepons_wepons.quantity) AS quantity,wepons_wepons.reamrks
				FROM `wepons_distribution`
				LEFT JOIN wepons_wepons ON wepons_wepons.we_distid=wepons_distribution.id
				LEFT JOIN product ON product.id=wepons_wepons.name
				LEFT JOIN brands ON brands.id=product.brand_id
				LEFT JOIN categories ON categories.id=product.categories_id
				LEFT JOIN thana ON thana.id=wepons_distribution.thanaid
				WHERE wepons_distribution.thanaid='".$id."' GROUP BY wepons_wepons.name  ORDER BY `wepons_distribution`.`creationDate` DESC";
		$query = $conn->query($sql);
		//$row = $query->fetch_assoc();
	//echo $row;
	while($row =  $query->fetch_assoc())
	{
	$rows[]= $row;
	}
	echo json_encode($rows);
		//echo json_encode($row);
	}
	
?>
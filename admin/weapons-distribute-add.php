<?php
	include 'includes/session.php';
	/*for Self EmMoSlip Add*/
	if(isset($_POST['WeaponsDistributeAdd'])){
			$logID=$_SESSION['admin'];
			$choosethana= $_POST['choosethana'];
			
			
			$sql = "INSERT INTO wepons_distribution(logid,thanaid,purpose,creationDate,status) 
				VALUES ('$logID','$choosethana','',NOW(),'1')";
				$query = $conn->query($sql);
			if(!empty($query)){
				
				$sql ="SELECT id,thanaid FROM `wepons_distribution` WHERE id>=LAST_INSERT_ID()ORDER BY id DESC LIMIT 1";
				$query = $conn->query($sql);
				
				while($row = $query->fetch_assoc()){
					$lastID=$row['id'];
					$thanaid=$row['thanaid'];
				}
				$number = count($_POST["name"]);  
				if($number > 0)  
				{  
					for($i=0; $i<$number; $i++)  
					{  
						$name= $_POST['name'][$i];
						$quantity= $_POST['quantity'][$i];
						$bodyNo= $_POST['bodyNo'][$i];
						$remarks= $_POST['remarks'][$i];
						
					$sql02 = "INSERT INTO wepons_wepons(we_distid,thana_id,name,quantity,body_number,reamrks,postingDate) 
					VALUES ('$lastID','$thanaid','$name','$quantity','$bodyNo','$remarks',Now())";
					$conn->query($sql02);
					
					}
					$_SESSION['success'] = 'Weapons Distribute Successfully Added';
				} 
			}
			else{
				$_SESSION['error'] = 'Error!';
			}header('location: weapons-distribute.php');
	}
	
?>
		
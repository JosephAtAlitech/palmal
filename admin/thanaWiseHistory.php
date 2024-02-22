<?php include 'includes/session.php'; ?>
<?php
if(isset($_POST['startDate']))
//if(isset($_POST['EmpName']))
{
	$cName=$_POST['cName'];
	$startDate=$_POST['startDate'];
	$endtDate=$_POST['endtDate'];
	//$EmpName=$_POST['EmpName'];
?>
	<br><br>
	<table class="table table-bordered">
                <thead>
				<tr style="background: #3f3e93;color: white;">
					<th class="hidden"></th>
					<th>id</th>
					<th>Name</th>
					<th>Date</th>
					<th>Details</th>
					<th>DQauntity</th>
					<th>RQauntity</th>
					<th>Status</th>
				</tr>
                </thead>
                <tbody>
                  <?php
					$sql = "SELECT soldiers_distribute.id,soldiers_distribute.police_id,soldiers_distribute.body_no,soldiers_distribute.cc_number,police_soldier.name,police_soldier.phone,soldiers_distribute.we_product_id,
							categories.categories_name,categories.categories_type,soldiers_distribute.we_product_quantity,soldiers_distribute.bu_product_id,categoriesBU.categories_type AS buType,
							categoriesBU.categories_name AS proBulletName,soldiers_distribute.bu_product_quantity,soldiers_distribute.purpose,soldiers_distribute.distribute_dateTime,		soldiers_distribute.adjust_dateTime,soldiers_distribute.logid,soldiers_distribute.re_status,soldiers_distribute.re_weQuantity,soldiers_distribute.re_buQuantity,
							soldiers_distribute.re_comments,soldiers_distribute.re_date
							FROM `soldiers_distribute`
							LEFT JOIN police_soldier ON police_soldier.police_id=soldiers_distribute.police_id
							LEFT JOIN categories ON categories.id=soldiers_distribute.we_product_id
							LEFT JOIN categories AS categoriesBU ON categoriesBU.id=soldiers_distribute.bu_product_id
							WHERE soldiers_distribute.logid='".$cName."' AND soldiers_distribute.distribute_dateTime BETWEEN '".$startDate."' AND '".$endtDate."' ORDER BY `soldiers_distribute`.`id` DESC";
                    $query = $conn->query($sql);
					$fid='0';
					$did=1;
					$did12=0;
                    while($row = $query->fetch_assoc()){
						//$fid=$row['firm_id'];
						//$pcnid=$row['pcn_no'];
						$pcnid=$row['we_product_quantity']-$row['re_weQuantity'];
						$pcnid12=$row['bu_product_quantity']-$row['re_buQuantity'];
						$image_name=$row["re_status"];
						$did12+=$did;
                      echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$did12."</td>
							<td>".$row['name']." - Pcode : ".$row['police_id']."<br>Phone: ".$row['phone']."<br>CC No: ".$row['cc_number']."</td>
							<td>Ddate : ".$row['distribute_dateTime']."<br>Adate : ".$row['adjust_dateTime']."<br>Rdate : ".$row['re_date']."</td>
							<td>".$row['categories_name']." (".$row['categories_type']." - ".$row['body_no'].")<br> ".$row['proBulletName']." (".$row['buType'].")</td>
							<td>".$row['we_product_quantity']."<br>".$row['bu_product_quantity']."</td>
							<td>".$row['re_weQuantity']."<br>".$row['re_buQuantity']."</td>
							<td>".$pcnid."<br>".$pcnid12."<br><img src='../images/".$image_name."' alt='Running'/></td>
                        </tr>
						";
                    }
					echo "
					<a href='ThanWisepdfReports.php?ThanaID=".$cName."&ds=".$startDate."&de=".$endtDate."' target='_blank' title='Issue Details' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat' style='background: white;color: blue;margin-bottom: 3%;'><i class='fa fa-print'> Print Reports </i></a>
					";
				  ?>
                </tbody>
              </table>
<?php } ?>
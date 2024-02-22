<?php include 'includes/session.php'; ?>
<?php
if(isset($_POST['startDate']))
//if(isset($_POST['EmpName']))
{
	$tripNumber=$_POST['tripNumber'];
	$Ds=$_POST['startDate'];
	$De=$_POST['endtDate'];
	//$EmpName=$_POST['EmpName'];
?>
	<br><br>
	<table class="table table-bordered">
                <thead>
				<tr style="background: #3f3e93;color: white;">
					<th class="hidden"></th>
					<th>id</th>
					<th>Type</th>
					<th>Categories</th>
					<th>Brands</th>
					<th>Quantity</th>
					<th>Date</th>
				</tr>
                </thead>
                <tbody>
                  <?php
					$sql = "SELECT product.id,product.type,product.ranks,product.product_image,product.body_no,product.we_name,product.brand_id,product.categories_id,
				SUM(product.quantity) AS quantity,brands.brand_type,brands.brand_name,categories.categories_type,categories.categories_name,product.create_date
				FROM `product` 
				LEFT JOIN brands ON brands.id=product.brand_id
				LEFT JOIN categories ON categories.id=product.categories_id
				where product.create_date BETWEEN '".$Ds."' AND '".$De."'
				GROUP BY categories.categories_name,product.we_name";
                    $query = $conn->query($sql);
					
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						//$fid=$row['firm_id'];
						//$pcnid=$row['pcn_no'];
						//$pcnid=$row['we_product_quantity']-$row['re_weQuantity'];
						//$pcnid12=$row['bu_product_quantity']-$row['re_buQuantity'];
						//$image_name=$row["re_status"];
						//$did12+=$did;
                      echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$idNo++."</td>
							<td>".$row['type']."</td>
							<td>".$row['categories_name'].' - '.$row['we_name']."</td>
							<td>".$row['brand_name']."</td>
							<td>".$row['quantity']."</td>
							<td>".$row['create_date']."</td>
                        </tr>
						";
                    }
					echo "
					<a href='CustomDateweaponsDetailsReports.php?ThanaID=".$cName."&ds=".$Ds."&de=".$De."' target='_blank' title='Issue Details' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat' style='background: white;color: blue;margin-bottom: 3%;'><i class='fa fa-print'> Date Wise Generate Print Reports </i></a>
					";
				  ?>
                </tbody>
              </table>
<?php } ?>
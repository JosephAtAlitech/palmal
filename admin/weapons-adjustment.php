<?php include 'includes/session.php'; $thanaId = $_GET['thanaId'];?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Distribute Weapons Information </span>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Advance Information </li>
		</ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<?php
			if(isset($_SESSION['error'])){
			  echo "
				<div class='alert alert-danger alert-dismissible'>
				  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				  <h4><i class='icon fa fa-warning'></i> Error!</h4>
				  ".$_SESSION['error']."
				</div>
			  ";
			  unset($_SESSION['error']);
			}
			if(isset($_SESSION['success'])){
			  echo "
				<div class='alert alert-success alert-dismissible'>
				  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				  <h4><i class='icon fa fa-check'></i> Success!</h4>
				  ".$_SESSION['success']."
				</div>
			  ";
			  unset($_SESSION['success']);
			}
		?>
	  <link rel="stylesheet" href="../css/buttons.dataTables.min.css"/>
       <div class="row">
        <div class="col-xs-12">
          <div class="box">
			<div class="box-header with-border">
				
            </div>
            <div class="box-body">
				<div class="col-md-5">
					<div class="col-md-5">
						<input name="min" id="min" class="form-control icondate" placeholder="Select Start date" type="text" data-date-format="yyyy-mm-dd" />					
					</div>
					<label class="control-label col-md-1">-To-</label>
					<div class="col-md-5">
						<input name="max" id="max" class="form-control icondate" placeholder="Select End date" data-date-format="yyyy-mm-dd"/>
					</div>
				</div>
              <table id="leaves-view" class="table table-bordered" width='100%'>
                <thead>
					<th class="hidden"></th>
					<th>ThanaDetails</th>
					<th>Category</th>
					<th>BodyNo</th>
					<th>Quantity</th>
					<th>Remarks</th>
					<th>PostingDate</th>
					<th width='9%'>Action</th>
				</thead>
                <tbody>
					<?php
                    $sql = "SELECT wepons_wepons.id,wepons_distribution.thanaid,wepons_distribution.purpose,wepons_distribution.creationDate,
						thana.thana_name,thana.address,thana.phone,thana.thana_status,wepons_wepons.name,product.we_name,product.bu_name,wepons_wepons.body_number,brands.brand_name,categories.categories_name,product.type,wepons_wepons.quantity,wepons_wepons.reamrks,
						wepons_wepons.adj_body_number,wepons_wepons.adj_quantity,wepons_wepons.adj_remarks
						FROM `wepons_distribution`
						LEFT JOIN wepons_wepons ON wepons_wepons.we_distid=wepons_distribution.id
						LEFT JOIN product ON product.id=wepons_wepons.name
						LEFT JOIN brands ON brands.id=product.brand_id
						LEFT JOIN categories ON categories.id=product.categories_id
						LEFT JOIN thana ON thana.id=wepons_distribution.thanaid
						WHERE wepons_distribution.thanaid='".$thanaId."' ORDER BY `wepons_distribution`.`creationDate` DESC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
							<th class='hidden'></th>
							<td>".$row['thana_name']." - ".$row['thana_status']." <br>".$row['address']."<br>Phone : ".$row['phone']."</td>
							<td>".$row['categories_name']." - ".$row['we_name']."".$row['bu_name']." <b style='color:green;'>".$row['type']."</b><br>".$row['brand_name']."</td>
							<td>D: ".$row['body_number']."<br> <b style='color:green;'>R : ".$row['adj_body_number']."</b></td>
							<td>D: ".$row['quantity']."<br><b style='color:green;'>R: ".$row['adj_quantity']."/".$row['quantity']."</b></td>
							<td>D: ".$row['reamrks']."<br><b style='color:green;'>R: ".$row['adj_remarks']."</b></td>
							<td>".$row['creationDate']."</td>
							<td style='width:6%;'>
							
								<button class='btn btn-success btn-sm adjustmentWeapons btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Adjustment </button>
								
							</td>
						</tr>
                      ";
                    }
					?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/weapons_distribute_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.adjustmentWeapons').click(function(e){
    e.preventDefault();
    $('#adjustmentWeapons').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'adjustDistributeView-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#Adjid').val(response.id);
      $('#Adjthana_id').val(response.thana_id);
      $('#Adjname').val(response.name);
      $('#Adjquantity').val(response.quantity);
      $('#AdjbodyNo').val(response.body_number);
      $('#Adjreamrks').val(response.reamrks);
      
      
    }
  });
}
</script>

<script type="text/javascript">
		
		$(document).ready(function() {
			$('#leaves-view').DataTable( {
			  responsive: true,
			  "scrollX": true,
			  dom: 'Bfrtip',
				buttons: [
					'pageLength','copy', 'csv', 'pdf', 'print'
				]
			})
		})

		$(document).ready(function(){
				$.fn.dataTable.ext.search.push(
				function (settings, data, dataIndex) {
					var min = $('#min').datepicker("getDate");
					var max = $('#max').datepicker("getDate");
					var startDate = new Date(data[2]);
					if (min == null && max == null) { return true; }
					if (min == null && startDate <= max) { return true;}
					if(max == null && startDate >= min) {return true;}
					if (startDate <= max && startDate >= min) { return true; }
					return false;
				}
				);

       
            $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#leaves-view').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });
        });
</script>
</body>
</html>

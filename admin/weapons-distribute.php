<?php include 'includes/session.php'; ?>
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
				<a href="#WeaponsDistribute" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Weapons Distribute</a>
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
					<th>ThanaName</th>
					<th>DisQuantity</th>
					<th>RetQuantity</th>
					<th>PostingDate</th>
					<th width='9%'>Action</th>
				</thead>
                <tbody>
					<?php
                    $sql = "SELECT wepons_distribution.id,wepons_distribution.thanaid,wepons_distribution.purpose,wepons_distribution.creationDate,
							thana.thana_name,thana.phone,thana.thana_status,thana.address,wepons_wepons.name,product.ranks,brands.brand_name,categories.categories_name,categories.categories_type,
							SUM(IF(categories.categories_type='Weapons',wepons_wepons.quantity,NULL)) wequantity,
							SUM(IF(categories.categories_type='Weapons',wepons_wepons.adj_quantity,NULL)) adj_wequantit,
							SUM(IF(categories.categories_type='Bullets',wepons_wepons.quantity,NULL)) buquantity,
							SUM(IF(categories.categories_type='Bullets',wepons_wepons.adj_quantity,NULL)) adj_buquantit,
							wepons_wepons.reamrks
							FROM `wepons_distribution`
							LEFT JOIN wepons_wepons ON wepons_wepons.we_distid=wepons_distribution.id
							LEFT JOIN product ON product.id=wepons_wepons.name
							LEFT JOIN brands ON brands.id=product.brand_id
							LEFT JOIN categories ON categories.id=product.categories_id
							LEFT JOIN thana ON thana.id=wepons_distribution.thanaid
							GROUP BY wepons_distribution.thanaid";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
						//$reamaning=$row['quantity']-$row['adj_quantity'];
                      echo "
                        <tr>
                          <th class='hidden'></th>
						  <td>".$row['thana_name']." (<b style='color:green;'>".$row['thana_status']."</b>)<br>".$row['address']."<br>Phone: ".$row['phone']."</td>
                          <td>Weapons : <b style='color:blue;'>".$row['wequantity']."</b><br>Bullets : <b style='color:blue;'>".$row['buquantity']."</b></td>
                          <td>Weapons : <b style='color:green;'>".$row['adj_wequantit']."</b> / <b style='color:blue;'>".$row['wequantity']."</b><br>Bullets : <b style='color:green;'>".$row['adj_buquantit']."</b>/ <b style='color:blue;'>".$row['buquantity']."</b></td>
                          <td>".$row['creationDate']."</td>
							<td>
								<button class='btn btn-primary btn-sm viewWeaponsDetails btn-flat' data-id='".$row['thanaid']."'><i class='fa fa-eye'></i></button>
								<a href='receiveHistory-viewpdf.php?pid=".$row['id']."&thanaId=".$row['thanaid']."' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i></a>
								<a href='weapons-adjustment.php?pid=".$row['id']."&thanaId=".$row['thanaid']."' target='_blank' title='Adjustment' style='margin-top: 5px;' data-toggle='tooltip' class='btn btn-success btn-sm btn-flat'><i class='fa fa-dedent'></i></a>
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
<script type="text/javascript">
$(function(){
	$('.edit').click(function(e){
		e.preventDefault();
		$('#edit').modal('show');
		var id = $(this).data('id');
    getRow(id);
	});
	$('.viewWeaponsDetails').click(function(e){
		e.preventDefault();
		$('#viewWeaponsDetails').modal('show');
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
    url: 'weDistributeView-row.php',
    data: {id:id},
    dataType: 'json',
		success: function(rows){
			var trHTML = '<table class="table table-bordered table-responsive text-center"><tr class="bg-primary"><th>Date</th><th>ReceivedFrom</th><th>Categories</th><th>Brands</th><th>Type</th><th>Quantity</th></tr>';
			$('#Balanceoutput').html('');
			for(var i=0;i<rows.length;i++){
				trHTML += "<tr class='bg-info'><td>"+rows[i].creationDate+"</td><td> "+rows[i].thana_name+" "+rows[i].address+"</td><td>"+rows[i].categories_name+"</td><td>"+rows[i].brand_name+"</td><td>"+rows[i].categories_type+"</td><td>"+rows[i].quantity+"</td></tr>";
				$('#emmoslippdf').html("<a href='receiveHistory-viewpdf.php?id="+rows[i].name+"&id2="+rows[i].categories_id+"' target='_blank' class='btn btn-primary btn-xs'><i class='fa fa-print'></i> Print </a>");
			}
			
			trHTML+="</table>";
			
			$('#Balanceoutput').append(trHTML);
		}
	
		});
  $.ajax({
			type: 'POST',
			url: 'self_money_row.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				$('#reqID').val(response.id);
				$('#RErequisition_id').val(response.requisition_id);
				$('.editcv_ID').html(response.id);
				$('#job_ID').val(response.job_id);
		
			}
		});
}
</script>
<script type="text/javascript">  
 $(document).ready(function(){  
		var i=1;
		var s=1;	  
      $('#add').click(function(){  
			i++;
			s++;
           $('#dynamic_field').append('<tr id="row'+i+'"><td class="col-sm-3"><select class="form-control" name="name[]" id="name_'+s+'">'+$('#name_0').html()+'</select></td><td class="col-sm-2"><input type="number" class="form-control" name="quantity[]" placeholder="Quantity" ></td> <td class="col-sm-4"><input type="text" class="form-control" name="bodyNo[]" placeholder=" Insert Weapons Body No" ></td><td class="col-sm-3"><input type="text" class="form-control" name="remarks[]" placeholder=" Remarks " ></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({ 
                url:"EmMoSlip-add12.php",  
                method:"POST",
				data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 
 
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

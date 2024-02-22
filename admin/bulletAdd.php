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
        Weapons Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Weapons Information</li>
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
	  <link rel="stylesheet" href="buttons.dataTables.min.css"/>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
				<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Weapons</a>
				<a href="#addnewBullets" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Bullets</a>
				<a href="weaponsAll.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> ALL </a>
				<a href="weaponsAdd.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Weapons </a>
				<a href="bulletAdd.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Bullets </a>
			</div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
                  <th>id</th>
                  <th>Weapon Name</th>
                  <th>Image</th>
                  <th>Type</th>
                  <th>Brand Name</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT product.id,product.type,product.ranks,product.product_image,product.brand_id,product.categories_id,SUM(product.quantity) AS quantity,
							brands.brand_type,brands.brand_name,categories.categories_type,categories.categories_name
							FROM `product` 
							LEFT JOIN brands ON brands.id=product.brand_id
							LEFT JOIN categories ON categories.id=product.categories_id 
                            WHERE product.type='Bullets' GROUP BY categories.categories_name";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
                      echo "
                        <tr>
							<td>".$idNo++."</td>
							<td>".$row['categories_name']."</td>
							<td width='12%'><img src=../images/stock/".$row['product_image']." style='width: 100%;height: 75px;'/></td>
							<td>".$row['type']."</td>
							<td>".$row['brand_name']."</td>
							<td>".$row['quantity']."</td>
                          
                          <td style='width: 10%;'>
                            <a href='weaponsHistory-viewpdf.php?catName=".$row['categories_name']."&brandId=".$row['brand_name']."&type=".$row['type']."' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i></a>
                            <a href='weaponsDetails.php?catName=".$row['categories_name']."&type=".$row['type']."' target='_blank' title='View Details' data-toggle='tooltip' class='btn btn-success btn-sm btn-flat'><i class='fa fa-eye'></i></a>
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
  <?php include 'includes/weapons_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>

	var userselect = document.getElementById('input');

$(function(){
  $('.editWeapons').click(function(e){
    e.preventDefault();
    $('#editWeapons').modal('show');
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
    url: 'weapons_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#weid').val(response.id);
      $('#wetype').val(response.type);
      $('#weproduct_name').val(response.product_name);
      $('#weproduct_image').val(response.product_image);
      $('#webrand_id').val(response.brand_id);
      $('#wecategories_id').val(response.categories_id);
      $('#wequantity').val(response.quantity);
      $('#wecountry').val(response.country);
    }
  });
}
</script>
<script>

$(document).ready(function() {
    $('#example_company').DataTable( {
      //responsive: true
	  dom: 'Bfrtip',
        buttons: [
            'pageLength','copy', 'csv', 'pdf', 'print'
        ]
    })
  })
</script>
</body>
</html>

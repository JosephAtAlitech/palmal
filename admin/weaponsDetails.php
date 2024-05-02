<?php include 'includes/session.php'; $catName = $_GET['catName']; $type = $_GET['type']; ?>
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
              
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
                  <th>id</th>
                  <th>Weapon Name</th>
                  <th>Image</th>
                  <th>Type</th>
                  <th>Brand Name</th>
                  <th>Body No</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT product.id,product.type,product.ranks,product.product_image,product.brand_id,product.body_no,product.we_name,product.cc_no,product.categories_id,product.bu_name,product.quantity,
							brands.brand_type,brands.brand_name,categories.categories_type,categories.categories_name
							FROM `product` 
							LEFT JOIN brands ON brands.id=product.brand_id
							LEFT JOIN categories ON categories.id=product.categories_id 
                            WHERE categories.categories_name='".$catName."' AND product.type='".$type."'";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
                      echo "
                        <tr>
							<td>".$idNo++."</td>
							<td>".$row['categories_name']."<br>".$row['we_name']."</td>
							<td width='12%'><img src=../images/stock/".$row['product_image']." style='width: 100%;height: 75px;'/></td>
							<td>".$row['type']."<br>".$row['bu_name']."</td>
							<td>".$row['brand_name']."</td>
							<td>".$row['body_no']."</td>
							<td>".$row['quantity']."</td>
                          
							<td style='width: 8%;'>
							";
							if($type=='Bullets'){
								echo "<button class='btn btn-primary btn-sm editBullets btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>";
							}
							else{
								echo "<button class='btn btn-success btn-sm editWeapons btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>";
							}
						echo"	
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
$(function(){
  $('.editWeapons').click(function(e){
    e.preventDefault();
    $('#editWeapons').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $('.editBullets').click(function(e){
    e.preventDefault();
    $('#editBullets').modal('show');
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
      $('#buid').val(response.id);
      $('#wetype').val(response.type);
      $('#weranks').val(response.ranks);
      $('#wepbody_no').val(response.body_no);
      $('#weproduct_image').val(response.product_image);
      $('#webrand_id').val(response.brand_id);
      $('#bubrand_id').val(response.brand_id);
      $('#wecategories_id').val(response.categories_id);
      $('#bucategories_id').val(response.categories_id);
      $('#we_name').val(response.we_name);
      $('#bu_name').val(response.bu_name);
      $('#wequantity').val(response.quantity);
      $('#buquantity').val(response.quantity);
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

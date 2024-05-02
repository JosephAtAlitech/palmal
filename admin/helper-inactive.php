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
        Helper Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Helper Information</li>
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
				<a href="#addnewhelper" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Helper</a>
				<a href="helper-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
				<a href="helper-inactive.php" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-eye"></i> In-Active </a>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>HelperInfo</th>
					<th>HelperImage</th>
					<th>IDCards</th>
					<th>Status</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT * FROM `helper_master`  WHERE status!='Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td><u>Helper Name</u>: ".$row['helper_name']." <br><u>Address</u>: ".$row['address']."<br><u>Phone</u>: ".$row['phone']."</td>
							<td><img src='../images/helper/".$row['helper_photo']."' style='width:80px; height:60px;' /></td>
							<td><img src='../images/helper/".$row['helper_id_copy']."' style='width:80px; height:60px;' /></td>
							<td>".$row['status']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm activeHelper btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-trash'></i> Active</button>
								<a href='helperHistory-viewpdf.php?vid=".$row['id']."' target='_blank' title='Print' data-toggle='tooltip' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-print'></i> Print </a>
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
  <?php include 'includes/helper-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.EditHelper').click(function(e){
    e.preventDefault();
    $('#EditHelper').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.activeHelper').click(function(e){
    e.preventDefault();
    $('#activeHelper').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'helper-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#helperid').val(response.id);
      $('#activeid').val(response.id);
	  
      $('#helper_name').val(response.helper_name);
      $('#address12').val(response.address);
      $('#PhoneNumber').val(response.phone);
      $('#status').val(response.status);
      $('#activestatus').val(response.status);
	  
		$('#helper_photo_image').html("<img src='../images/helper/"+response.helper_photo+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		$('#helper_id_copy').html("<img src='../images/helper/"+response.helper_id_copy+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
		
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

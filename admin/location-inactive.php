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
        In-Active Location Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Location Information</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Location</a>
               <a href="location-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
                  <th>id</th>
                  <th>Location Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT * FROM `location_master` WHERE status='In-Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td>".$row['location_name']."</td>
							<td>".$row['status']."</td>
							<td style='width: 10%;'>
								<button class='btn btn-success btn-sm activeLocation btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Active </button>
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
  <?php include 'includes/location-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.editBranch').click(function(e){
    e.preventDefault();
    $('#editBranch').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.activeLocation').click(function(e){
    e.preventDefault();
    $('#activeLocation').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'location_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#activeid').val(response.id);
      $('#deletid').val(response.id);
      $('#activebranch_name').val(response.location_name);
      $('#activebranch_code').val(response.branch_code);
      $('#activestatus').val(response.status);
      
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

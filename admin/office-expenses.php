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
        Office Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="trip-expenses.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Office Information</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Office Expenses</a>
			  <b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th class='hidden'></th>
					<th>id</th>
					<th>ACC Head</th>
					<th>Amount</th>
					<th>Expenses Type</th>
					<th>Date</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT * FROM `office_expenses` ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$idNo++."</td>
							<td>".$row['acc_head']."</td>
							<td>".$row['acc_head_type']."</td>
							<td>".$row['exp_date']."</td>
							<td style='width							<td>".$row['amount']."</td>
: 10%;'>
								<button class='btn btn-success btn-sm editOfficeExp btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
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
  <?php include 'includes/office-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src='../bootstrapvalidator.min.js'></script>
<script type="text/javascript">
 
	$(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		excluded: [':disabled'],
        fields: {
            AccountHead: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Account Head'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
            },
			OfficeAmount: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Please Insert Amount Only'
                    },
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Amount value only'
					}
                }
            }
			}
        })	
	}); 
	
	$(document).ready(function() {
    $('#contact_formEdit').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		excluded: [':disabled'],
        fields: {
            AccountHead: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Account Head'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
            },
			OfficeAmount: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Please Insert Amount Only'
                    },
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Amount value only'
					}
                }
            }
			}
        })	
	}); 
	
</script>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.editOfficeExp').click(function(e){
    e.preventDefault();
    $('#editOfficeExp').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.deleteBranch').click(function(e){
    e.preventDefault();
    $('#deleteBranch').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'officeExp_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#deletid').val(response.id);
      $('#EditAccountHead').val(response.acc_head);
      $('#Editamount').val(response.amount);
      $('#Editacc_head_type').val(response.acc_head_type);
      $('#Editexp_date').val(response.exp_date);
      $('#deletbranch_name').html(response.branch_name);
      $('#editbranch_code').val(response.branch_code);
      $('#editstatus').val(response.status);
      
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

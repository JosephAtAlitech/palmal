<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
	
	<link rel="stylesheet" href="select2/select2.min.css" />
	
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Party List Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Party List Information</li>
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
				<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add New Party</a>
				<b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
			</div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>SL</th>
					<th>Company Name</th>
					<th>Contact Person</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Since From</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT * FROM `party_name` WHERE status!='In-active' ORDER BY id  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td>".$row['company_name']."</td>
							<td>".$row['contact_person']."</td>
							<td>".$row['phone']."</td>
							<td>".$row['address']."</td>
							<td>".$row['create_date']."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm EditParty btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
								<button class='btn btn-danger btn-sm deleteParty btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-trash'></i></button>
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
  <?php include 'includes/party-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	
	
 
	function phoneAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_Avilability.php",
		data:'PhoneCheck='+$("#PhoneCheck").val(),
		type: "POST",
		success:function(data){
		$("#phone-availability-status").html(data);
		$("#loaderIcon").hide();
		},
		error:function (){}
		});
	}
	
	
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
				companyName: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Company Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				contactPerson: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Contact Person'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				Address: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Address'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				
				phoneNumber: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Phone Number'
						},
						regexp: {
							regexp: /^(?:\+?88)?01[13-9]\d{8}$/,
							message: 'Mobile Ex: 8801823835334'
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
				companyName: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Company Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				contactPerson: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Contact Person'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				Address: {
					validators: {
							stringLength: {
							min: 3,
						},
							notEmpty: {
							message: 'Please Insert Only Address'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				
				phoneNumber: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Phone Number'
						},
						regexp: {
							regexp: /^(?:\+?88)?01[15-9]\d{8}$/,
							message: 'Mobile Ex: 8801823835334'
						}
					}
				}
				
			}
        })	
	}); 
	
</script>
<script>

$(function(){
  $('.EditParty').click(function(e){
    e.preventDefault();
    $('#EditParty').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.deleteParty').click(function(e){
    e.preventDefault();
    $('#deleteParty').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'party-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#deletid').val(response.id);
      $('#Editcompany_name').val(response.company_name);
      $('#Deletecompany_name').html(response.company_name);
      $('#Editcontact_person').val(response.contact_person);
      $('#Editphone').val(response.phone);
      $('#Editaddress').val(response.address);
      
      
		
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

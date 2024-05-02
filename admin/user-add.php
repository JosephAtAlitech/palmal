<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; include('wialon.php'); $wialon_api = new Wialon();?>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
<style>
.select-group input.form-control{ width: 65%}
.select-group select.input-group-addon { width: 35%; }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
	<link rel="stylesheet" href="select2/select2.min.css" />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>User Information</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">User Information</li>
		</ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<?php
			$sql = "SELECT tokenId FROM `customer_token` WHERE status='Active' ORDER BY `id`  DESC";
                    $query = $conn->query($sql);
					$row = $query->fetch_assoc();
					$token = $row['tokenId'];
				
				$tokenInfo = $token;
				$result = $wialon_api->login($tokenInfo);
				$json = json_decode($result, true);
					
		?>
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
				<a href="#addnewUser" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add User</a>
				
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th>id</th>
					<th>Name</th>
					<th>Photo</th>
					<th>User Name</th>
					<th>Mobile</th>
					<th>Email</th>
					<th>Branch</th>
					<th>Status</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT admin.id,admin.username,admin.firstname,admin.lastname,admin.email,admin.photo,admin.created_on,admin.status,admin.mobile,admin.deleted,
                branch_master.branch_name,branch_master.id as branchId 
                FROM `admin`
                                LEFT JOIN branch_master ON admin.branch_id=branch_master.id
                                WHERE admin.username!='Admin' and deleted='On'";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						if($row['status']=='1'){
						    $status='Active';
						}
						else{
						    $status='In-active';
						}
						echo "
                        <tr>
							<td>".$idNo++."</td>
							<td>".$row['firstname']."</td>
							<td>".$row['photo']."</td>
							<td>".$row['username']."</td>
							<td>".$row['mobile']."</td>
							<td>".$row['email']."</td>
							<td>".$row['branch_name']."</td>
							<td>".$status."</td>
							<td style='width: 9%;'>
								<button class='btn btn-success btn-sm EditUser btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
								<button class='btn btn-danger btn-sm deleteUser btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-trash'></i></button>
								<button class='btn btn-deafult btn-sm changePassword btn-flat' style='margin-bottom: 5px;' data-id='".$row['id']."'><i class='fa fa-edit'>Password</i></button>
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
  <?php include 'includes/user-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	
	function chasisAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_AvilabilityVehicle.php",
		data:'chasisNumberCheck='+$("#chasisNumberCheck").val(),
		type: "POST",
		success:function(data){
		$("#chasis-availability-status").html(data);
			if(data=="OK") {
				$('#submit-button').prop('disabled', false)
				return true;    
			} else {
				$('#submit-button').prop('disabled', true)
				return false;   
			}
		$("#loaderIcon").hide();
		},
		error:function (){}
		});
	}
	function engineAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_AvilabilityVehicle.php",
		data:'EnginNumberCheck='+$(EnginNumberCheck).val(),
		type: "POST",
		success:function(data){
		$("#engine-availability-status").html(data);
		if(data=="OK") {
				$('#submit-button').prop('disabled', false)
				return true;    
			} else {
				$('#submit-button').prop('disabled', true)
				return false;   
			}
		$("#loaderIcon").hide();
		},
		error:function (){}
		});
	}
	
	// image error 
	$(document).ready(function(){
		  $("img").bind("error",function(){
			// Set the default image
			$(this).attr("src","broken_image.png");
		  });
		});
	
	
	
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
				fCustomerName: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				lContactPerson: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				userName: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert User Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				PhoneNumber: {
					validators: {
								stringLength: {
								min: 1,
							},
								notEmpty: {
								message: 'Please Insert User Phone'
							},
							regexp: {
								regexp: /^(?:\+?88)?01[15-9]\d{8}$/,
								message: 'Please insert Phone Number only'
							}
						}
				},
				EmailAddress: {
					validators: {
								stringLength: {
								min: 1,
							},
							regexp: {
								regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
								message: 'Please insert valid Email only'
							}
						}
				},
				userImage: {
					validators: {
						regexp: {
							regexp: /^.*\.(jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF) only'
						}
					}
				}
				
				
			}
        })	
	}); 
	
	$(document).ready(function() {
    $('#edit_contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		excluded: [':disabled'],
        fields: {
				fCustomerName: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				lContactPerson: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				userName: {
					validators: {
						stringLength: {
							min: 2,
						},
						notEmpty: {
							message: 'Please Insert User Name'
						},
						regexp: {
							regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
							message: 'Please insert alphanumeric value only'
						}
					}
				},
				PhoneNumber: {
					validators: {
								stringLength: {
								min: 1,
							},
								notEmpty: {
								message: 'Please Insert User Phone'
							},
							regexp: {
								regexp: /^(?:\+?88)?01[15-9]\d{8}$/,
								message: 'Please insert Phone Number only'
							}
						}
				},
				EmailAddress: {
					validators: {
								stringLength: {
								min: 1,
							},
							regexp: {
								regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
								message: 'Please insert valid Email only'
							}
						}
				},
				userImage: {
					validators: {
						regexp: {
							regexp: /^.*\.(jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF)$/,
							message: 'Please insert (jpg|JPG|JPEG|png|gif|GIF|doc|DOC|pdf|PDF) only'
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
  $('.EditUser').click(function(e){
    e.preventDefault();
    $('#EditUser').modal('show');
    var id = $(this).data('id');
    //alert(id);
    getRow(id);
  });
    
    $('.changePassword').click(function(e){
    e.preventDefault();
    $('#changePassword').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
    
  $('.deleteUser').click(function(e){
    e.preventDefault();
    $('#deleteUser').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
    //alert(id);
  $.ajax({
    type: 'POST',
    url: 'user-row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#deletid').val(response.id);
      $('#chdeletid').val(response.id);
	  $('#deletusername').html(response.username);
      $('#edit_fcustomerName').val(response.firstname);
      $('#edit_lcustomerName').val(response.lastname);
      $('#editUname1').val(response.username);
      $('#editemailAddress').val(response.email);
      $('#edit_phoneNumber').val(response.mobile);
      $('#edit_branceNumber').val(response.branchId);
     
	
	}
  });
}
</script>
<script type="text/javascript">
// Print message to log
function msg(text) { $("#log").prepend(text + "<br/>"); }

	function init() { // Execute after login succeed
		var sess = wialon.core.Session.getInstance(); // get instance of current Session
		// flags to specify what kind of data should be returned
		var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;

		sess.loadLibrary("itemIcon"); // load Icon Library	
		sess.updateDataFlags( // load items to current session
		[{type: "type", data: "avl_unit", flags: flags, mode: 0}], // Items specification
			function (code) { // updateDataFlags callback
				if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code

				// get loaded 'avl_unit's items  
				var units = sess.getItems("avl_unit");
				if (!units || !units.length){ msg("Units not found"); return; } // check if units found

				for (var i = 0; i< units.length; i++){ // construct Select object using found units
					var u = units[i]; // current unit in cycle
					// append option to select
					$("#units").append("<option value='"+ u.getId() +"'>"+ u.getName()+ "</option>");
				}
				// bind action to select change event
				$("#units").change( getSelectedUnitInfo );
			}
		);
	}

	// execute when DOM ready
	$(document).ready(function () {
		var myToken = <?php echo(json_encode($token)); ?>;
		wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
		// For more info about how to generate token check
		// http://sdk.wialon.com/playground/demo/app_auth_token
		wialon.core.Session.getInstance().loginToken(myToken, "", // try to login
			function (code) { // login callback
				// if error code - print error message
				if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
				//msg("Logged successfully"); 
				init(); // when login suceed then run init() function
		});
	});
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

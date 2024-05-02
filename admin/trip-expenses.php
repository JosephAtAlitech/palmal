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
        Trip Expenses Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="trip-expenses.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Trip Expenses Information</li>
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
				<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Trip Expenses</a>
				<b style="color: red;padding: 10%;font-size: 2rem;"> Not Active For <?php echo $user['firstname'].' '.$user['lastname']; ?></b>
            </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th class='hidden'></th>
					<th>id</th>
					<th>Trip Number</th>
					<th>vehicle Name</th>
					<th>Police Exp</th>
					<th>Toll Exp</th>
					<th>Parking Exp</th>
					<th>Ent. Exp</th>
					<th>Others Exp</th>
					<th>Date</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
						$sql = "SELECT trip_expenses.id,trip_expenses.trip_no,trip_expenses.vehicle_id,trip_expenses.police_exp,trip_expenses.toll_exp,trip_expenses.parking_exp,trip_expenses.entertainment,trip_expenses.others_exp,trip_expenses.expenses_date,vehicle_master.vehicle_number
							FROM `trip_expenses`
							LEFT JOIN vehicle_master ON vehicle_master.id=trip_expenses.vehicle_id  
							ORDER BY `trip_expenses`.`id`  DESC";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						
						echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$idNo++."</td>
							<td>".$row['trip_no']."</td>
							<td>".$row['vehicle_number']."</td>
							<td>".$row['police_exp']."</td>
							<td>".$row['toll_exp']."</td>
							<td>".$row['parking_exp']."</td>
							<td>".$row['entertainment']."</td>
							<td>".$row['others_exp']."</td>
							<td>".$row['expenses_date']."</td>
							<td style='width: 10%;'>
								<button class='btn btn-success btn-sm editTrip btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit </button>
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
  <?php include 'includes/trip-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src='../bootstrapvalidator.min.js'></script>
<script type="text/javascript">
	
	function loadPurchase(){
	var tripNumber = $('#tripNumber').val();
	var dataString = 'loadPurchaseByPurchaseCode=1&tripNumber='+tripNumber;
	$.ajax({
		type: 'GET',
		url: 'loadVehecle.php',
		data: dataString,
		dataType: 'json',
		success: function(response){
			$('#vehicleNumber').val(response[0].id);
			
		},
		error: function (xhr) {
			//alert("3="+xhr.responseText);
			alert(xhr.responseText);
		}
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
            expensesName: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Expenses Name'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
            },
             PoliceExpenses: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Police Expenses'
					}
                }
            },
			TollExpenses: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Toll Expenses'
					}
                }
            },
			ParkingExpenses: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Parking Expenses'
					}
                }
            },
			Entertainment: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Entertainment'
					}
                }
            },
			OthersExpenses: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Others Expenses'
					}
                }
            },
			ExpensesDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
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
            expensesName: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Expenses Name'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
            },
             PoliceExpenses: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Police Expenses'
					}
                }
            },
			TollExpenses: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Toll Expenses'
					}
                }
            },
			ParkingExpenses: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Parking Expenses'
					}
                }
            },
			Entertainment: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Entertainment'
					}
                }
            },
			OthersExpenses: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Others Expenses'
					}
                }
            },
			ExpensesDate: {
                validators: {
                    date: {
                        message: 'The date is not valid',
                        format: 'YYYY/MM/DD'
                    },
                }
            }
			}
        })	
	});
	
</script>
<script>
	var userselect = document.getElementById('input');

$(function(){
  $('.editTrip').click(function(e){
    e.preventDefault();
    $('#editTrip').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.deleteTrip').click(function(e){
    e.preventDefault();
    $('#deleteTrip').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'tripaddExpenses_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#deletid').val(response.id);
      $('#editTripid').val(response.trip_no);
      $('#editvehicle_id').val(response.vehicle_id);
	  
      $('#editPoliceExpenses').val(response.police_exp);
	  $('#editParking_exp').val(response.parking_exp);
      $('#editTollExpenses').val(response.toll_exp);
      $('#editParkingExpenses').val(response.toll_exp);
      $('#editEntertainment').val(response.entertainment);
      $('#editOthersExpenses').val(response.others_exp);
      $('#editexpenses_date').val(response.expenses_date);
	  
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
  
</script>

</body>
</html>

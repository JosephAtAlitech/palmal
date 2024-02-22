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
        Fuel Sheets Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="diselReposrt.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Fuel Sheets Information</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Fuel Sheets</a>
               <!--a href="branch-master.php" class="btn btn-success btn-sm btn-flat"><i class="fa fa-eye"></i> Active </a>
              <a href="branch-inactive.php" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-eye"></i> In-Active </a>
			-->
		   </div>
            <div class="box-body">
              <table id="example_company" class="table table-bordered">
                <thead>
					<th class='hidden'></th>
					<th>id</th>
					<th>Vehicle Name</th>
					<th>Pump Name</th>
					<th>Fuel Type</th>
					<th>Liter</th>
					<th>Price Ltr</th>
					<th>Amount</th>
					<th>Action</th>
                </thead>
                <tbody>
                  <?php
					$sql = "SELECT diesel_reports.*,vehicle_master.vehicle_number,oil_pump_name.pump_name as pumpName,oil_pump_name.address
							FROM `diesel_reports` 
                            INNER JOIN oil_pump_name ON oil_pump_name.id=diesel_reports.pump_name
							LEFT JOIN vehicle_master ON vehicle_master.id=diesel_reports.vehicle_no
							where diesel_reports.delete_status!='In-Active' ORDER BY diesel_reports.id  DESC;";
                    $query = $conn->query($sql);
					$idNo=1;
                    while($row = $query->fetch_assoc()){
						$dieselLitre=$row['litre_price'];
						$litrePrice=$row['litre_price'];
						$TotalAmount=($dieselLitre*$litrePrice);
						
						echo "
                        <tr>
							<td class='hidden'></td>
							<td>".$idNo++."</td>
							<td>".$row['vehicle_number']."</td>
							<td>".$row['pumpName']." Address : ".$row['address']."<br>".$row['diesel_date']."</td>
							<td>".$row['diesel_type']."</td>
							<td>".$row['diesel_litre']."</td>
							<td>".$row['litre_price']."</td>
							<td>".$row['total_amount']."</td>
							
							<td style='width: 10%;'>
								<button class='btn btn-success btn-sm editDieselRep btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i></button>
								<button class='btn btn-danger btn-sm deleteDieselRep btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i></button>
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
  <?php include 'includes/dieselReports-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	
	$('.datepick').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        
    }); 
	
	$("#fuelType").change(function (){
		$("#fuelRate").val($("#fuelType").val());
		$("#fuelTypeText").val($("#fuelType option:selected").text());
		calc();
	})
	
	function calc()
		{
			var elm = document.forms["myform"];

			if (elm["EnterAmount"].value != "" && elm["fuelRate"].value != "")
			{
			    elm["DieselInLitre"].value= (parseFloat(elm["EnterAmount"].value) / parseFloat(elm["fuelRate"].value)).toFixed(2);
			    
			}
		}
	function calcEdit()
		{
			var elm = document.forms["myformEdit"];

			if (elm["EnterAmount"].value != "" && elm["fuelRate"].value != "")
			{
			    elm["DieselInLitre"].value = (parseFloat(elm["EnterAmount"].value) / parseFloat(elm["fuelRate"].value)).toFixed(2);
			    
			}
		}	

	
	$(document).ready(function() {
	  $("#vehicleNumber").select2({
	    placeholder: "Select Vehicle No",
		dropdownParent: $("#addnew"),
		allowClear: true,
    	width:'100%'
	  });
	});
	$(document).ready(function() {
	  $("#fuelType").select2({
	     placeholder: "Select Fuel Type",
		dropdownParent: $("#addnew"),
		allowClear: true,
    	width:'100%'
	  });
	});
	$(document).ready(function() {
	  $("#PumpName").select2({
	     placeholder: "Select Pump Name",
		dropdownParent: $("#addnew"),
		allowClear: true,
    	width:'100%'
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
            vehicleNumber: {
                validators: {
                        notEmpty: {
                        message: 'Please Select Vehicle Number'
                    }
					
                }
            },
			fuelType: {
                validators: {
                        notEmpty: {
                        message: 'Please Select Fuel Type'
                    }
					
                }
            },
			dieselDate: {
                validators: {
                        notEmpty: {
                            message: 'Please Insert Only Slip Number'
                        },
    					regexp: {
    						regexp: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (2[0-3]|[01][0-9]):[0-5][0-9]+$/,
    						message: 'Please insert alphanumeric value only'
    					}
                    }
            },
			PumpName: {
                    validators: {
                            notEmpty: {
                            message: 'Please Select Pump Name'
                        }
    					
                    }
				},
				SlipNumber: {
                    validators: {
                            stringLength: {
                            min: 3,
                        },
                            notEmpty: {
                            message: 'Please Insert Only Slip Number'
                        },
    					regexp: {
    						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
    						message: 'Please insert alphanumeric value only'
    					}
                    }
				},
				EnterAmount: {
					validators: {
						stringLength: {
							min: 1,
						},
						notEmpty: {
							message: 'Please Insert Diesel In Litre'
						},
						regexp: {
							regexp: /^[0-9]{1,10}$/,
							message: 'Please insert Intiger only'
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
            branchName: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Branch Name'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
            },
				DieselInLitre: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Please Insert Diesel In Litre'
                    },
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Intiger only'
					}
                }
				},
				RatePerlitre: {
                validators: {
                    stringLength: {
                        min: 1,
                    },
                    notEmpty: {
                        message: 'Please Insert Rate Per Litre'
                    },
					regexp: {
						regexp: /^[0-9]{1,10}$/,
						message: 'Please insert Diesel In Litre only'
					}
                }
				},
				location: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert location Name'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
				},
				PumpName: {
                validators: {
                            notEmpty: {
                            message: 'Please Select Pump Name'
                        }
    					
                    }
				},
				KmplNumber: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Kmpl Number'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
				},
				kmsNumber: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Kms Number'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
				},
				SlipNumber: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'Please Insert Only Slip Number'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ '\.\-\s\,\;\:\/\&\$\%\(\)]+$/,
						message: 'Please insert alphanumeric value only'
					}
                }
				},
             branchCode: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please Insert Branch Code Only'
                    },
					regexp: {
						regexp: /^([a-zA-Z0-9_ ]+\s)*[a-zA-Z0-9_ ]+$/,
						message: 'Please insert alphanumeric value only'
					}
                },
				fuelType: {
					validators: {
						notEmpty: {
							message: 'Please Select Fuel Type'
						}
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
  $('.editDieselRep').click(function(e){
    e.preventDefault();
    $('#editDieselRep').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.deleteDieselRep').click(function(e){
    e.preventDefault();
    $('#deleteDieselRep').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'dieselReport_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editid').val(response.id);
      $('#deletid').val(response.id);
      $('#Editdiesel_date').val(response.diesel_date);
      $('#Editvehicle_no').val(response.vehicle_no);
      $('#Editdiesel_litre').val(response.diesel_litre);
      $('#EditfuelRate').val(response.litre_price);
      $('#Edittotal_amount').val(response.total_amount);
      $('#Editpump_name').val(response.pump_name);
      $('.EditfuelTypeText').val(response.diesel_type);
      $('#Editslip_number').val(response.slip_number);
	  
      $('#deletslip_number').html(response.slip_number);
      
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

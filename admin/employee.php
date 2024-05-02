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
        Employee List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Employee List</li>
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
	  <style>
		* Response */
		.response{
			padding: 6px;
			display: none;
		}

		.not-exists{
			color: red;
		}

		.exists{
			color: green;
		}
		</style>
	 <link rel="stylesheet" href="../css/buttons.dataTables.min.css"/>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
               <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example_employee" class="table table-bordered">
                <thead>
                  <th>Emp.ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Emp.Type</th>
                  <th>Schedule</th>
                  <th>Member Since</th>
                  <th style="width: 12%;">Action</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN position ON position.id=employees.position_id LEFT JOIN schedules ON schedules.id=employees.schedule_id LEFT JOIN company ON company.id=employees.firm_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['employee_id']; ?></td>
                          <td><img src="<?php echo (!empty($row['photo']))? '../images/'.$row['photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> <a href="#edit_photo" data-toggle="modal" class="pull-right photo" data-id="<?php echo $row['empid']; ?>"><span class="fa fa-edit"></span></a></td>
                          <td><?php echo $row['firstname'].' '.$row['lastname'].'<br>'.$row['firm_name'];?></td>
                          <td><?php echo $row['description']; ?></td>
                          <td><?php echo $row['employee_type'] .'<br>'. $row['employee_status']; ?></td>
                          <td><?php echo date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out'])); ?></td>
                          <td><?php echo date('M d, Y', strtotime($row['created_on'])) ?></td>
                          <td>
                            <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-edit"></i></button>
                            <!--button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-trash"></i></button-->
                            <button class="btn btn-danger btn-sm empUpdate btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-user"></i></button>
                            <button class="btn btn-danger btn-sm view btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-eye"></i></button>
                          </td>
                        </tr>
                      <?php
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
  <?php include 'includes/employee_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(document).ready(function(){

   $("#employeeId").keyup(function(){

      var uname = $("#employeeId").val().trim();

      if(uname != ''){

         $("#uname_response").show();

         $.ajax({
            url: 'uname_check.php',
            type: 'post',
            data: {uname:uname},
            success: function(response){

                if(response > 0){
                    $("#uname_response").html("<span class='not-exists'>* Employee ID Already in use.</span>");
                }else{
                    $("#uname_response").html("<span class='exists'>Employee ID Available Till Now.</span>");
                }

             }
          });
      }else{
         $("#uname_response").hide();
      }

    });

 });
</script>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $('.empUpdate').click(function(e){
    e.preventDefault();
    $('#empUpdate').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
 
  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });
  
$('.view').click(function(e){
    e.preventDefault();
    $('#view').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  
});

function getRow(id){	
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.employee_id').html(response.employee_id);
      $('.del_employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_emp_type').val(response.employee_type);
      $('.emp_type').html(response.employee_type);
	  $('.web_url').html(response.web_url);
      $('#edit_marital_status').val(response.marital_status);
      $('.marital_status').html(response.marital_status);
      $('#edit_nid').val(response.nid);
      $('#edit_gender').val(response.gender);
      $('.gender').html(response.gender);
      $('#edit_nationality').val(response.nationality);
      $('.nationality').html(response.nationality);
      $('#blood_group_val').val(response.blood_group);
      $('.blood_group_val').html(response.blood_group);
      $('#datepicker_edit').val(response.birthdate);
      $('.datepicker_edit').html(response.birthdate);
      $('#edit_religion').val(response.religion);
      $('#edit_phone').val(response.phone);
      $('#edit_title').val(response.title);
	  $('#edit_alt_phone').val(response.alt_phone);
      $('.phone').html(response.phone);
	  $('.alt_phone').html(response.alt_phone);
      $('#edit_email').val(response.email);
      $('#edit_alt_email').val(response.alt_email);
      $('.email').html(response.email);
      $('.alt_email').html(response.alt_email);
      $('#edit_present_address').val(response.present_address);
      $('.present_address').html(response.present_address);
      $('#edit_parmanent_address').val(response.parmanent_address);
      $('.parmanent_address').html(response.parmanent_address);
      $('#edit_father_name').val(response.father_name);
      $('.father_name').html(response.father_name);
      $('#edit_mother_name').val(response.mother_name);
      $('.mother_name').html(response.mother_name);
      $('#edit_spouse_name').val(response.spouse_name);
      $('.spouse_name').html(response.spouse_name);
      $('#edit_bank_name').val(response.bank_name);
      $('.bank_name').html(response.bank_name);
      $('#edit_branch_name').val(response.branch_name);
      $('.branch_name').html(response.branch_name);
      $('#edit_ac_number').val(response.account_number);
      $('.ac_number').html(response.account_number);
      $('#edit_emp_status').val(response.employee_status);
      $('#empstatus').val(response.employee_status);
      $('.emp_status').html(response.employee_status);
      $('#edit_bonding_year').val(response.bonding_year);
      $('.bonding_year').html(response.bonding_year);
      $('#imageview').html("<img src='../images/"+response.photo+"' style='width: 100%;height: 90px;border-radius: 15%;'/>");
      $('#emprintid').html("<a href='profile-view.php?id="+response.empid+"' target='_blank' class='btn btn-success btn-sm btn-flat'> <span class='glyphicon glyphicon-print'>Print</span></a>");
		
      $('#company_val').val(response.firm_id).html(response.firm_name);
      $('.company_val').val(response.firm_id).html(response.firm_name);
      $('#department_val').val(response.department_id).html(response.department_name);
      $('.department_val').html(response.department_name);
      $('.created_on').html(response.created_on);
	  
      $('#position_val').val(response.position_id).html(response.description);
      $('.position_val').html(response.description);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
      $('#schedule_title').val(response.schedule_id).html(response.title);
	 
    }
  });
}
</script>
<script>

$(document).ready(function() {
    $('#example_employee').DataTable( {
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

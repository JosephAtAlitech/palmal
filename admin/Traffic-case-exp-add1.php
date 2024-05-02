<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
    .select-group input.form-control {
        width: 65%
    }

    .select-group select.input-group-addon {
        width: 35%;
    }
</style>
<link rel="stylesheet" href="select2/select2.min.css" />

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>


        <div class="content-wrapper">

            <section class="content-header">
                <h1>Traffic Case Expanses Information</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Traffic Case Expanses List</li>
                </ol>
            </section>

            <section class="content">

                <link rel="stylesheet" href="buttons.dataTables.min.css" />
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <a href="#addExpModal" data-toggle="modal"
                                    class="btn btn-primary btn-sm btn-flat float-right"><i class="fa fa-plus"></i> Add
                                    Expanse </a>

                            </div>
                            <div class="row">
                            <div class="col-md-4">
                                
                            <select id="getVehicle" class="form-control" name="getVehicle" placeholder="Select Vehicle ">
								<?php
								$sql = "SELECT vehicle_master.id,vehicle_master.vehicle_number,manufacturer_name.name,vehicle_master.maker_brand,vehicle_master.cc_brand,vehicle_master.fuel_type,vehicle_master.wings_name,vehicle_master.employee_name,vehicle_master.location 
                                        FROM `vehicle_master`  
                                        INNER JOIN manufacturer_name ON manufacturer_name.id=vehicle_master.makers_name
                                         WHERE delete_status='Active' ORDER BY `vehicle_master`.`id` DESC ";
								$result = $conn->query($sql);
								echo "<option value='0'>Select Vehicle</option>";
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row['id'] . "'>" . $row['vehicle_number'] . " " . $row['name'] . " " . $row['maker_brand'] . " " . $row['cc_brand'] . " CC (" . $row['employee_name'] . ") </option>";
									}
								}
								?>
							</select>
                            </div>

                                <div class="col-md-4">
                                
                                    <select name="" class="form-control " id="yearmonth">
                                    <?php
                                    $currentYear = date("Y");
                                    $currentMonth = date("m");
                                    echo "<option value='0'>Select Month</option>";
                                    for ($i = $currentYear; $i >= 2021; $i--) {
                                        for ($j = 1; $j <= 12; $j++) {
                                            $value = "$i-" . str_pad($j, 2, "0", STR_PAD_LEFT); // Format: YYYY-MM
                                            $label = date("F", mktime(0, 0, 0, $j, 1, $i)) . " $i"; // Format: Month Year
                                            echo "<option value=\"$value\">$label</option>";
                                        }
                                    }
                                    ?>
                                    </select>
                                </div>



                                <div class="col-md-4">
                                    <button class="btn btn-primary" type="button" onclick="getPdf()">
                                        <i class="fa fa-file-pdf-o"></i> Get Pdf
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6"></div>
                                <div class="col-xs-6">
                                    <div id='divMsg' class='alert alert-success alert-dismissible successMessage'></div>
                                    <div id='divErrorMsg' class='alert alert-danger alert-dismissible errorMessage'>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">

                                <table id="traffic_police_expnse_table" class="table table-bordered" width="100%">
                                    <thead>
                                        <th>SN#</th>
                                        <th>Vehicle No</th>
                                        <th>Driver Name</th>
                                        <th>Name Of Fectory</th>
                                        <th>User Name</th>
                                        <th>Case ID</th>
                                        <th>Receptable Amount</th>
                                        <th>Non Receptable Amount</th>
                                        <th>Total Amount</th>
                                        <th>Occurance Date/Settle Date</th>
                                        <th>Reason</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/Traffic-case-exp-modal.php'; ?>

    </div>
    <?php include 'includes/scripts.php'; ?>
    <script src='../bootstrapvalidator.min.js'></script>
    <script src="select2/select2.min.js"></script>
    <script src="includes/js/Traffic-case-exp-manage.js"></script>
</body>

</html>
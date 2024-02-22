<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; include('wialon.php'); $wialon_api = new Wialon();

date_default_timezone_set('Asia/Dhaka');
$toDay = (new DateTime())->format("m/d/Y H:i:s");
$toDayTime = date('m/d/Y h:i:s A', strtotime($toDay));
$previousDate = date('Y-m-d', strtotime('-1 days')).'08:00:00';

?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
	
<link rel="stylesheet" href="select2/select2.min.css" />	
<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
<link href="../dist/dateTime/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
	
	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Trip Sheet Information <?php echo $_SESSION['admin']; ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Trip Sheet Information</li>
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
				<div class="col-xs-5">
				<a href="#addnew" onclick="AddNewTrip()" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add New Trip Sheet</a>
				</div>
				<div class="col-xs-4"></div>
        		<div class="col-xs-3">
        			<select id="sortData" class="form-control" name="sortData" style='float:right;'>
					    
					    <?php
    					    $initialYear = 2020;
    					    $fromDate = date('Y-m-d', strtotime('-0 days'));
    					    $toDate = date('Y-m-d');
    					    echo '<option value="'.$fromDate.','.$toDate.'">Today</option>';
    					    
    					    $fromDate = date('Y-m-d', strtotime('-2 days'));
    					    $toDate = date('Y-m-d');
    				        echo '<option value="'.$fromDate.','.$toDate.'" Selected>2 Days</option>';
    					    
    					    $fromDate = date('Y-m-d', strtotime('-7 days'));
    					    $toDate = date('Y-m-d');
    				        echo '<option value="'.$fromDate.','.$toDate.'" >7 Days</option>';
    					    
    					    $fromDate = date('Y-m-d', strtotime('-15 days'));
    					    $toDate = date('Y-m-d');
    				        echo '<option value="'.$fromDate.','.$toDate.'" >15 Days</option>';
    					    
    					    $fromDate = date('Y-m-d', strtotime('-30 days'));
    					    $toDate = date('Y-m-d');
    					    echo '<option value="'.$fromDate.','.$toDate.'" >30 Days</option>';
    				        
    				        $fromDate = date('Y-m-d', strtotime('-45 days'));
    				        $toDate = date('Y-m-d');
    					    echo '<option value="'.$fromDate.','.$toDate.'" >45 Days</option>';
    				        
    				        $fromDate = date('Y-m-d', strtotime('-180 days'));
    				        $toDate = date('Y-m-d');
    					    echo '<option value="'.$fromDate.','.$toDate.'">180 Days</option>';
    				        for($i = date("Y"); $i >= $initialYear; $i--){
    				            $fromDate = $i.'-01-01';
    					        $toDate = $i.'-12-31';
    				            echo '<option value="'.$fromDate.','.$toDate.'">Year - '.$i.'</option>';
    				        }
					    ?>
					</select>
    			</div>
			</div>
            <div class="box-body">
                <table id="example_company" class="table table-bordered">
                    <thead>
    					<th>SL</th>
    					<th>Trip Date</th>
    					<th width="11%">Trip Number</th>
    					<th>Vehicle Number</th>
    					<th>KM</th>
    					<th width="10%">Fuel Issue</th>
    					<th>Trip's date</th>
    					<th>Action</th>
                    </thead>
                </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/trip-sheet-modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

<script src='../bootstrapvalidator.min.js'></script>
<script src="select2/select2.min.js"></script>
<script src="../dist/dateTime/moment.min.js" type="text/javascript"></script>
<script src="../dist/dateTime/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="js/trip-sheet.js"></script>

</body>
</html>
<script>
//function msg(text) {$("#log").prepend(text + "<br/>");}
function msg(text) { $("#log").val(text); }
function init() { // Execute after login succeed
	// specify what kind of data should be returned
	var res_flags = wialon.item.Item.dataFlag.base | wialon.item.Resource.dataFlag.reports;
	var unit_flags = wialon.item.Item.dataFlag.base;

	var sess = wialon.core.Session.getInstance(); // get instance of current Session
	sess.loadLibrary("resourceReports"); // load Reports Library
	sess.updateDataFlags( // load items to current session
		[
			{ // 'avl_resource's specification
				type: "type",
				data: "avl_resource",
				flags: res_flags,
				mode: 0
			},
			{ // 'avl_unit's specification
				type: "type",
				data: "avl_unit",
				flags: unit_flags,
				mode: 0
			}
		],

		function(code) { // updateDataFlags callback
			if (code) {// exit if error code
				msg(wialon.core.Errors.getErrorText(code));
				return;
			}

			var res = sess.getItems("avl_resource"); // get loaded 'avl_resource's items
			if (!res || !res.length) { // check if resources found
				msg("Resources not found");
				return;
			}
			for (var i = 0; i < res.length; i++) // construct Select object using found resources
				$("#res").append("<option value='" + res[i].getId() + "'>" + res[i].getName() + "</option>");

			var units = sess.getItems("avl_unit"); // get loaded 'avl_units's items
			// check if units found
			if (!units || !units.length) {
				msg("Units not found");
				return;
			}
			for (var i = 0; i < units.length; i++) // construct Select object using found units
				$("#units").append("<option value='" + units[i].getId() + "'>" + units[i].getName() + "</option>");
		}
	);
	drawCheckboxes();
	$('#templ').change(drawCheckboxes);
}


function drawCheckboxes () {
	// get available reports table
	wialon.core.Session.getInstance().getReportTables(function (code,data){
		//var selectedTmpl = $("#templ").val();
		var col = [];
		var html = '';
		html += '<ul id="columns" style="display:none;"><li><input class="rep_col" type="checkbox" id="time_begin" checked><label for="time_begin">Start</label></li><li><input class="rep_col" type="checkbox" id="time_end" checked><label for="time_end">End</label></li><li><input class="rep_col" type="checkbox" id="mileage" checked><label for="mileage">Mileage</label></li></ul>';
		$('#columns').html(html);
		});

}


function executeReport() { // execute selected report
	// get data from corresponding fields
	var id_res = $("#res").val(),
		templ = $("#templ").val(),
		alert(templ);
		
		id_unit = $("#units").val(),
		time = $("#interval").val();
	if (!id_res) {
		msg("Select resource");
		return;
	} // exit if no resource selected
	if (!id_unit) {
		msg("Select unit");
		return;
	} // exit if no unit selected
	var sess = wialon.core.Session.getInstance(); // get instance of current Session
	var res = sess.getItem(id_res); // get resource by id
	var from_date = new Date($("#start_dt").val());
	var from = Date.parse(from_date)/1000;
	var end_date = new Date($("#end_dt").val());
	var to = Date.parse(end_date)/1000;
	//var to = sess.getServerTime(); // get current server time (end time of report time interval)
	//var from = to - parseInt($("#interval").val(), 10); // calculate start time of report
	var columns = $("ul li .rep_col:checked"); // get columns, that need to be in a report
	// specify time interval object
	var interval = {
		"from": from,
		"to": to,
		"flags": wialon.item.MReport.intervalFlag.absolute
	};

	var c="", cl=""; // columns and columnsLabels variables
	for(var i=0; i< columns.length; i++){ // cycle to generate columns and columnsLabels
		c += (c==""?"":",") + columns[i].id;
		cl += (cl==""?"":",") + $(columns[i].nextSibling).text();//.innerText;
	}
	$("#unitsAvailability").prop("disabled", true); // disable button (to prevent multiclick while execute)
	var template = {// fill template object
		"id": 0,
		"n": templ,
		"ct": "avl_unit",
		"p": "",
		"tbl": [{
				"n": templ,
				"l": $("#templ option[value='" + templ + "']").text(),
				"c": c,
				"cl": cl,
				"s": "",
				"sl": "",
				"p": "",
				"sch": {
					"f1": 0,
					"f2": 0,
					"t1": 0,
					"t2": 0,
					"m": 0,
					"y": 0,
					"w": 0
				},
				"f": 0
			}]
	};
	res.execReport(template, id_unit, 0, interval, // execute selected report

	function(code, data) { // execReport template
		$("#unitsAvailability").prop("disabled", false); // enable button
		if (code) {
			msg(wialon.core.Errors.getErrorText(code));
			return;
		} // exit if error code
		if (!data.getTables().length) { // exit if no tables obtained
			msg("Null");
			return;
		} else showReportResult(data); // show report result
	});
}

function showReportResult(result) { // show result after report execute
	var columns = $("ul li .rep_col:checked");
	var total_milage = 0;
	//var html1='';
	var tables = result.getTables(); // get report tables
	if (!tables) return; // exit if no tables
	for (var i = 0; i < tables.length; i++) { // cycle on tables
		var html = "";
		result.getTableRows(i, 0, tables[i].rows, // get Table rows
			function(code, rows) { // getTableRows callback
				if (code) {
					msg(wialon.core.Errors.getErrorText(code));
					return;
				} // exit if error code
				for (var j in rows) { // cycle on table rows
					if (typeof rows[j].c == "undefined") continue; // skip empty rows
					//html += "<tr" + (j % 2 == 1 ? " class='odd' " : "") + ">"; // open table row
					var searchparam = 0;
					for (var k = 0; k < rows[j].c.length; k++) // add ceils to table
					{
						var data = getTableValue(rows[j].c[k]);
						/*if($(columns[k].nextSibling).text() == "Start"){
							//html1+=data+" - ";
							data = new Date(data);
							var start_date = new Date($("#start_dt").val());
							if(data >= start_date){
								searchparam++;
							}
						}else if($(columns[k].nextSibling).text() == "End"){
							//html1+=data+" - ";
							data = new Date(data);
							var end_date = new Date($("#end_dt").val());
							if(data <= end_date){
								searchparam++;
							}
						}
						else */if($(columns[k].nextSibling).text() == "Mileage"){
							//html1+=data+" <br> ";
							//if(searchparam == 2)
								total_milage += parseFloat(data);
						}
					
					} 
				
				}
				html = Math.round(total_milage);
				
				msg(html);
			},
		this,html);
	}
}

function getTableValue(data) { // calculate ceil value
	if (typeof data == "object")
		if (typeof data.t == "string") return data.t;
		else return "";
		else return data;
}

// execute when DOM ready

    
	function runningDistanceVFT(){
		/*var end_actual_time = $("#today").val();
		var start_actual_time = $("#start_dt").val();
		start_actual_time = new Date(start_actual_time);
		end_actual_time = new Date(end_actual_time);

		var diff = end_actual_time - start_actual_time;

		var diffSeconds = diff/1000;
		$("#interval").html("<option value='"+diffSeconds+"'>Time</option>")*/
		executeReport();
	}; // bind action to button click
$(document).ready(function() {    
    var myToken = <?php echo(json_encode($token)); ?>;
	wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
    // For more info about how to generate token check
    // http://sdk.wialon.com/playground/demo/app_auth_token
		wialon.core.Session.getInstance().loginToken(myToken, "", // try to login
	function(code) { // login callback
		// if error code - print error message
		if (code) {
			msg(wialon.core.Errors.getErrorText(code));
			return;
		}
		//msg("Logged successfully");
		init(); // when login suceed then run init() function
	});
});
</script>

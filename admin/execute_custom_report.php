<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; include('wialon.php'); $wialon_api = new Wialon();?>
   
	<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
    
<body class="hold-transition skin-blue sidebar-mini">
<style>
#map{width:100%; height:400px; }
#log, #tracks tr td { border: 1px solid #c6c6c6; }
#tracks { width: 100%;margin-top: 10%; }
.close_btn { text-align: center; vertical-align: middle; cursor: pointer; }
.unit {cursor: pointer;}
</style>
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
	
	
	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Live Custom Reports Information
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Live Custom Reports Information</li>
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
	  <link rel="stylesheet" href="buttons.dataTables.min.css"/>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <div class="box-body">
				<div class="form-group">
					<table>
                    	<tr>
                    		<td>Select resource and table:</td>
                    		<td>
                    			<select id="res"></select>
                    			<select id="templ">
                    				<option value="unit_trips">Trips Information</option>
                    			</select>
                    		</td>
                    	</tr>
                    	<tr>
                    		<td>Select unit:</td>
                    		<td>
                    			<select id="units"></select>
                    		</td>
                    	</tr>
                    	<tr>
                    		<td>Select time interval:</td>
                    		<td>
                    			<select id="interval">
                    				<option value="86400" title="60 sec * 60 minutes * 24 hours = 86400 sec = 1 day">Last day</option>
                    				<option value="604800" title="86400 sec * 7 days = 604800 sec = 1 week">Last week</option>
                    				<option value="2592000" title="86400 sec * 30 days = 2592000 sec = 1 month">Last month</option>
                    			</select>
                    		</td>
                    	</tr>
                    	<tr>
                    		<td>Report Columns:</td>
                    		<td><ul id="columns"></ul></td>
                    	</tr>
                    	<tr><td colspan="2" style="text-align:center;"><input type="button" value="Execute report" id="exec_btn"/></td></tr>
                    </table>
                    <div id="log"></div>
					
				</div>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script type="text/javascript">
function msg(text) {
	$("#log").prepend(text + "<br/>");
}

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
		html += '<ul id="columns"><li><input class="rep_col" type="checkbox" id="time_begin" checked><label for="time_begin">Start</label></li><li><input class="rep_col" type="checkbox" id="location_begin" checked><label for="location_begin">Start location</label></li><li><input class="rep_col" type="checkbox" id="time_end" checked><label for="time_end">End</label></li><li><input class="rep_col" type="checkbox" id="location_end" checked><label for="location_end">End location</label></li><li><input class="rep_col" type="checkbox" id="mileage" checked><label for="mileage">Mileage</label></li></ul>';
		$('#columns').html(html);
	});

}


function executeReport() { // execute selected report
	// get data from corresponding fields
	var id_res = $("#res").val(),
		templ = $("#templ").val(),
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
	var to = sess.getServerTime(); // get current server time (end time of report time interval)
	var from = to - parseInt($("#interval").val(), 10); // calculate start time of report
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
	$("#exec_btn").prop("disabled", true); // disable button (to prevent multiclick while execute)
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
		$("#exec_btn").prop("disabled", false); // enable buttontr
		if (code) {
			msg(wialon.core.Errors.getErrorText(code));
			return;
		} // exit if error code
		if (!data.getTables().length) { // exit if no tables obtained
			msg("<b>There is no data generated</b>");
			return;
		} else showReportResult(data); // show report result
	});
}

function showReportResult(result) { // show result after report execute
	var tables = result.getTables(); // get report tables
	if (!tables) return; // exit if no tables
	for (var i = 0; i < tables.length; i++) { // cycle on tables
		// html contains information about one table
		var html = "<b>" + tables[i].label + "</b><div class='wrap'><table style='width:100%'>";

		var headers = tables[i].header; // get table headers
		html += "<tr>"; // open header row
		for (var j = 0; j < headers.length; j++) // add header
			html += "<th>" + headers[j] + "</th>";
		html += "</tr>"; // close header row
		result.getTableRows(i, 0, tables[i].rows, // get Table rows
			function(code, rows) { // getTableRows callback
				if (code) {
					msg(wialon.core.Errors.getErrorText(code));
					return;
				} // exit if error code
				for (var j in rows) { // cycle on table rows
					if (typeof rows[j].c == "undefined") continue; // skip empty rows
					html += "<tr" + (j % 2 == 1 ? " class='odd' " : "") + ">"; // open table row
					for (var k = 0; k < rows[j].c.length; k++) // add ceils to table
						html += "<td>" + getTableValue(rows[j].c[k]) + "</td>";
					html += "</tr>"; // close table row
				}
				html += "</table>";
				msg(html + "</div>");
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
$(document).ready(function() {
	$("#exec_btn").click(executeReport); // bind action to button click
    var myToken = <?php echo(json_encode($token)); ?>;
	wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
    // For more info about how to generate token check
    // http://sdk.wialon.com/playground/demo/app_auth_token
	//wialon.core.Session.getInstance().loginToken("93280bb1d0c3629cac957e2ed63cc91506DD7189D1E30B540F3CE8DECF9253B056D3BBE7", "", // try to login
	wialon.core.Session.getInstance().loginToken(myToken, "",
	function(code) { // login callback
		// if error code - print error message
		if (code) {
			msg(wialon.core.Errors.getErrorText(code));
			return;
		}
		msg("Logged successfully");
		init(); // when login suceed then run init() function
	});
});
</script>
</body>
</html>

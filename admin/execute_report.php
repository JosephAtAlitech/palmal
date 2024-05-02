<?php include 'includes/session.php'; 
    date_default_timezone_set('Asia/Dhaka');
	$toDay = (new DateTime)->format("Y-m-d H:i:s");
	$toDayDate = (new DateTime)->format("Y-m-d");
?>
<?php include 'includes/header.php'; include('wialon.php'); $wialon_api = new Wialon();?>

<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
	
<body class="hold-transition skin-blue sidebar-mini">
<style>  #units tr td, #units { 
  border: 1px solid #c6c6c6; 
} 

#loader {
  border: 8px solid #02a8c461;
  border-top-color: rgb(243, 243, 243);
  border-top-style: solid;
  border-top-width: 8px;
border-radius: 50%;
border-top: 8px solid #1902b7;
width: 60px;
height: 60px;
-webkit-animation: spin 2s linear infinite;
animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
td, th{ border: 1px solid #c6c6c6; }
.wrap{ max-height:150px; overflow-y: auto; }
.odd, th{ background:#EEE; border: 1px solid #c6c6c6; }
</style>
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Execute Duty/Engine/Magnet Houre Reports
		</h1>
		<ol class="breadcrumb">
        <a href="allUnitTrack.php"> <a href="allUnitTrack.php" style="margin: 8px;font-size: 15px;"> <i class="fa fa-refresh"></i> Refresh</a>
		<i class="fa fa-dashboard"></i> Home </a></li><li class="active"> Execute Reports</li>
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
					
					<div class="col-md-12">
					
						<table class="table table-bordered" width="100%">
                        	<tr><td>Select resource and template:</td><td><select id="res"></select><select id="templ"></select></td></tr>
                        	<tr><td>Select unit:</td><td><select id="units" onchange="changeDateTime()"></select></td></tr>
                        	<tr>
                        		<td>Select time interval:</td>
                        		
                        		<!--td><select id="interval">
                        			<option value="86400" title="60 sec * 60 minutes * 24 hours = 86400 sec = 1 day">Last day</option> 
                        			<option value="604800" title="86400 sec * 7 days = 604800 sec = 1 week">Last week</option>
                        			<option value="2592000" title="86400 sec * 30 days = 2592000 sec = 1 month">Last month</option>    
                        		</select></td-->
                        		<td>
                        		    <input type="date" class="form-control" id="selectDate" name="selectDate" onchange="changeDateTime()" />
                        		</td>
                        	</tr>
                        	<tr><td colspan="2" style="text-align:center;display:none;"><input type="button" value="Execute report" id="exec_btn"/></td></tr>
                        </table>
					    <div id="log"></div>
						
					</div>
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

var count = 0;
// Print message to log
function msg(text) { $("#log").prepend(text + "<br/>"); }

function init() {// Execute after login succeed
	// specify what kind of data should be returned
	var res_flags = wialon.item.Item.dataFlag.base | wialon.item.Resource.dataFlag.reports;
	var unit_flags = wialon.item.Item.dataFlag.base;
	
	var sess = wialon.core.Session.getInstance(); // get instance of current Session
	sess.loadLibrary("resourceReports"); // load Reports Library
	sess.updateDataFlags( // load items to current session
		[{type: "type", data: "avl_resource", flags:res_flags , mode: 0}, // 'avl_resource's specification
		 {type: "type", data: "avl_unit", flags: unit_flags, mode: 0}], // 'avl_unit's specification
		function (code) { // updateDataFlags callback
			if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code

			var res = sess.getItems("avl_resource"); // get loaded 'avl_resource's items
			if (!res || !res.length){ msg("Resources not found"); return; } // check if resources found
			for (var i = 0; i< res.length; i++) // construct Select object using found resources
				$("#res").append("<option value='" + res[i].getId() + "'>" + res[i].getName() + "</option>");

			getTemplates(); // update report template list
			
			$("#res").change( getTemplates ); // bind action to select change

			var units = sess.getItems("avl_unit"); // get loaded 'avl_units's items
			if (!units || !units.length){ msg("Units not found"); return; } // check if units found
			for (var i = 0; i< units.length; i++) // construct Select object using found units
			{
				$("#units").append("<option value='"+ units[i].getId() +"'>"+ units[i].getName()+ "</option>");
				 //alert($("#units").val());
    			/*var today = new Date();
                var selectDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    			
    			//var selectDate = $('#selectDate').val();
        	    //$('#str').val();
        	    
        	    var dateTime = new Date(selectDate);
                var end_dt = dateTime.getMonth()+1 + '/' + dateTime.getDate() + '/' + dateTime.getFullYear()+' 8:59 AM';
                dateTime.setDate(dateTime.getDate()-1);	  
                var start_dt = dateTime.getMonth()+1 + '/' + dateTime.getDate() + '/' + dateTime.getFullYear()+' 9:00 AM';
                var from = Date.parse(start_dt)/1000;
        	    //var end_date = new Date($("#end_dt").val());
    	        var to = Date.parse(end_dt)/1000;*/
                //executeReport(from,to/*,units[i].getId(),selectDate*/)
			}

            
		}
	);
}

function getTemplates(){ // get report templates and put it in select list
	//$("#templ").html("<option></option>"); // ad first empty element
	var res = wialon.core.Session.getInstance().getItem($("#res").val()); // get resource by id
	// check user access to execute reports
	if (!wialon.util.Number.and(res.getUserAccess(), wialon.item.Item.accessFlag.execReports)){
		$("#exec_btn").prop("disabled", true); // if not enough rights - disable button
		msg("Not enought rights for report execution"); return; // print message and exit
	} else $("#exec_btn").prop("disabled", false); // if enough rights - disable button

	var templ = res.getReports(); // get reports templates for resource
	for(var i in templ){
		if (templ[i].ct != "avl_unit") continue; // skip non-unit report templates
		// add report template to select list
		$("#templ").append("<option value='"+ templ[i].id +"'>"+ templ[i].n+ "</option>");
	}
}

function executeReport(from,to/*,id_unit,selectDate*/){ // execute selected report
    // get data from corresponding fields
	var id_res=$("#res").val(), id_templ=$("#templ").val(), id_unit=$("#units").val(); //time=$("#interval").val();
	//var id_res=$("#res").val(), id_templ=$("#templ").val(); //, id_unit=$("#units").val();
	if(!id_res){ msg("Select resource"); return;} // exit if no resource selected
	if(!id_templ){ msg("Select report template"); return;} // exit if no report template selected
	if(!id_unit){ msg("Select unit"); return;} // exit if no unit selected

	var sess = wialon.core.Session.getInstance(); // get instance of current Session
	var res = sess.getItem(id_res); // get resource by id
	var from = from;
	var to = to;
	
	

	// specify time interval object
	var interval = { 
	    "from": from, 
	    "to": to, 
	    "flags": wialon.item.MReport.intervalFlag.absolute 
	};
	
	var template = res.getReport(id_templ); // get report template by id
	$("#exec_btn").prop("disabled", true); // disable button (to prevent multiclick while execute)

	res.execReport(template, id_unit, 0, interval, // execute selected report
		function(code, data) { // execReport template
			$("#exec_btn").prop("disabled", false); // enable button
			if(code){ msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			if(!data.getTables().length){ // exit if no tables obtained
				msg("<b>There is no data generated</b>"); return; }
			else showReportResult(data/*,id_unit,selectDate*/); // show report result
	});
}
var status = "";
function showReportResult(result/*,id_unit,selectDate*/){ // show result after report execute
	var tables = result.getTables(); // get report tables
	if (!tables) return; // exit if no tables
	/*alert(JSON.stringify(tables.length));
	alert(JSON.stringify(tables[1].total[2]));*/
	for(var i=0; i < tables.length; i++){ // cycle on tables
		// html contains information about one table
		var html = "<b>"+ tables[i].label +"</b><div class='wrap'><table style='width:100%'>";
		status += tables[i].label+";";
		/*vid[i] = id_unit;
		calculation_date[i] = selectDate;*/
		var headers = tables[i].header; // get table headers
		html += "<tr>"; // open header row
		for (var j=0; j<headers.length; j++) // add header
			html += "<th>" + headers[j] + "</th>";
		html += "</tr>"; // close header row
		result.getTableRows(i, 0, tables[i].rows, // get Table rows
			qx.lang.Function.bind( function(html, code, rows) { // getTableRows callback
				if (code) {msg(wialon.core.Errors.getErrorText(code)); return;} // exit if error code
				var v_id = $("#units").val();
				var calculationDate = $("#selectDate").val();
				//alert(status);
				count++;
				/*$.ajax({
                    type: 'POST',
                    url: 'execute_report_action.php',
                    data: {'tables':rows, 'vid':v_id,'calculation_date':calculationDate,'count':count,'status':status},
                    dataType: 'json',
                    beforeSend: function(){
                        // Show image container
                        $("#editLoader").show();
                   },
                    success: function(response){
                        //alert(JSON.stringify(response));
                        //alert(JSON.stringify(response));
                      
                    },error: function (xhr) {
                         //alert(JSON.stringify(xhr));
                    },
                    complete:function(data){
                        // Hide image container
                        $("#editLoader").hide();
                    }
                });*/
				for(var j in rows) { // cycle on table rows
					if (typeof rows[j].c == "undefined") continue; // skip empty rows
					html += "<tr"+(j%2==1?" class='odd' ":"")+">"; // open table row
					for (var k = 0; k < rows[j].c.length; k++) // add ceils to table
						html += "<td>" + getTableValue(rows[j].c[k]) + "</td>";
					html += "</tr>";// close table row
				}
				html += "</table>";
				msg(html +"</div>");
			}, this, html)
		);
		
	}
	
		/*$.ajax({
            type: 'POST',
            url: 'execute_report_action.php',
            data: {'tables':tables, 'vid':vid,'calculation_date':calculation_date},
            dataType: 'json',
            beforeSend: function(){
                // Show image container
                $("#editLoader").show();
           },
            success: function(response){
                alert(response);
              
            },error: function (xhr) {
                 alert(JSON.stringify(xhr));
            },
            complete:function(data){
                // Hide image container
                $("#editLoader").hide();
            }
        });*/
}

function getTableValue(data) { // calculate ceil value
	if (typeof data == "object")
		if (typeof data.t == "string") return data.t; else return "";
	else return data;
}

// execute when DOM ready
$(document).ready(function () {
    var myToken = <?php echo(json_encode($token)); ?>;
	$("#exec_btn").click( executeReport ); // bind action to button click

	wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
    // For more info about how to generate token check
    // http://sdk.wialon.com/playground/demo/app_auth_token
	wialon.core.Session.getInstance().loginToken(myToken, "", // try to login
		function (code) { // login callback
			// if error code - print error message
			if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
			msg("Logged successfully"); init(); // when login suceed then run init() function
	});
});

    date_default_timezone_set('Asia/Dhaka');
	$('.example').datetimepicker();
	$('.exampleEdit').datetimepicker();
	$('.exampleEnd').datetimepicker();
	$('.exampleEditEnd').datetimepicker();
	var date = new Date();
	$(".exampleEnd").val(date.getMonth()+1 + '/' + date.getDate() + '/' + date.getFullYear()+' 8:00 AM');
	date.setDate(date.getDate()-1);
	$(".example").val(date.getMonth()+1 + '/' + date.getDate() + '/' + date.getFullYear()+' 8:00 AM');
	

	
	function changeDateTime() {
	    
	    var selectDate = $('#selectDate').val();
	    //$('#str').val();
	    //alert(selectDate);
	    if(selectDate != ""){
	        
    	    var dateTime = new Date(selectDate);
    	    dateTime.setDate(dateTime.getDate()+1);
            var end_dt = dateTime.getMonth()+1 + '/' + dateTime.getDate() + '/' + dateTime.getFullYear()+' 8:00 AM';
            dateTime.setDate(dateTime.getDate()-1);
            var start_dt = dateTime.getMonth()+1 + '/' + dateTime.getDate() + '/' + dateTime.getFullYear()+' 8:00 AM';
    	    var from = Date.parse(start_dt)/1000;
    	    var to = Date.parse(end_dt)/1000;
    	    count = 0;
    	    alert(start_dt + " - " + end_dt);
    	    //alert(from + " - "+to);
    	    executeReport(from,to);
	    }
    }
</script>
</body>
</html>
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; include('wialon.php'); $wialon_api = new Wialon();?>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
	
<body class="hold-transition skin-blue sidebar-mini">
<style>  #log { border: 1px solid #c6c6c6; }.icon {float:left; margin:10px;} </style>
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Live Tracking Information
		</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Live Tracking Information</li>
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
					<div class="col-md-2">
					<?php
						//echo '<b>Hello , '.$json['user']['nm'].' !</b>';
						//$userId= $json['user']['id'];
						//echo '<br>Eid : '.$userId;
					?>
					</div>
					<div class="col-md-9">
						<label for="sunit">Select <?php echo '<b> - '.$json['user']['nm'].'- </b>';?> unit:</label>
						<select class="form-control" id="units">
							<option value="" selected>~~ Select Units ~~</option>
						</select>
						<div id="log"></div>
						<a href="vfunit_arrival.php?unit_id=16276522&unit_name=SAGrp 11-0646 TATA 15 ton">GeoLink</a>
						
						<!--a href="http://test-vf.vftracker.com/vfunit_arrival.php?unit_id=%UNIT_ID%&unit_name=%UNIT%&geofence=%ZONE%&time=%POS_TIME%&speed=%SPEED%&location=%LOCATION%&lat=%LAT%&lon=%LON%&notification=%NOTIFICATION%" target="_blank">GeoLink</a-->
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

function getSelectedUnitInfo(){ // print information about selected Unit

	var val = $("#units").val(); // get selected unit id
	if(!val) return; // exit if no unit selected
	
	var unit12 = wialon.core.Session.getInstance().getItem(val); // get unit by id
	if(!unit12){ msg("Unit not found");return; } // exit if unit not found
	
	// construct message with unit information
	var text = "<div style='border: 1px solid gray;border-radius: 3px;'>'"+unit12.getName()+"' Selected. "; // get unit name
	var icon = unit12.getIconUrl(32); // get unit Icon url
	if(icon) text = "<img class='icon' src='"+ icon +"' alt='icon'/>"+ text; // add icon to message
	var pos = unit12.getPosition(); // get unit position
	//if(pos){ // check if position data exists
	    var time = wialon.util.DateTime.formatTime(pos.t);
		text += "<b>Last message</b> "+ time +"<br/>"+ // add last message time
			//"<b>Position</b> "+ pos.x+", "+pos.y +"<br/>"+ // add info about unit position
			"<b>Speed</b> "+ pos.s; // add info about unit speed
        // try to find unit location using coordinates 
		wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}], function(code, shoaib){ 
		msg(text += "<br/><b>Location of unit</b>: "+ shoaib +"</div>");});
	//} else // position data not exists, print message
		//msg(text + "<br/><b>Location of unit</b>: Unknown</div>");
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

	
	function geoPreview(lat,long) {
		var elemA = document.getElementById("lat").value;
		var elemB = document.getElementById("long").value;

 window.location.href = "vfunit_arrival.php?lat="+elemA+"&lon="+elemB+"&setLatLon=Set";
		}

</script>
</body>
</html>

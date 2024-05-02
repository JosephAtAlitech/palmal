<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; include('wialon.php'); $wialon_api = new Wialon();?>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
	<!-- load map -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.2/leaflet.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.2/leaflet.js"></script>
	
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
						
						<div id="map"></div>
							<div class="col-md-5">
								<label>Select unit :</label><select class="form-control" id="units"><option value="" selected>~~ Select Units ~~</option></select>
							</div>
							<div class="col-md-5">
								<label>Select track color :</label><select class="form-control" id="color">
								  <option value="0000ff">Blue</option>
								  <option value="00ff00">Green</option>
								  <option value="ff0000">Red</option>
								  <option value="808000">Olive</option>
								  <option value="800080">Purple</option>
								  <option value="ffff00">Yelow</option>
								  <option value="800000">Maroon</option>
								  <option value="ffffff">White</option>
								  <option value="000000">Black</option>
								</select>
							</div>
							<div class="col-md-2">
								<label>Search :</label>
								<input class="form-control" id="build" type="button" value="Build">
							</div><br><br><br><br>
							
							<div id="log"></div>
							<br><br>
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
var map, markers = {}, tile_layer, layers = {}; // global variables

// Print message to log
function msg(text) { $("#log").html(text + "<br/>"); }

function init() { // Execute after login succeed
	var sess = wialon.core.Session.getInstance(), // get instance of current Session
		flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage, // specify what kind of data should be returned
		renderer = wialon.core.Session.getInstance().getRenderer();
	
	renderer.addListener("changeVersion", update_renderer);
	sess.loadLibrary("itemIcon"); // load Icon Library 
	
	sess.updateDataFlags( // load items to current session
	    [{type: "type", data: "avl_unit", flags: flags, mode: 0}], // Items specification
	    function (code) { // updateDataFlags callback
		    if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			
		    var units = sess.getItems("avl_unit"); // get loaded 'avl_resource's items
		    if (!units || !units.length){ msg("No units found"); return; } // check if units found
		    for (var i = 0; i< units.length; i++) // construct Select list using found resources
			    $("#units").append("<option value='"+ units[i].getId() +"'>"+ units[i].getName()+ "</option>");
		    $("#build").click( show_track );  // bind action to select change event
			//$("#tracks").on("click", ".close_btn", delete_track); //click, when need delete current track
			//$("#tracks").on("click", ".unit", focus_track); //click, when need to see any track
	});
}

function show_track () {
	var unit_id =  $("#units").val(),
		sess = wialon.core.Session.getInstance(), // get instance of current Session	
		renderer = sess.getRenderer(),
		cur_day = new Date(),
		from = Math.round(new Date(cur_day.getFullYear(), cur_day.getMonth(), cur_day.getDate()) / 1000), // get begin time - beginning of day
		to = from + 3600 * 24 - 1, // end of day in seconds
		unit = sess.getItem(unit_id), // get unit by id
		color = $("#color").val() || "ffffff"; // track color

		if (!unit) return; // exit if no unit

		// check the existence info in table of such track 
		if (document.getElementById(unit_id))
		{
			msg("You already have this track.");
			return;
		}
      
		var pos = unit.getPosition(); // get unit position
		if(!pos) return; // exit if no position

		// callback is performed, when messages are ready and layer is formed
		callback =  qx.lang.Function.bind(function(code, layer) {
			if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			
			if (layer) { 
				var layer_bounds = layer.getBounds(); // fetch layer bounds
				if (!layer_bounds || layer_bounds.length != 4 || (!layer_bounds[0] && !layer_bounds[1] && !layer_bounds[2] && !layer_bounds[3])) // check all bounds terms
				    return;
				
				// if map existence, then add tile-layer and marker on it
				if (map) {
				   //prepare bounds object for map
				    var bounds = new L.LatLngBounds(
					L.latLng(layer_bounds[0],layer_bounds[1]),
					L.latLng(layer_bounds[2],layer_bounds[3])
				    );
				    map.fitBounds(bounds); // get center and zoom
				    // create tile-layer and specify the tile template
					if (!tile_layer)
						tile_layer = L.tileLayer(sess.getBaseUrl() + "/adfurl" + renderer.getVersion() + "/avl_render/{x}_{y}_{z}/"+ sess.getId() +".png", {zoomReverse: true, zoomOffset: -1}).addTo(map);
					else 
						tile_layer.setUrl(sess.getBaseUrl() + "/adfurl" + renderer.getVersion() + "/avl_render/{x}_{y}_{z}/"+ sess.getId() +".png");
				    // push this layer in global container
				    layers[unit_id] = layer;
				    // get icon
				    var icon = L.icon({ iconUrl: unit.getIconUrl(24) });
				    //create or get marker object and add icon in it
				    var marker = L.marker({lat: pos.y, lng: pos.x}, {icon: icon}).addTo(map);
				    
					marker.setLatLng({lat: pos.y, lng: pos.x}); // icon position on map
					marker.setIcon(icon); // set icon object in marker
					markers[unit_id] = marker;	    
				}
				// create text-string with data
				
				var time = wialon.util.DateTime.formatTime(pos.t);
				
				wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}],function(code, shoaib){
				msg(text +="<td style='border: 1px solid #f4f4f4;padding: 5px;width: 44%;'>Location of Unit :" + shoaib +"</td>" )});
				
				var text = "<tr id='" + unit_id + "'>";  
				// print message with information about selected unit and its position
				text += "<td style='border: 1px solid #f4f4f4;padding: 5px;width: 28%;' class='unit'><img src='" + unit.getIconUrl(32) + "'/> " + unit.getName() + "</td>"; 
				text += "<td style='border: 1px solid #f4f4f4;padding: 5px;width: 28%;'>Mileage :" + layer.getMileage()/(1000).toFixed(2) + " Km <br> Speed :" + pos.s + "<br> Last Message :" + time + "</td>";
				//text +="<td>Location of Unit :" + shoaib +"</td>";
				//text += "<td style='border: 2px solid #" + color + "'></td>";
				//text += "<td class='close_btn'>x</td></tr>";
				//add info in table
				//$("#tracks").html(text);
			}
			
			
			
			
			
			
	});
	// query params
	params = {
		"layerName": "route_unit_" + unit_id, // layer name
		"itemId": unit_id, // ID of unit which messages will be requested
		"timeFrom": from, //interval beginning
		"timeTo": to, // interval end
		"tripDetector": 0, //use trip detector: 0 - no, 1 - yes
		"trackColor": color, //track color in ARGB format (A - alpha channel or transparency level)
		"trackWidth": 5, // track line width in pixels
		"arrows": 0, //show course of movement arrows: 0 - no, 1 - yes
		"points": 1, // show points at places where messages were received: 0 - no, 1 - yes
		"pointColor": color, // points color
		"annotations": 0 //show annotations for points: 0 - no, 1 - yes
	};
	renderer.createMessagesLayer(params, callback);
}

function update_renderer () {
	var sess = wialon.core.Session.getInstance(),
		renderer = sess.getRenderer();
	if (tile_layer && tile_layer.setUrl)
		tile_layer.setUrl(sess.getBaseUrl() + "/adfurl" + renderer.getVersion() + "/avl_render/{x}_{y}_{z}/" + sess.getId() + ".png"); // update url-mask in tile-layer
}

/*function focus_track (evt) {
	var row = evt.target.parentNode, // get row with data by target parentNode
		unit_id = row.id; // get unit id from current row
	// get bounds for map
	if (layers && layers[unit_id])
		var bounds =  layers[unit_id].getBounds();
	if (bounds && map)
	{
		// create object with need params
		var map_bounds = new L.LatLngBounds(
			L.latLng(bounds[0],bounds[1]),
			L.latLng(bounds[2],bounds[3])
		);
		// set view in geting bounds
		map.fitBounds(map_bounds); // get center and zoom
	}
}*/

/*function delete_track (evt) {
	var row = evt.target.parentNode, // get row with data by target parentNode
		unit_id = row.id, // get unit id from current row
		sess = wialon.core.Session.getInstance(),
		renderer = sess.getRenderer();
	if (layers && layers[unit_id])
	{
		// delete layer from renderer
		renderer.removeLayer(layers[unit_id], function(code) { 
			if (code) 
				msg(wialon.core.Errors.getErrorText(code)); // exit if error code
			else 
				msg("Track removed."); // else send message, then ok
		});
		delete layers[unit_id]; // delete layer from container
	}
	// move marker behind bounds
	if (map)
		map.removeLayer(markers[unit_id]);
	delete markers[unit_id];
	// remove row from info table
	$(row).remove();
}*/

function init_map() {
    // create a map in the "map" div, set the view to a given place and zoom
    //map = L.map('map').setView([53.9, 27.55], 10);
    map = L.map('map').setView([23.81, 90.41], 7);
	var sess = wialon.core.Session.getInstance(); // get instance of current Session	
    // add WebGIS tile layer
	L.tileLayer(sess.getBaseGisUrl("render") + "/gis_render/{x}_{y}_{z}/" + sess.getCurrUser().getId() + "/tile.png", {
		zoomReverse: true, 
		zoomOffset: -1
	}).addTo(map);
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
            init_map();
            init(); // when login suceed then run init() function
	});
})

</script>
</body>
</html>

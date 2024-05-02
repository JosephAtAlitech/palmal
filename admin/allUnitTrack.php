<?php include 'includes/session.php'; ?>
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
        <a href="allUnitTrack.php"> <a href="allUnitTrack.php" style="margin: 8px;font-size: 15px;"> <i class="fa fa-refresh"></i> Refresh</a>
		<i class="fa fa-dashboard"></i> Home </a></li><li class="active"> Live Tracking</li>
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
					
					<div class="col-md-12"><div id="units12"></div>
					<div id="units645"></div>
						<table id='units' class="table table-bordered">
								<tr style="background-color: #100777;color: white;border: 2px solid #100777;">
									<th>#</th>
									<th>Icon</th>
									<th>Unit Name</th>
									<th>Last Message</th>
									<th>Speed</th>
									<th>Current Location</th>
								</tr>
						</table>
					
						<!--<table id='units' class="table table-bordered">
							<tr style="background-color: #100777;color: white;border: 2px solid #100777;">
								<th>#</th>
								<th>UnitId</th>
								<th>Unit Name</th>
								<th>Last Message</th>
								<th>Speed (Km/h)</th>
								<th>Location</th>
							</tr>
						</table>-->
						
						<div id="units12"></div>
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
	// Print message to log
	function msg(text) { $("#log").prepend(text + "<br/>"); }

	function init() { // Execute after login succeed
		var sess = wialon.core.Session.getInstance(); // get instance of current Session
		// flags to specify what kind of data should be returned
		var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;

		sess.loadLibrary("itemIcon"); // load Icon Library	
		sess.updateDataFlags( // load items to current session
		[{type: "type", data: "avl_unit", flags: flags, mode: 0}], 
			
			
			
			function (code) { // updateDataFlags callback
				
				if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
				
				// get loaded 'avl_unit's items  
				var units = sess.getItems("avl_unit");
				if (!units || !units.length){ msg("Units not found"); return; } 
				
				
				//var cart_div = document.getElementById("units12345");
				
				// construct table data using found units
				//$("#units").val("<table><tr><th>ID</th><th>Location</th></tr>");
				var sn_count = 1;
				for (var i = 0; i< units.length; i++){ 
					var u = units[i], 
						u_id = u.getId(), // id of current unit
						row = ""; // html-string of any row in table
					sn_count++;
					var unit12 = wialon.core.Session.getInstance().getItem(u_id); // get unit by id
					if(!unit12){ msg("Unit not found");return; } // exit if unit not found
					var pos = unit12.getPosition(); // get unit position
					var time = wialon.util.DateTime.formatTime(pos.t);
					var location = ([pos.x,pos.y]);
					var coordsc = [{lat:pos.y, lon:pos.x}];
					var getName = u.getName();
					//alert(getName);
					// begin row html-string
					setTimeout('getSelectedUnitInfo('+u.getId()+','+i+')',800);
					//setInterval('UpdategetSelectedUnitInfo('+u.getId()+')',1000*30);
					// setInterval('resetLivevehiclemoment()',(1000*30));
					$("#units").append('</tr>');
					/*row += "<tr><td>"+ i+"</td>"; 
					row += "<td>"+ u.getId()+"</td>"; 
					row += "<td><img class='icon' src='" + u.getIconUrl(16) + "' alt='icon'/>  " + u.getName() + "</td>";
					row += "<td>"+ time +"</td>";
					row += "<td>"+ pos.s+" (Km/h)</td>";
					row += "<td id='row_"+i+"'>";
					
					//alert(myvarible);
					row +="</td>";	
					row += "</tr>";*/
					
					//$("#units").append(row); // append formating row
					//maxi++;
					
				}
				
			});
			
		}
		function getSelectedUnitInfo(unitid,sn_count){ // print information about selected Unit
			
			var val = unitid;//$("#units").val(); // get selected unit id
			if(!val) return; // exit if no unit selected
			
			var unit = wialon.core.Session.getInstance().getItem(val); // get unit by id
			if(!unit){ msg("Unit not found");return; } // exit if unit not found
			
				var pos = unit.getPosition(); // get unit position
				var time = wialon.util.DateTime.formatTime(pos.t);
				var location = ([pos.x,pos.y]);
				
				var icon = unit.getIconUrl(22);
				var getName = unit.getName();
				
				
				
				address='';
				wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}], function(code, address){ 
					if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
					updateIdleTime(icon,getName, pos.s,  pos.t,address,sn_count);
				});
		}
		var ind = 1;
		function updateIdleTime(icon,getName,speed,lastmessagetime,address,sn_count)
		{
			//time=time.replace('-','');
			//alert(lastmessagetime);
			var curdate = new Date();
			
			var lastmessagetimeDateC = new Date(null);
			lastmessagetimeDateC.setTime(lastmessagetime*1000);
			var lastmessagetimeDate = lastmessagetimeDateC.toLocaleString();
			
			
			
			
			$("#units").append("<tr><td>"+ind+"</td><td><img class='icon' src='" + icon + "' alt='icon'/></td><td>" + getName+"</td><td>"+lastmessagetimeDate+"</td><td>"+speed+" Km/h</td><td>"+address+"</td></tr>");
			ind = ind + 1;
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
				msg("<div id='loader'></div>"); 
				
				init(); // when login suceed then run init() function
		});
	})
	
	setTimeout(function() {
    $('#loader').fadeOut('fast');
	}, 2500); // <-- time in milliseconds
</script>
</body>
</html>
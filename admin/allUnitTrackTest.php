<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; include('wialon.php'); $wialon_api = new Wialon();?>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
	
<body class="hold-transition skin-blue sidebar-mini">
<style>  #units tr td, #units { 
  border: 1px solid #c6c6c6; 
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
					
					<div class="col-md-12"><div id="units12"></div>
					<div id="units12345"></div>
						<table id='units' class="table table-bordered">
							<tr style="background-color: #100777;color: white;border: 2px solid #100777;">
								<th>#</th>
								<th>UnitId</th>
								<th>Unit Name</th>
								<th>Last Message</th>
								<th>Speed (Km/h)</th>
								<th>Location</th>
							</tr>
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
				for (var i = 0; i< units.length; i++){ 
					var u = units[i], 
						u_id = u.getId(), // id of current unit
						row = ""; // html-string of any row in table
					
					var unit12 = wialon.core.Session.getInstance().getItem(u_id); // get unit by id
					if(!unit12){ msg("Unit not found");return; } // exit if unit not found
					var pos = unit12.getPosition(); // get unit position
					var time = wialon.util.DateTime.formatTime(pos.t);
					var location = ([pos.x,pos.y]);
					
					wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}], function (code,Address){
						Address;
						//alert(Address);
					});
					//wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}], function (code,Address){
						//$("#units12").append("<ul><li>"+Address+"</li>");
					//});
					// begin row html-string
					row += "<tr><td>"+ i+"</td>"; 
					row += "<td>"+ u.getId()+"</td>"; 
					row += "<td><img class='icon' src='" + u.getIconUrl(16) + "' alt='icon'/>  " + u.getName() + "</td>";
					row += "<td>"+ time +"</td>";
					row += "<td>"+ pos.s+" (Km/h)</td>";
					row += "<td>"+
					wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}], function (code,Address){
						return Address.next();
					
					+"</td>"});	
					row += "</tr>";
					$("#units").append(row); // append formating row
						
					
				}
			});
	
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
				msg("Logged successfully"); 
				//msg("Lodding......"); 
				init(); // when login suceed then run init() function
		});
	})
</script>
</body>
</html>

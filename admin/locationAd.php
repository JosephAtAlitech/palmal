
	<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
	
<body class="hold-transition skin-blue sidebar-mini">
<style>  #units tr td, #units { 
  border: 1px solid #c6c6c6; 
} 

</style>
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
		
	  <link rel="stylesheet" href="buttons.dataTables.min.css"/>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
           
            <div class="box-body">
				<div class="form-group">
					
					<div class="col-md-12">
					<table class="table table-bordered" id="units12345"></table>
						
						
						<div id="log"></div>
					</div>
				</div>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>

</div>
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
					
					
					wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}], function (code,Address){
						
						$("#units12345").append("<tr><td>"+Address+"</td>");
					});
						
				  
					
					
				}
			});
	
		}
	// execute when DOM ready
	$(document).ready(function () {
		
		wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
		// For more info about how to generate token check
		// http://sdk.wialon.com/playground/demo/app_auth_token
		wialon.core.Session.getInstance().loginToken("34c9a4c19198c154e81d591d4c15fc5cCE76030E6126726DA8D45EAE88E93FD4872B018B", "", // try to login
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

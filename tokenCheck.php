<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>How to get token</title>
	<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
</head>
<style>
	#token {
	font-weight: bolder;
}
</style>
<body>
    <!-- Call getToken() onclick -->
	<input id="login" type="button" value="Click to open login page" onclick="getToken()"/>
    <!-- Print token here-->
    Your token: <span id="token"></span>
    <br /><br />
    <input id="logout" type="button" value="Click to logout" disabled onclick="logout()"/>
</body>
</html>
<script>
// Wialon site dns
var dns = "https://hosting.wialon.com";

// Main function
function getToken() {
    // construct login page URL
	var url = dns + "/login.html"; // your site DNS + "/login.html"
	url += "?client_id=" + "App";	// your application name
    url += "&access_type=" + 0x100;	// access level, 0x100 = "Online tracking only"
    url += "&activation_time=" + 0;	// activation time, 0 = immediately; you can pass any UNIX time value
    url += "&duration=" + 8640000;	// duration, 8640000 = 100 days in seconds
    url += "&flags=" + 0x1;			// options, 0x1 = add username in response
    
    url += "&redirect_uri=" + dns + "/post_token.html"; // if login succeed - redirect to this page

    // listen message with token from login page window
    window.addEventListener("message", tokenRecieved);
    
    // finally, open login page in new window
    window.open(url, "_blank", "width=760, height=500, top=300, left=500");    
}

// Help function
function tokenRecieved(e) {
    // get message from login window
    var msg = e.data;
    if (typeof msg == "string" && msg.indexOf("access_token=") >= 0) {
        // get token
       	var token = msg.replace("access_token=", "");
        // now we can use token, e.g show it on page
        document.getElementById("token").innerHTML = token;
        document.getElementById("login").setAttribute("disabled", "");
        document.getElementById("logout").removeAttribute("disabled");
        
        // or login to wialon using our token
        wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com");
        
        wialon.core.Session.getInstance().loginToken(token, "", function(code) {
            if (code)
                return;
            var user = wialon.core.Session.getInstance().getCurrUser().getName();
            alert("Authorized as " + user);
        });
        
        // remove "message" event listener
        window.removeEventListener("message", tokenRecieved);
    }
}

function logout() {
    var sess = wialon.core.Session.getInstance();
	if (sess && sess.getId()) {
    	sess.logout(function() {
            document.getElementById("logout").setAttribute("disabled", "");
            document.getElementById("login").removeAttribute("disabled");
        });
    }
}
</script>
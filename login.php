
<!DOCTYPE html>
<html>
<head>
	<title>MyChat | Sign Up</title>
	<style type="text/css">
		@font-face{
			font-family: headFont;
			src: url(ui/fonts/Summer-Vibes-OTF.otf);
		}
		@font-face{
			font-family: myFont;
			src: url(ui/fonts/OpenSans-Regular.ttf);
		}
		#wrapper{
			max-width: 900px;
			min-height: 500px; 
			margin: auto;
			color: #fff;
			font-family: myFont;
			
		}
		
		#header{
			background-color: #485b6c;
			height: 70px;
			font-size: 40px;
			text-align: center;
			font-family: headFont;
		}
		form{
			width: 100%;
			max-width: 400px;
			background-color: white;
			margin: auto;
			padding: 10px;
			margin-top: 50px;
			color: black;
		}
		input[type=text], input[type=password], input[type=button]{
			width: 100%;
			color: gray;
			border-radius: 5px;
			border: solid thin gray;
			height: 25px;
		}
		input[type=button]{
			 background-color: #1b6879;
			 color: white;
			 cursor: pointer;
		}
		input[type=radio]{
			cursor: pointer;
		}
		input:hover{
			border: solid thin #1b6879;
		}
		#error{
			text-align: center; 
			padding: 0.5em; 
			background-color: #ecaf91; 
			color: white; 
			display: none;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<div id="header">myChat</div>
		<div id="error"></div>
		<form id="myform">
			<input type="text" name="email" id="email" placeholder="Email"><br><br>
			<input type="password" name="password" id="password" placeholder="Password"><br><br>
			
			<input type="button" id="login_button" value="Log in"><br><br>
			<div style="display: block; text-align: center;">Don't have an account? Kindly <a style="text-decoration: none;" href="signup.php"> Signup </a> here</div>
		
			<br>
		</form>

	</div>
</body>
</html>

<script>

function _(element) {
	return document.getElementById(element);
}
	var login_button = _("login_button");
login_button.addEventListener("click", collect_data);

	

function collect_data(){
	login_button.disabled = true;
	login_button.value = "Loading... Please wait...";

	var myform = _("myform");
	var inputs = myform.getElementsByTagName("INPUT");

	
	var data = {};
	for (var i = inputs.length - 1; i >= 0; i--) {
			var key = inputs[i].name;

		switch(key){
			
			case "password":
			data.password = inputs[i].value;
			break;
			case "email":
			data.email = inputs[i].value;
			break;
		}
	}

	send_data(data, "login");
}

function send_data(data, type){
	var xml = new XMLHttpRequest();

	xml.onload = function(){
		if (xml.readyState == 4 && xml.status == 200) {
			//alert(xml.responseText);
			handle_result(xml.responseText);
			login_button.disabled = false;
			login_button.value = "Log in";
		}
	}

	data.data_type = type;
	var data_string = JSON.stringify(data);
	xml.open("POST", "api.php", true);
	xml.send(data_string);
}

function handle_result(result){
	var data = JSON.parse(result);
	if (data.data_type == "info") {
		window.location = "index.php";
	}else{
		var error = _("error");
		error.innerHTML = data.message;
		error.style.display = "block";	
	}
}

 
	
</script>

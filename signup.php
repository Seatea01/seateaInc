<!DOCTYPE html>
<html>
<head>
	<title>SeateaInc | Sign Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
			font-size: 40px;
			text-align: center;
			font-family: headFont;
		}
		form{
			width: 100%;
			background-color: white;
			margin: auto;
			padding: 10px;
			margin-top: 50px;
			color: black;
		}
		input[type=text], input[type=password], input[type=button]{
			color: gray;
			border-radius: 5px;
			border: solid thin gray;
		}
		input[type=button]{
			 background-color: #1b6879;
			 color: white;
			 cursor: pointer;
		}
		input[type=radio]{
			cursor: pointer;
		}
		form #ask{ 
			text-align: center;
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
                
		@media only screen and (max-width: 600px) {
		  #wrapper {
		  }
			form{
			padding: 20px;
			margin: auto;
			}
		}
</style>
</head>
<body>
	<div id="wrapper">
		<div id="header">SeateaInc
		<div style="font-size: 19px; font-family: myFont;">Signup</div></div>
		<div id="error"></div>
		<form id="myform">
			<input class="form-control form-control-sm" type="text" name="username" id="username" placeholder="Username"><br>
			<input class="form-control form-control-sm" type="text" name="email" id="email" placeholder="Email"><br>
			<div style="padding: 5px;">
				Gender:<br>
				<input type="radio" name="gender_male" id="gender" value="Male">Male<br>
				<input type="radio" name="gender_female" id="gender" value="Female">Female
                         </div>
			<input class="form-control form-control-sm" type="password" name="password" id="password" placeholder="Password"><br>
			<input class="form-control form-control-sm" type="password" name="password2" placeholder="Retype Password"><br>
			<input type="button" id="signup_button" value="Signup"><br><br>
			<div id="ask">Already a member? Kindly <a style="text-decoration: none;" href="login.php"> Sign in </a> here</div>
		
			<br>
		</form>

	</div>
</body>
</html>

<script>

function _(element) {
	return document.getElementById(element);
}
	var signup_button = _("signup_button");
signup_button.addEventListener("click", collect_data);

	

function collect_data(){

	signup_button.disabled = true;
	signup_button.value = "Loading... Please wait...";
	var myform = _("myform");
	var inputs = myform.getElementsByTagName("INPUT");

	
	var data = {};
	for (var i = inputs.length - 1; i >= 0; i--) {
			var key = inputs[i].name;

		switch(key){
			case "username":
			data.username = inputs[i].value;
			break;
			case "password":
			data.password = inputs[i].value;
			break;
			case "password2":
			data.password2 = inputs[i].value;
			break;
			case "gender_male":
			case "gender_female":
			if (inputs[i].checked) {
				data.gender = inputs[i].value;
				};
			break;
			case "email":
			data.email = inputs[i].value;
			break;
		}
	}
//alert(JSON.stringify(data));
	send_data(data, "signup");
	
}

function send_data(data, type){
	var xml = new XMLHttpRequest();

	xml.onload = function(){
		if (xml.readyState == 4 && xml.status == 200) {
			handle_result(xml.responseText);
			//alert(xml.responseText);
			signup_button.disabled = false;
			signup_button.value = "Signup";
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

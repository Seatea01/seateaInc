<?php

include('class.php'); 

$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];

if (isset($_POST['submit'])) {
	# code...

	$DB = new Database();
	//$dbconn = $DB->connect();
	$data = $_POST;
	$result = $DB->signup($data);
	if ($result) {
		echo "Users added Sucessfully";
	}else{
		echo "Failed to add User!";
	}
}else{
	header("location: signup.php");
	die;
}	 
	//





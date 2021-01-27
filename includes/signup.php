<?php
$info = (Object)[];

$data = false;
	$data['userid'] = $DB->generate_id(20);
	$data['date'] = date("Y-m-d H:i:s");

$data['username'] = $DATA_OBJ->username;
	if (empty($DATA_OBJ->username)) {
		$Error .= "Please enter a valid username .<br>";
	}else{
		if (!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->username)) {
			$Error .= "username Can Only Contain Alphabets .<br>";
		}
		if (strlen($DATA_OBJ->username)<3) {
			$Error .= "username must be at least 3 characters long .<br>";
		}
	}

$data['email'] = $DATA_OBJ->email;
	if (empty($DATA_OBJ->email)) {
	$Error .= "Please enter a valid email <br>";
	}else{
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email)) 
		{
			$Error .= "Please enter a valid email .<br>";
		}
	}

	$data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;
	if (empty($DATA_OBJ->gender)) {
	$Error .= "Please select a gender <br>";
	}else{
		if ($DATA_OBJ->gender != 'Male' && $DATA_OBJ->gender != 'Female') {
			$Error .= "Please select a valid gender . <br>";
		}
	}

$data['password'] = $DATA_OBJ->password;
$password = $DATA_OBJ->password2;
	if (empty($DATA_OBJ->password)) {
	$Error .= "Please enter a valid password <br>";
	}else{
		if ($DATA_OBJ->password != $DATA_OBJ->password2) {
			$Error .= "Passwords do not match<br>";
		}
		if (strlen($DATA_OBJ->password)<3) {
			$Error .= "Password must be at least 3 characters long .<br>";
		}
	}
	
	if ($Error =="") {
		$query = "INSERT INTO users(userid,username,email,gender,password,date) values(:userid,:username,:email,:gender,:password,:date)";
		$result = $DB->write($query, $data);
		if ($result) {
			$info->message = "Account created successful";
		    $info->data_type = "info";
		    echo json_encode($info);
		}else{
			//echo "";
			$info->message = "Problem occured while creating your account";
		    $info->data_type = "error";
		    echo json_encode($info);
		}
	}else{
		//echo $Error;
		$info->message = $Error;
		$info->data_type = "error";
		echo json_encode($info);
	}
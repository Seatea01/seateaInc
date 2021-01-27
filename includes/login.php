<?php
$info = (Object)[];
$data = false;

$data['email'] = htmlspecialchars($DATA_OBJ->email);
//$data['password'] = $DATA_OBJ->password;

//validate info
if (empty($DATA_OBJ->email)) {
	$Error = "Please enter a valid email";
}
if (empty($DATA_OBJ->password)) {
	$Error = "Please enter a valid password";
}

if($Error == ""){
$query = "SELECT * FROM users WHERE email = :email limit 1";
		$result = $DB->read($query, $data);
		if (is_array($result)) {
			$result = $result[0];
			if ($result->password == $DATA_OBJ->password) {
				$_SESSION['userid'] = $result->userid;
				$info->message = "You're Successfully Loggedin";
				$info->data_type = "info";
				echo json_encode($info);
				}else{
					$info->message = "Wrong Password";
				$info->data_type = "error";
				echo json_encode($info);
				}
				}else{
					$info->message = "Wrong Email";
					$info->data_type = "error";
					echo json_encode($info);
				}

			}else{
				$info->message = "An error occured";
				$info->data_type = "error";
				echo json_encode($info);
			}
<?php
$info = (Object)[];
$data = false;

$data['userid'] = $_SESSION['userid'];

//echo "<pre>";
//print_r($data['userid']);
//echo "</pre>";
//die;
if($Error == ""){
$query = "SELECT * FROM users WHERE userid = :userid limit 1";
		$result = $DB->read($query, $data);
		if (is_array($result)) {
			$result = $result[0];
			$result->data_type = "user_info";
			//confirm image
			$image = ($result->gender == "Male") ? "ui/images/user_male.jpg" : "ui/images/user_female.jpg";
				if (file_exists($result->image)) {
					$image = $result->image;
				}
				$result->image = $image;
			echo json_encode($result);
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
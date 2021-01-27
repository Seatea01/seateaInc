<?php
if (isset($_SESSION['userid'])) {
	
	//$_SESSION['userid'] = NULL;
	unset($_SESSION['userid']);
}

$info->logged_in = false;
echo json_encode($info);
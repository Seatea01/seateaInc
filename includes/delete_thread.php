<?php
	$arr['userid'] = 'null';
	if (isset($DATA_OBJ->find->userid)) {
		$arr['userid'] = $DATA_OBJ->find->userid;	
	}
	
	//read from DB
	$arr['sender'] = $_SESSION['userid'];
	$arr['receiver'] = $arr['userid'];

	$sql = "SELECT * FROM messages WHERE (sender = :sender  && receiver = :receiver) || (receiver = :sender  && sender = :receiver) order by id desc";

	$result = $DB->read($sql, $arr);

	if (is_array($result)) 
	{
		foreach ($result as $row)
		{
			if ($_SESSION['userid'] == $row->sender) 
			{
				$sql = "update messages set deleted_sender = 1 WHERE id = $row->id LIMIT 1";
				$DB->write($sql, $arr);
			}

			if ($_SESSION['userid'] == $row->receiver) 
			{
				$sql = "update messages set deleted_receiver = 1 WHERE id = $row->id LIMIT 1";
				$DB->write($sql, $arr);
			}
		}
	}
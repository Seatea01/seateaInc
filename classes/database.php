<?php

class Database
{
	private $con = "";

	function __construct()
	{
		$this->con = $this->connect();
	}

	public function connect()
	{
		$string = "mysql:host= 	l0ebsc9jituxzmts.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=i63ky60fkiv1kh2w";
		try
		{
			$connection = new PDO($string, DBUSER, DBPASS);
			return $connection;

		}catch(PDOException $e)
		{
			echo $e->getMessage();
			die;
		}
		return false;
	}


	public function write($query, $data_array = [])
	{
		$con = $this->connect();
		$statement = $con->prepare($query);
		$click = $statement->execute($data_array);
		if ($click) {
			return true;
		}
		return false;
	}


	public function read($query, $data_array = [])
	{
		$con = $this->connect();
		$statement = $con->prepare($query);
		$click = $statement->execute($data_array);
		if ($click) {
			$result = $statement->fetchAll(PDO::FETCH_OBJ);
			if (is_array($result) && count($result)>0) {
				return $result;
			}
			return false;
		}
		return false;
	}

	public function get_user($userid)
	{
		$con = $this->connect();
		$arr['userid'] = $userid;
		$query = "select * from users where userid = :userid limit 1";
		$statement = $con->prepare($query);
		$click = $statement->execute($arr);
		if ($click) {
			$result = $statement->fetchAll(PDO::FETCH_OBJ);
			if (is_array($result) && count($result)>0) 
			{
				return $result[0];
			}
			return false;
		}
		return false;
	}


	public function generate_id($max)
	{
		$rand = "";
		$rand_count = rand(4,$max);
		for ($i=0; $i < $rand_count; $i++) { 
			$r = rand(0,9);
			$rand .= $r;
		}
		return $rand;
	}
}
?>

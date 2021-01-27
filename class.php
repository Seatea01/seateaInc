<?php

class Database
{
		//private $error = "";
		public $dbhost = "localhost";
		public $dbname = "test";
		public $dbpass = "";
		public $dbuser = "root";
	public function connect(){
		$dbconn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		return $dbconn;
		
		
	}
	public function save(){
		$conn = $this->connect();
		$result = mysqli_query($conn, $this->sql);
		return $result;
	}

	public function signup($data){
		$conn = $this->connect();
		$username = $data['username'];
		$password = $data['password'];
		$gender = $data['gender'];
		if (!empty($data['username']) || !empty($data['gender']) || !empty($data['password'])) {
			$sql = "insert into users values('', '$username', '$password', '$gender')";
			return $result = mysqli_query($conn, $sql);
		}else{
			$error .= "empty field found!";
		}
		return $error;
	}
}
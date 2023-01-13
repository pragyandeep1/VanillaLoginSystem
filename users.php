<?php 

	class Users{

		public $conn;
		public function __construct($db){
			$this->conn = $db;
		}

		public function auth($username, $password){
			$json = [];
			$stmt = $this->conn->prepare("SELECT id, username, fname, lname, email, password FROM users WHERE username=? AND active=1");
			$stmt->execute([$username]);
			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				if (password_verify($password, $row['password'])) {
					$json['id']			= $row['id'];
					$json['username']	= $row['username'];
					$json['fname']		= $row['fname'];
					$json['lname']		= $row['lname'];
					$json['email']		= $row['email'];
					return json_encode($json);
				}
			}
			return false;
		}
	}

?>
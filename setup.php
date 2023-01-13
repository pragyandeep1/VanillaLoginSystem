<?php 
	class Setup{
		private $conn;

		public function __construct($db){
			$this->conn = $db;
		}

		public function createTables(){
			$message = [];
			$message = '[Setup started]<br>';

			$query = "CREATE TABLE IF NOT EXISTS  users (
				id INT NOT NULL AUTO_INCREMENT,
				username VARCHAR(50) NOT NULL,
				fname VARCHAR(150) NOT NULL,
				lname VARCHAR(150) NOT NULL,
				email VARCHAR(150) NOT NULL,
				password VARCHAR(150) NOT NULL,
				active INT NOT NULL DEFAULT 0,
				PRIMARY KEY (id)
			)";

			$stmt = $this->conn->prepare($query);

			if ($stmt->execute()) {
				$message[] = 'User table is successfully created.';
				$i = 0;
				$users = [
					[
						'username'	=> 'admin',
						'fname'		=> 'Test',
						'lname'		=> 'Admin',
						'email'		=> 'admin@example.com',
						'password'	=> 'password'
					],
					[
						'username'	=> 'test',
						'fname'		=> 'Test',
						'lname'		=> 'Person',
						'email'		=> 'test@example.com',
						'password'	=> 'password'
					]
				];

				foreach ($users as $user) {
					$stmtVfy = $this->conn->prepare("SELECT * FROM users WHERE username=?");
					$stmtVfy->execute([$user['username']]);

					if ($stmtVfy->fetch()!=true) {
						$stmt = $this->conn->prepare("INSERT INTO users (username, fname, lname, email, password, active) VALUES (?,?,?,?,?,?)");
						if($stmt->execute([
							$user['username'],
							$user['fname'],
							$user['lname'],
							$user['email'],
							password_hash($user['password']),
							PASSWORD_DEFAULT),
							1
						])){
							$i++;
						}
					}
				}
				$message = 'Inserted '.$i.' rows into USERS table.';
			}
			else{
				$message = 'It failed to create Users table.';
			}

			$message = '[Setup completed]<br>';
			return $message;
		}
	}
?>
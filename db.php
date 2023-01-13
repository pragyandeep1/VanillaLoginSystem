<?php 
	
	class DB{
		private $host = 'localhost';
		private $port = 3308;
		private $username = 'root';
		private $password = '';
		private $database_name = 'sampleapi';
		public $conn;

		public function getConnection(){
			$this->conn = null;

			try{
				$this->conn = new PDO(
					"mysql:host=".$this->host.";
					port=".$this->port.";
					dbname=".$this->database_name,
					$this->username,
					$this->password
				);
			}
			catch(PDOException $e){
				echo "Database could not be connected: ".$e->getMessage();
			}
		}
 	}

?>
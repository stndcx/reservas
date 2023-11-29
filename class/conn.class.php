<?php

class Dbh{

	private $host;
	private $user;
	private $pass;
	private $dbName;
	private $pdo;

	public function __construct(){
		$this->host = DB_HOST;
		$this->user = DB_USER;
		$this->pass = DB_PASS;
		$this->dbName = DB_NAME;
		$this->pdo = $this->connect();
	}

	private function connect(){
		try{
			$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
			$pdo = new PDO($dsn, $this->user, $this->pass);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $pdo;
		} catch(PDOException $e){
			throw new Exception('Error: '.$e->getMessage());
		}
	}

	public function get_connection() {
		return $this->pdo;
	}
}

?>
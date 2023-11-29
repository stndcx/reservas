<?php

class Main extends Dbh{

	private $pdo;

	/**
	*
	* Constructor
	*
	* @param string DB_HOST
	* @param string DB_USER
	* @param string DB_PASS
	* @param string DB_NAME
	*
	*/

	public function __construct(){
		parent::__construct();
		$this->pdo = $this->get_connection();
	}


	public function reservas(){

		$sql = "SELECT * FROM lista LEFT JOIN usuarios ON usuarios.id = lista.idusuario";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;

	}

}

?>
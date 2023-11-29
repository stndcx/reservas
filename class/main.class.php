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


	public function rango($fecha, $disponible, $pdo){

		$sql = "SELECT * FROM lista LEFT JOIN usuarios ON lista.idusuario = usuarios.id WHERE lista.fecha = :fecha AND lista.asiento IN (" . implode(',', $disponible) . ")";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>
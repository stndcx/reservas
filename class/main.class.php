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

	public function rango($fecha, $disponible){

		$sql = "SELECT * FROM lista LEFT JOIN usuarios ON lista.idusuario = usuarios.id WHERE lista.fecha = :fecha AND lista.asiento IN (" . implode(',', $disponible) . ")";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public function habilitados($fecha, $disponible){

		$reservas = $this->reservas_hoy($fecha);
		$ass_res = array_column($reservas, 'asiento');
		$ass_dis = array_diff($disponible, $ass_res);

		return $ass_dis;

	}

	function reservas_hoy($fecha){

		$sql = "SELECT * FROM lista LEFT JOIN usuarios ON lista.idusuario = usuarios.id WHERE lista.fecha = :fecha";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	function nueva_reserva($idusuario, $asiento, $estado, $date){
	
		$sql = "INSERT INTO lista (idusuario, asiento, estado, fecha) VALUES (?,?,?,?)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([$idusuario, $asiento, $estado, $date]);

		return;

	}

}

?>
<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');

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

	public function login(){
		if(isset($_POST['signin'])){
			if(!empty($_POST['email']) && !empty($_POST['pass'])){
				$sql = "SELECT * FROM usuarios WHERE email=:email AND pass=:pass";
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute(array(':email'=>$_POST['email'], ':pass'=>hash('sha256', $_POST['pass'])));

				$fila = $stmt->fetch();       
				if($fila > 0){
					$_SESSION['logueado'] = "SI";
					$_SESSION['id']  = $fila['id'];
					header('location: ./?page=home');
				} else{
					echo '<div class="text-center alert alert-danger">Please check your email and password and try again.</div>';
				}
			}
		}
	}

	public function usuarios($id){
		$sql = "SELECT * FROM usuarios WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array(":id" => $id));
		$ress = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $ress;
	}

	public function calendario($disponible){

		echo '<table class="table">';
		echo "<tr><th>D&iacute;as</th><th>Lugares Disponibles</th></tr>";

		for ($i = 1; $i <= 7; $i++) {
			$fecha = date('Y-m-d', strtotime("+{$i} days"));

			echo "<tr>";
			echo '<td><a href=./?page=espacio_uno&fecha='.$fecha.'>'.$fecha.'</a></td>';

			$as_dis = $this->habilitados($fecha, $disponible);
			echo "<td>" . implode(", ", $as_dis) . "</td>";

			echo "</tr>";
		}

		echo "</table>";
	}

	public function rango($fecha, $disponible){

		$sql = "SELECT * FROM lista LEFT JOIN usuarios ON lista.idusuario = usuarios.id WHERE lista.fecha = :fecha AND lista.asiento IN (" . implode(',', $disponible) . ")";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array(":fecha" => $fecha));
		$ress = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $ress;

	}

	public function habilitados($fecha, $disponible){

		$reservas = $this->reservas_hoy($fecha);
		$ass_res = array_column($reservas, 'asiento');
		$ass_dis = array_diff($disponible, $ass_res);

		return $ass_dis;

	}

	public function reservas_hoy($fecha){

		$sql = "SELECT * FROM lista LEFT JOIN usuarios ON lista.idusuario = usuarios.id WHERE lista.fecha = :fecha";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array(":fecha" => $fecha));
		$ress = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $ress;

	}

	public function reservas($reservas){

		foreach ($reservas as $reserva) {

			echo '<div class="d-flex justify-content-between align-items-center">';
			echo '<p class="text-capitalize mb-0">'.$reserva['nombre'].'</p>';
			echo ' Asiento #'.$reserva['asiento'];
			echo '</div>';
			echo '<hr>';

		}
	}

	public function validar_reserva($id, $fecha){

		$sql = "SELECT COUNT(*) as total FROM lista WHERE idusuario = :id AND fecha = :fecha";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array(":id" => $id, ":fecha" => $fecha));

		$ress = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($ress['total'] > 0) {
			echo '<input class="btn btn-secondary me-3" value="Reservar" disabled>';
		} else {
			echo '<input class="btn btn-primary me-3" type="submit" value="Reservar">';
		}
	}

	public function nueva_reserva($idusuario, $asiento, $estado, $date){
	
		$sql = "INSERT INTO lista (idusuario, asiento, estado, fecha) VALUES (?,?,?,?)";
		$stmt = $this->pdo->prepare($sql);
		// $stmt->execute([$idusuario, $asiento, $estado, $date]);

		try {
			$stmt->execute([$idusuario, $asiento, $estado, $date]);
			echo '<script>';
			echo 'mostrarNotificacion("Reserva exitosa", "success");';
			echo '</script>';

		} catch (PDOException $e) {
			echo '<script>';
			echo 'mostrarNotificacion("Error al realizar la reserva", "error");';
			echo '</script>';
		}

		return;

	}

}

?>
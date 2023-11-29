<div class="container py-5">

<h5 class="mb-3">Reservas</h5>

<?php

function connect(){
	$host = 'localhost';
	$db = 'reservas';
	$user = 'root';
	$pass = '';

	try {
		$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	} catch (PDOException $e) {
		echo "Error de conexión: " . $e->getMessage();
		die();
	}
}

$pdo = connect();

$hoy = date('Y-m-d');
$reservasHoy = reservas_hoy($hoy, $pdo);

?>

<div class="row">
<div class="col-md-5">
<div class="shadow rounded-4 p-3">
<h5 class="mb-3">Reservas para hoy <?=$hoy;?></h5>
<?=reservas($reservasHoy);?>
</div>
</div>

<div class="col-md-7">
<div class="shadow rounded-4 p-3">
<h5>Pr&oacute;xima reserva</h5>
<?php
$disponible = range(1, 22);
calendario($disponible, $pdo);

function reservas_hoy($fecha, $pdo){

	$sql = "SELECT * FROM lista LEFT JOIN usuarios ON lista.idusuario = usuarios.id WHERE lista.fecha = :fecha";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
	$stmt->execute();

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function reservas($reservas){
	foreach ($reservas as $reserva) {
?>
<div class="d-flex justify-content-between align-items-center">
<p class="text-capitalize mb-0"><?=$reserva['nombre'];?></p>
Asiento #<?=$reserva['asiento'];?>
</div>
<hr>
<?php
	}
}

function calendario($disponible, $pdo){

	echo '<table class="table">';
	echo "<tr><th>D&iacute;as</th><th>Lugares Disponibles</th></tr>";

	for ($i = 1; $i <= 7; $i++) {
		$fecha = date('Y-m-d', strtotime("+{$i} days"));

		echo "<tr>";
		echo '<td><a href=./?page=espacio_uno&fecha='.$fecha.'>'.$fecha.'</a></td>';

		$as_dis = habilitados($fecha, $disponible, $pdo);
		echo "<td>" . implode(", ", $as_dis) . "</td>";

		echo "</tr>";
	}

	echo "</table>";
}

function habilitados($fecha, $disponible, $pdo){

	$reservas = reservas_hoy($fecha, $pdo);

	$as_res = array_column($reservas, 'asiento');
	$as_dis = array_diff($disponible, $as_res);

	return $as_dis;
}

?>

</div>
</div>
</div>

</div>
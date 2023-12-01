
<div class="container py-5">
<h5 class="mb-3">Reservas - <a href="./">Home</a></h5>

<?php

$disponible = range(1, 10);
$izquierda = array_slice($disponible, 0, 5);
$derecha = array_slice($disponible, 5);

$fecha = $_GET['fecha'];
$ass_dis = $app->habilitados($fecha, $disponible);
$reservas = $app->rango($fecha, $disponible);

?>

<div class="row">
<div class="col-md-4">
<div class="shadow rounded-4 p-3">
<h5 class="mb-3">Reservados para el d&iacute;a <?=$fecha;?></h5>

<?php

if (empty($reservas)) {
	echo '<p class="mb-0">No hay lugares reservados para esta fecha.</p>';
} else {
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

$ass_dis = $app->habilitados($fecha, $disponible);

?>
</div>
</div>

<div class="col-md-7">
<div class="shadow rounded-4 p-3">
<h3>Espacio A1</h3>
<h5 class="mb-3">Seleccione un asiento</h5>

<?php

if(isset($_POST['asiento'])){

	$idusuario = 1; // el id debe ser el del usuario logueado
	$asiento = $_POST['asiento'];
	$estado = 0;
	$date = $fecha;

	$app->nueva_reserva($idusuario, $asiento, $estado, $date);

}

?>

<form action="" method="post">

<div class="tablet">
<div class="left-chairs">
<?php
foreach ($izquierda as $asiento) {
?>
	<label class="chair" style="border-radius: 10px 0 0 10px;">
<?php
		$disabled = in_array($asiento, $ass_dis) ? '' : 'disabled';
?>
		<input type='radio' name='asiento' value='<?=$asiento;?>' <?=$disabled;?>> 
		<img src="assets/img/office-chair-left.png">
	</label>
<?php
}
?>
</div>

<div class="table-rect"></div>
<div class="right-chairs">
<?php
foreach ($derecha as $asiento) {
?>
	<label class="chair">
<?php
		$disabled = in_array($asiento, $ass_dis) ? '' : 'disabled';
?>
		<input type='radio' name='asiento' value='<?=$asiento;?>' <?=$disabled;?>>
		<img src="assets/img/office-chair-right.png">
	</label>
<?php
}
?>

</div>
</div>

<br>
<br>
<input class="btn btn-primary shadow mb-3" type='submit' value='Reservar'>
</form>

<a class="btn btn-primary" href="./?page=espacio_dos&fecha=<?=$fecha;?>">Espacio A2 para el <?=$fecha;?></a>
<a class="btn btn-primary" href="./?page=espacio_tres&fecha=<?=$fecha;?>">Espacio A3 para el <?=$fecha;?></a>

</div>
</div>
</div> <!-- end row -->
</div>

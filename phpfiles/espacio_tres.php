
<div class="container py-5">
<?php

function connect() {
    $host = 'localhost';
    $db = 'reservas';
    $usuario = 'root';
    $contrasena = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $usuario, $contrasena);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        die();
    }
}

$pdo = connect();

$disponible = range(17, 22);

$izquierda = array_slice($disponible, 0, 3);
$derecha = array_slice($disponible, 3);

$fecha = $_GET['fecha'];

$ass_dis = habilitados($fecha, $disponible, $pdo);

$reservas = rango($fecha, $disponible, $pdo);

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

function rango($fecha, $disponible, $pdo){

    $sql = "SELECT * FROM lista LEFT JOIN usuarios ON lista.idusuario = usuarios.id WHERE lista.fecha = :fecha AND lista.asiento IN (" . implode(',', $disponible) . ")";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function reservas_hoy($fecha, $pdo){

    $sql = "SELECT * FROM lista LEFT JOIN usuarios ON lista.idusuario = usuarios.id WHERE lista.fecha = :fecha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function habilitados($fecha, $disponible, $pdo)
{
     $reservas = reservas_hoy($fecha, $pdo);

    $ass_res = array_column($reservas, 'asiento');

    $ass_dis = array_diff($disponible, $ass_res);

    return $ass_dis;
}


$ass_dis = habilitados($fecha, $disponible, $pdo);

?>

</div>
</div>

<div class="col-md-7">
<div class="shadow rounded-4 p-3">
<h3>Espacio A3</h3>
<h5 class="mb-3">Seleccione un asiento</h5>

<form action="" method="post">

<div class="tablet">
<div class="left-chairs">
<?php foreach ($izquierda as $asiento) { ?>
<label class="chair" style="border-radius: 10px 0 0 10px;">
<?php
$disabled = in_array($asiento, $ass_dis) ? '' : 'disabled';
?>
<input type='radio' name='asiento' value='<?=$asiento;?>' <?=$disabled;?>> 
<img src="assets/img/office-chair-left.png">


</label>
<?php } ?>
</div>

<div class="table-rect-dt"></div>

<div class="right-chairs">

<?php foreach ($derecha as $asiento) { ?>

<label class="chair">

<?php
$disabled = in_array($asiento, $ass_dis) ? '' : 'disabled';
?>

<input type='radio' name='asiento' value='<?=$asiento;?>' <?=$disabled;?>>
<img src="assets/img/office-chair-right.png">


</label>

<?php } ?>

</div>
</div>

<br>
<br>
<input class="btn btn-primary shadow mb-3" type="submit" value="Reservar">
</form>


<a class="btn btn-primary" href="./?page=espacio_uno&fecha=<?=$fecha;?>">Volver a espacio Uno para el <?=$fecha;?></a>
<a class="btn btn-primary" href="./?page=espacio_dos&fecha=<?=$fecha;?>">Ver en espacio Dos para el <?=$fecha;?></a>

</div>
</div>
</div>
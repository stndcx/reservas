<?php

if(isset($_SESSION['logueado']) && $_SESSION['logueado'] === "SI") {

$user = $app->usuarios($_SESSION['id']);

?>

<div class="container py-5">
<h5 class="mb-3">Hola <span class="text-capitalize"><?=$user[0]['nombre'];?></span> - <a href="./?page=out">Salir</a></h5>
<h5 class="mb-3">Reservas</h5>

<?php

$hoy = date('Y-m-d');
$reservasHoy = $app->reservas_hoy($hoy);

?>

<div class="row">
<div class="col-md-5">
<div class="shadow rounded-4 p-3">
<h5 class="mb-3">Reservas para hoy <?=$hoy;?></h5>
<?=$app->reservas($reservasHoy);?>
</div>
</div>

<div class="col-md-7">
<div class="shadow rounded-4 p-3">
<h5>Pr&oacute;xima reserva</h5>
<?php

$disponible = range(1, 22);
$app->calendario($disponible);

?>


<img src="assets/img/plano.jpg" class="img-fluid">

</div>



</div>
</div>



</div>

<?php

} else {
	header('location: ./?page=login');
	exit();
}

?>
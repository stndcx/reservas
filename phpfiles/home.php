<?php

if(isset($_SESSION['logueado']) && $_SESSION['logueado'] === "SI") {

	$user = $app->usuarios($_SESSION['id']);
	require "html/nav.php";


	echo '<div class="container py-3">';
	echo '<h5 class="mb-3">Hola <span class="text-capitalize">'.$user[0]['nombre'].'</span></h5>';

	$hoy = date('Y-m-d');
	$reservasHoy = $app->reservas_hoy($hoy);

	echo '<div class="row">';
	echo '<div class="col-md-5">';
	echo '<div class="shadow rounded-4 p-3">';
	echo '<p>Reservas para hoy '.$hoy.'</p>';
	$app->reservas($reservasHoy);
	echo '</div>';
	echo '</div>';

	echo '<div class="col-md-7">';
	echo '<div class="shadow rounded-4 p-3">';
	echo '<p>Pr&oacute;xima reserva</p>';

	$disponible = range(1, 22);
	$app->calendario($disponible);

	echo '</div>';

	echo '</div>';
	echo '</div>'; // end row
	echo '</div>'; // end container

} else {
	header('location: ./?page=login');
	exit();
}

?>
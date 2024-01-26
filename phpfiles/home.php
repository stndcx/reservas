<?php

if(isset($_SESSION['logueado']) && $_SESSION['logueado'] === "SI") {

	$user = $app->usuarios($_SESSION['id']);
	require "html/nav.php";


	echo '<div class="container py-4">';

	$hoy = date('Y-m-d');
	$fecha_imp = get_date($hoy);
	$reservasHoy = $app->reservas_hoy($hoy);

	echo '<div class="row">';
	echo '<div class="col-md-5">';
	echo '<div class="shadow rounded-4 p-3">';

	echo '<table>';
	echo '<tbody>';
	echo '<tr>';
	echo '<td>';
	echo '<div style="background: url(assets/img/bg-calendar.png) no-repeat 0 0;height: 80px;position: relative;width: 70px;font-size: .875rem;line-height: 18px;">';
	echo '<span style="color: #fff;font-size: .75rem;top: 1px; font-weight: bold;position: absolute;text-align: center;width: 65px;">'.$fecha_imp['mes'].'</span>';
	echo '<span style="color: #222;font-size: 200%;top: 30px; font-weight: bold;position: absolute;text-align: center;width: 65px;">'.$fecha_imp['dia'].'</span>';
	echo '<span style="color: #222;font-size: .75rem;top: 57px; font-weight: bold;position: absolute;text-align: center;width: 65px;">'.$fecha_imp['dia_text'].'</span>';
	echo '</div>';
	echo '</td>';

	echo '<td style="width:100%">';
	echo '<div class="p-3">';
	echo '<h5 class="mb-0">Hola <span class="text-capitalize">'.$user[0]['nombre'].'</span></h5>';
	echo '<p>Panel de reservas</p>';
	echo '</div>';
	echo '</td>';
	echo '</tr>';

	echo '</tbody>';
	echo '</table>';

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
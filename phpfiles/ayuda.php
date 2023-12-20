<?php

if(isset($_SESSION['logueado']) && $_SESSION['logueado'] === "SI") {

	$user = $app->usuarios($_SESSION['id']);

	require 'html/nav.php';

	echo '<div class="container py-3">';
	echo '<div class="col-md-7">';
	echo '<img src="assets/img/plano.jpg" class="img-fluid">';
	echo '</div>';
	echo '</div>';

} else {
	header('location: ./?page=login');
	exit();
}

?>
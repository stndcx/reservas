<?php

function headerapp(){
	$html_header = "html/header.php";
	require_once($html_header);
}

function footerapp($data=""){
	$html_footer = "html/footer.php";
	require_once($html_footer);
}

function get_date($fecha) {
	$fecha_objeto = new DateTime($fecha);
	$mes = mes_es($fecha_objeto->format('n'));
	$dia = $fecha_objeto->format('d');
	$dia_text = dia_es($fecha_objeto->format('N'));
	return [
		'mes' => $mes,
		'dia' => $dia,
		'dia_text' => $dia_text,
	];
}

function mes_es($mes) {
	switch ($mes) {
		case 1: return 'ene';
		case 2: return 'feb';
		case 3: return 'mar';
		case 4: return 'abr';
		case 5: return 'may';
		case 6: return 'jun';
		case 7: return 'jul';
		case 8: return 'ago';
		case 9: return 'sep';
		case 10: return 'oct';
		case 11: return 'nov';
		case 12: return 'dic';
		default: return '';
	}
}

function dia_es($dia) {
	switch ($dia) {
		case 1: return 'lun';
		case 2: return 'mar';
		case 3: return 'mié';
		case 4: return 'jue';
		case 5: return 'vie';
		case 6: return 'sáb';
		case 7: return 'dom';
		default: return '';
	}
}

?>
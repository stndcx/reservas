<?php

function headerapp(){
	$html_header = "html/header.php";
	require_once($html_header);
}

function footerapp($data=""){
	$html_footer = "html/footer.php";
	require_once($html_footer);
}

?>
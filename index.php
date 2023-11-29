<?php

// session_start();

require 'helpers/config.php';
require 'helpers/functions.php';
require 'class/conn.class.php';
require 'class/main.class.php';

$app = new Main();

headerapp();

if(isset($_GET['page']) && $_GET['page']){
	
	$file = 'phpfiles/'.$_GET['page'].'.php';
	if(file_exists($file)){
		include 'phpfiles/'.$_GET['page'].'.php';
	} else{
		include 'phpfiles/error.php';
	}
} else{
	include 'phpfiles/home.php';
}


footerapp();

?>
<?php

if($_SERVER['SERVER_NAME'] == 'localhost'){
	define("DB_HOST", 'localhost');
	define("DB_USER", 'root');
	define("DB_PASS", '');
	define("DB_NAME", 'reservas');
} else{
	define("DB_HOST", "");
	define("DB_USER", "");
	define("DB_PASS", "");
	define("DB_NAME", "");
}

// Decimal and thousand delimiters Ex. 24.1989,00
define("SPD", ".");
define("SPM", ",");
define("SMONEY", "$");

?>
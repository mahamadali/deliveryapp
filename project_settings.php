<?php
	// This file is used for settings the project

	/* Project related settings */
	define("BASE_PATH", dirname(__FILE__));
	define("SITE_URL", 'index.php');
	define("HOME_URL", 'http://localhost/deliveryboys/');
	define("SITE_TITLE", "A2Z Delivery");
	define('ORDER_NUMBER_PREFIX','ORDA2Z_');

	/* Database related settings */
	define("HOST", 'localhost');
	define("USERNAME", 'root');
	define("PASSWORD", '');
	define("DATABASE", 'deliveryboys');

	/* Security level settings */
	define('APP_SECRET_HASH','deliveryboys');

	/* Backend table listing settings */
	define('RECORDS_PER_PAGE','10');
	define('APP_LOGO_ALLOWED_EXTENSIONS','jpg,jpeg,gif,bmp,png');

	define('MAP_API_KEY','AIzaSyA7nBjT-cjlh-B_n-4ClAsgfJLF6v7InFA');

	header('Access-Control-Allow-Origin: *');
?>

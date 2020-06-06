<?php 
	ob_start();
	session_start();
	date_default_timezone_set('Asia/Kathmandu');

	if ($_SERVER['SERVER_ADDR'] =='127.0.0.1' || $_SERVER['SERVER_ADDR'] =='::1') {
		define('ENVIRONMENT', 'DEVELOPMENT');
	}else{
		define('ENVIRONMENT', 'PRODUCTION');
	}

	if (ENVIRONMENT=='DEVELOPMENT') {
		error_reporting(E_ALL);
		define('DB_HOST', 'localhost');
		define('DB_NAME', 'magazine');
		define('DB_USER', 'root');
		define('DB_PASS', '');
		define('SITE_URL', 'http://magazine.com/');
	}else{
		error_reporting(E_ALL);
		define('DB_HOST', '	fdb25.awardspace.net');
		define('DB_NAME', '3460660__magazine');
		define('DB_USER', 'admin');
		define('DB_PASS', 'wT1t},bd62RF@fA[');
		define('SITE_URL', 'https://sahasprajapati.000webhostapp.com/');
	
	ini_set("display_errors", 1);	
	}

	define('ERROR_PATH', $_SERVER['DOCUMENT_ROOT'].'error/');
	define('CLASS_PATH', $_SERVER['DOCUMENT_ROOT'].'database/class/');
	define('CONFIG_PATH', $_SERVER['DOCUMENT_ROOT'].'config/');
	define('ADMIN_PATH', $_SERVER['DOCUMENT_ROOT'].'admin/');

	define('ALLOWED_EXTENSION', ['jpg','png','jpeg','tif']);


	define('UPLOAD_URL',SITE_URL."upload/");
	
?>
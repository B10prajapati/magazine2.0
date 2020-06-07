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
		define('DB_HOST', 'sql303.epizy.com');
		define('DB_NAME', 'epiz_25947121_magazine');
		define('DB_USER', 'epiz_25947121');
		define('DB_PASS', 'VYoJkEwARyu2WI');
		define('SITE_URL', 'http://b10prajapati.epizy.com/');

        
        ini_set('display_errors', 'On');
        ini_set('html_errors', 'On');
	}

	define('ERROR_PATH', $_SERVER['DOCUMENT_ROOT'].'/error/');
	define('CLASS_PATH', $_SERVER['DOCUMENT_ROOT'].'/database/class/');
	define('CONFIG_PATH', $_SERVER['DOCUMENT_ROOT'].'/config/');
	define('ADMIN_PATH', $_SERVER['DOCUMENT_ROOT'].'/admin/');

	define('ALLOWED_EXTENSION', ['jpg','png','jpeg','tif']);


	define('UPLOAD_URL',SITE_URL."/upload/");
	
?>
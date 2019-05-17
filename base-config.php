<?php 
/*
 * Basic Configurations
 * Author Viggie <viggie@viggie.com>
 * 
 */

// Basic Config
define('MM', 'Matrimony');
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__.DS);
define('SITE', BASE_PATH.'public'.DS);
define('CLASSES', BASE_PATH.'classes'.DS);
define('CONTROLLER', BASE_PATH.'mvc/Controllers'.DS);
define('MODEL', BASE_PATH.'mvc/Models'.DS);
define('VIEW', BASE_PATH.'mvc/Views'.DS);

// Domain and protocol
define('DOMAIN', $_SERVER['HTTP_HOST']);
if (!empty($_SERVER['HTTPS'])) {
	define('PROTOCOL', 'https://');
} else {
	define('PROTOCOL', 'http://');
}

// Base URL
$base = '';
if (!empty($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['SCRIPT_NAME']) && empty($base)) {
	$base = str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_NAME']);
	$base = dirname($base);
} elseif (empty($base)) {
	$base = empty( $_SERVER['SCRIPT_NAME'] ) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	$base = dirname($base);
}
if (strpos($_SERVER['REQUEST_URI'], $base)!==0) {
	$base = '/';
} elseif ($base!=DS) {
	$base = trim($base, '/');
	$base = '/'.$base.'/';
} else {
	$base = '/';  // Workaround for Windows Servers
}
//define('BASE_URL', $base);

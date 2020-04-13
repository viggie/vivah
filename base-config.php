<?php 
/*
 * Basic Configurations
 * Author Viggie <viggie@viggie.com>
 * 
 * Site specific settings are in site-config.php. 
 * Normally settings in this file are not needed to be changed
 * unless you are renaming / changing folders within the app.
 * 
 */

// Basic Config
define('MM', 'Matrimony');
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__.DS);
define('SITE', BASE_PATH.'public'.DS);
define('API', BASE_PATH.'api'.DS);
define('CONTROLLER', BASE_PATH.'api/controllers'.DS);
define('MODEL', BASE_PATH.'api/models'.DS);
define('VIEW', BASE_PATH.'views'.DS);

// Build Base URL
$protocol = (!empty($_SERVER['HTTPS'])) ? 'https://' : 'http://';
define('BASE_URL', $protocol.$_SERVER['HTTP_HOST']);

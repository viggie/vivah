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
define('CLASSES', BASE_PATH.'classes'.DS);
define('CONTROLLER', BASE_PATH.'mvc/Controllers'.DS);
define('MODEL', BASE_PATH.'mvc/Models'.DS);
define('VIEW', BASE_PATH.'mvc/Views'.DS);

// Build Base URL
$protocol = (!empty($_SERVER['HTTPS'])) ? 'https://' : 'http://';
define('BASE_URL', $protocol.$_SERVER['HTTP_HOST']);

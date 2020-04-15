<?php //defined('MM') or die('go to Matrimony');
/*
 * DB Configurations
 * Author Viggie <viggie@viggie.com>
 * 
 * Change your Site Name & Slogan here.
 */
// include base config
include('base-config.php');

// Site Meta
define('SITENAME', 'Matrimony Site');
define('SLOGAN', 'Matrimony website for South India');
define('KEYWORDS', 'matrimony, match making, bride, groom, arranged marriage');
define('DESCRIPTION', 'Matrimony website specifically designed for South Indian marriages with religious & community based classifications.');

// Advanced settings
define('ADMIN_URL', 'admin');  // change the admin url to obscure eg: adm123 or xyz123

// Edit the database access details as needed.
define('DB_NAME', 'vhosts_vivah');
define('DB_USER', 'viggie');
define('DB_PASS', 'vi');
define('DB_HOST', 'localhost');

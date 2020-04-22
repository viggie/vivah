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
define('SITENAME', 'Vivah - Matrimony');
define('SLOGAN', 'Matrimony website for South India');
define('KEYWORDS', 'matrimony, match making, bride, groom, arranged marriage');
define('DESCRIPTION', 'Matrimony website specifically designed for South Indian marriages with religious & community based classifications.');

// Advanced settings
define('ADMIN_URL', 'admin');  // change the admin url to obscure eg: adm123 or xyz123

// Edit the database access details as needed.
define('DB_NAME', 'vivah');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');

// Email details for sending email 
define('MAIL_HOST', '');        // Email sender like smtp.gmail.com
define('MAIL_USER', '');        // userid - email address
define('MAIL_PASS', '');        // email password
define('MAIL_PORT', '');        // TCP port number to connect to

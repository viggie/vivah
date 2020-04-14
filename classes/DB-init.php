<?php
/*
 * DBinit
 */
$DBname = 'vhosts_vivah';
$DBuser = 'viggie';
$DBpass = 'vi';
$DBhost = 'localhost';

$db = new mysqli($DBhost,$DBuser,$DBpass,$DBname);
// check connection
if ($db->connect_error) {
  trigger_error('Database connection failed: '  . $db->connect_error, E_USER_ERROR);
}

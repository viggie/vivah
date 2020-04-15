<?php
/*
 * DBinit
 */

$db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// check connection
if ($db->connect_error) {
  trigger_error('Database connection failed: '  . $db->connect_error, E_USER_ERROR);
}

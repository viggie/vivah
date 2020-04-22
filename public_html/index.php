<?php
/*
 * Processing all URLs for Vivah
 * 
 */
require_once '../site-config.php';
require_once CLASSES.'ViRouter.php';
require_once CLASSES.'ViSession.php';
require_once VIEW.'Theme.php';

$router = new ViggieRouter();
$router->route('/^\/?$/', function(){
	include CONTROLLER.'index.php';
 });
$router->route('/^\/([\w-]+)\/?$/', function($section){
	if(is_file(CONTROLLER."{$section}.php"))   
	   include CONTROLLER."{$section}.php";
	else if($section==ADMIN_URL) include CONTROLLER.'admin/index.php';
	else if($section=='logout') include CONTROLLER.'index.php';
	else include NOT_FOUND;
 });
$router->route('/^\/([\w-]+)\/([\w-]+)\/?$/', function($section,$task){
	if(is_file(CONTROLLER."{$section}.php"))
 	  include CONTROLLER."{$section}.php";
	else if($section==ADMIN_URL) include CONTROLLER.'admin/index.php';
	else include NOT_FOUND;
 });
$router->route('/^\/([\w-]+)\/([\w-]+)\/([\w-]+)\/?$/', function($section,$cat,$task){
	if(is_file(CONTROLLER."{$section}.php"))
 	  include CONTROLLER."{$section}.php";
	else if($section==ADMIN_URL) include CONTROLLER.'admin/index.php';
	else include NOT_FOUND;
 });
$router->route('/^\/([\w-]+)\/([\w-]+)\/([\w-]+)\/([\w-]+)\/?$/', function($section,$cat, $task, $subtask){
	if(is_file(CONTROLLER."{$section}.php"))
 	  include CONTROLLER."{$section}.php";
	else if($section==ADMIN_URL) include CONTROLLER.'admin/index.php';
	else include NOT_FOUND;
 });


$router->execute($_SERVER['REQUEST_URI']);


 // print '<p>Request URI : '.$_SERVER['REQUEST_URI'] . '</p>';


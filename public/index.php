<?php
/*
 * Processing all URLs for Matrimony
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
 	  else include NOT_FOUND;
 });
$router->route('/^\/([\w-]+)\/([\w-]+)\/?$/', function($section,$task){
	if(is_file(CONTROLLER."{$section}.php"))
 	  include CONTROLLER."{$section}.php";
	else include NOT_FOUND;
 });
$router->route('/^\/([\w-]+)\/([\w-]+)\/([\w-]+)\/?$/', function($section,$cat,$task){
	if($section == 'blog') 
 	  include CONTROLLER."blog-posts/blogpost.php";
 	else if($section == 'portfolio') 
 	  include CONTROLLER."pfolio/{$cat}-{$task}.php";
	else include NOT_FOUND;
   // print "Folder Cat Page - Load {$section}/{$cat}/{$task}.php";
 });
$router->route('/^\/([\w-]+)\/([\w-]+)\/([\w-]+)\/([\w-]+)\/?$/', function($city, $region, $task, $subtask){
    print "city={$city}, region={$region}, task={$task}, subtask={$subtask}";
 });


$router->execute($_SERVER['REQUEST_URI']);


 // print '<p>Request URI : '.$_SERVER['REQUEST_URI'] . '</p>';


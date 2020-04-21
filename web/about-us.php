<?php defined('MM') or die('go to Matrimony');
/*
 * About & Static Pages
 */
include(CLASSES.'DB-init.php');
include(MODEL.'login.php');
include VIEW.'pageView.php';

// Session & Login
$session = new Vi\Session('vivah');
$session->start();
if ( ! $session->isValid(5)) {
    session_destroy();
}

$chk_login = $session->get('vivah.user');

$msg = $session->get('msg');
if($msg!='')  $session->put('msg','');

$view = new Vi\View\pageView();

if(isset($task)) {
	switch ($task) {
		case 'privacy-policy':
		$view->privacy($session);
		break;

		case 'about-us':
		default :
		$view->index($session);
	}
} else {
  $view->index($session);
}        
<?php defined('MM') or die('go to Vivah');
/*
 * Home Page for Vivah
 */
require_once(CLASSES.'DB-init.php');
include(MODEL.'profile.php');
include(MODEL.'masters.php');
include(MODEL.'login.php');
include VIEW.'indexView.php';

// Session & Login
$session = new Vi\Session('vivah');
$session->start();
if ( ! $session->isValid(5)) {
    session_destroy();
}

//Verifies login.
$user = isset($_POST["user"]) ? trim($_POST["user"]) : "";
if (!empty($user)) {
	if ($_POST['passwd']) {
		// Sanitize
		$user = filter_var($user, FILTER_SANITIZE_STRING);
		$pass = trim($_POST['passwd']);
		initLogin($user, $pass, $db, $session);
	}
}

$chk_login = $session->get('mylai.user');
if(!$chk_login) {
}

if(isset($section) && ($section=='logout')) {
    $session->forget();
    header("Location: ".BASE_URL);
}

$msg = $session->get('msg');
if($msg!='')  $session->put('msg','');


$masters = new Vi\Model\Master($db);
$view = new Vi\View\indexView();

$data = array (
  'loggedin' => $chk_login,
  'session' => $session,
  'msg'		 => $msg,
  'subsect' => $masters->getSubsectList()
);
$view->index($data);

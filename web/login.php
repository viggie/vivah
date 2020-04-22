<?php defined('MM') or die('go to Matrimony');
/*
 * Home Page
 */
include(CLASSES.'DB-init.php');
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

$chk_login = $session->get('vivah.user');
if($chk_login && ($section=='logout')) {
    $session->forget();
}

$chk_login = $session->get('vivah.user');
if($chk_login) {
    $status = $session->get('user.status');
    if($status=='N') {
        // First login
        $session->put("msg", "<b>Welcome!</b> Please change your password.");
        header("Location: ".BASE_URL."/change-password");
    } else {
        header("Location: ".BASE_URL."/profile");
    }
}

$msg = $session->get('msg');
if($msg!='')  $session->put('msg','');


$view = new Vi\View\indexView();

$data = array (
  'loggedin' => $chk_login,
  'session' => $session,
  'msg'		 => $msg
);
$view->login($data);


<?php defined('MM') or die('go to Matrimony');
/*
 * About & Static Pages
 */
include(CLASSES.'DB-init.php');
include(MODEL.'login.php');
include VIEW.'contactView.php';

// Session & Login
$session = new Vi\Session('vivah');
$session->start();
if ( ! $session->isValid(5)) {
    session_destroy();
}

$chk_login = $session->get('vivah.user');

$msg = $session->get('msg');
if($msg!='')  $session->put('msg','');

if ($chk_login) {
    $name = $session->get('display.name');
    $email = $session->get('user.email');
} else {
    $name = $email = '';
}



$view = new Vi\View\contactView();

if(isset($task)) {
	switch ($task) {

        case 'send':
        // Received form values
        if($name == '') $name = trim($db->real_escape_string($_POST['yrname']));
        if($email == '') $email = trim($db->real_escape_string($_POST['yremail']));

		$data = array (
			'name'   =>  $name,
			'email'	 =>  $email,
			'subject'  => trim($db->real_escape_string($_POST['yrsub'])) ,
			'yrmsg'    => trim($db->real_escape_string($_POST['yrmsg'])) 
		);
		$emailcheck = filter_var($data['email'], FILTER_VALIDATE_EMAIL);

		if (empty($data['name']) || ($emailcheck==false)) {
			$session->put('msg','Form values are incorrect.  Please try again.');
		} else {
            $view->create($data);
            $session->put('msg','Message received.  We will cntact soon!');
        }
        header("Location: ".BASE_URL."/contact");
		break;


		default :
		$data = array (
			'loggedin' => $chk_login,
			'session' => $session
		);
		$view->index($data,$msg);
	}
} else {
	$data = array (
		'loggedin' => $chk_login,
		'session' => $session,
        'name' => $name,
        'email' => $email
	);
  $view->index($data,$msg);
}

$db->close();

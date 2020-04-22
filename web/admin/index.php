<?php defined('MM') or die('go to Matrimony');
/*
 * Admin Home Page for Matrimony
 */
include(CLASSES.'DB-init.php');
include(MODEL.'admin.php');

// Session & Login
$session = new Vi\Session('vivahadmin');
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
        $res = initAdmin($user, $pass, $db, $session);
        print $res;
	}
} 

$chk_login = $session->get('areyou.admin');
if(!$chk_login) {
	include VIEW.'admin/loginView.php';
	exit;
}

if(isset($task) && ($task=='logout')) {
    $session->forget();
    header("Location: ". BASE_URL . '/' .ADMIN_URL);
}


// Models
include(MODEL.'profile.php');
include(MODEL.'masters.php');
include(MODEL.'user.php');
// Views
require VIEW.'admin/indexView.php';

$profile = new Vi\Model\Profile($db,'');
$userpay = new Vi\Model\UserPay($db);
$view = new Vi\View\Admin\indexView($session);

$msg = $session->get('msg');
if($msg!='')  $session->put('msg','');

if (isset($task)) {
	switch($task) {
		case 'edit-profile' :
		if(isset($_POST['id'])) {
			$id = trim($db->real_escape_string($_POST['id']));
		} else {
			$session->put('msg','Incorrect ID to Edit Profile');
			header("Location: ".BASE_URL . '/' . ADMIN_URL.'/profiles');
		}
		$masters = new Vi\Model\Master($db);
		include(CONTROLLER.'admin/editprofile.php');
		break;

		case 'view-profile' :
		if(isset($_POST['id'])) {
			$id = trim($db->real_escape_string($_POST['id']));
		} else {
			$session->put('msg','Incorrect ID to View Profile');
			header("Location: ".BASE_URL. '/' .ADMIN_URL.'/profiles');
		}
		$data = array(
			'session'  => $session,
			'msg'	   => $msg,
			'profile' => $profile->get($id)
		);
		$view->viewProfile($data);
		break;

		case 'change-status' :
		if(isset($_POST['id'])) {
			$id = trim($db->real_escape_string($_POST['id']));
			$st = trim($db->real_escape_string($_POST['status']));
		} else {
			$session->put('msg','Incorrect ID to Change Status');
			header("Location: ".BASE_URL . '/' . ADMIN_URL.'/profiles');
		}
		$stnam['P'] = 'pending';
		$stnam['A'] = 'reActivate';
		$stnam['S'] = 'suspend';
		$stnam['D'] = 'delete';
		$cv = $stnam[$st];

		$changed = $profile->$cv($id);
		if($changed) $session->put('msg','Status Changed Successfully');
		header("Location: ".BASE_URL . '/' . ADMIN_URL.'/profiles');   
		break;

		case 'profiles' :
		$data = array(
			'session'  => $session,
			'msg'	   => $msg,
			'profiles' => $profile->getAll()
		);
		$view->profiles($data);
		break;

		default :
		$data = array (
			'session' => $session,
			'msg'	  => $msg,
			'counts'  => $profile->getCounts(),
			'paid_users' => $userpay->getPlanwiseUserCount()
		);
		$view->index($data);		
	}

} else {
	$data = array (
		'session' => $session,
		'msg'	   => $msg,
		'counts'  => $profile->getCounts(),
		'paid_users' => $userpay->getPlanwiseUserCount()
	);
	$view->index($data);
}


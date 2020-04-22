<?php defined('MM') or die('go to Matrimony');
/*
 * Change Password
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

$chk_login = $session->get('vivah.user');
if($chk_login) {
    $uid = $session->get('user.id');
    $status = $session->get('user.status');
} else {
    $uid = '';
    if (!isset($task)) header("Location: ".BASE_URL);
}


// Change Password
$oldpwd = isset($_POST["oldpasswd"]) ? trim($_POST["oldpasswd"]) : "";
if (!empty($oldpwd)) {
    $oldpwd = trim($db->real_escape_string($oldpwd));

    $newpwd  = trim($db->real_escape_string($_POST['passwd1']));
    $newpwd2 = trim($db->real_escape_string($_POST['passwd2']));
	if ($newpwd == $newpwd2) {
        // bcrypt
        $passwd = password_hash($newpwd, PASSWORD_BCRYPT, array("cost" => 10));
        $change = changePwd($uid,$passwd,$db,$oldpwd);
        if($change) {
            $session->put("msg", "<b>Password successfully changed!</b>");
            if($status=='N') {
                // First login
                header("Location: ".BASE_URL."/edit-profile");
            } else {
                header("Location: ".BASE_URL."/profile");
            }
        
        } else {
            $session->put("msg", "<b>Error!</b>, Old Password mis-match. Please re-try.");
        }
	} else {
        $session->put("msg", "<b>Error!</b>, Password mis-match. Please re-try.");
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
$view->changePassword($data);

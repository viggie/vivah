<?php defined('MM') or die('go to Matrimony');
/*
 * Profile Display
 */
include(CLASSES.'DB-init.php');
include(MODEL.'profile.php');
include(MODEL.'masters.php');
include(MODEL.'login.php');
include VIEW.'profileView.php';

// Session & Login
$session = new Vi\Session('vivah');
$session->start();
if ( ! $session->isValid(5)) {
    session_destroy();
}

$chk_login = $session->get('vivah.user');
if($chk_login) {
    $uid = $session->get('user.id');
    $taskid = $uid;
} else {
    $uid = '';
    if (!isset($task)) header("Location: ".BASE_URL);
}

if (isset($task)) {
    $taskid = substr($task,1);
    $gender = strtoupper(substr($task,0,1));
}

$profile = new Vi\Model\Profile($db,$uid);
$view = new Vi\View\profileView();

$msg = $session->get('msg');
if($msg!='')  $session->put('msg','');

$data = array (
    'loggedin' => $chk_login,
    'session' => $session,
    'msg'	   => $msg,
    'profile'  => $profile->get($taskid)
);
$view->index($data);
  
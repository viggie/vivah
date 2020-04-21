<?php defined('MM') or die('go to Matrimony');
/*
 * Members Search Page
 */
include(CLASSES.'DB-init.php');
include(MODEL.'profile.php');
include(MODEL.'masters.php');
include(MODEL.'login.php');
include VIEW.'searchView.php';

// Session & Login
$session = new Vi\Session('vivah');
$session->start();
if ( ! $session->isValid(5)) {
    session_destroy();
}

$chk_login = $session->get('vivah.user');
if($chk_login) {
  //  header("Location: ".BASE_URL);
}
$msg = $session->get('msg');
if($msg!='')  $session->put('msg','');

$profile = new Vi\Model\Profile($db);
$masters = new Vi\Model\Master($db);
$view = new Vi\View\searchView();

if(isset($task)) {
	switch ($task) {
		case 'advanced':
        break;

		case 'result':
		if(!isset($_POST['gender'])) {
			header("Location: ".BASE_URL."/search");
			break;
		}
		$data = array (
			'gender'  => trim($db->real_escape_string($_POST['gender'])) ,
			'agefrom' => trim($db->real_escape_string($_POST['agefrom'])) ,
			'ageto'	  => trim($db->real_escape_string($_POST['ageto'])) ,
			'commid' => trim($db->real_escape_string($_POST['commid']))
        );
        $starlist = $masters->getStars();
        
        $res = $profile->getSearchResults($data);
		$resdata = array (
			'loggedin' => $chk_login,
			'session' => $session,
			'formdata' => $data,
            'result'   => $res,
			'community' => $masters->getCommunities()
		);

        $view->index($resdata,$msg);
        break;

		case 'by-id':
		if(!isset($_POST['profid'])) {
			header("Location: ".BASE_URL."/search");
			break;
		}
		$profid  = trim($db->real_escape_string($_POST['profid']));
		if (strlen($profid)>4) {
			$taskid = substr($profid,1);
			$gender = strtoupper(substr($profid,0,1));

			if(($gender == 'B') || ($gender == 'G')) {
				if (is_numeric($taskid)) {
					header("Location: ".BASE_URL."/profile/".$profid);
					break;
				}
			}
		}
		$session->put('msg','Profile ID '.$profid.' doesn\'t exist');
		header("Location: ".BASE_URL."/search");

        break;

		default :
		$data = array (
			'loggedin' => $chk_login,
			'session' => $session,
			'formdata' => '',
			'result'   => '',
			'community' => $masters->getCommunities()
		);
		$view->index($data,$msg);
	}
} else {
	$data = array (
		'loggedin' => $chk_login,
		'session' => $session,
		'formdata' => '',
        'result'   => '',
		'community' => $masters->getCommunities()
	);
  $view->index($data,$msg);
}

$db->close();
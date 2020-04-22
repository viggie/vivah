<?php defined('MM') or die('go to Matrimony');
/*
 * Profile Display
 */
include(CLASSES.'DB-init.php');
include(MODEL.'profile.php');
include(MODEL.'masters.php');
include(MODEL.'login.php');
include VIEW.'editprofileView.php';

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

$profile = new Vi\Model\Profile($db,$uid);
$masters = new Vi\Model\Master($db);
$view = new Vi\View\editprofileView();

$msg = $session->get('msg');
if($msg!='')  $session->put('msg','');
if($status=='P') {
    $msg .= '<h4>Please complete your Profile to find a better match.</h4>';
    //$profile->reActivate($uid);
}
$formnum = 0;

if (isset($task)) {
    switch ($task) {
        case 'photo' : 
        include ('adm_inc/editphoto.php');
        header("Location: ".BASE_URL.'/edit-profile');
        break;
    }

}

// Form submission part
if (isset($_POST['formnum'])) {
    // Check form
    $formnum = $_POST['formnum'];
    switch ($_POST['formnum']) {
        case 5:
        // Preferences
    		$preferences    = trim($db->real_escape_string($_POST['preferences']));

            $data = "preferences='$preferences' ";
            $res = $profile->edit($data, $uid);

			if($res) {
				$msg = 'Profile Preferences updated';
			} else {
				$msg = 'Unable to update Profile';
            }
            
        break;

        case 4:
        // Family
    		$father_name = trim($db->real_escape_string($_POST['father_name']));
    		$father_job = trim($db->real_escape_string($_POST['father_job']));
    		$mother_name = trim($db->real_escape_string($_POST['mother_name']));
    		$mother_job = trim($db->real_escape_string($_POST['mother_job']));

            $brothers = trim($db->real_escape_string($_POST['brothers']));
            $sisters  = trim($db->real_escape_string($_POST['sisters']));

            $data = "father_name='$father_name', father_job='$father_job', mother_name='$mother_name', mother_job='$mother_job',
            brothers='$brothers', sisters='$sisters'";
            $res = $profile->edit($data, $uid);

			if($res) {
				$msg = 'Profile Family Details updated';
			} else {
				$msg = 'Unable to update Profile';
            }
        
        break;

        case 3:
        // Personal
    		$height = trim($db->real_escape_string($_POST['height']));
	    	$weight = trim($db->real_escape_string($_POST['weight']));
    		$mother_tongue = trim($db->real_escape_string($_POST['mother_tongue']));

            $commid = trim($db->real_escape_string($_POST['commid']));
    		$religionid = trim($db->real_escape_string($_POST['religionid']));
	    	$starid  = trim($db->real_escape_string($_POST['starid']));
	    	$rashiid = trim($db->real_escape_string($_POST['rashiid']));
    		$astro_pic = trim($db->real_escape_string($_POST['astro_pic']));


            $data = "height='$height', weight='$weight', complexion='$complexion', mother_tongue='$mother_tongue',
            commid='$commid', religionid='$religionid', starid='$starid', rashiid='$rashiid' ";
            $res = $profile->edit($data, $uid);

			if($res) {
				$msg = 'Profile Personal Details updated';
			} else {
				$msg = 'Unable to update Profile';
			}
        break;

        case 2:
        // Edu
    		$eduid  = trim($db->real_escape_string($_POST['eduid']));
	    	$edu_details = trim($db->real_escape_string($_POST['edu_details']));
	    	$jobid  = trim($db->real_escape_string($_POST['jobid']));
    		$job_title   = trim($db->real_escape_string($_POST['job_title']));
   			$job_salary  = trim($db->real_escape_string($_POST['job_salary']));


            $data = "eduid='$eduid', education='$edu_details', jobid='$jobid', job_title='$job_title', job_salary='$job_salary' ";
            $res = $profile->edit($data, $uid);

			if($res) {
				$msg = 'Profile Education &amp; Job Details updated';
			} else {
				$msg = 'Unable to update Profile';
			}
            
        break;

        case 1:
        // Basic
    		$gender = trim($db->real_escape_string($_POST['gender']));
	    	$pname  = trim($db->real_escape_string($_POST['pname']));
	    	$lname  = trim($db->real_escape_string($_POST['lname']));
    		$dob    = trim($db->real_escape_string($_POST['pdob']));
   			$mstatus = trim($db->real_escape_string($_POST['mstatus']));

            $contact = trim($db->real_escape_string($_POST['contact']));
            // email not editable
    		$pphone  = trim($db->real_escape_string($_POST['pphone']));
    		$address = trim($db->real_escape_string($_POST['address']));


            $data = "gender='$gender', name='$pname', lastname='$lname', dob='$dob', statusid='$mstatus',
            contact='$contact', mobile='$pphone', address='$address' ";
            $res = $profile->edit($data, $uid);

			if($res) {
				$msg = 'Profile Basic Details updated';
			} else {
				$msg = 'Unable to update Profile';
			}
            
        break;
    }

    $status = $session->get('user.status');
    if($status=='N') {
        $profile->reActivate($uid);
        $msg .= '<br>Your profile is now Active.';
    }

}

if($msg=='') {
    
    $status = $session->get('user.status');
    if($status=='P') {
        // $profile->reActivate($uid);
        $msg = 'Please complete your Profile to get a better match.';
    }

}

$data = array (
    'loggedin' => $chk_login,
    'session'  => $session,
    'msg'	   => $msg,
    'formnum'  => $formnum,
    'edutype'  => $masters->getEduCategories(),
    'jobtype'  => $masters->getJobCategories(),
    'religion'  => $masters->getReligions(),
    'community'  => $masters->getCommunities(),
    'mstatus'  => $masters->getMaritalStatuses(),
    'stars'    => $masters->getStars(),
    'rashi'    => $masters->getRashis(),
    'profile'  => $profile->get($uid)
);
$view->index($data);
  
<?php defined('MM') or die('go to Matrimony');

$formnum = 0; $msg = '';

// Form submission part
if (isset($_POST['formnum'])) {
    // Check form
    $formnum = $_POST['formnum'];
    $uid = trim($db->real_escape_string($_POST['id']));
    switch ($_POST['formnum']) {
        case 5:
        // Preferences
    		$prefer_edu = trim($db->real_escape_string($_POST['prefer_edu']));
	    	$prefer_job  = trim($db->real_escape_string($_POST['prefer_job']));
	    	$prefer_subsect  = trim($db->real_escape_string($_POST['prefer_subsect']));
    		$preferences    = trim($db->real_escape_string($_POST['preferences']));


            $data = "prefer_edu='$prefer_edu', prefer_job='$prefer_job', prefer_subsect='$prefer_subsect', preferences='$preferences' ";
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
    		$family_status = trim($db->real_escape_string($_POST['family_status']));


            $data = "father_name='$father_name', father_job='$father_job', mother_name='$mother_name', mother_job='$mother_job',
            brothers='$brothers', sisters='$sisters', family_status='$family_status' ";
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
	    	$complexion = trim($db->real_escape_string($_POST['complexion']));
    		$mother_tongue = trim($db->real_escape_string($_POST['mother_tongue']));

            $subsectid = trim($db->real_escape_string($_POST['subsectid']));
    		$gothramid = trim($db->real_escape_string($_POST['gothramid']));
	    	$starid  = trim($db->real_escape_string($_POST['starid']));
	    	$rashiid = trim($db->real_escape_string($_POST['rashiid']));
    		$astro_pic = trim($db->real_escape_string($_POST['astro_pic']));


            $data = "height='$height', weight='$weight', complexion='$complexion', mother_tongue='$mother_tongue',
            subsectid='$subsectid', gothraid='$gothramid', starid='$starid', rashiid='$rashiid' ";
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


            $data = "eduid='$eduid', edu_details='$edu_details', jobid='$jobid', job_title='$job_title', job_salary='$job_salary' ";
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


            $data = "gender='$gender', name='$pname', lastname='$lname', dob='$dob', marriage_statusid='$mstatus',
            contact='$contact', mobile='$pphone', address='$address' ";
            $res = $profile->edit($data, $uid);

			if($res) {
				$msg =  'Profile Basic Details updated';
			} else {
				$msg = 'Unable to update Profile';
			}
            
        break;
    }
}

$data = array (
    'loggedin' => $chk_login,
    'session'  => $session,
    'msg'	   => $msg,
    'formnum'  => $formnum,
    'edutype'  => $masters->getEduTypeList(),
    'jobtype'  => $masters->getJobTypeList(),
    'gothram'  => $masters->getGothramList(),
    'subsect'  => $masters->getSubsectList(),
    'stars'    => $masters->getStarsList(),
    'rashi'    => $masters->getRashiList(),
    'profile'  => $profile->get($id)
);
$view->editProfile($data);
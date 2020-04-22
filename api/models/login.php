<?php
//namespace Models\Admin;

//initialize session
function initLogin($user, $passwd, $db, $session) { 

	//if input is complete, checks admin
	if(isset($user) && isset($passwd)) 	{
		 
		//sanitize
        $user = $db->real_escape_string($user);
        $gender = strtoupper(substr($user,0,1));
        $seekerid = substr($user,1);
		//querystring.
		$qst = "SELECT status,passwd,name,email FROM seekers WHERE id='$seekerid' AND gender='$gender'";
		if(!$res = $db->query($qst)) {
		    die('There was an error running the query [' . $db->error . ']');
		}
	   //if user is found, register some variables.
	   $num_rows = $res->num_rows;
	   if ($num_rows > 0)
	   {
		   $res->data_seek(0);
		   $row = $res->fetch_assoc();
		   if (password_verify($passwd, $row['passwd'])) {
			$session->refresh();
			$session->put("vivah.user", true);
							
			//you can register what ever you want...
			$session->put("user.id", $seekerid);
			$session->put("user.status", $row['status']);
			$session->put("display.name", $row["name"]);
			$session->put("user.email", $row['email']);
			$session->put("msg", "");
		  } else {
			$session->put("msg", "<b>Incorrect Log-in</b>, Please try again.");
		  }
														 
		} else { 
	
	      $session->put("msg", "<b>Incorrect Log-in</b>, Please try again.");
		}
		
		$res->close();
	
	} else {
	$session->put("msg", "<b>Please enter User ID and password ");
	} 
}

function changePwd($uid, $passwd, $db,$oldpwd) {
	if (($uid>0) && (strlen($passwd)>3) ) {
		// verify old password
		$qst = "SELECT passwd FROM seekers WHERE id='$uid'";
		$res = $db->query($qst);
		$num_rows = $res->num_rows;
		if ($num_rows > 0) 
		{
			$res->data_seek(0);
			$row = $res->fetch_assoc();
			if (password_verify($oldpwd, $row['passwd'])) {
				$sql = "UPDATE seekers SET passwd='$passwd' WHERE id='$uid'";
				$res1 = $db->query($sql);
				if($res1) return true;
			}
		}
 	}
	
	return false;
}


function setToken($uid,$db) {
	if ($uid>0) {
		// set token
		$ip = getIp();
		$hash = md5(uniqid(rand(), true));
		$qst = "INSERT INTO user_forgotpwd (usr_id, pwdtoken, request_from) VALUES ('$uid','$hash','$ip')";
		$res = $db->query($qst);

		if ($res) return $hash;
 	}
	
	return false;
}


// Get IP address as reliable as possible
function getIp() {
	// std way ...
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		//check for ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		// Check for the Proxy User
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}
<?php
//namespace Models\Admin;

//initialize session
function initAdmin($user, $passwd, $db, $session) { 

	//if input is complete, checks admin
	if(isset($user) && isset($passwd)) 	{
		 
		//sanitize
		$user = $db->real_escape_string($user);
		//querystring.
		$qst = "SELECT * FROM staffs WHERE user='$user'";
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
			if($row['status']=='W') {
				$session->refresh();
				$session->put("areyou.admin", true);
								
				//you can register what ever you want...
				$session->put("admin.id", $row["staffid"]);
				$session->put("display.name", $row["name"]);
				$session->put("msg", "Logged");
			} else {
				$session->put("msg", "<b>Please contact admin</b>.");
			}
		  } else {
			$session->put("msg", "<b>Incorrect Log-in</b>, Please try again.");
		  }
														 
		} else { 
	
	      $session->put("msg", "<b>Incorrect Log-in</b>, Please try again.");
		}
		
		$res->close();
	
	} else {
	$session->put("msg", "<b>Please enter User Name and password ");
	} 
}

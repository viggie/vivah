<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

defined('MM') or die('go to Matrimony');
/*
 * Register Page
 */
include(CLASSES.'DB-init.php');
include(MODEL.'profile.php');
include(MODEL.'masters.php');
include(MODEL.'login.php');
include VIEW.'registerView.php';

// Session & Login
$session = new Vi\Session('vivahM');
$session->start();
if ( ! $session->isValid(5)) {
    session_destroy();
}

$chk_login = $session->get('vivah.user');
if($chk_login) {
    header("Location: ".BASE_URL);
}
$msg = $session->get('msg');
if($msg!='')  $session->put('msg','');

$profile = new Vi\Model\Profile($db);
$masters = new Vi\Model\Master($db);
$view = new Vi\View\registerView();

if(isset($task)) {
	switch ($task) {

		case 'mainimage':
		$id        = trim($db->real_escape_string($_POST['id']));
		$original_name = $_FILES["main_img"]["name"];
		$uploadedfile = $_FILES['main_img']['tmp_name'];
		if($id>0) {
			// load image class
			include(CLASSES.'SimpleImage.php');
			$image = new \claviska\SimpleImage();
			$new_name = $id.'-'.urlencode($original_name);
			$full_path = SITE.'article_images/'.$new_name;
			$thumb_path = SITE.'article_images/thumbs/'.$new_name;
			if($original_name) {
				// Main image
				$image->fromFile($uploadedfile)
				//			->resize(960)
				//			->crop(0,0,960,540)
							->thumbnail(960,540)
							->toFile($full_path);
				// Thumbnail
				$image->fromFile($full_path)
							->thumbnail(160,90)
							->toFile($thumb_path);
				//save name to db
				$data = " main_img='$new_name' ";
				$res = $article->edit($data,$id);
				$session->put('msg', 'Main image updated');
			}
		} else {
			$session->put('msg', 'Insufficient data. Unable to add image');
		}

		$session->put('editid',$id);
		header("Location: ".BASE_URL.'/register/edit');
		break;


		case 'add':
		// New registration
		// Random password generation
		$passwd = random_password(8);
		$the_pwd = password_hash($passwd, PASSWORD_BCRYPT, array("cost" => 10));

		$data = array (
			'passwd' => $the_pwd,
			'added_by' => 'U',
			'gender' => trim($db->real_escape_string($_POST['gender'])) ,
			'name'   => trim($db->real_escape_string($_POST['pname'])) ,
			'email'	 => trim($db->real_escape_string($_POST['pemail'])) ,
			'mobile'  => trim($db->real_escape_string($_POST['pphone'])) ,
			'dob'    => trim($db->real_escape_string($_POST['pdob'])) 
		);
		$emailcheck = filter_var($data['email'], FILTER_VALIDATE_EMAIL);

		if (empty($data['name']) || ($emailcheck==false)) {
			$res = 0;
		} else {
			$res = $profile->create($data);
		}
		
		if($res>0) {
			$session->put('profid',$res);
			$mmsg = '';
			
			if(MAIL_HOST != '') {
				// send password in email
				include CLASSES.'ViMailer.php';
				$mail->isHTML(true);
				$mail->addAddress($data['email']);
				$mail->Subject = 'Welcome to '. SITENAME;
				$mail->Body    = '
				 <p>We wish you finding a great match at <b>'. SITENAME .'</b>.</p>

				 <p>Please visit <a href="'. BASE_URL .'/login">
				 '. BASE_URL .'/login</a> and enter the following 
				 login details <br>
				 Profile ID: '.$data['gender'].$res.'<br>
			 	Passwod: '.$passwd.'</p>

				 <p><b>Important!  Please complete your profile to find a better match!</b></p>

				 <p>Thanks,<br> '. SITENAME .'</p>
				';
				$mail->AltBody = 'We wish you finding a great match at '. SITENAME .'

Please visit '. BASE_URL .'login and enter the following login details 
Profile ID: '.$data['gender'].$res.'
Passwod: '.$passwd.'

Important!  Please complete your profile to find a better match!

Thanks,
'. SITENAME .'
			';

				//send the message, check for errors
				if (!$mail->send()) {
					$mmsg = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
				} else {
					$mmsg = 'Login details sent. !';
				}
		

			} else {
				// display password in screen
				$mmsg = 'Please login with the following 
				login details <br>
				Profile ID: '.$data['gender'].$res.'<br>
				Passwod: '.$passwd;
			}
		
			$session->put('msg', $mmsg );
		} else {
			$session->put('msg','Unable to create Profile. Please contact admin.');
		}
		header("Location: ".BASE_URL."/register");
		break;

		case 'update':
		// Receive & sanitize form values
		$id        = trim($db->real_escape_string($_POST['id']));
		$secid     = trim($db->real_escape_string($_POST['section']));
		//$main_img  = trim($db->real_escape_string($_POST['main_img']));
		$vibaram   = trim($db->real_escape_string($_POST['vibaram']));
		$pubdate   = trim($db->real_escape_string($_POST['pub_date']));
		$status    = '';
		if(isset($_POST['susp'])) {
			$status = ", status='S' ";
			$part_msg = 'Suspended';
		} elseif(isset($_POST['publish'])) {
			$status = ", status='P'";
			$status .=", pub_date='".$pubdate."'";
			$part_msg = 'Published';
		} elseif(isset($_POST['draft'])) {
			$status = ", status='D' ";
			$part_msg = 'saved as Draft';
		} else { $part_msg = 'Updated'; }

		// build part sql
		if($id>0) {
			$data = "secid='$secid', vibaram='$vibaram' $status";
			$res = $article->edit($data,$id);
			if($res) {
				$session->put('msg', 'Article ID: '.$id.' is '.$part_msg);
			} else {
				$session->put('msg', 'Unable to update article');
			}
		} else {
			$session->put('msg', 'Error in ID: Article not '.$part_msg);
		}
		header("Location: ".BASE_URL.'/register');
		break;

		case 'delete':
		// Receive & sanitize form values
		$id        = trim($db->real_escape_string($_POST['id']));

		// build part sql
		if($id>0) {
			$res = $article->delete($id);
			if($res>0) {
				$session->put('msg', 'Article ID: '.$id.' removed');
			} else {
				$session->put('msg', 'Unable to Remove article');
			}
		} else {
			$session->put('msg', 'Error in ID: Article not Removed');
		}
		header("Location: ".BASE_URL.'/register');
		break;

		default :
		$data = array (
			'loggedin' => $chk_login,
			'session' => $session,
			'mmsg' => $mmsg,
			'stars' => $masters->getStars()
		);
		$view->index($data,$msg);
	}
} else {
	$data = array (
		'loggedin' => $chk_login,
		'session' => $session,
		'stars' => $masters->getStars()
	);
  $view->index($data,$msg);
}

$db->close();

function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
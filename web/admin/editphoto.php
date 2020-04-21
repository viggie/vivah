<?php defined('MM') or die('go to Matrimony');


$change="";
$abc="";
$watermark = SITE."assets/images/watermark.png";
$url = BASE_URL; 

// remove photo
if (isset($_POST['rem']) && ($_POST['rem']=='del')) {
	$rem= $profile->removePhoto($id);
}

if(isset($_POST['ftype']) && ($_POST['ftype']=='upload')) {
    $id   = trim($db->real_escape_string($_POST['uid']));
    $original_name = $_FILES["photo"]["name"];
    $uploadedfile = $_FILES['photo']['tmp_name'];

  if($id>0) {
    // load image class
    include(CLASSES.'SimpleImage.php');
    $image = new \claviska\SimpleImage();
    $new_name = $id.'-'.urlencode($original_name);
    $full_path = SITE.'profile-pics/'.$new_name;
    $thumb_path = SITE.'profile-pics/thumbs/'.$new_name;
    if($original_name) {
        // Main image
        $image->fromFile($uploadedfile)
        //			->resize(960)
        //			->crop(0,0,960,540)
                    ->thumbnail(450,600)
                    ->overlay($watermark, 'bottom right')
                    ->toFile($full_path);
        // Thumbnail
        $image->fromFile($full_path)
                    ->thumbnail(100,100)
                    ->toFile($thumb_path);
        //save name to db
        $upd= $profile->addPhoto($new_name,$id);
        $session->put('msg', 'Photo updated');
    }
  } else {
    $session->put('msg', 'Insufficient data. Unable to add Photo');
  }



}


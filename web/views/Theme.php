<?php 
/*
 * Vivah Layout Theme
 * 
 * Author Viggie <viggie@viggie.com>
 * 
 */
namespace Vi\View;

class SiteView {


public function the_header($title=SLOGAN,$keyword=KEYWORDS, $desc=DESCRIPTION,$image='',$session) {
	$url = BASE_URL;
  $sitetitle = SITENAME;
  $ogimg = 'assets/images/favicon.png';
  $ogurl = $url.$_SERVER['REQUEST_URI'];

  $loggedin = $session->get('vivah.user');
  

$html = <<<END
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="$desc">
	<meta name="keyword" content="$keyword">
    <meta name="author" content="Viggie">
    <meta property="og:url" content="$ogurl">
    <meta property="og:type" content="article">
    <meta property="og:title" content="$title :: $sitetitle">
    <meta property="og:description" content="$desc">
    <meta property="og:image" content="$url/$ogimg">

    <title> $title :: $sitetitle </title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom fonts for this template -->
    <script src="https://kit.fontawesome.com/e2ad5cd9b0.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto+Slab&display=swap" rel="stylesheet"> 

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="$url/vendor/DataTables/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="$url/assets/css/matrimony.css?v=2"/>
    <link rel="shortcut icon" href="$url/assets/images/favicon32.png" type="image/png" />
	
  </head>

  <body id="page-top">
    <div id="page-preloader"><span class="spinner"></span></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="$url"><img src="$url/assets/images/vivah.png" alt="$sitetitle" class="img-fluid"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="$url/"> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="$url/about-us"> About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="$url/search"> Members</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="$url/contact"> Contact</a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
END;

if ($loggedin) {
  $html .= '
          <li class="nav-item dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle btn btn-light text-danger"><i class="fas fa-user"></i>&nbsp; MY ACCOUNT </a>
            <div class="dropdown-menu dropdown-menu-right pt-0" style="width:200px;">
                <h5 class="text-center bg-warning pt-1 pb-1"> '. ucfirst( $session->get('display.name') ) .'</h5>
                <a class="dropdown-item" href="'.$url.'/profile">Your Profile </a>
                <a class="dropdown-item" href="'.$url.'/edit-profile">Edit Profile</a>
                <a class="dropdown-item" href="'.$url.'/change-password">Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="'.$url.'/logout">Log Out</a>
            </div>

 ';
} else {
  $html .= <<<END
          <li class="nav-item dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle btn btn-light text-danger"><i class="fas fa-sign-in-alt"></i>&nbsp; LOGIN </a>
                <div class="dropdown-menu dropdown-menu-right">
  						  <h3 class="text-center">Log In</h3>
                      <form action="$url/login" method="post" class="form px-4 py-3">
                        <div class="form-group">
                          <input name="user" type="text" placeholder="Profile ID" class="form-control">
                        </div>
                        <div class="form-group">
                          <input name="passwd" type="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-danger"><i class="fas fa-sign-in-alt"></i>&nbsp; Log in</button>
                        </div>
						<a href="$url/forgot-password">Forgot Password</a><br>
						Do not have an account?
						<a href="$url/register" class="btn btn-warning btn-block text-nowrap"><i class="fas fa-user-plus"></i>&nbsp; Register New </a>
                      </form>
                </div>

END;

}

$html .= <<<END
           </li>
           </ul>


        </div>
      </div>
    </nav>

    <div class="clearfix" id="headerMargin"></div>

END;


return $html;
}

public function the_footer($addjs = '') {
  $url = BASE_URL;
  $sitename = SITENAME;
  
$html = <<<END

    <div class="clearfix"></div>

    <!-- Footer -->
    <footer>
      <div class="container-fluid bg-dark mt-2 p-2">
       <div class="container mt-3">
         <div class="row">
           <div class="col">
             <img src="assets/images/RamSita.png" alt="$sitename" class="pt-3">
            </div>
            <div class="col">
            <h3> Information </h3>
            <ul class="footer-list list-unstyled">
              <li><a href="$url/about-us">About Us</a></li>
            </ul>
           </div>
            <div class="col">
            <h3> Help & Support </h3>
            <ul class="footer-list list-unstyled">
              <li><a href="$url/contact">Contact Us</a></li>
            </ul>
           </div>
            <div class="col">
            <h3> Other Services </h3>
            <ul class="footer-list list-unstyled">
              <li><a href="#" target="blank">Link 1</a>&nbsp; <small style="font-size:70%"><i class="fas fa-external-link-alt"></i></small></li>
              <li><a href="#" target="blank">Link 2</a>&nbsp; <small style="font-size:70%"><i class="fas fa-external-link-alt"></i></small></li>
              <li><a href="#" target="blank">Link 3</a>&nbsp; <small style="font-size:70%"><i class="fas fa-external-link-alt"></i></small></li>
              <li><a href="#" target="blank">Link 4</a>&nbsp; <small style="font-size:70%"><i class="fas fa-external-link-alt"></i></small></li>
            </ul>
           </div>
        </div>
       </div>

      <div class="container mt-3">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; 2019 $sitename</span>
          </div>
          <div class="col-md-4">
            <a href="$url/about-us/privacy-policy">Privacy Policy</a>
          </div>
          <div class="col-md-4 text-right">
          <ul class="list-inline social-buttons">
          <li class="list-inline-item">
            <a href="https://twitter.com/" target="_blank">
            <i class="fab fa-twitter-square"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://www.facebook.com/" target="_blank">
              <i class="fab fa-facebook"></i>
            </a>
          </li>
          </ul>
         </div>
        </div>
      </div>
     </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="$url/vendor/DataTables/datatables.min.js"></script>
    <script src="$url/assets/js/PasswordValidatorv2.js"></script>
    <script src="$url/assets/js/matrimony.js?v=1"></script>

	$addjs
	
  </body>
</html>


END;

return $html;
}


public function regForm() {
  $url = BASE_URL;
  $mindate = date('Y-m-d',strtotime('-60years'));
  $maxdate = date('Y-m-d',strtotime('-18years'));
  $valdate = date('Y-m-d',strtotime('-21years'));
  $html = <<<END

        <form action="$url/register/add" method="post">
         <div class="form-group row">
          <label for="gender" class="col-md-2 col-form-label"> Gender </label>
          <div class="col-md-10">
          <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
            <label class="btn btn-outline-danger active">
            <input type="radio" name="gender" id="gen1" value="F" checked> Female
            </label>
            <label class="btn btn-outline-danger">
            <input type="radio" name="gender" id="gen2" value="M" > Male
            </label>
          </div>
          </div>
         </div>

         <div class="form-group row">
          <label for="pname" class="col-md-2 col-form-label"> Name </label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="pname" placeholder="Name" required> 
          </div>
         </div>

         <div class="form-group row">
          <label for="pemail" class="col-md-2 col-form-label"> E-mail </label>
          <div class="col-md-10">
            <input type="email" class="form-control" name="pemail" placeholder="E-mail" required> 
          </div>
         </div>

         <div class="form-group row">
          <label for="pphone" class="col-md-2 col-form-label"> Phone </label>
          <div class="col-md-10">
            <input type="phone" class="form-control" name="pphone" placeholder="Phone" required> 
          </div>
         </div>

         <div class="form-group row">
          <label for="pdob" class="col-md-2 col-form-label"> Date of Birth </label>
          <div class="col-md-10">
            <input type="date" class="form-control" name="pdob" min="$mindate" max="$maxdate" value="$valdate" required> 
          </div>
         </div>


        <div class="row">
        <div class="col text-right">
        <button type="submit" class="btn btn-success"> <i class="far fa-user"></i> Register </button>
        </div>
        </div>
       </form>
     


END;

  return $html;
}


public function searchForm($communities,$formdata='') {
  $url = BASE_URL;

  $gender = $commid = $from_range = $to_range = '';
  $gselect = $bselect = $fromselect = $toselect = ''; 
  $agefrom = 21; $ageto = 24;
  $lowend = 18;

  if(is_array($formdata)) {
    $gender  = $formdata['gender'];
    $agefrom = $formdata['agefrom'];
    $ageto   = $formdata['ageto'];
    $commid = $formdata['commid'];

    if($gender=='G') $gselect = 'selected';
    if($gender=='B') {
      $lowend = 21;
      $bselect = 'selected';
    } 
  }

  $community_range = $this->select_options($communities,$commid);
  for ($i=$lowend;$i<=58;$i++) {
    if($i==$agefrom) $fromselect = 'selected';
    if($i==$ageto)   $toselect = 'selected';
    $from_range .= "<option value='$i' $fromselect>$i</option>\n";
    $to_range .= "<option value='$i' $toselect>$i</option>\n";
    $fromselect = $toselect = '';
  }


  $html = <<<END

       <form action="$url/search/result" method="post" class="form-inline">
         <h4> Find Match </h4>
         <div class="form-group mb-2 ml-2">
           <label class="sr-only" for="gender">Gender</label>
           <select name="gender" class="form-control">
           <option value="G" $gselect> Girl </option>
           <option value="B" $bselect> Boy </option>
           </select>
         </div>
         <div class="form-group mb-2 ml-2">
           <label class="sr-only" for="agefrom">Age min</label>
           <select name="agefrom" class="form-control">
           '. $from_range .'
           </select>
         </div>
         <div class="form-group mb-2 ml-2">
           <label class="sr-only" for="agefrom">Age max</label>
           <select name="ageto" class="form-control">
           '. $to_range .'
           </select>
         </div>
         <div class="form-group mb-2 ml-2">
           <label class="sr-only" for="commid">Communities</label>
           <select name="commid" class="form-control">
             <option value="A"> Select All </option>
           '. $community_range .'
           </select>
         </div>
         <div class="form-group mb-2 ml-2">
           <button type="submit" class="btn btn-danger"> <i class="fas fa-search"></i> Search </button>
         </div>
       </form>
     
END;

  return $html;
}


public function print($content,$meta='',$session,$addjs='') {
  if (is_array($meta)) {
      $title = $meta['title'];
      $keyword = $meta['keyword'];
      $desc  = $meta['desc'];
      $image = $meta['img'];
  } else {
      $title = SLOGAN;
      $keyword = KEYWORDS;
      $desc  = DESCRIPTION;
      $image = '';
  }
  $themeheader = $this->the_header($title,$keyword,$desc,$image,$session);
  $themefooter = $this->the_footer($addjs);

  print $themeheader;
  print $content;
  print $themefooter;
}


public function select_options($values,$selected='') {
  $options = '';
  foreach ($values as $value) {
      $sltd = '';
      $value = array_values($value);
      if($value[0]==$selected) $sltd = " selected";
      $options .= '<option value="'.$value[0].'" '.$sltd.'>'.$value[1]."</option>\n";
  }

  return $options;
}

public function alert($msg) {
  $val = '';
  if ($msg!="") {
      $val = '<div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Note!</strong> '.$msg.'</div>';
  }

  return $val;
}

}

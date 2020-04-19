<?php 
/*
 * Layout Theme
 * 
 * Copyright 2019 Matrimony <viggie@viggie.com>
 * 
 */
namespace Vi\View\Admin;

class AdminView
{
  private $login;

  public function __construct($login) {
    $this->login = $login;
  }

  public function admin_header($title="Kalanjiam") {
    $url = BASE_URL;
    $sitetitle = SITENAME;
    $chk_login = $this->login->get('areyou.admin');
	

$html = <<<END
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Viggie">

    <title> $title :: $sitetitle </title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom fonts for this template -->
    <script src="https://kit.fontawesome.com/e2ad5cd9b0.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Slab&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="$url/vendor/DataTables/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="$url/assets/css/matrimony.css"/>
    <link rel="shortcut icon" href="$url/assets/images/favicon.png" type="image/png" />

    <link href="$url/vendor/summernote/summernote-bs4.css" rel="stylesheet">
    </head>

  <body id="page-top">
    <div id="page-preloader"><span class="spinner"></span></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="$url"><img src="$url/assets/images/mylai-matrimony.png" alt="$sitetitle" style="height:50px"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="$url/admin"> Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="$url/admin/profiles"> Profiles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="$url/admin/logout"> Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container" style="margin-top:90px">

    
END;

return $html;
}

public function admin_footer( $addjs="") {
  $adminurl = ADMIN_URL;
	$url = BASE_URL;

$html = <<<END


    </div>

    <!-- Footer -->
    <footer class="mt-4 p-3 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; 2019 MylaiMatrimony.com</span>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="$url/vendor/summernote/summernote-bs4.min.js"></script>
    <script src="$url/vendor/DataTables/datatables.min.js"></script>
    <script src="$url/assets/js/PasswordValidatorv2.js"></script>
    <script src="$url/assets/js/matrimony.js"></script>
    <script src="$url/assets/js/admin.js"></script>

	$addjs
	
  </body>
</html>


END;

return $html;
}




public function print($content,$session,$addjs='') {
  $title = "Admin";
  $url = BASE_URL;

 
  $themeheader = $this->admin_header($title);
  $themefooter = $this->admin_footer();

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


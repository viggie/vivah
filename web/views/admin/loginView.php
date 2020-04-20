<?php defined('MM') or die('go to Matrimony');
/*
 * Admin login screen - Matrimony
 */

$style="margin-top:7%";
$showmsg = '';
$msg = $session->get('msg');
if ($msg != '') {
	$showmsg  = "<div class='row justify-content-center' style='margin-top:6%'>";
	$showmsg .= "<div class='alert alert-warning col-md-4' role='alert'> ";
	$showmsg .= $msg; 
	$showmsg .= "</div>\n";
	$showmsg .= "</div>\n";
	$session->put('msg','');
	$style="margin-top:2%";
}

$url = BASE_URL;
?> 

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Viggie">

    <title> Login :: <?php echo SITENAME; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom fonts for this template -->
    <script src="https://kit.fontawesome.com/e2ad5cd9b0.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Slab&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/matrimony.css"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>/assets/images/favicon.png" type="image/png" />
  </head>

  <body id="page-top" style="background-color:#eee;">

  <?php print $showmsg; ?>

 <div class="row justify-content-center" style="<?php echo $style; ?>">
	<div class="col-md-4">
	  <h2 class="text-center bg-danger text-white mb-0 p-2">
	   <?php echo SITENAME; ?>
	  </h2>
	  <div class="card p-4">
		<h3>Log in</h3>
 		<form name="log_in" class="form mt-3" action="<?php echo BASE_URL . '/'. ADMIN_URL; ?>" method="post">
			<div class="form-group">
			 <div class="input-group">
			   <div class="input-group-prepend">
           <span class="input-group-text">
					   <i class="far fa-user"></i>
            </span>
          </div>
				<label for="User1" class="sr-only">Username</label>
				<input type="text" class="form-control" id="User1" name="user" maxlength="150" size="40" placeholder="Username" tabindex="1" required>
			 </div>
			</div>
			<div class="form-group mb-4">
			 <div class="input-group">
			   <div class="input-group-prepend">
           <span class="input-group-text">
					  <i class="fas fa-sign-in-alt"></i>
            </span>
          </div>
				<label for="Pass1" class="sr-only">Password</label>
				<input type="password" class="form-control" id="Pass1" name="passwd" maxlength="32" size="20" placeholder="Password" tabindex="2" required>
				</div>
			</div>
			<button type="submit" class="btn btn-danger btn-lg"> Log In </button>
		</form>
	  </div>
	</div>
  </div>


    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>


<?php defined('MM') or die('go to Matrimony');
/*
 * 404 PAGE NOT FOUND AT Vivah
 */

	require_once VIEW.'Theme.php';

	$view = new Vi\View\SiteView();
	$session = new Vi\Session('mylaiM');
	$session->start();
	$themeheader = $view->the_header(SLOGAN,KEYWORDS,DESCRIPTION,'',$session);
	$themefooter = $view->the_footer();


print $themeheader;

print '	<section id="oneBox" class="section">
		<div class="container">
			<div class="row">
			  <div class="col p-3">
			  <div class="card">
			  <div class="card-body">
			   <h1 class="text-center text-danger"> <i class="fas fa-exclamation-circle"></i> </h1>
			   <h2 class="bg-danger text-white p-2">Oops! Couldn\'t find it here!</h2>
			   <p class="lead"> Please click the links in this page to explore '. SITENAME .'! </p>

			   <p class="lead"> Or, please contact admin </p>
			   <h6> Thank you </h6>

';

print '		  </div>
			  </div>
			  </div>	
		   </div>
		</div>
	</section>
';



print $themefooter;

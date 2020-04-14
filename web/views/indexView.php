<?php  
/* 
 *  Site Index View
 */
namespace Vi\View;

require_once VIEW.'Theme.php';

class indexView extends siteView 
{
    private $val;

    public function index($data) {
        $loggedin  = $data['loggedin'];
        $session   = $data['session'];
        $subsectlist = $data['subsect'];
        //$starlist  = $data['starlist'];
        if ($data['msg'] != '') {
          $content = '<script type="text/javscript"> alert("'. $data['msg'] .'"); </script>';
        } else { $content = ''; }

        $search_form = $this->searchForm($subsectlist,'');

        $sliders = '
        <div id="mylaiSlider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="'.BASE_URL.'/assets/images/banner/Slide01.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
             <h3 class="slider-title">Find perfect matches in <br>your preferred choice</h3>
             <p><span style="font-size: 28px; background-color: rgb(255, 255, 255); top: 0px; left: 78.5px; padding: 0px; line-height: 42px; letter-spacing: 0.42px; color: #dc3545;">Detailed search &amp; consulting.</span></p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="'.BASE_URL.'/assets/images/banner/Slide02.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
             <h3 class="slider-title">Detailed Search &amp; Consulting </h3>
             <p><span style="font-size: 28px; background-color: rgb(255, 255, 255); top: 0px; left: 78.5px; padding: 0px; line-height: 42px; letter-spacing: 0.42px; color: #dc3545;">Search Now</span></p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="'.BASE_URL.'/assets/images/banner/Slide03.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
             <h3 class="slider-title">Upload your details <br>get requests</h3>
             <p><span style="font-size: 28px; background-color: rgb(255, 255, 255); top: 0px; left: 78.5px; padding: 0px; line-height: 42px; letter-spacing: 0.42px; color: #dc3545;">Profile </span></p>
            </div>
          </div>

        </div>
        <!--
        <a class="carousel-control-prev" href="#mylaiSlider" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#mylaiSlider" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        -->


       <div id="hoverSearch">
         <div class="bg-warning pt-2 pl-3">
         '. $search_form .'
         </div>
       </div>


       </div>';

       $login_form = '
       <form action="'. BASE_URL .'" method="POST">
       <div class="form-row align-items-center">
         <div class="col">
           <label class="sr-only" for="user">Username</label>
           <input type="text" name="user" class="form-control mb-2" id="inlineFormInputGroup" placeholder="Profile ID">
         </div>
         <div class="col">
           <label class="sr-only" for="inlineFormInput">Password</label>
           <input type="password" name="passwd" class="form-control mb-2" id="inlineFormInput" placeholder="Password">
         </div>
         <div class="col">
           <button type="submit" class="btn btn-warning mb-2"><i class="fas fa-sign-in-alt"></i> Log in</button>
         </div>
       </div>
       </form>
       ';
       

        $content .= '
        ';
        $content .= $sliders ;
        $regForm = $this->regForm();

        $content .=  '
     
    <div class="container-fluid bg-white p-3">
    <div class="container">
    <div class="row">

      <div class="col-sm order-last">
        
        <div class="card border-danger mb-3">
        <div class="card-header bg-danger text-light"> Register your Profile </div>
        <div class="card-body"> 
        '. $regForm .'
        </div>
        </div>

      </div>

      <div class="col-sm">

        <ul class="list-unstyled mt-3 pt-3">
          <li class="mb-3"><i class="fas fa-haykal text-danger pr-1" style="font-size:21px; line-height:32px;"></i> FREE Registration </li>
          <li class="mb-3"><i class="fas fa-haykal text-danger pr-1" style="font-size:21px; line-height:32px;""></i> Update profile with Photo and Horoscope </li>
          <li class="mb-3"><i class="fas fa-haykal text-danger pr-1" style="font-size:21px; line-height:32px;""></i> Browse to find suitable bride / groom. </li>
        </ul>
      
      </div>

     ';



     $content .=  '
     </div>
     </div>
     </div>';


        return $this->print($content,'',$session);
    }


    public function login($data) {
        $loggedin  = $data['loggedin'];
        $session   = $data['session'];
        $msg       = $data['msg'];
        $alert = '';
        if($msg=='') {
          $msg = $session->get('msg');
          if($msg!='')  $session->put('msg','');
        }
        if($msg!='') $alert = $this->alert($msg);

        $content =  '
     
    <div class="container-fluid bg-white p-3">
    <div class="container">
    <div class="row">

      <div class="col-6 order-last">
        '.$alert.'
        <div class="card border-danger mb-3">
        <div class="card-header bg-danger text-light"> Log In </div>
        <div class="card-body"> 
  						  <h3 class="text-center">Log In</h3>
                      <form action="'.BASE_URL.'/login" method="post" class="form px-4 py-3">
                        <div class="form-group">
                          <input name="user" type="text" placeholder="Profile ID" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <input name="passwd" type="password" placeholder="Password" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-danger"><i class="fas fa-sign-in-alt"></i>>&nbsp; Log in</button>
                        </div>
                      </form>

                      <div class="mt-3 pt-3">
						<a href="'.BASE_URL.'/forgot-password">Forgot Password</a><br><br>
						Do not have an account?
            <a href="'.BASE_URL.'/register" class="btn btn-warning btn-block text-nowrap"><i class="fas fa-user-plus"></i>&nbsp; Register New </a>
            </div>
        </div>
        </div>
              
       </div>
              
       <div class="col-3">
              
       </div>
              
    </div>
    </div>
    </div>';
              
              
    return $this->print($content,'',$session);
    }


    public function changePassword($data) {
      $loggedin  = $data['loggedin'];
      $session   = $data['session'];
      $msg       = $data['msg'];
      $skip = $alert = '';
      if($msg!='') $alert = $this->alert($msg);
      $status = $session->get('user.status');
      if($status == 'P') $skip = '<a href="'.BASE_URL.'/edit-profile" class="btn btn-light">Skip &amp; Complete Your Profile!</a>';

      $content =  '
   
  <div class="container-fluid bg-white p-3">
  <div class="container">
  <div class="row">

    <div class="col-6 order-last">
      '.$alert.'
      <div class="card border-warning mb-3">
      <div class="card-header bg-warning"> Change Password </div>
      <div class="card-body"> 
                    <form action="'.BASE_URL.'/change-password" method="post" class="form px-4 py-3">
                      <div class="form-group">
                        <label for="oldpasswd" class="form-label"> Existing Password </label>
                        <input name="oldpasswd" type="password" placeholder="Type Existing Password" class="form-control" required>
                      </div><br>
                      <div class="form-group">
                        <label for="passwd1" class="form-label"> New Password </label>
                        <input name="passwd1" type="password" placeholder="New Password" class="form-control" id="passwd1">
                      </div>
                      <div class="form-group">
                        <input name="passwd2" type="password" placeholder="Re-type New Password" class="form-control" id="passwd2">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-key"></i>&nbsp; Change Password</button>
                      </div>
                    </form>
          <p class="text-right">'.$skip.'</p>
      </div>
      </div>
            
     </div>
            
     <div class="col-3">
            
     </div>
            
  </div>
  </div>
  </div>';
            
            
      return $this->print($content,'',$session);
    }
  

    public function forgotPassword($data) {
      $loggedin  = $data['loggedin'];
      $session   = $data['session'];
      $msg       = $data['msg'];
      $alert = '';
      if($msg!='') $alert = $this->alert($msg);

      $content =  '
   
  <div class="container-fluid bg-white p-3">
  <div class="container">
  <div class="row">

    <div class="col-6 order-last">
      '.$alert.'
      <div class="card border-info mb-3">
      <div class="card-header bg-info text-white"> Forgot Password </div>
      <div class="card-body"> 
                    <form action="'.BASE_URL.'/forgot-password/set" method="post" class="form px-4 py-3">
                      <div class="form-group">
                        <label for="profid" class="form-label"> Profile ID </label>
                        <input name="profid" type="text" placeholder="Type Profile ID" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="emailid" class="form-label"> Email Address </label>
                        <input name="emailid" type="email" placeholder="Your registered email" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-info"><i class="fas fa-key"></i>&nbsp; Reset Password </button>
                      </div>
                    </form>
      </div>
      </div>
            
     </div>
            
     <div class="col-3">
            
     </div>
            
  </div>
  </div>
  </div>';
            
            
      return $this->print($content,'',$session);
    }  

}
              

/*
Other two sliders

          <div class="carousel-item">
            <img class="d-block w-100" src="'.BASE_URL.'/assets/images/banner/02-beach-beach-wedding-chairs.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block" style="bottom: 130px;">
             <h3 class="slider-title text-dark">Largest Matrimonial Service</h3>
             <p><span style="font-size: 28px; background-color: rgb(255, 255, 255); top: 0px; left: 78.5px; padding: 0px; line-height: 42px; letter-spacing: 0.42px; color: #dc3545;">for Brahmin Community <br>in Tamilnadu</span></p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="'.BASE_URL.'/assets/images/banner/03-black-and-white-car.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
             <h5 class="slider-title">Find your Special One!</h5>
             <p> </p>
            </div>
          </div>

          */
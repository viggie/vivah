<?php  
/* 
 *  Register View
 */
namespace Vi\View;

require_once VIEW.'Theme.php';

class profileView extends siteView 
{
    private $val;

    public function index($data) {
        $profile = $data['profile'][0];
        $session   = $data['session'];
        $msg = $data['msg'];
        $editBtn = $uid = '';
        $uid = $session->get('user.id');
        
        if($profile['id']==$uid) {
          $editBtn = '<a href="/edit-profile" class="btn btn-success float-right">Edit Your Profile</a>';
        }


        $alert = '';
        if($msg!='') $alert = $this->alert($msg);

        $content =  '
        <div class="container-fluid page-header p-3">
        <div class="row">
          <div class="col">
            <h1> Profile </h1>
          </div>
        </div>
        </div>
     
    <div class="container-fluid bg-white p-3">
    <div class="container">
    <div class="row">

      <div class="col">
        '.$alert.'
        
      </div>

    </div>
    <div class="row">

      <div class="col">
        '.$editBtn.$this->showProfile($profile).'
        
      </div>

    </div>
    </div>
    </div>';


        return $this->print($content,'',$session);
    }


    private function showProfile($profile) {
        if(!is_array($profile)) {
            return "Nothing to show here.";
        }
        
        if($profile['photo']=='') {
          $img = BASE_URL.'/assets/images/'.$profile['gender']."ph.png";
          $showimg = '<img src="'.$img.'" class="img-thumbnail rounded-circle" alt="'. $profile['name'] .'">';
          $mainimg = '';
        } else {
          $img = BASE_URL.'/profile-pics/thumbs/'.$profile['photo'];
          $showimg = '<a href="" data-toggle="modal" data-target="#showPhoto" data-whatever="showPhoto">
          <img src="'.$img.'" class="img-thumbnail rounded-circle" alt="'. $profile['name'] .'"></a>';
          $mainimg = BASE_URL.'/profile-pics/'.$profile['picture'];
        }
        $profid =  $profile['gender'] .  $profile['id'];
        
        if ($profile['gender']=='G') { $gender = 'Girl';
        } else { $gender = 'Boy'; }
        
        switch ($profile['statusid']) {
          case 'W': $mstatus = 'Widow'; if($profile['gender']=='M') $mstatus = 'Widower'; break;
          case 'D': $mstatus = 'Divorced'; break;
          case 'S': $mstatus = 'Separated'; break;
          default : $mstatus = 'Never Married'; break;
        }

        /*
        switch ($profile['complexion']) {
          case 'V': $complxn = 'Very Fair'; break;
          case 'F': $complxn = 'Fair'; break;
          case 'M': $complxn = 'Medium'; break;
          default : $complxn = 'Fair'; break;
        }
        */
        $content =  '
        <h2>Profile of '. $profile['name'] .' &nbsp; (ID: '.$profid.' )</h2>

        <div class="row">
        <div class="col-sm-2 text-center">
          '. $showimg .'
        </div>

        <div class="col-sm-5">
            <p> Full Name: '. $profile['name'] .' <br>
            Age : '.$profile['age'].' <br>
            Date of Birth : '. date('d-M-Y', strtotime($profile['dob']) )  .' </p>
        </div>

        <div class="col-sm-5">
            <p> ID: '. $profid .'  &nbsp; '.$gender.' <br>
            '. $mstatus  .' <br>
            '.$profile['city'].' </p>
        </div>
        
        <div class="col-sm-12">
          <p>'. nl2br($profile['profile']) . '</p>
        </div>
      </div>


        <div class="row mb-3">
        <div class="col-sm">

        <div class="card border-danger">
        <div class="card-header bg-danger text-light"> Education &amp; Job </div>
        <div class="card-body"> 
          <div class="row">
            <div class="col-sm-4"> Education </div>  <div class="col-sm-8"> '.$profile['educategory'] .'</div>
            <div class="col-sm-4"> &nbsp; </div>  <div class="col-sm-8"> '.$profile['education'] .'</div>
            <div class="col-sm-4"> Job </div>  <div class="col-sm-8"> '.$profile['jobcategory'] .'</div>
            <div class="col-sm-4"> Salary </div>  <div class="col-sm-8"> '.$profile['job_salary'] .'</div>
          </div>
        </div>
        </div>

        </div>
        <div class="col-sm">

        <div class="card border-danger">
        <div class="card-header bg-danger text-light"> Personal </div>
        <div class="card-body"> 
          <div class="row">
            <div class="col-sm-4"> Height </div> <div class="col-sm-8"> '.$profile['height'] .'</div>
            <div class="col-sm-4"> Weight </div> <div class="col-sm-8"> '.$profile['weight'] .'</div>
            <div class="col-sm-4"> Mother Tongue </div> <div class="col-sm-8"> '.$profile['mother_tongue'] .'</div>
          </div>
        </div>
        </div>

        </div>
        </div><!-- row -->



        <div class="row mb-3">
        <div class="col-sm">

        <div class="card border-danger">
        <div class="card-header bg-danger text-light"> Lineage &amp; Horoscope </div>
        <div class="card-body"> 
          <div class="row">
            <div class="col-sm-4"> Community </div> <div class="col-sm-8"> '.$profile['name_english'] .'</div>
            <div class="col-sm-4"> Religion </div> <div class="col-sm-8"> '.$profile['religion_eng'] .'</div>
            <div class="col-sm-4"> Star </div> <div class="col-sm-8"> '.$profile['star_eng'] .'</div>
            <div class="col-sm-4"> Rashi </div> <div class="col-sm-8"> '.$profile['rashi_eng'] .'</div>
            <div class="col-sm-12"> <img src="'.$profile['astro_pic'] .'" alt="" class="img-fluid"></div>
          </div>
        </div>
        </div>

        </div>
        <div class="col-sm">

        <div class="card border-danger">
        <div class="card-header bg-danger text-light"> Family Details </div>
        <div class="card-body"> 
          <div class="row">
            <div class="col-sm-4"> Father </div> <div class="col-sm-8"> '.$profile['father_name'] .'<br>'.$profile['father_job'] .'</div>
            <div class="col-sm-4"> Mother </div> <div class="col-sm-8"> '.$profile['mother_name'] .'<br>'.$profile['mother_job'] .'</div>
            <div class="col-sm-4"> Brothers </div> <div class="col-sm-8"> '.$profile['brothers'] .'</div>
            <div class="col-sm-4"> Sisters </div> <div class="col-sm-8"> '.$profile['sisters'] .'</div>
          </div>
        </div>
        </div>

        </div>
        </div><!-- row -->

        
        <div class="row mb-3">
        <div class="col-sm">

        <div class="card border-danger">
        <div class="card-header bg-danger text-light"> Preferences  </div>
        <div class="card-body"> 
          <div class="row">
          <div class="col-sm">
            <div class="col-sm-12"> General:<br> '.$profile['preferences'] .'</div>
          </div>
          </div>
        </div>
        </div>

        </div>
        </div><!-- row -->


        <div class="modal fade" id="showPhoto" tabindex="-2" role="dialog" aria-labelledby="shPhoto" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title text-white" id="shPhoto"><i class="far fa-user-circle"></i> '. $profile['name'] .'</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-center">
            <img src="'.$mainimg.'" class="img-fluid" alt="'. $profile['name'] .'">


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
        </div>
                 
        ';

        return $content;
    } 
}
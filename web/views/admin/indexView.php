<?php 
/* 
 * Admin Index View
 */
namespace Vi\View\Admin;
require_once VIEW.'admin/Theme.php';

class indexView extends AdminView 
{

    public function index($data) {
        $session  = $data['session'];
        $counts   = $data['counts'];
        $paidusers = $data['paid_users'];
        //$starlist  = $data['starlist'];
        if ($data['msg'] != '') {
          $content = $this->alert($data['msg']);
        } else { $content = ''; }
        $profile_stats = $paiduser_stats = ''; $totprofiles = $totpaidusers = 0;

        if(is_array($counts)) {
            foreach($counts as $cou) {
                switch ($cou['statusid']) {
                    case 'A': $profile_stats .= '<span class="badge badge-warning float-right">'.$cou['totall'].'</span> Active : '; break;
                    case 'P': $profile_stats .= '<span class="badge badge-warning float-right">'.$cou['totall'].'</span> Pending : '; break;
                    case 'S': $profile_stats .= '<span class="badge badge-warning float-right">'.$cou['totall'].'</span> Suspended : '; break;
                    case 'D': $profile_stats .= '<span class="badge badge-warning float-right">'.$cou['totall'].'</span> Deleted : '; break;
                    case 'N': $profile_stats .= '<span class="badge badge-warning float-right">'.$cou['totall'].'</span> New : ';
                }
                $profile_stats .= '<br>';
                $totprofiles += $cou['totall'];
            }
        }

        if(is_array($paidusers)) {
            foreach($paidusers as $pu) {
                switch ($pu['status']) {
                    case 'A': $paiduser_stats .= '<span class="badge badge-warning float-right">'.$pu['cou'].'</span> Active : '; break;
                    case 'P': $paiduser_stats .= '<span class="badge badge-warning float-right">'.$pu['cou'].'</span> Pending : '; break;
                    case 'S': $paiduser_stats .= '<span class="badge badge-warning float-right">'.$pu['cou'].'</span> Suspended : '; break;
                    case 'D': $paiduser_stats .= '<span class="badge badge-warning float-right">'.$pu['cou'].'</span> Deleted : '; break;
                }
                $paiduser_stats .= '<br>';
                $totpaidusers += $pu['cou'];
            }
        }

        $content .= '
        <div class="row bg-warning pt-1">
         <div class="col-md-12">
          <h2>Dashboard</h2>
         </div>
        </div>
        <div class="row">
         <div class="col-sm-4 pt-1">
           <div class="card border-danger" style="width:150px;">
           <div class="card-header bg-danger text-light"> Profiles <span class="badge badge-light float-right">'.$totprofiles.'</span> 
           </div>
           <div class="card-body"> 
             <p class="lead"><b> '. $profile_stats .' </b></p>
           </div>
           </div>
         </div>

         <div class="col-sm-4 pt-1">
           <div class="card border-success" style="width:150px;">
           <div class="card-header bg-success text-light"> Users <span class="badge badge-light float-right">'.$totpaidusers.'</span> 
           </div>
           <div class="card-body"> 
             <p class="lead"><b> '. $paiduser_stats .' </b></p>
           </div>
           </div>
         </div>


        </div>
        ';

        return $this->print($content,$session);
    }


    public function profiles($data) {
        $session  = $data['session'];
        $profiles = $data['profiles'];
        if ($data['msg'] != '') {
          $content = $this->alert($data['msg']);
        } else { $content = ''; }
        $stats = ''; 

        if(is_array($profiles)) {
          $totprofiles = count($profiles);
          $pflist = '
          <table id="profiles" class="table">
          <thead>
          <tr><th>ID</th><th>Status</th><th>Date</th><th style="width:25rem;">Name</th><th> &nbsp; </th></tr>
          </thead>
          <tbody>';
          foreach($profiles as $prof) {
            switch($prof['status']) {
              case 'N': $status = '<span class="badge badge-dark"> New </span>'; break;
              case 'P': $status = '<span class="badge badge-primary p-1">Pending</span>'; break;
              case 'A': $status = '<span class="badge badge-success">Active</span>'; break;
              case 'S': $status = '<span class="badge badge-warning">Suspended</span>'; break;
              case 'D': $status = '<span class="badge badge-danger">Deleted</span>'; break;
            }
            $pflist .= '<tr><td>'.$prof['gender'].$prof['id'].'</td><td>'.$status.'</td><td>'.
            date('d-m-Y',strtotime($prof['joined_on'])).'</td><td class="text-nowrap">'.$prof['name'].
            '</td>';
            $pflist .= '<td> <form action="'.BASE_URL.'/'.ADMIN_URL.'/view-profile" class="d-inline mr-3" method="POST">
            <input type="hidden" name="id" value="'.$prof['id'].'">
            <button type="submit" class="btn btn-primary" name="submit" title="View"><i class="far fa-address-card"></i></button>
            </form> 
            ';
            $pflist .= '<form action="'.BASE_URL.'/'.ADMIN_URL.'/edit-profile" class="d-inline" method="POST">
            <input type="hidden" name="id" value="'.$prof['id'].'">
            <button type="submit" class="btn btn-warning" name="submit" title="Edit"><i class="far fa-edit"></i></button>
            </form> 
            </td></tr>';
          }
          $pflist .= '
          </tbody>
          </table>';
        } else {
          $pflist = 'No Profiles yet!';
        }
        

        $content .= '
        <div class="row bg-warning pt-1">
         <div class="col-md-12">
          <h2>Profiles</h2>
         </div>
        </div>
        <div class="row">
         <div class="col">
           <div class="card">
             <div class="card-body">
             '. $pflist .'
             </div>
           </div>
 
         </div>
        </div>
        ';

        return $this->print($content,$session);
    }


    public function viewProfile($data) {
      $profile = $data['profile'][0];
      $session   = $data['session'];
      
      if ($data['msg'] != '') {
        $content = $this->alert($data['msg']);
      } else { $content = ''; }

      $stnam['P'] = 'Pending';
      $stnam['A'] = 'Active';
      $stnam['S'] = 'Suspend';
      $stnam['D'] = 'Delete';
      $statusbtn = '';

      foreach($stnam as $key => $stat) {
        if($key == $profile['status']) continue;
        $statusbtn .= '
        <form action="'.BASE_URL.'/'.ADMIN_URL.'/change-status" class="d-inline mr-3" method="POST">
        <input type="hidden" name="id" value="'.$profile['id'].'">
        <input type="hidden" name="status" value="'. $key .'">
        <button type="submit" class="btn btn-primary" name="submit" title="change to Pending">
        '. $stat .' </button>
        </form> 
        ';  

      }


      $content =  '
        <div class="row bg-warning pt-2 mb-3">
         <div class="col-md-12">
           <form action="'.BASE_URL.'/'.ADMIN_URL.'/edit-profile" class="d-inline float-right" method="POST">
           <input type="hidden" name="id" value="'.$profile['id'].'">
           <button type="submit" class="btn btn-danger" name="submit" title="Edit">
           <i class="far fa-edit"></i> Edit this Profile</button>
           </form> 

           <h2>View Profile</h2>
         </div>
        </div>
        <div class="row mb-2">
         <div class="col text-center border border-success p-1">
           <b> Change Status to </b>
          '. $statusbtn .' 

         </div>
        </div>
        <div class="row">
         <div class="col">
        '. $this->showProfile($profile) .'

          </div>
        </div>
      ';

      return $this->print($content,$session);

    }

    private function showProfile($profile) {
      if(!is_array($profile)) {
          return "Nothing to show here.";
      }
      
      if($profile['photo']=='') {
        $img = BASE_URL.'/images/'.$profile['gender']."ph.png";
      } else {
        $img = BASE_URL.'/profile/'.$profile['photo'];
      }
      $profid =  $profile['gender'] .  $profile['id'];
      
      if ($profile['gender']=='F') { $gender = 'Woman';
      } else { $gender = 'Man'; }
      
      switch ($profile['statusid']) {
        case 'W': $mstatus = 'Widow'; if($profile['gender']=='B') $mstatus = 'Widower'; break;
        case 'D': $mstatus = 'Divorced'; break;
        case 'S': $mstatus = 'Separated'; break;
        default : $mstatus = 'Never Married'; break;
      }
      $stnam['N'] = 'New';
      $stnam['P'] = 'Pending';
      $stnam['A'] = 'Active';
      $stnam['S'] = 'Suspended';
      $stnam['D'] = 'Deleted';

      $content =  '
      <h2>
      <span class="badge badge-success float-right"><b>Profile Status: '. $stnam[ $profile['status'] ].'</b></span>
      '. $profile['name'] .' &nbsp; (ID: '.$profid.' )</h2>

      <div class="row">
      <div class="col-sm-2 text-center">
        <img src="'.$img.'" class="img-thumbnail" alt="'. $profile['name'] .'">
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
        
      </div>

      <div class="row mb-3">
      <div class="col-sm">

      <div class="card border-danger">
      <div class="card-header bg-danger text-light"> Contact  </div>
      <div class="card-body"> 
        <div class="row">
        <div class="col-sm">
          <div class="row">
          <div class="col-sm-4"> Email </div> <div class="col-sm-8"> '.$profile['email'] .'</div>
          <div class="col-sm-4"> Phone </div> <div class="col-sm-8"> '.$profile['mobile'] .'</div>
          </div>
        </div>
        <div class="col-sm">
          <div class="col-sm-12"> Address:<br> '.$profile['address'] .'</div>
        </div>
        </div>
      </div>
      </div>

      </div>
      </div><!-- row -->


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

      
      ';

      return $content;
  }


public function editProfile($data) {
    $profile = $data['profile'][0];
    $session   = $data['session'];
    $msg = $data['msg'];

    $edutype   = $data['edutype'];
    $jobtype   = $data['jobtype'];
    $religion  = $data['religion'];
    $community = $data['community'];
    $stars     = $data['stars'];
    $rashi     = $data['rashi'];

    $alert = '';
    if($msg!='') $alert = $this->alert($msg);

    if(!is_array($profile)) {
        return "Nothing to show here.";
    }
    
    if($profile['photo']=='') {
      $img = BASE_URL.'/images/'.$profile['gender']."ph.png";
    } else {
      $img = BASE_URL.'/profile/'.$profile['photo'];
    }
    $profid =  $profile['gender'] .  $profile['id'];
    
    if ($profile['gender']=='G') { $gender = 'Girl';
    } else { $gender = 'Boy'; }
    switch ($profile['statusid']) {
      case 'W': $mstatus = 'Widow'; if($profile['gender']=='B') $mstatus = 'Widower'; break;
      case 'D': $mstatus = 'Divorced'; break;
      case 'S': $mstatus = 'Separated'; break;
      default : $mstatus = 'Never Married'; break;
    }
    
    // Select Form tab
    $tab1 = $tab2 = $tab3 = $tab4 = $tab5 = '';
    $pane1 = $pane2 = $pane3 = $pane4 = $pane5 = '';
    switch ($data['formnum']) {
      case 1: $tab2='active'; $pane2='show active'; break;
      case 2: $tab3='active'; $pane3 = 'show active'; break;
      case 3: $tab4='active'; $pane4 = 'show active'; break;
      case 4: $tab5='active'; $pane5 = 'show active'; break;
      default: $tab1='active'; $pane1 = 'show active'; 
    }


    $content =  '
    <div class="row bg-warning pt-2 mb-3">
    <div class="col-md-12">
      <form action="'.BASE_URL.'/'.ADMIN_URL.'/view-profile" class="d-inline float-right" method="POST">
      <input type="hidden" name="id" value="'.$profile['id'].'">
      <button type="submit" class="btn btn-primary" name="submit" title="Edit">
      <i class="far fa-address-card"></i> View this Profile</button>
      </form> 

     <h2> Edit Profile </h2>
    </div>
    </div>
 
<div class="row pt-3">

  <div class="col">


  <h2>'. $profile['name'] .' &nbsp; (ID: '.$profid.' )</h2>

  <div class="row">
  <div class="col-2">
    <img src="'.$img.'" class="img-thumbnail" alt="'. $profile['name'] .'">
  </div>

  <div class="col-10">
    <div class="row">
    <div class="col-sm">
      <p> Full Name: '. $profile['name'] .' </p>
      <p> Date of Birth : '. date('d-M-Y', strtotime($profile['dob']) )  .' </p>
    </div>

    <div class="col-sm">
      <p> ID: '. $profid .'  &nbsp; Gender: '.$gender.' </p>
      <p> Marital Status : '. $mstatus  .' </p>
    </div>
    </div>
    
  </div>
  </div>
  <div class="row">

    <div class="col">
      '.$alert.'
    
    </div>

  </div>

  <div class="row">
  <div class="col mt-3" id="editprofile">

  <ul class="nav nav-tabs nav-fill">
  <li class="nav-item">
    <a class="nav-link '.$tab1.'" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true"> Basic Details </a>
  </li>
  <li class="nav-item">
    <a class="nav-link '.$tab2.'" id="edu-tab" data-toggle="tab" href="#edu" role="tab" aria-controls="edu" aria-selected="false"> Education &amp; Job  </a>
  </li>
  <li class="nav-item">
    <a class="nav-link '.$tab3.'" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="false"> Personal &amp; Horoscope </a>
  </li>
  <li class="nav-item">
    <a class="nav-link '.$tab4.'" id="family-tab" data-toggle="tab" href="#family" role="tab" aria-controls="family" aria-selected="false"> Family Details </a>
  </li>
  <li class="nav-item">
    <a class="nav-link '.$tab5.'" id="prefer-tab" data-toggle="tab" href="#prefer" role="tab" aria-controls="prefer" aria-selected="false">Preferences </a>
  </li>
  </ul>

  <div class="tab-content p-3 mb-3">
   <div class="tab-pane fade '.$pane1.'" id="basic" role="tabpanel" aria-labelledby="edu-tab">
    <form action="'.BASE_URL.'/'.ADMIN_URL.'/edit-profile" method="post">
     <input type="hidden" name="id" value="'.$profile['id'].'">
     <div class="row">
     '. $this->formBasic($profile) .'
     </div>
    </form>
   </div>
   <div class="tab-pane fade '.$pane2.'" id="edu" role="tabpanel" aria-labelledby="edu-tab">
    <form action="'.BASE_URL.'/'.ADMIN_URL.'/edit-profile" method="post">
     <input type="hidden" name="id" value="'.$profile['id'].'">
     <div class="row">
     '. $this->formEdu($profile,$edutype,$jobtype) .'
     </div>
    </form>
   </div>
   <div class="tab-pane fade '.$pane3.'" id="personal" role="tabpanel" aria-labelledby="personal-tab">
    <form action="'.BASE_URL.'/'.ADMIN_URL.'/edit-profile" method="post">
     <input type="hidden" name="id" value="'.$profile['id'].'">
     <div class="row">
     '. $this->formPersonal($profile,$community,$religion,$stars,$rashi) .'
     </div>
    </form>
   </div>
   <div class="tab-pane fade '.$pane4.'" id="family" role="tabpanel" aria-labelledby="family-tab">
    <form action="'.BASE_URL.'/'.ADMIN_URL.'/edit-profile" method="post">
     <input type="hidden" name="id" value="'.$profile['id'].'">
     <div class="row">
     '. $this->formFamily($profile) .'
     </div>
    </form>
   </div>
   <div class="tab-pane fade '.$pane5.'" id="prefer" role="tabpanel" aria-labelledby="prefer-tab">
    <form action="'.BASE_URL.'/'.ADMIN_URL.'/edit-profile" method="post">
     <input type="hidden" name="id" value="'.$profile['id'].'">
     <div class="row">
     '. $this->formPrefer($profile) .'
     </div>
    </form>
   </div>
  </div>


  </div>
  </div>


  
  </div>

</div>';


    return $this->print($content,'',$session);
}



private function formBasic($profile) {
  // Data 
  if ($profile['gender'] =='B') {
    $boys = 'active';
    $girls = '';
  } else {
    $boys = '';
    $girls = 'active';
  }
  $mindate = date('Y-m-d',strtotime('-60years'));
  $maxdate = date('Y-m-d',strtotime('-18years'));    

  $mstatus = array(
    array( 'id'=>'U', 'name'=>'Never Married' ),
    array( 'id'=>'W', 'name'=>'Widow(er)' ),
    array( 'id'=>'D', 'name'=>'Divorced' ),
    array( 'id'=>'S', 'name'=>'Separated' )
  );
  $mstatuslist = $this->select_options($mstatus,$profile['statusid']);


  $content = '
    <div class="col-sm">
     <div class="form-group row">
      <label for="gender" class="col-md-2 col-form-label"> Gender </label>
      <div class="col-md-10">
      <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
        <label class="btn btn-outline-danger '.$girls.'">
        <input type="radio" name="gender" id="gen1" value="G" checked> Woman
        </label>
        <label class="btn btn-outline-danger '.$boys.'">
        <input type="radio" name="gender" id="gen2" value="B" > Man
        </label>
      </div>
      </div>
     </div>

     <div class="form-group">
      <label for="pname" class="form-label"> Name <sup>*</sup></label>
      <input type="text" class="form-control" name="pname" placeholder="Name" value="'. $profile['name'] .'" required> 
     </div>
     <div class="form-group">
      <label for="lname" class="form-label"> Last Name (or Initials) </label>
      <input type="text" class="form-control" name="lname" placeholder="Last Name" value="'. $profile['lastname'] .'"> 
     </div>

     <div class="form-group">
      <label for="pdob" class="form-label"> Date of Birth </label>
      <input type="date" class="form-control dob" name="pdob" min="'.$mindate.'" max="'.$maxdate.'" value="'. $profile['dob'] .'" required> 
     </div>

     <div class="form-group">
      <label for="mstatus" class="form-label"> Marital Status </label>
        <select name="mstatus" class="form-control">
          '. $mstatuslist .'
        </select>
     </div>

     </div>
     <div class="col-sm">
      <h5> Contact Details </h5>
      <div class="form-group">
      <label for="contact" class="form-label"> Contact Name <sup>*</sup></label>
        <input type="text" class="form-control" name="contact" placeholder="Contact Name" value="'. $profile['contact'] .'" required> 
     </div>

     <div class="form-group">
      <label for="pemail" class="form-label"> E-mail </label>
        <input readonly class="form-control-plaintext" name="pemail" value="'. $profile['email'] .'"> 
     </div>

     <div class="form-group">
      <label for="pphone" class="form-label"> Phone </label>
        <input type="phone" class="form-control" name="pphone" placeholder="Phone" value="'. $profile['mobile'] .'" required> 
     </div>

     <div class="form-group">
      <label for="address" class="form-label"> Address </label>
       <textarea class="form-control" name="address" placeholder="Contact Address" required>'. $profile['address'] .'</textarea> 
     </div>


     </div>
     </div>



     <div class="row">
     <div class="col text-right">
     <button type="submit" class="btn btn-lg btn-success"> <i class="fas fa-database"></i> Save &amp; Proceed &raquo; </button>
     <input type="hidden" name="formnum" value="1">
     </div>
  

  ';

  return $content;
}


private function formEdu($profile,$edutype,$jobtype) {
  $edulist = $this->select_options($edutype,$profile['eduid']);
  $joblist = $this->select_options($jobtype,$profile['jobid']);

  $content = '
    <div class="col-sm">

     <div class="form-group">
       <label for="eduid" class="form-label">Education Category</label>
       <select name="eduid" class="form-control">
       '. $edulist .'
       </select>
      </div>

      <div class="form-group">
       <label for="education" class="form-label"> Education Details </label>
         <input type="text" class="form-control" name="education" value="'. $profile['education'] .'" placeholder="Degree or Certificate Details"> 
      </div>


     </div>
     <div class="col-sm">
     <h5> Job Details </h5>

      <div class="form-group">
        <label for="jobid" class="form-label">Job Type</label>
        <select name="jobid" class="form-control">
        '. $joblist .'
        </select>
      </div>

      <div class="form-group">
       <label for="job_title" class="form-label"> Job Title </label>
       <input type="text" class="form-control" name="job_title" value="'. $profile['job_title'] .'" placeholder="Job Title"> 
      </div>

      <div class="form-group">
       <label for="job_salary" class="form-label"> Salary (per month) </label>
       <input type="text" class="form-control" name="job_salary" value="'. $profile['job_salary'] .'" placeholder="Preferably in Rs."> 
      </div>



     </div>
     </div>



     <div class="row">
     <div class="col text-right">
       <button type="submit" class="btn btn-lg btn-success"> <i class="fas fa-database"></i> Save &amp; Proceed &raquo; </button>
       <input type="hidden" name="formnum" value="2">
     </div>
  

  ';

  return $content;
}    


private function formPersonal($profile,$commid,$religion,$stars,$rashi) {
  $community = $this->select_options($commid,$profile['commid']);
  $religion = $this->select_options($religion,$profile['religionid']);

  $starlist = $this->select_options($stars,$profile['starid']);
  $rashilist = $this->select_options($rashi,$profile['rashiid']);

  $content = '
    <div class="col-sm">

      <div class="form-group">
       <label for="height" class="form-label"> Height </label>
         <input type="text" class="form-control" name="height" value="'. $profile['height'] .'" placeholder=" In feet & inches"> 
      </div>

      <div class="form-group">
       <label for="weight" class="form-label"> Weight </label>
         <input type="text" class="form-control" name="weight" value="'. $profile['weight'] .'" placeholder=" In KG"> 
      </div>

      <div class="form-group">
       <label for="mother_tongue" class="form-label"> Mother Tongue </label>
         <input type="text" class="form-control" name="mother_tongue" value="'. $profile['mother_tongue'] .'" placeholder="Mother Tongue"> 
      </div>


     </div>
     <div class="col-sm">

      <div class="form-group">
       <label for="commid" class="form-label"> Community </label>
       <select name="commid" class="form-control">
         <option value=""> Select </option>
       '. $community .'
       </select>
      </div>
     
      <div class="form-group">
        <label for="religionid" class="form-label"> Religion </label>
        <select name="religionid" class="form-control">
         <option value=""> Select </option>
        '. $religion .'
        </select>
      </div>



     <h5> Horoscope </h5>

      <div class="form-group">
       <label for="starid" class="form-label"> Star </label>
       <select name="starid" class="form-control">
       '. $starlist .'
       </select>
      </div>
     
      <div class="form-group">
        <label for="rashiid" class="form-label"> Rashi </label>
        <select name="rashiid" class="form-control">
        '. $rashilist .'
        </select>
      </div>

      <div class="form-group">
       <label for="astro_pic" class="form-label"> Jathakam </label>
       <input type="file" class="form-control" name="astro_pic"> 
      </div>


     </div>
     </div>



     <div class="row">
     <div class="col text-right">
       <button type="submit" class="btn btn-lg btn-success"> <i class="fas fa-database"></i> Save &amp; Proceed &raquo; </button>
       <input type="hidden" name="formnum" value="3">
     </div>
  

  ';

  return $content;
}    

private function formFamily($profile) {

  $content = '
    <div class="col-sm">

      <div class="form-group">
       <label for="father-name" class="form-label"> Father Name </label>
         <input type="text" class="form-control" name="father_name" value="'. $profile['father_name'] .'" placeholder="Father Name"> 
      </div>

      <div class="form-group">
       <label for="father-job" class="form-label"> Father Job </label>
         <input type="text" class="form-control" name="father_job" value="'. $profile['father_job'] .'" placeholder="Father Job"> 
      </div>

      <div class="form-group">
       <label for="mother-name" class="form-label"> Mother Name </label>
         <input type="text" class="form-control" name="mother_name" value="'. $profile['mother_name'] .'" placeholder="Mother Name"> 
      </div>

      <div class="form-group">
       <label for="mother-job" class="form-label"> Mother Job </label>
         <input type="text" class="form-control" name="mother_job" value="'. $profile['mother_job'] .'" placeholder="Mother Job"> 
      </div>


     </div>
     <div class="col-sm">

      <div class="form-group">
       <label for="brothers" class="form-label"> Brothers </label>
         <input type="text" class="form-control" name="brothers" value="'. $profile['brothers'] .'" placeholder="Brothers"> 
      </div>

      <div class="form-group">
       <label for="sisters" class="form-label"> Sisters </label>
         <input type="text" class="form-control" name="sisters" value="'. $profile['sisters'] .'" placeholder="Sisters"> 
      </div>


     </div>
     </div>



     <div class="row">
     <div class="col text-right">
       <button type="submit" class="btn btn-lg btn-success"> <i class="fas fa-database"></i> Save &amp; Proceed &raquo; </button>
       <input type="hidden" name="formnum" value="4">
     </div>
  

  ';

  return $content;
}    

private function formPrefer($profile) {

  $content = '
    <div class="col-sm">

      <div class="form-group">
       <label for="prefer-general" class="form-label"> General </label>
       <textarea class="form-control" name="preferences" placeholder="General">'. $profile['preferences'] .'</textarea> 
      </div>


     </div>
     <div class="col-sm">



     </div>
     </div>



     <div class="row">
     <div class="col text-right">
       <button type="submit" class="btn btn-lg btn-success"> <i class="fas fa-database"></i> Save  </button>
       <input type="hidden" name="formnum" value="5">
     </div>
  

  ';

  return $content;
}    


}

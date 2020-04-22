<?php  
/* 
 *  Register View
 */
namespace Vi\View;

require_once VIEW.'Theme.php';

class editprofileView extends siteView 
{
    private $val;

    public function index($data) {
        $profile = $data['profile'][0];
        $session   = $data['session'];
        $msg = $data['msg'];

        $edutype   = $data['edutype'];
        $jobtype   = $data['jobtype'];
        $religion  = $data['religion'];
        $comm   = $data['comm'];
        $stars     = $data['stars'];
        $rashi     = $data['rashi'];

        $alert = $remBtn = '';
        if($msg!='') $alert = $this->alert($msg);

        if(!is_array($profile)) {
            return "Nothing to show here.";
        }
        
        if($profile['photo']=='') {
          $mainimg = $img = BASE_URL.'/images/'.$profile['gender']."ph.png";
        } else {
          $img = BASE_URL.'/profile-pics/thumbs/'.$profile['photo'];
          $mainimg = BASE_URL.'/profile-pics/'.$profile['photo'];
          $remBtn = '<div style="width:200px; position:relative; z-index:10; float:right;">
        <form action="'.BASE_URL.'/edit-profile/photo" method="post">
          <input type="hidden" name="remove" value="true">
          <input type="hidden" name="uid" value="'.$profile['id'].'">
          <button type="submit" name="submit" class="btn btn-danger mt-2 float-right"><i class="fas fa-portrait"></i> Remove Photo </button>
        </form>
        </div>
          ';
        }
        $profid =  $profile['gender'] .  $profile['id'];
        
        if ($profile['gender']=='G') { $gender = 'Girl';
        } else { $gender = 'Boy'; }
        switch ($profile['marriage_statusid']) {
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
        <div class="container-fluid page-header p-3">
        <div class="row">
          <div class="col">
            <h1> Edit Your Profile </h1>
          </div>
        </div>
        </div>
     
    <div class="container-fluid bg-white p-3">
    <div class="container">
    <div class="row">

      <div class="col">


      <h2>Edit Profile of '. $profile['name'] .' &nbsp; (ID: '.$profid.' )</h2>

      <div class="row">
      <div class="col-2 text-center">
        <a href="" data-toggle="modal" data-target="#changePh" data-whatever="changePh">
        <img src="'.$img.'" class="img-thumbnail rounded-circle" alt="'. $profile['name'] .'"></a>
        <button class="btn btn-light btn-block" data-toggle="modal" data-target="#changePh" data-whatever="changePh"> <i class="far fa-user-circle"></i> Change Photo  </button>
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
        <form action="'.BASE_URL.'/edit-profile" method="post">
         <div class="row">
         '. $this->formBasic($profile) .'
         </div>
        </form>
       </div>
       <div class="tab-pane fade '.$pane2.'" id="edu" role="tabpanel" aria-labelledby="edu-tab">
        <form action="'.BASE_URL.'/edit-profile" method="post">
         <div class="row">
         '. $this->formEdu($profile,$edutype,$jobtype) .'
         </div>
        </form>
       </div>
       <div class="tab-pane fade '.$pane3.'" id="personal" role="tabpanel" aria-labelledby="personal-tab">
        <form action="'.BASE_URL.'/edit-profile" method="post">
         <div class="row">
         '. $this->formPersonal($profile,$comm,$religion,$stars,$rashi) .'
         </div>
        </form>
       </div>
       <div class="tab-pane fade '.$pane4.'" id="family" role="tabpanel" aria-labelledby="family-tab">
        <form action="'.BASE_URL.'/edit-profile" method="post">
         <div class="row">
         '. $this->formFamily($profile) .'
         </div>
        </form>
       </div>
       <div class="tab-pane fade '.$pane5.'" id="prefer" role="tabpanel" aria-labelledby="prefer-tab">
        <form action="'.BASE_URL.'/edit-profile" method="post">
         <div class="row">
         '. $this->formPrefer($profile) .'
         </div>
        </form>
       </div>
      </div>


      </div>
      </div>


      
      </div>

    </div>
    </div>
    </div>
    
    <div class="modal fade" id="changePh" tabindex="-2" role="dialog" aria-labelledby="chPhoto" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-white" id="chPhoto"><i class="far fa-user-circle"></i> Change Photo </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body text-center">
        '.$remBtn.'
        <img src="'.$mainimg.'" class="img-fluid" alt="'. $profile['name'] .'">

        <h4 class="mt-3"> Change / Upload New Photo </h4>
        <form action="'.BASE_URL.'/edit-profile/photo" method="post" enctype="multipart/form-data">
          <input type="hidden" name="uid" value="'.$profile['id'].'">
          <input type="hidden" name="ftype" value="upload">
          <div class="form-group">
            <input type="file" class="form-control-file" name="photo" id="image">
          </div>
          <button type="submit" name="submit" class="btn btn-success mt-2 float-right"><i class="fas fa-portrait"></i> Upload Photo </button>
        </form>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>
        
    
    
    ';


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
      $mstatuslist = $this->select_options($mstatus,$profile['marriage_statusid']);


      $content = '
        <div class="col-sm">
         <div class="form-group row">
          <label for="gender" class="col-md-2 col-form-label"> Gender </label>
          <div class="col-md-10">
          <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
            <label class="btn btn-outline-danger '.$girls.'">
            <input type="radio" name="gender" id="gen1" value="G" checked> Female
            </label>
            <label class="btn btn-outline-danger '.$boys.'">
            <input type="radio" name="gender" id="gen2" value="B" > Male
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
           <label for="edu_details" class="form-label"> Education Details </label>
             <input type="text" class="form-control" name="edu_details" value="'. $profile['edu_details'] .'" placeholder="Degree or Certificate Details"> 
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


    private function formPersonal($profile,$comm,$religion,$stars,$rashi) {
      $commlist = $this->select_options($comm,$profile['commid']);
      $religionlist = $this->select_options($religion,$profile['gothraid']);

      $starlist = $this->select_options($stars,$profile['starid']);
      $rashilist = $this->select_options($rashi,$profile['rashiid']);

      $complexion = array(
        array( 'id'=>'V', 'name'=>'Very Fair' ),
        array( 'id'=>'F', 'name'=>'Fair' ),
        array( 'id'=>'M', 'name'=>'Medium' )
      );
      $complexlist = $this->select_options($complexion,$profile['complexion']);

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
           '. $commlist .'
           </select>
          </div>
         
          <div class="form-group">
            <label for="religionid" class="form-label"> religion </label>
            <select name="religionid" class="form-control">
             <option value=""> Select </option>
            '. $religionlist .'
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
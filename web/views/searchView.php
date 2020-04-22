<?php  
/* 
 *  Search View
 */
namespace Vi\View;

require_once VIEW.'Theme.php';

class searchView extends siteView 
{
    private $val;

    public function index($data,$msg) {
        $loggedin  = $data['loggedin'];
        $session   = $data['session'];
        $community = $data['community'];
       // $starlist  = $data['starlist'];
        $formdata  = $data['formdata'];
        $result    = $data['result'];
        $searchForm = $this->searchForm($community,$data['formdata']);

        $alert = '';
        if($msg!='') $alert = $this->alert($msg);

        $addjs='';

        $content =  '
     
    <div class="container-fluid page-header p-3">
    <div class="row">
      <div class="col">
        <h1>Members </h1>
      </div>
    </div>
    </div>
    <div class="container-fluid bg-white p-3">
    <div class="container">
    '.$alert.'
    <div class="row">
      <div class="col-md-8 order-last">
        
        <div class="card border-danger mb-3">
        <div class="card-header bg-danger text-light"> Find your Match </div>
        <div class="card-body"> 
        '. $searchForm .'
        </div>
        </div>

      </div>

      <div class="col-md-4">

        <div class="card border-danger mb-3">
        <div class="card-header bg-danger text-light"> Find by ID </div>
        <div class="card-body"> 
          <form action="'.BASE_URL.'/search/by-id" method="post">
          <div class="form-row">
            <div class="col-md-7 mb-2">
            <label class="sr-only" for="profid">Profile ID</label>
            <input type="text" class="form-control" name="profid" id="profid" placeholder="Profile ID" required>
            </div>
            <div class="col-md-5 mb-2">
            <button type="submit" class="btn btn-danger"> <i class="fas fa-search"></i> Find </button>
            </div>
          </div>
          </form>

        </div>
        </div>

      </div>

     </div>
     <div class="row">


       <div id="results" class="col mb-3">
     ';
     if(is_array($result)) {
       $totresults = count($result);
       if ($totresults>0) {
         /*
         $limit = 20; // 20 results per page
         if ($totresults > $limit) {
           // load pagination
          $total_pages = ceil($totresults / $limit);   
          $pagLink = '<ul class="pagination justify-content-center">';                         
          for ($i=1; $i<=$total_pages; $i++) { 
            if ($i==$pn) { 
                $pagLink .= '<li class="page-item active"><a class="page-link" href="index.php?page=' .$i.'">'.$i.'</a></li>'; 
            }             
            else  { 
                $pagLink .= '<li class="page-item"><a class="page-link" href="'.$i.'">  '.$i. '</a></li>';   
            } 
          }
          $pagLink .= '</ul>';   
         }
         */
         $content .= '<h5 class="text-center">Found '.$totresults.' Matches.</h5>
         <div class="col-sm-12 pt-2">
         <nav>
           <ul class="pagination justify-content-center pagination-sm">
           </ul>
         </nav> 
         </div>   
           
         ';
         foreach ($result as $res) {
          $content .= $this->showResult($res);
         }
         $addjs=' <script src="'.BASE_URL.'/assets/js/pagination.js?v=1"></script>';
       } else {
         $content .= '<p class="lead text-center">No results for your search.  
                      Please try a different one.</p>';
       }
     }

     $content .= '
       </div>

     </div>
     </div>
     </div>';


        return $this->print($content,'',$session,$addjs);
    }

    
    function showResult($row,$odd="Y",$showprofile='Y')  {
	  	$url = BASE_URL; 
		
		  if (!is_array($row)) { return ""; }
    
      if($row['photo']=='') {
        $img = BASE_URL.'/images/'.$row['gender']."ph.png";
      } else {
        $img = BASE_URL.'/profile/'.$row['photo'];
      }
      
      $profid =  $row['gender'] .  $row['id'];
    
      if ($row['gender']=='F') { $gender = 'Female';
      } else { $gender = 'Male'; }

      if($odd=="Y") {
			  $mainclass = "odd";
  			$bclass = "primary";
	  	} else {
		  	$mainclass = "even";
			  $bclass = "secondary";
		  }

		  $bgroom = ($row['gender']=="F") ? "<b>Bride</b>" : "<b>Groom</b>";
		  

  		$mstatus   = $row['status'];
	  	switch ($mstatus) {
  			case "S": $mstatus = 'Separated'; break;
	  		case "D": $mstatus = 'Divorced'; break;
		  	case "W": $mstatus = 'Widow/er'; break;
			  default: $mstatus = 'Never Married'; 
		  }


      $content =  '
      <div class="result '.$mainclass.'">
      <div class="row">
       <div class="col-sm-12 border-top border-danger bg-light">
         <a href="'.$url.'/profile/'.$profid.'" class="btn btn-info float-right mt-1">View Profile</a>
         <h3 class="p-1"> <b>'.$profid.' &nbsp; '.$row['name'].' </b> </h3>
       </div>
		  </div>
		  <div class="row border-bottom">
       <div class="col-sm-2 pt-2">
         <img src="'.$img.'" alt="'.$profid.'" class="img-thumbnail rounded-circle">
       </div>
       <div class="col-sm-5">
           <div class="row mb-3">
             <div class="col-sm-4"> Name </div> <div class="col-sm-8"> '.$row['name'] .'</div>
             <div class="col-sm-4"> Age </div> <div class="col-sm-8"> '.$row['age'] .'</div>
             <div class="col-sm-4"> Education </div>  <div class="col-sm-8"> '.$row['educategory'] .'</div>
             <div class="col-sm-4"> &nbsp; </div>  <div class="col-sm-8"> '.$row['education'] .'</div>
             <div class="col-sm-4"> Job </div>  <div class="col-sm-8"> '.$row['jobcategory'] .'</div>
             <div class="col-sm-4"> Job Location </div>  <div class="col-sm-8"> '.$row['job_place'] .'</div>
           </div>

       </div>
       <div class="col-sm-5 border-left">
           <div class="row mb-3">
             <div class="col-sm-12"> '.$bgroom .'</div>
             <div class="col-sm-4"> Community </div> <div class="col-sm-8"> '.$row['name_english'] .'</div>
             <div class="col-sm-4"> Rashi </div> <div class="col-sm-8"> '.$row['rashi_eng'] .'</div>
             <div class="col-sm-4"> Star </div> <div class="col-sm-8"> '.$row['star_eng'] .'</div>
           </div>

       </div>

	    </div>
		  </div> <!-- result -->';

		return $content;
	}

  
}
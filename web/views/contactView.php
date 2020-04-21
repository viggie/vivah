<?php  
/* 
 *  Contact View
 */
namespace Vi\View;

require_once VIEW.'Theme.php';

class contactView extends siteView 
{
    private $val;

    public function index($data,$msg) {

        $url = BASE_URL;
        $meta = array(
            'title' => 'Contact',
            'keyword' => KEYWORDS,
            'desc' => DESCRIPTION
        );
        $session   = $data['session'];
        $alert = '';
        if($msg!='') $alert = $this->alert($msg);

        if ($data['loggedin']) {
            $name = '<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="'. $data['name'] .'">';
            $email = '<p> '. $data['email'] .' </p>';
        } else {
            $name = '<input type="text" class="form-control" name="yrname" placeholder="Name" required>';
            $email = '<input type="email" class="form-control" name="yremail" placeholder="email" required>';
        }

        $content =  '
     
    <div class="container-fluid bg-white p-3">
    <div class="container">
    <div class="row">

      <div class="col-6 order-last">
        '.$alert.'
        
        <div class="card border-warning mb-3">
        <div class="card-header bg-warning"> Write to Us </div>
        <div class="card-body"> 
          <form class="form" action="'.$url.'/contact/send" method="POST">
            <div class="form-group">
              <label for="yrname" clas="form-label"> Your Name </label>
              '.$name.'
            </div>
            

            <div class="form-group">
              <label for="yremail" clas="form-label"> Your E-Mail </label>
              '.$email.'
            </div>
            
            <div class="form-group">
              <label for="yrsub" clas="form-label"> Subject </label>
              <input type="text" class="form-control" name="yrsub" placeholder="Subject" required>
            </div>
            
            <div class="form-group">
              <label for="yrmsg" clas="form-label"> Message </label>
              <textarea class="form-control" name="yrmsg" rows="7" placeholder="Please write your message" required></textarea>
            </div>

            <p class="text-right mb-1">
            <button type="submit" class="btn btn-lg btn-warning"> Send <i class="fas fa-paper-plane"></i> </button>
            </p>

           </form>
        </div>
        </div>

      </div>

      <div class="col-3">

      </div>

     </div>
     </div>
     </div>';


        return $this->print($content,$meta,$session);
    }


    public function create($data) {
        if (is_array($data)) {
            // check values & send
        }

        return;
    }




    public function print($content,$meta='', $session,$addjs='') {
        if (is_array($meta)) {
            $title = $meta['title'];
            $keyword = $meta['keyword'];
            $desc  = $meta['desc'];
        } else {
            $title = SITENAME;
            $keyword = KEYWORDS;
            $desc  = DESCRIPTION;
        }
        $themeheader = $this->the_header($title,$keyword,$desc,'',$session);
        $themefooter = $this->the_footer();
 
        print $themeheader;
        print '
        <div class="container-fluid page-header p-3">
        <div class="row">
          <div class="col">
            <h1> '.$title.' </h1>
          </div>
        </div>
        </div>

          '.$content.'
        ';
        print $themefooter;
    }
    
}
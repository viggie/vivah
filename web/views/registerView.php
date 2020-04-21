<?php  
/* 
 *  Register View
 */
namespace Vi\View;

require_once VIEW.'Theme.php';

class registerView extends siteView 
{
    private $val;

    public function index($data,$msg) {
        $regForm = $this->regForm();
        $session   = $data['session'];

        $alert = '';
        if($msg!='') $alert = $this->alert($msg);

        $content =  '
     
    <div class="container-fluid bg-white p-3">
    <div class="container">
    <div class="row">

      <div class="col-6 order-last">
        '.$alert.'
        <div class="card border-danger mb-3">
        <div class="card-header bg-danger text-light"> Register your Profile </div>
        <div class="card-body"> 
        '. $regForm .'
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
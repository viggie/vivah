<?php  
/* 
 * Static Pages View
 */
namespace Vi\View;

require_once VIEW.'Theme.php';

class pageView extends siteView 
{

    public function index($session) {
        // index is the about-us page here.
        $url = BASE_URL;
        $meta = array(
            'title' => 'About Us',
            'keyword' => KEYWORDS,
            'desc' => DESCRIPTION
        );
        $content =  <<<END
        <div class="container">
        <div class="row">
        <div class="col p-2">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sem lectus, varius ac sodales sit amet, tincidunt posuere nibh. Curabitur ornare nibh vitae nibh feugiat auctor. Morbi et dui metus. Duis dictum mi mauris, at tempor lectus. Aliquam sollicitudin gravida mi vel bibendum. Sed dapibus lorem ut orci vestibulum quis commodo enim porttitor. Vestibulum tincidunt rhoncus dui ac scelerisque. Maecenas id nisl ut nulla mattis posuere. Fusce sed lectus vel odio faucibus venenatis. Integer ac velit in elit tempus fringilla.</p>

        <p>Proin luctus lorem eget velit elementum cursus. Duis sagittis congue augue nec gravida. Integer pretium sagittis tincidunt. Nullam tempus, leo quis sodales vestibulum, odio est auctor ipsum, sit amet tempus dui sapien ut ipsum. Sed facilisis dapibus orci, ac rutrum dui consequat vel. Mauris consequat, lectus vel egestas tempor, dolor turpis consectetur neque, sit amet interdum enim felis sodales metus. Cras placerat velit ac nisi ornare non viverra metus viverra. Donec turpis odio, sagittis nec luctus a, sagittis non nibh. Praesent vitae sapien nunc. Nam laoreet nunc quis risus sollicitudin ultricies. Vestibulum facilisis tellus id sem ultricies cursus. Donec pellentesque risus eu neque imperdiet lacinia. In hac habitasse platea dictumst. Pellentesque a aliquam sapien. Nullam tempus, tellus et rhoncus condimentum, nisi tellus suscipit quam, at fermentum est dolor ac felis.</p>

        </div>
        </div>
        </div>
   
       
END;

        return $this->print($content,$meta,$session);
    }


    public function privacy($session) {
        $url = BASE_URL;
        $meta = array(
            'title' => 'Privacy Policy',
            'keyword' => KEYWORDS,
            'desc' => DESCRIPTION
        );
        $content =  <<<END
END;

        return $this->print($content,$meta,$session);
    }


    public function schemes($session) {
        $url = BASE_URL;
        $meta = array(
            'title' => 'Schemes &amp; Tariffs',
            'keyword' => KEYWORDS,
            'desc' => DESCRIPTION
        );
        $content =  <<<END
        
END;

        return $this->print($content,$meta,$session);
    }


   

    public function print($content,$meta='',$session,$addjs='') {
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
        $themefooter = $this->the_footer($addjs);
 
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

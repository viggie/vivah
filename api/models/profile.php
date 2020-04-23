<?php  
namespace Vi\Model;

class Profile 
{
    private $db,$user;

    function __construct($db,$uid='') {
        $this->db = $db;
        $this->db->set_charset("utf8");
        $this->user = $uid;
    }

    public function getCounts() {
        $qst = "SELECT statusid,count(*)as totall FROM seekers WHERE status='A' GROUP BY statusid";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }


    public function getActive($limit=200) {
        $qst = "SELECT p.*, e.educategory, j.jobcategory, g.religion_eng, r.rashi_eng, s.star_eng, c.name_english 
            FROM seekers as p
            LEFT JOIN param_educategory as e ON e.eduid = p.eduid
            LEFT JOIN param_jobcategory as j ON j.jobid = p.jobid
            LEFT JOIN param_religion as g ON g.religionid = p.religionid
            LEFT JOIN param_rashi as r ON r.rashiid = p.rashiid
            LEFT JOIN param_stars as s ON s.starid = p.starid
            LEFT JOIN param_communities as c ON c.commid = p.commid
            WHERE p.status = 'A' ORDER BY p.id DESC LIMIT $limit";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getAll() {
        $qst = "SELECT p.*, e.educategory, j.jobcategory, g.religion_eng, r.rashi_eng, s.star_eng, c.name_english 
            FROM seekers as p
            LEFT JOIN param_educategory as e ON e.eduid = p.eduid
            LEFT JOIN param_jobcategory as j ON j.jobid = p.jobid
            LEFT JOIN param_religion as g ON g.religionid = p.religionid
            LEFT JOIN param_rashi as r ON r.rashiid = p.rashiid
            LEFT JOIN param_stars as s ON s.starid = p.starid
            LEFT JOIN param_communities as c ON c.commid = p.commid
            ORDER BY p.id DESC";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function get($id) {
        if($id>0) {
            $qst = "SELECT p.*, TIMESTAMPDIFF(YEAR, p.dob, now()) as age,
                    e.educategory, j.jobcategory, g.religion_eng, r.rashi_eng, s.star_eng, c.name_english 
                        FROM seekers as p
                        LEFT JOIN param_educategory as e ON e.eduid = p.eduid
                        LEFT JOIN param_jobcategory as j ON j.jobid = p.jobid
                        LEFT JOIN param_religion as g ON g.religionid = p.religionid
                        LEFT JOIN param_rashi as r ON r.rashiid = p.rashiid
                        LEFT JOIN param_stars as s ON s.starid = p.starid
                        LEFT JOIN param_communities as c ON c.commid = p.commid
                        WHERE p.id='$id'";
            $res = $this->db->query($qst);
            $data = $this->change2Array($res);

            return $data;
        }

        return false;
    }

    public function getSearchResults($data) {
        if(is_array($data)) {
            $gender  = $data['gender'];
            $agefrom = $data['agefrom'];
            $ageto   = $data['ageto'];
            $commid  = $data['commid'];
            if($commid=='A') { $community = NULL; } 
            else { $community = 'AND p.commid = '.$commid; }
            $qst ="SELECT p.*, TIMESTAMPDIFF(YEAR, p.dob, CURDATE()) AS age,
                e.educategory, j.jobcategory, g.religion_eng, r.rashi_eng, s.star_eng, c.name_english FROM seekers as p
                LEFT JOIN param_educategory as e ON e.eduid = p.eduid
                LEFT JOIN param_jobcategory as j ON j.jobid = p.jobid
                LEFT JOIN param_religion as g ON g.religionid = p.religionid
                LEFT JOIN param_rashi as r ON r.rashiid = p.rashiid
                LEFT JOIN param_stars as s ON s.starid = p.starid
                LEFT JOIN param_communities as c ON c.commid = p.commid
                WHERE p.status = 'A' 
                  AND p.gender = '$gender'
                  AND TIMESTAMPDIFF(YEAR, p.dob, now()) >= $agefrom
                  AND TIMESTAMPDIFF(YEAR, p.dob, now()) <= $ageto
                  $community
                ORDER BY p.id DESC";
            $res = $this->db->query($qst);
            $data = $this->change2Array($res);

            return $data;
        }

        return false;
    }

    public function getByCommunities($id,$limit=0) {
        if($id>0) {
            $limits = '';
            if($limit>0) $limits = " LIMIT $limit";
            $qst = "SELECT p.*, e.educategory, j.jobcategory, g.religion_eng, r.rashi_eng, s.star_eng, c.name_english 
            FROM seekers as p
            LEFT JOIN param_educategory as e ON e.eduid = p.eduid
            LEFT JOIN param_jobcategory as j ON j.jobid = p.jobid
            LEFT JOIN param_religion as g ON g.religionid = p.religionid
            LEFT JOIN param_rashi as r ON r.rashiid = p.rashiid
            LEFT JOIN param_stars as s ON s.starid = p.starid
            LEFT JOIN param_communities as c ON c.commid = p.commid
            WHERE p.status = 'A' 
              AND p.commid = $id
            ORDER BY p.id DESC".$limits;
            $res = $this->db->query($qst);
            $data = $this->change2Array($res);

            return $data;
        }

        return false;
    }


    public function create($data) {
        if(is_array($data)) {
            $qst = "INSERT INTO seekers(added_by, passwd, name, gender, dob, email, mobile) 
                    VALUES ('{$data['added_by']}', '{$data['passwd']}', '{$data['name']}',
                    '{$data['gender']}', '{$data['dob']}', '{$data['email']}', '{$data['mobile']}' 
                    )";
            $this->db->query($qst);
            $id = mysqli_insert_id($this->db);

            return $id;
        }
    }

    public function edit($data, $id) {
        if(($data!='') && ($id>0)) {
            $qst = "UPDATE seekers SET ".$data." WHERE id = ".$id;
            $this->db->query($qst);
           // $this->writelog($id);

            return true;
        }

        return false;
    }

    public function reActivate($id) {
        if ($id>0) {
            $qst = "UPDATE seekers SET status='A' WHERE id = ".$id;
            $this->db->query($qst);
           // $this->writelog($id);

            return true;
        }

        return false;
    }

    public function pending($id) {
        if ($id>0) {
            $qst = "UPDATE seekers SET status='P' WHERE id = ".$id;
            $this->db->query($qst);
            return true;
        }

        return false;
    }

    public function suspend($id) {
        if ($id>0) {
            $qst = "UPDATE seekers SET status='S' WHERE id = ".$id;
            $this->db->query($qst);
           // $this->writelog($id);

            return true;
        }

        return false;
    }

    public function delete($id) {
        if ($id>0) {
            $qst = "UPDATE seekers SET status='D' WHERE id = ".$id;
            $this->db->query($qst);
          //  $this->writelog($id);

            return true;
        }

        return false;
    }

    public function addPhoto($image,$id) {
        if ($id>0) {
            $qst = "UPDATE seekers SET photo='$image' WHERE id = ".$id;
            $this->db->query($qst);
            return true;
        }
        return false;
    }

    public function removePhoto($id) {
        if ($id>0) {
            $qst = "UPDATE seekers SET picture=NULL WHERE id = ".$id;
            $this->db->query($qst);
            return true;
        }
        return false;
    }



    private function change2Array($res) {
        $data = array();
        if($res->num_rows>0) {
            while($row=$res->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    private function readlog($id) {
        if (($id>0) && ($this->user>0)) {
            $qst = "INSERT INTO user_viewlog (usrid, seekerid) 
                    VALUES ('$this->user','$id')";
            $this->db->query($qst);

            return true;
        }

        return false;
    }

}

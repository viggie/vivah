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
        $qst = "SELECT status,count(*)as totall FROM profiles GROUP BY status";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }


    public function getActive($limit=5) {
        $qst = "SELECT p.*, e.category, g.gothram, r.rashi_eng, s.star_eng, c.name_english 
            FROM profiles as p
            LEFT JOIN m_edutype as e ON e.eduid = p.eduid
            LEFT JOIN m_gothram as g ON g.gotraid = p.gothraid
            LEFT JOIN m_rashi as r ON r.rashiid = p.rashiid
            LEFT JOIN m_stars as s ON s.starid = p.starid
            LEFT JOIN m_subsect as c ON c.subsectid = p.subsectid
            WHERE p.status = 'A' ORDER BY p.id DESC LIMIT $limit";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getAll() {
        $qst = "SELECT p.*, e.category, g.gothram, r.rashi_eng, s.star_eng, c.name_english 
            FROM profiles as p
            LEFT JOIN m_edutype as e ON e.eduid = p.eduid
            LEFT JOIN m_gothram as g ON g.gotraid = p.gothraid
            LEFT JOIN m_rashi as r ON r.rashiid = p.rashiid
            LEFT JOIN m_stars as s ON s.starid = p.starid
            LEFT JOIN m_subsect as c ON c.subsectid = p.subsectid
            ORDER BY p.id DESC";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function get($id) {
        if($id>0) {
            $qst = "SELECT p.*, TIMESTAMPDIFF(YEAR, p.dob, now()) as age,
                    e.category, j.job_type, g.gothram, r.rashi_eng, s.star_eng, c.name_english 
                        FROM profiles as p
                        LEFT JOIN m_edutype as e ON e.eduid = p.eduid
                        LEFT JOIN m_jobtype as j ON j.jobid = p.jobid
                        LEFT JOIN m_gothram as g ON g.gotraid = p.gothraid
                        LEFT JOIN m_rashi as r ON r.rashiid = p.rashiid
                        LEFT JOIN m_stars as s ON s.starid = p.starid
                        LEFT JOIN m_subsect as c ON c.subsectid = p.subsectid
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
            $subsectid  = $data['subsectid'];
            if($subsectid=='A') { $subsect = NULL; } 
            else { $subsect = 'AND p.subsectid = '.$subsectid; }
            $qst ="SELECT p.*, TIMESTAMPDIFF(YEAR, p.dob, CURDATE()) AS age,
                e.category, j.job_type, g.gothram, r.rashi_eng, s.star_eng, c.name_english FROM profiles as p
                LEFT JOIN m_edutype as e ON e.eduid = p.eduid
                LEFT JOIN m_jobtype as j ON j.jobid = p.jobid
                LEFT JOIN m_gothram as g ON g.gotraid = p.gothraid
                LEFT JOIN m_rashi as r ON r.rashiid = p.rashiid
                LEFT JOIN m_stars as s ON s.starid = p.starid
                LEFT JOIN m_subsect as c ON c.subsectid = p.subsectid
                WHERE p.status = 'A' 
                  AND p.gender = '$gender'
                  AND TIMESTAMPDIFF(YEAR, p.dob, now()) >= $agefrom
                  AND TIMESTAMPDIFF(YEAR, p.dob, now()) <= $ageto
                  $subsect
                ORDER BY p.id DESC";
            $res = $this->db->query($qst);
            $data = $this->change2Array($res);

            return $data;
        }

        return false;
    }

    public function getBySubsect($id,$limit=0) {
        if($id>0) {
            $limits = '';
            if($limit>0) $limits = " LIMIT $limit";
            $qst = "SELECT p.*, e.category, g.gothram, r.rashi_eng, s.star_eng, c.name_english FROM profiles as p
            LEFT JOIN m_edutype as e ON e.eduid = p.eduid
            LEFT JOIN m_gothram as g ON g.gotraid = p.gothraid
            LEFT JOIN m_rashi as r ON r.rashiid = p.rashiid
            LEFT JOIN m_stars as s ON s.starid = p.starid
            LEFT JOIN m_subsect as c ON c.subsectid = p.subsectid
            WHERE p.status = 'A' 
              AND p.subsectid = $id
            ORDER BY p.id DESC".$limits;
            $res = $this->db->query($qst);
            $data = $this->change2Array($res);

            return $data;
        }

        return false;
    }


    public function create($data) {
        if(is_array($data)) {
            $qst = "INSERT INTO profiles(passwd, added_by, name, gender, dob, email, mobile) 
                    VALUES ('{$data['passwd']}', '{$data['added_by']}', '{$data['name']}',
                    '{$data['gender']}', '{$data['dob']}', '{$data['email']}', '{$data['mobile']}' 
                    )";
            $this->db->query($qst);
            $id = mysqli_insert_id($this->db);

            return $id;
        }
    }

    public function edit($data, $id) {
        if(($data!='') && ($id>0)) {
            $qst = "UPDATE profiles SET ".$data." WHERE id = ".$id;
            $this->db->query($qst);
           // $this->writelog($id);

            return true;
        }

        return false;
    }

    public function reActivate($id) {
        if ($id>0) {
            $qst = "UPDATE profiles SET status='A' WHERE id = ".$id;
            $this->db->query($qst);
           // $this->writelog($id);

            return true;
        }

        return false;
    }

    public function pending($id) {
        if ($id>0) {
            $qst = "UPDATE profiles SET status='P' WHERE id = ".$id;
            $this->db->query($qst);
            return true;
        }

        return false;
    }

    public function suspend($id) {
        if ($id>0) {
            $qst = "UPDATE profiles SET status='S' WHERE id = ".$id;
            $this->db->query($qst);
           // $this->writelog($id);

            return true;
        }

        return false;
    }

    public function delete($id) {
        if ($id>0) {
            $qst = "UPDATE profiles SET status='D' WHERE id = ".$id;
            $this->db->query($qst);
          //  $this->writelog($id);

            return true;
        }

        return false;
    }

    public function addPhoto($image,$id) {
        if ($id>0) {
            $qst = "UPDATE profiles SET picture='$image' WHERE id = ".$id;
            $this->db->query($qst);
            return true;
        }
        return false;
    }

    public function removePhoto($id) {
        if ($id>0) {
            $qst = "UPDATE profiles SET picture=NULL WHERE id = ".$id;
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
            $qst = "INSERT INTO zreadlog (usrid, profid) 
                    VALUES ('$this->user','$id')";
            $this->db->query($qst);

            return true;
        }

        return false;
    }

}

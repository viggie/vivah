<?php  
namespace Vi\Model;

class Master
{
    private $db;

    function __construct($db) {
        $this->db = $db;
        $this->db->set_charset("utf8");
    }

    public function getCommunities() {
        $qst = "SELECT * FROM param_communities WHERE parentid=0";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getSubCommunities($parent) {
        $qst = "SELECT * FROM param_communities WHERE parentid=".$parent;
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getStars() {
        $qst = "SELECT * FROM param_stars";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getRashis() {
        $qst = "SELECT * FROM param_rashi";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getReligions() {
        $qst = "SELECT * FROM param_religion";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getMaritalStatuses() {
        $qst = "SELECT * FROM param_mstatus";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getEduCategories() {
        $qst = "SELECT * FROM param_educategory";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getJobCategories() {
        $qst = "SELECT * FROM param_jobcategory";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
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

}

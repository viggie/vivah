<?php  
namespace Vi\Model;

class Master
{
    private $db;

    function __construct($db) {
        $this->db = $db;
        $this->db->set_charset("utf8");
    }

    public function getSubsectList() {
        $qst = "SELECT * FROM m_subsect";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getStarsList() {
        $qst = "SELECT starid, star_eng FROM m_stars";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getRashiList() {
        $qst = "SELECT rashiid, rashi_eng FROM m_rashi";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getGothramList() {
        $qst = "SELECT * FROM m_gothram";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getEduTypeList() {
        $qst = "SELECT * FROM m_edutype";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }

    public function getJobTypeList() {
        $qst = "SELECT * FROM m_jobtype";
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

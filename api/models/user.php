<?php  
namespace Vi\Model;

class UserPay
{
    private $db;

    function __construct($db) {
        $this->db = $db;
        $this->db->set_charset("utf8");
    }

    public function getPlanwiseUserCount() {
        $qst = "SELECT status,COUNT(usrid) AS cou FROM user_accounts GROUP BY status";
        $res = $this->db->query($qst);
        $data = $this->change2Array($res);

        return $data;
    }


    public function getPayData() {
        $qst = "SELECT * FROM user_paydata";
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

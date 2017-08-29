<?php

class BanRepDao {

    public function cfl($dbid, $dt0, $dtn) {

        try {

            $list = array();

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT 'Ban0' AS std, SUM(i.val) AS val FROM ban_mov i WHERE i.dt < '{$dt0->format('Y-m-d')}'";

            $sql .= " UNION";

            $sql .= "(SELECT m.std AS std, SUM(m.val) AS val FROM ban_mov m";
            $sql .= " WHERE m.dt >= '{$dt0->format('Y-m-d')}' AND m.dt <= '{$dtn->format('Y-m-d')}'";
            $sql .= " GROUP BY m.std)";

            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {

                $list[$row['std']] = round($row['val'], 2);

            }
            
            return $list;

        } catch (Exception $e) {

            throw new exception($e->getMessage());              
        }
    }
}

?>
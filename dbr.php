<?php

class BanRecDao {

    public function getList($dbid, $dt0, $dtn) {

        try {
            /*
            Warning: Select support max 9 accounts in code
            */

            $list = array();
            
            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT b.dt, b.cc, b.seq, b.hist, (SELECT SUM(-br.val) FROM rec_mov br WHERE b.dt = br.bandt AND b.cc = br.bancc AND b.seq = br.banseq AND br.std = 'RecBan') AS recbanval, b.val AS banval";
            $sql .= " FROM ban_mov b";
            $sql .= " WHERE b.dt >= '{$dt0->format('Y-m-d')}' AND b.dt <= '{$dtn->format('Y-m-d')}' AND b.std = 'BanOrx'";

            $result = $conn->query($sql);

            if (!$result) throw new Exception();

            // Set

            while($row = $result->fetch_assoc()) {

                if ($row['recbanval'] == null) $row['recbanval'] = 0;
                
                $list[] = (object) array(
                    'dt' => $row['dt'],
                    'cc' => $row['cc'],
                    'seq' => $row['seq'],
                    'hist' => $row['hist'],
                    'recbanval' => $row['recbanval'],
                    'banval' => $row['banval']
                    );
            }

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            $conn->close();
        }
    }


    public function get($dbid, $doc) {

       try {

            $data = array();
            
            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            // Query master

            $aDoc = explode('.', $doc);

            $sql = "SELECT b.hist, b.val AS banval";
            $sql .= " FROM ban_mov b";
            $sql .= " WHERE CONCAT(b.dt,'.',b.cc,'.',b.seq) = '{$doc}'";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d1');

            $row = $result->fetch_assoc();
            $data['doc'] = $doc;
            $data['dt'] = $aDoc[0];
            $data['cc'] = $aDoc[1];
            $data['seq'] = $aDoc[2];
            $data['hist'] = $row['hist'];
            $data['banval'] = $row['banval'];
            $data['list'] = array();

            // Query detail

            $sql2 = "SELECT m.reccod, rd.cpname, rds.dtdue, m.recdt, SUM(-m.val) AS recval, SUM(IF(m.std = 'RecBan', -m.val, 0)) AS banval";
            $sql2 .= " FROM rec_mov m INNER JOIN rec_docseq rds ON m.reccod = CONCAT(REPLACE(rds.doc, 'NFS', 'DM'), '.', rds.seq)";
            $sql2 .= " INNER JOIN rec_doc rd ON rd.cod = rds.doc";
            $sql2 .= " WHERE m.doc = '{$doc}' GROUP BY CONCAT(m.doc, m.reccod)";

            $result = $conn->query($sql2);
            if (!$result) throw new Exception('d2');

            while($row = $result->fetch_assoc()) {

                $data['list'][] = array(
                    'reccod' => $row['reccod'],
                    'cpname' => $row['cpname'],
                    'dtdue' => $row['dtdue'],
                    'recdt' => $row['recdt'],
                    'recval' => $row['recval'],
                    'banval' => $row['banval']
                    );
            }

            return $data;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            $conn->close();
        }
    }


    public function put($dbid, $doc, $data) {

        try {

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('db1');
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql1 = "DELETE FROM rec_mov WHERE doc = '{$doc}'";

            if (count($data)) {

                $sql2 = "INSERT INTO rec_mov ( doc, reccod, seq, bandt, bancc, banseq, std, recdt, val) VALUES";

                $i = 0;
                foreach ($data as $value) {
                    if ($i > 0) $sql2 .= ",";
                    $sql2 .= " (";
                    $sql2 .= "'{$value['doc']}'";
                    $sql2 .= ", '{$value['reccod']}'";
                    $sql2 .= ", '{$value['seq']}'";
                    $sql2 .= ", '{$value['bandt']}'";
                    $sql2 .= ", '{$value['bancc']}'";
                    $sql2 .= ", '{$value['banseq']}'";
                    $sql2 .= ", '{$value['std']}'";
                    $sql2 .= ", '{$value['recdt']}'";
                    $sql2 .= ", '{$value['val']}'";
                    $sql2 .= ")";
                    $i++;
                }                

            }

            $result = $conn->query($sql1);

            if (!$result) throw new Exception('db2a');

            if (count($data)) {

                $result = $conn->query($sql2);
                
                if (!$result) throw new Exception('db2b');
            }

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            $conn->close();
        }
    }
}

?>
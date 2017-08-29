<?php


class BanMovDao {

    public function getList($dbid, $dt0, $dtn) {

        try {

            $list = array();
            
            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "(SELECT 0 AS id, '{$dt0->format('Y-m-d')}' AS dt, 0 AS seq, 'Saldo inicial' AS hist, '' AS docto, '' AS std, '' AS stdName, NULL AS cc";
            $sql .= ", (SELECT SUM(t.val) FROM ban_mov t WHERE t.Dt < '{$dt0->format('Y-m-d')}') AS val)"; 

            $sql .= " UNION";
            
            $sql .= " (SELECT m.id, m.dt, m.seq, m.hist, m.docto, m.std, s.name AS stdName, m.cc, m.val";
            $sql .= " FROM ban_mov m";
            $sql .= " INNER JOIN ban_std s ON s.cod = m.std";
            $sql .= " WHERE m.dt >= '{$dt0->format('Y-m-d')}' AND m.dt <= '{$dtn->format('Y-m-d')}')";
            $sql .= " ORDER BY dt, seq";

            $result = $conn->query($sql);
            if (!$result) throw new exception('d2');

            // Set
            
            if ($result->num_rows == 0) return $list;

            $bal = 0;
            while($row = $result->fetch_assoc()) {
                
                $bal =+ $row['val'];

                $list[] = array(
                    'id' => $row['id'],
                    'dt' => $row['dt'],
                    'seq' => $row['seq'],
                    'hist' => $row['hist'],
                    'docto' => $row['docto'],
                    'std' => $row['std'],
                    'stdName' => $row['stdName'],
                    'bac' => $row['cc'],
                    'val' => $row['val'],
                    'bal' => $bal
                    );
            }

            return $list;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        } finally {

            $conn->close();            
        }
    }


    public function get($dbid, $id) {

        try {

            $item = new BanMov();

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT m.*, (SELECT SUM(t.val) FROM ban_mov t WHERE t.id <= $id) AS bal";
            $sql .= " FROM ban_mov m WHERE m.id='$id'";

            $result = $conn->query($sql);

            if ($result->num_rows != 1) throw new exception();

            // Set

            $row = $result->fetch_assoc();
            $item->reset();
            $item->setId($row['id']);
            $item->setDt($row['dt']);
            $item->setSeq($row['seq']);
            $item->setHist($row['hist']);
            $item->setDocto($row['docto']);
            $item->setCc($row['cc']);
            $item->setStd($row['std']);
            $item->setObs($row['obs']);
            $item->setVal(round($row['val'], 2));
            $item->setBal(round($row['bal'], 2));

            return $item;

        } catch (Exception $e) {

            //throw new exception("database");
            throw new Exception($e->getMessage());
        }
    }


    public function getLast($dbid, $acc) {

        try {

            $item = new BanMov();

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT m.*, (SELECT SUM(t.val) FROM ban_mov t WHERE t.cc <= m.cc) AS bal";
            $sql .= " FROM ban_mov m WHERE m.cc = {$acc} ORDER BY m.id DESC LIMIT 1";

            $result = $conn->query($sql);

            // If none

            if ($result->num_rows == 0) {

                $sql = "SELECT 0 AS id, dtMin AS dt, 0 AS seq, '' AS hist, '' AS docto, '' AS std, {$acc} AS cc, 0 AS val, 0 AS bal FROM config";

                $result = $conn->query($sql);
            }

            // Set

            if ($result->num_rows != 1) throw new exception();

            $row = $result->fetch_assoc();

            $item->setId($row['id']);
            $item->setDt($row['dt']);
            $item->setSeq($row['seq']);
            $item->setHist($row['hist']);
            $item->setDocto($row['docto']);
            $item->setStd($row['std']);
            $item->setCc($row['cc']);
            $item->setObs($row['obs']);
            $item->setVal(round($row['val'], 2));
            $item->setBal(round($row['bal'], 2));

            return $item;

        } catch (Exception $e) {

            //throw new exception("database");
            throw new Exception($e->getMessage());
        }
    }


    public function getByBac($dbid) {

        try {

            $list = array();

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('conn');
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT a.id, a.name, IF(a.id = 1,'Caixa',CONCAT(a.ba,'/',a.ag,'/',a.cc)) AS cod, a.active, a.obs";
            $sql .= ", (SELECT CompanyCod FROM config) AS entityCod, (SELECT m1.dt FROM ban_mov m1 WHERE m1.cc = a.id ORDER BY m1.id DESC LIMIT 1) AS lastDt";
            $sql .= ", (SELECT SUM(m2.val) FROM ban_mov m2 WHERE m2.cc = a.id) AS lastBal";
            $sql .= " FROM ban_acc a";

            $result = $conn->query($sql);

            if ($result->num_rows == 0) throw new exception('none');

            // Set

            while($row = $result->fetch_assoc()) {

                $list[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'cod' => $row['cod'],
                    'active' => $row['active'],
                    'obs' => $row['obs'],
                    'entityCod' => $row['entityCod'],
                    'lastDt' => $row['lastDt'],
                    'lastBal' => round($row['lastBal'], 2),
                );
            }

            $conn->close();

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }


    public function post($dbid, $mov) {

        /*
        Input:

        Output: True
        */

        try {

            $ok = false;

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            //  Query

            $sql = "INSERT INTO ban_mov (dt, seq, hist, docto, cc, std, obs, val) VALUES (";
            $sql .= " '{$mov->getDt()}',";
            $sql .= " '{$mov->getSeq()}',";
            $sql .= " '{$mov->getHist()}',";
            $sql .= " '{$mov->getDocto()}',";
            $sql .= " {$mov->getCc()},";
            $sql .= " '{$mov->getStd()}',";
            $sql .= " '{$mov->getObs()}',";
            $sql .= " {$mov->getVal()}";
            $sql .= ")";

            $ok = $conn->query($sql);
            if (!$ok) throw new exception('d2');

            $conn->close();

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }


    public function put($dbid, $mov) {

        try {
            
            $ok = false;

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('db41');
            mysqli_set_charset($conn,'utf8');

            //  Query

            $sql = "UPDATE ban_mov SET";
            $sql .= " dt = '{$mov->getDt()}',";
            $sql .= " hist = '{$mov->getHist()}',";
            $sql .= " docto = '{$mov->getDocto()}',";
            $sql .= " cc = {$mov->getCc()},";
            $sql .= " std = '{$mov->getStd()}',";
            $sql .= " obs = '{$mov->getObs()}',";
            $sql .= " val = {$mov->getVal()}";
            $sql .= " WHERE id = {$mov->getId()}";

            $ok = $conn->query($sql);
            if (!$ok) throw new exception('db42');

            $conn->close();

            return $ok;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }

   
   public function delete($dbid, $id) {

        try {
            
            $ok = false;

            // Connection (1)

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('db51');
            mysqli_set_charset($conn,'utf8');

            //  Query (2)

            $sql = "DELETE FROM ban_mov WHERE id = {$id}";

            $ok = $conn->query($sql);
            if (!$ok) throw new exception('db52');

            $conn->close();

            return $ok;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }


    public function getAccList($dbid) {

        try {

            $list = array();
                
            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = 'SELECT * FROM  ban_acc a';

            $result = $conn->query($sql);

            // Set

            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {

                    $item = new BanAcc();
                    $item->id = (int)$row['id'];
                    $item->name = (string)$row['name'];
                    $item->ba = (string)$row['ba'];
                    $item->ag = (string)$row['ag'];
                    $item->cc = (string)$row['cc'];
                    $item->active = (bool)$row['active'];
                    $item->obs = (string)$row['obs'];
                    $list[] = $item;
                }
            }

            $conn->close();

            return $list;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }
}

?>
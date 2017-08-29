<?php

class BanPayDao {

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

            $sql = "SELECT m.std, m.dt, m.seq, m.cpname, m.bac, m.bandoc, m.val";
            $sql .= " FROM ban_pay m";
            $sql .= " WHERE m.dt >= '{$dt0->format('Y-m-d')}' AND m.dt <= '{$dtn->format('Y-m-d')}'";

            $result = $conn->query($sql);

            if (!$result) throw new Exception('d2');

            // Set

            while($row = $result->fetch_assoc()) {

                $dt = new Datetime($row['dt']);
                $doc = 'P' . date_format($dt, 'Ymd') . '.' . $row['seq'];
                $banval = $row['bandoc'] ? $row['val'] : 0;
                
                $list[] = array(
                    'doc' => $doc,
                    'std' => $row['std'],
                    'dt' => $row['dt'],
                    'seq' => $row['seq'],
                    'cpname' => $row['cpname'],
                    'bac' => $row['bac'],
                    'banval' => $banval,
                    'val' => $row['val']
                    );
            }

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
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

            // Query

            $aDoc = explode('.', $doc);
            $dt = substr($aDoc[0], 1,4) . '-' . substr($aDoc[0], 5,2) . '-' . substr($aDoc[0], 7,2);
            $seq = $aDoc[1] * 1;

            $sql = "SELECT m.std, m.dt, m.seq, m.cpcod, m.cpname, m.bac, m.instr, m.descr, m.bandoc, m.val";
            $sql .= " FROM ban_pay m";
            $sql .= " WHERE m.dt = '{$dt}' AND m.seq = {$seq}";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2a');

            $row = $result->fetch_assoc();
            $data['doc'] = $doc;
            $data['std'] = $row['std'];
            $data['dt'] = $row['dt'];
            $data['seq'] = $row['seq'];
            $data['cpcod'] = $row['cpcod'];
            $data['cpname'] = $row['cpname'];
            $data['instr'] = $row['instr'];
            $data['descr'] = $row['descr'];
            $data['bac'] = $row['bac'];
            $data['bandoc'] = $row['bandoc'];
            $data['val'] = $row['val'];

            // Query bandocList

            $data['bandoclist'] = array($data['bandoc']);

            $sql = "SELECT CONCAT(DATE_FORMAT(m.dt, '%Y%m%d'),'.',m.cc,'.', m.seq) AS doc, m.std";
            $sql .= " FROM ban_mov m";
            $sql .= " WHERE m.val = (-{$row['val']}) AND SUBSTR(m.std, 1,6) IN ('BanOpx','BanFdx','BanIax') AND ( SELECT COUNT(*) FROM ban_pay p WHERE CONCAT(DATE_FORMAT(m.dt, '%Y%m%d'),'.',m.cc,'.', m.seq) = p.bandoc ) = 0";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2b');

            while($row = $result->fetch_assoc()) {
                
                $data['bandoclist'][] = $row['doc'];
            }

            // Query list

            $sql = "SELECT m.reccod, d.cpname, ds.colstd, ds.colinstr, m.val";
            $sql .= " FROM pay_mov m INNER JOIN pay_docseq ds ON CONCAT(ds.doc, '.', ds.seq) = m.reccod INNER JOIN pay_doc d ON ds.doc = d.cod";
            $sql .= " WHERE m.doc = '{$doc}'";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2c');

            $data['list'] = array();
            while($row = $result->fetch_assoc()) {
                
                $data['list'][] = array(
                    'reccod' => $row['reccod'],
                    'cpname' => $row['cpname'],
                    'colstd' => $row['colstd'],
                    'colinstr' => $row['colinstr'],
                    'val' => -$row['val']
                    );
            }

            return $data;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }

    public function post($dbid, $data) {

        try {
            
            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT COUNT(*) AS rows FROM ban_pay WHERE dt = '{$data['dt']}'";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2a');

            $row = $result->fetch_assoc();
            $seq = intval($row['rows']) + 1;

            $sql = "INSERT INTO ban_pay (dt, seq, std, cpcod, cpname, instr, descr, bac, bandoc, val) VALUES (";
            $sql .= " '{$data['dt']}',";
            $sql .= " {$seq},";
            $sql .= " '{$data['std']}',";
            $sql .= " '{$data['cpcod']}',";
            $sql .= " '{$data['cpname']}',";
            $sql .= " '{$data['instr']}',";
            $sql .= " '{$data['descr']}',";
            $sql .= " {$data['bac']},";
            $sql .= " '{$data['bandoc']}',";
            $sql .= " {$data['val']}";
            $sql .= ")";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2b');

            //Insert new list

            $sql = "INSERT INTO pay_mov ( doc, reccod, seq, bandt, bancc, banseq, std, recdt, val) VALUES";

            $i = 1;
            foreach ($data['list'] as $value) {

                $doc = "P" . str_replace("-", "", $data['dt']) . "." . strval($seq);

                if ($i > 1) $sql .= " ,";
                $sql .= " (";
                $sql .= " '{$doc}',";
                $sql .= " '{$value['reccod']}',";
                $sql .= " 0,";
                $sql .= " NULL,";
                $sql .= " 0,";
                $sql .= " 0,";
                $sql .= " 'PayBan',";
                $sql .= " '{$data['dt']}',";
                $sql .= " -{$value['val']}";
                $sql .= ")";

                $i++;
            }
            
            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2c');
            
            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }

    public function put($dbid, $data) {

        try {

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('db1');
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "UPDATE ban_pay SET";
            $sql .= " std = '{$data['std']}',";
            $sql .= " cpcod = '{$data['cpcod']}',";
            $sql .= " cpname = '{$data['cpname']}',";
            $sql .= " instr = '{$data['instr']}',";
            $sql .= " descr = '{$data['descr']}',";
            $sql .= " bac = {$data['bac']},";
            $sql .= " bandoc = '{$data['bandoc']}',";
            $sql .= " val = {$data['val']}";
            $sql .= " WHERE dt ='{$data['dt']}' AND seq = {$data['seq']}";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('db2a');

            $doc = "P" . str_replace("-", "", $data['dt']) . "." . strval($seq);
            
            // Delete old list

            $sql = "DELETE FROM pay_mov WHERE doc = {$doc}";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2b');

            // Insert new list

            $sql = "INSERT INTO pay_mov ( doc, reccod, seq, bandt, bancc, banseq, std, recdt, val) VALUES";

            $i = 1;
            foreach ($data['list'] as $value) {

                $doc = "P" . str_replace("-", "", $data['dt']) . "." . strval($seq);

                if ($i > 1) $sql .= " ,";
                $sql .= " (";
                $sql .= " '{$doc}',";
                $sql .= " '{$value['reccod']}',";
                $sql .= " 0,";
                $sql .= " NULL,";
                $sql .= " 0,";
                $sql .= " 0,";
                $sql .= " 'PayBan',";
                $sql .= " '{$data['dt']}',";
                $sql .= " -{$value['val']}";
                $sql .= ")";

                $i++;
            }
            
            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2c');

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }

    public function delete($dbid, $dt, $seq) {

        try {

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('db1');
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "DELETE FROM ban_pay";
            $sql .= " WHERE dt ='{$dt}' AND seq = {$seq}";

            $result = $conn->query($sql);

            if (mysql_affected_rows() != 1) throw new Exception('db2');

            //if (!$result) throw new Exception('db2');

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }

    // Other

    public function getBanCodList($dbid, $val) {

        try {

            $list = array();
            
            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT CONCAT(DATE_FORMAT(m.dt, '%Y%m%d'),'.',m.cc,'.', m.seq) AS doc, m.std";
            $sql .= " FROM ban_mov m";
            $sql .= " WHERE m.val = (-$val) AND SUBSTR(m.std, 1,6) IN ('BanOpx','BanFdx','BanIax') AND ( SELECT COUNT(*) FROM ban_pay p WHERE CONCAT(DATE_FORMAT(m.dt, '%Y%m%d'),'.',m.cc,'.', m.seq) = p.bandoc ) = 0 ";

            $result = $conn->query($sql);

            if (!$result) throw new Exception('d2');

            // Set

            while($row = $result->fetch_assoc()) {
                
                $list[] = $row['doc'];
            }

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }

    public function getBanPayItemByRecCod($dbid, $reccod) {
        
        try {
           
            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT CONCAT(ds.doc,'.',ds.seq) AS reccod, d.cpname, ds.colstd, ds.colinstr, ds.val";
            $sql .= " FROM pay_docseq ds INNER JOIN pay_doc d ON d.cod = ds.doc";
            $sql .= " WHERE CONCAT(ds.doc,'.',ds.seq) = '{$reccod}'";

            $result = $conn->query($sql);

            if (!$result) throw new Exception('d2');

            // Set

            $row = $result->fetch_assoc();

            $data = array(
                'reccod' => $row['reccod'],
                'cpname' => $row['cpname'],
                'colstd' => $row['colstd'],
                'colinstr' => $row['colinstr'],
                'val' => $row['val']
                );

            return $data;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }
}

?>

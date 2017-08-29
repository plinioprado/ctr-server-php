<?php


class RecInsDao {
    
    public function getList($dbid, $dc, $dt0, $dtn) {

        try {

            $list = array();

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            // Query

            if ($dc == '1') $table = 'rec_doc'; else $table = 'pay_doc';

            $sql = "SELECT cod, cpcod, cpname, dt, val";
            $sql .= " FROM {$table}";
            $sql .= " WHERE dt >= '{$dt0->format('Y-m-d')}' AND dt <= '{$dtn->format('Y-m-d')}' ORDER BY dt, cod";

            $result = $conn->query($sql);

            // Set

            if ($result->num_rows == 0) return $list;

            while($row = $result->fetch_assoc()) {
                
                $list[] = array(
                    'cod' => $row['cod'],
                    'cpcod' => $row['cpcod'],
                    'cpname' => $row['cpname'],
                    'dt' => $row['dt'],
                    'val' => $row['val']
                    );
            }

            return $list;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        } finally {

            $conn->close();
        }
    }


    public function get($dbid, $dc, $doc) {

        try {

            $data = array();

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            // Query master

            if ($dc == '1') $table = 'rec_doc'; else $table = 'pay_doc';

            $sql = "SELECT cod, cpcod, cpname, dt, val, std, doctxt";
            $sql .= " FROM {$table} WHERE cod = '{$doc}'";

            $result = $conn->query($sql);

            if ($result->num_rows != 1) return $data;

            $row = $result->fetch_assoc();

            $data = array(
                'cod' => $row['cod'],
                'cpcod' => $row['cpcod'],
                'cpname' => $row['cpname'],
                'dt' => $row['dt'],
                'val' => (double)$row['val'],
                'std' => $row['std'],
                'doctxt' => htmlspecialchars_decode($row['doctxt']),
                'list' => array()
                );

            // Query list

            if ($dc == '1') $table = 'rec_docseq'; else $table = 'pay_docseq';

            $sql = "SELECT ds.seq, ds.dtdue, ds.val";
            $sql .= " FROM {$table} ds WHERE ds.doc = '{$doc}'";
          
            $result = $conn->query($sql);
            if ($result->num_rows == 0) throw new exception('noseq');

            while($row = $result->fetch_assoc()) {
                $data['list'][] = array(
                    'seq' => (int)$row['seq'],
                    'dtdue' => $row['dtdue'],
                    'val' => (double)$row['val']
                    );
            }       

            return $data;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }


    public function post($dbid, $dc, $input) {

        try {

            $ok = false;

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            //  Query

            if ($dc == '1') $table = 'rec_doc'; else $table = 'pay_doc';

            $doctxt = htmlspecialchars($input['doctxt']);

            $sql = "INSERT INTO {$table} (cod, cpcod, cpname, dt, val, std, doctxt) VALUES (";
            $sql .= " '{$input['cod']}',";
            $sql .= " '{$input['cpcod']}',";
            $sql .= " '{$input['cpname']}',";
            $sql .= " '{$input['dt']}',";
            $sql .= " {$input['val']},";
            $sql .= " '{$input['std']}',";
            $sql .= " '{$doctxt}'";
            $sql .= ")";

            throw new Exception($sql);

            $ok = $conn->query($sql);
            if (!$ok) throw new Exception('d2a');

            if ($dc == '1') $table = 'rec_docseq'; else $table = 'pay_docseq';

            foreach ($input['list'] as $seq) {

                $sql = "INSERT INTO {$table} (doc, seq, dtdue, val) VALUES (";
                $sql .= " '{$input['cod']}',";            
                $sql .= " {$seq['seq']},";
                $sql .= " '{$seq['dtdue']}',";
                $sql .= " {$seq['val']}";
                $sql .= ")";
                
                $ok = $conn->query($sql);
                if (!$ok) throw new Exception('d2b');
            }

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }


    public function put($dbid, $dc, $input) {

        try {

            $ok = false;

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            //  Query

            if ($dc == '1') $table = 'rec_doc'; else $table = 'pay_doc';

            $doctxt = htmlspecialchars($input['doctxt']);

            $sql = "UPDATE {$table} SET";
            $sql .= " cpcod = '{$input['cpcod']}',";
            $sql .= " cpname = '{$input['cpname']}',";
            $sql .= " dt = '{$input['dt']}',";
            $sql .= " val = {$input['val']},";
            $sql .= " std = '{$input['std']}',";
            $sql .= " doctxt = '{$doctxt}'";
            $sql .= " WHERE cod = '{$input['cod']}'";

            $ok = $conn->query($sql);
            if (!$ok) throw new Exception('d2a');

            if ($dc == '1') $table = 'rec_docseq'; else $table = 'pay_docseq';

            // Delet old seqs

            $sql = "DELETE FROM {$table} WHERE doc = '{$input['cod']}'";

            $ok = $conn->query($sql);
            if (!$ok) throw new Exception('d2b');

            // Insert new seqs

            $sql = "INSERT INTO {$table} (doc, seq, dtdue, val) VALUES";

            $countSeq = count($input['list']);
            for ($i = 0; $i < $countSeq; $i++) {
                
                $seq = $input['list'][$i];
                $seqNum = $i+1;

                if ($i > 0) $sql .= ",";
                $sql .= " (";
                $sql .= " '{$input['cod']}',";            
                $sql .= " {$seq['seq']},";
                $sql .= " '{$seq['dtdue']}',";
                $sql .= " {$seq['val']}";
                $sql .= ")";
            }

            $ok = $conn->query($sql);
            if (!$ok) throw new Exception('d2c');

            return true;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }


   public function delete($dbid, $cod) {

        try {
            
            $ok = false;

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            //  Query
            if ($dc == '1') $table = 'rec_doc'; else $table = 'pay_doc';

            $sql = "DELETE FROM {$table} WHERE cod = '{$cod}'";

            $ok = $conn->query($sql);
            if (!ok) throw new exception();

            if ($dc == '1') $table = 'rec_docseq'; else $table = 'pay_docseq';

            $sql = "DELETE FROM {$table} WHERE doc = '{$cod}'";

            $ok = $conn->query();
            if (!$ok) throw new exception('d2');

            return $ok;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        } finally {

            if ($conn) $conn->close();
        }
    }


}

?>
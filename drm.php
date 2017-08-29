<?php

class RecMovDao {

    public function getList($dbid, $dc, $dt0, $dtn, $dtParam, $status) {

        try {

            $list = array();
            
            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            // Query

            if ($dc == '1') {
                $tablemov = 'rec_mov';
                $tabledoc = 'rec_doc';
                $tableseq = 'rec_docseq';
            } else {
                $tablemov = 'pay_mov';
                $tabledoc = 'pay_doc';
                $tableseq = 'pay_docseq';
            }

            $sql = "SELECT CONCAT(REPLACE(ds.doc, 'NFS', 'DM'), '.', ds.seq) AS cod, d.cpcod, d.cpname, d.dt, ds.dtdue, ds.val";
            $sql .= ", (SELECT SUM(-br.val) FROM {$tablemov} br WHERE br.reccod = CONCAT(REPLACE(ds.doc, 'NFS', 'DM'), '.', ds.seq)) AS banval";
            $sql .= " FROM {$tableseq} ds";
            $sql .= " INNER JOIN {$tabledoc} d ON ds.doc = d.cod";
            if ($dtParam == 'dt') {
                $sql .= " WHERE d.dt >= '{$dt0}' AND d.dt <= '{$dtn}' ORDER BY d.dt, ds.doc";
            } else {
                $sql .= " WHERE ds.dtdue >= '{$dt0}' AND ds.dtdue <= '{$dtn}' ORDER BY ds.dtdue, CONCAT(REPLACE(ds.doc, 'NFS', 'DM'), '.', ds.seq)";
            }

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2');

            // Set

            while($row = $result->fetch_assoc()) {

                $bal = round($row['val'] - $row['banval'], 2);

                
                if (($status == '1' and $bal == 0 ) or ($status == '2' and $bal != 0 )) continue;
               
                $list[] = array(
                    'cod' => $row['cod'],
                    'cpcod' => $row['cpcod'],
                    'cpname' => $row['cpname'],
                    'dt' => $row['dt'],
                    'dtdue' => $row['dtdue'],
                    'val' => round($row['val'], 2),
                    'bal' => $bal
                    );
            }

            $conn->close();

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
            //throw new exception("database");
        }
    }

    public function get($dbid, $dc, $cod) {

       try {

            $data = array();
           
            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            // Query

            if ($dc == '1') {
                $tablemov = 'rec_mov';
                $tabledoc = 'rec_doc';
                $tableseq = 'rec_docseq';
            } else {
                $tablemov = 'pay_mov';
                $tabledoc = 'pay_doc';
                $tableseq = 'pay_docseq';
            }

            $sql = "SELECT CONCAT(REPLACE(ds.doc, 'NFS', 'DM'), '.', ds.seq) AS codrec, 'Venda' AS docstdname, ds.dtdue, d.cpcod, d.cpname, d.doctxt AS instxt, d.dt AS dtrec, 'RecIns' AS std, ds.doc AS docto, ds.val, ds.colstd, ds.colinstr";
            $sql .= " FROM {$tableseq} ds INNER JOIN {$tabledoc} d ON d.cod = ds.doc";
            $sql .= " WHERE CONCAT(REPLACE(ds.doc, 'NFS', 'DM'), '.', ds.seq) = '{$cod}'";
            $sql .= " UNION (";
            $sql .= " SELECT '' AS codrec, '' AS docstdname, '' AS dtdue, '' AS cpcod, '' AS cpname, '' AS instxt, m.recdt AS dtrec, m.std, m.doc AS docto, m.val, '' AS colstd, '' AS colinstr";
            $sql .= " FROM {$tablemov} m WHERE m.reccod = '{$cod}' ORDER BY m.recdt, m.bandt, m.bancc, m.banseq";           
            $sql .= ")";

            $result = $conn->query($sql);

            // Get

            if (!$result) throw new Exception('d2');

            if ($result->num_rows > 0) {

                $i = 0;
                while($row = $result->fetch_assoc()) {

                    // Master (receivable) only in the first row

                    if ($i == 0) {

                        if (substr($row['codrec'], 0,2) == 'DM') {
                            $arr = explode(";", $row['instxt']);
                            $instxt = $arr[52];                       
                        } else {
                            $instxt = '';
                        }

                        $data['codrec'] = $row['codrec'];
                        $data['docstdname'] = $row['docstdname'];
                        $data['dtdue'] = $row['dtdue'];
                        $data['cpcod'] = $row['cpcod'];
                        $data['cpname'] = $row['cpname'];
                        $data['colstd'] = $row['colstd'];
                        $data['colinstr'] = $row['colinstr'];
                        $data['instxt'] = $instxt;
                        $data['list'] = array();
                    }

                    // Detail (movs) in all rows

                    $data['list'][] = array(
                        'seq' => $row['seq'],
                        'dtrec' => $row['dtrec'],
                        'std' => $row['std'],
                        'docto' => $row['docto'],
                        'val' => $row['val']
                        );

                    $i++;
                }

            } else {
                
                throw new Exception('no seq');
            }
            
            return $data;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            $conn->close();
        }
    }

    public function put($dbid, $dc, $input) {

        try {

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception('d1');
            mysqli_set_charset($conn,'utf8');

            $codrec = $input['codrec'];

            // Get

            if ($dc == '1') {
                $tablemov = 'rec_mov';
                $tableseq = 'rec_docseq';
            } else {
                $tablemov = 'pay_mov';
                $tableseq = 'pay_docseq';
            }

            $sql = "UPDATE {$tableseq} SET dtdue = '{$input['dtdue']}', colstd = '{$input['colstd']}', colinstr = '{$input['colinstr']}'";
            $sql .= " WHERE CONCAT(REPLACE(doc, 'NFS', 'DM'), '.', seq) = '{$codrec}'";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2a');

            $std = $input['std'];

            $sql = "DELETE FROM {$tablemov} WHERE reccod = '{$codrec}' AND std IN ('RecAdd','RecSub','RecRei') AND SUBSTRING(doc, 1) <> '2'";

            $result = $conn->query($sql);
            if (!$result) throw new Exception('d2b');


            //doc reccod  seq bandt   bancc   banseq  std recdt   val

            if (count($input['list'])) {

                $sql = "INSERT INTO {$tablemov} (doc, reccod, seq, bandt, bancc, banseq, std, recdt, val) VALUES";

                $i = 0;
                foreach ($input['list'] as $value) {
                    
                    if ($i > 0) $sql .= ",";
                    $sql .= " (";
                    $sql .= " '{$value['doc']}'";
                    $sql .= ", '{$value['reccod']}'";
                    $sql .= ", {$value['seq']}";
                    $sql .= ", '{$value['bandt']}'";
                    $sql .= ", '{$value['bancc']}'";
                    $sql .= ", {$value['banseq']}";
                    $sql .= ", '{$value['std']}'";
                    $sql .= ", '{$value['recdt']}'";
                    $sql .= ", {$value['val']}";
                    $sql .= ")";
                    $i++;
                }

                $result = $conn->query($sql);
                if (!$result) throw new Exception('d2c');

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
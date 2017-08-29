<?php

class MntAuditDao {

    public function getList() {

        try {

            $list = array();

            // Dependencies

            require_once('d.php');
            $dao = new Dao();

            // Get

            $dbList = $dao->getDbList();

            foreach ($dbList as $key => $value) {

                $list[$key] =  $value['dbdescr'];
            }

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function get($id) {

        try {

            // Dependencies

            require_once('dl.php');
            $obj = new Dao();

            // Connection

            $dbList = $obj->getDbList();

            $db = $dbList = $obj->getDb(1);

            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            $db = $dbList = $obj->getDb($id);

            $err = 0;
            $txt = "Abrindo db " . $db['dbdescr'] . "<br>";

            $conn2 = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn2->connect_error) throw new exception();
            mysqli_set_charset($conn2,'utf8');

            // Show tables

            $txt .= "Verificando tabelas<br>";

            $sql = "SHOW TABLES";

            $result = $conn->query($sql);
            $tables = array();
            while($row = $result->fetch_row()) {
                $tables[] = $row[0];
            }

            $result2 = $conn2->query($sql);
            $tables2 = array();
            while($row2 = $result2->fetch_row()) {
                $tables2[] = $row2[0];
            }

            foreach ($tables as $tab) {

                if (!in_array($tab, $tables2)) {

                    $err++;
                    $txt .= "falta tabela {$tab}<br>";
                }  else {

                    $sql = "SHOW COLUMNS FROM {$tab}";
                    $result = $conn->query($sql);
                    $fields = array();
                    while($row = $result->fetch_row()) {
                        $fields[] = $row[0];
                    }

                    $result2 = $conn2->query($sql);
                    $fields2 = array();
                    while($row = $result2->fetch_row()) {
                        $fields2[] = $row[0];
                    }

                    if ($fields != $fields2) {

                        $err++;
                        $txt .= "campo diferente em {$tab}<br>";
                    }
                }
            }

            $txt .= "{$err} diferença(s)";

            return $txt;
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }  
}

?>
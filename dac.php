<?php

class ConfigDao {

    public function get($dbid) {

        try {

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT * FROM config";

            $result = $conn->query($sql);

            // Get

            $row = $result->fetch_assoc();

            $data = array();
            foreach ($row as $key => $value) {
                $data[$key] = $value;
            }

            return $data;
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } finally {

            $conn->close();
        }
    }
}


?>
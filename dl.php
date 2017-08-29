<?php

class LoginDao {

    public function login($user, $pass, $dbid) {

        try {

            // Connection

            $dao = new Dao();
            $db = $dao->getDb($dbid);
            $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
            if ($conn->connect_error) throw new exception();
            mysqli_set_charset($conn,'utf8');

            // Query

            $sql = "SELECT u.Name AS userName, u.Std AS userStd, u.Active AS userActive, c.CompanyCod AS companyCod, c.CompanyFullName AS companyFullName, c.DtMin AS dtMin, c.DtMax AS dtMax FROM users u, config c WHERE u.Email = '{$user}' AND u.Pass = '{$pass}'";

            $result = $conn->query($sql);

            if ( !$result ) throw new exception("database error");
            if ( $result->num_rows > 1 ) throw new exception("database");
            if ( $result->num_rows == 0 ) throw new exception("invalid login");

            while($row = $result->fetch_assoc()) {

                if ($row['userActive'] != "Sim") throw new exception("inactive user");
                
                $obj = new stdClass();
                $obj->userName = $row['userName'];
                $obj->userStd = $row['userStd'];
                $obj->companyCod = $row['companyCod'];
                $obj->companyFullName = $row['companyFullName'];
                $obj->dtMin = $row['dtMin'];
                $obj->dtMax = $row['dtMax'];
                $obj->token = $token;

                $list[] = $obj;

            }

            $sql = "SELECT id, name, ba, ag, cc, active, obs FROM ban_acc ORDER BY id";
            if ( !$result or $result->num_rows == 0) throw new exception("database");

            $result = $conn->query($sql);

            $obj->accList = array();
            while($row = $result->fetch_assoc()) {

                if ($row['id'] == 1) {
                    $cod = 'Caixa';
                } else {
                    $cod = $row['ba'].'/'.$row['ag'].'/'.$row['cc'];
                }

                $obj->accList[] = (object) array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'cod' => $cod,
                    'active' => $row['active'],
                    'obs' => $row['obs']
                    );
            }

            $sql = "SELECT cod, name, active FROM ban_std ORDER BY IF(cod = 'BanOni', 1, 2), name";
            $result = $conn->query($sql);            
            if ( !$result or $result->num_rows == 0) throw new exception("database");

            $obj->stdList = array();
            while($row = $result->fetch_assoc()) {

                $obj->stdList[] = (object) array(
                    'cod' => $row['cod'],
                    'name' => $row['name'],
                    'active' => $row['active']
                    );
            }

            $conn->close();

            return $list;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }


    public function getDb($id) {

        try {

            $dbList = $this->getDbList();
            $db = $dbList[$id];

            if (count($db) != 5) throw new exception('db');

            return $dbList[$id];

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }
}

?>
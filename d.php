<?php

class Dao {

    function getUsrByUser($user) {

        $usr = array();

        $list = $this->getUsrList();
        foreach ($list as $value) {
            if ($value['user'] == $user) {
                $usr = $value;
                break;
            }
        }

        return $usr;
    }

    function getDbIdByToken($token) {

        $usr = array();

        $list = $this->getUsrList();
        foreach ($list as $value) {
            if ($value['token'] == $token) {
                $usr = $value;
                break;
            }
        }

        return $usr['dbid'];
    }


    function getUsrList() {

        $list = array(
            array('user' => 'joao@exemplo.com.br', 'token' => '35544332211', 'dbid' => 3),
            array('user' => 'maria@exemplo.com.br', 'token' => '35544332211', 'dbid' => 3),
        );

        return $list;
    }


    public function getDb($dbib) {

        $db = array();

        $list = $this->getDbList();

        $db = $list[$dbib];

        return $db;
    }


    public function getDbList() {

        $data = array(

            3 => array(
                'dbdescr' => 'xxxxxx',
                'dbname' => 'xxxxxx',
                'servername' => 'xxxxxx',
                'username' => 'xxxxxx',
                'password' => 'xxxxxx'
                )
            ); 

        return $data;
    }
}

?>
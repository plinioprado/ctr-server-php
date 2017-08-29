<?php

class RecMovItem {
    /*
    Move in DocRecSeq, serviced by:
        BanRec when 'std' = 'RecBan'
        RecMov when 'std' = 'RecIns' (virtual and readonly), 'RecBan' (readonly), 'RecAdd', 'RecSub' or 'RecRei'
    */

    public $doc; // Mover document (first part of primay index):
    public $codRec; // Receivable (second part of primay index)
    public $dt; // Date
    public $val; // Value
    public $std; // Stantard
    public $acc; // Bank account id when std = 'RecBan':
}

class Bas {

    public function test_dtStr($str) {

        try {

            $pattern = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
            if (!preg_match($pattern, $str)) throw new exception();

            $dt = date_create($str);
            if (!$dt) throw new exception();

            return $dt;

        } catch (Exception $e) {

            throw new exception('invalid date');
        }
    }


    public function test_email($email) {

        try {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new exception();

            return true;

        } catch (Exception $e) {

            throw new exception("invalid email");
        }
    }


    public function test_id($id) {

        try {

            $pattern = "/^[0-9]{1,6}$/";
            if (!preg_match($pattern, $id)) throw new exception();

            return true;

        } catch (Exception $e) {

            throw new exception("invalid id");
        }
    }

    
    public function test_pass($pass) {

        try {

            $pattern = "/^[0-9A-Za-z#]{5,30}$/";
            if (!preg_match($pattern, $pass)) throw new exception();

            return true;

        } catch (Exception $e) {

            throw new exception('invalid pass');
        }

    }


    public function test_user($user) {

        try {

            $this->test_email($user);

            return true;

        } catch (Exception $e) {

            throw new exception('invalid user');
        }
    }
}


function getUsrByUser($user) {

    $dao = new Dao();

    $usr = $dao->getUsrByUser($user);

    return $usr;

}


function getDbIdByToken($token) {

    $dao = new Dao();

    $dbid = $dao->getDbIdByToken($token);

    return $dbid;

}

function testDtStr($str) {

    try {

        $pattern = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
        if (!preg_match($pattern, $str)) throw new exception();

        $dt = date_create($str);
        if (!$dt) throw new exception();

        return $dt;

    } catch (Exception $e) {

        throw new exception('invalid date');
    }
}


?>
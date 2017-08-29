<?php

class BanRec {

    public $doc;
    public $dt;
    public $cc;
    public $seq;
    public $std = 'RecBan';
    public $list = array();

    /*
    Just Ref
        accCod
        banval
        hist
        srv
        token
    */


    public function set($input) {

        // From Uil

        $this->doc = $input['dt'] . '.' . $input['cc'] . '.'. $input['seq'];
        $this->dt = $input['dt']; //"2016-09-06"
        $this->cc = $input['cc']; // "2"
        $this->seq = $input['seq']; //"1"
        $this->std = 'RecBan';
        $this->list = array();

        foreach ($input['list'] as $value) {
            $this->list[] = array(
                'cpname' => $value['cpname'],
                'dtdue' => $value['dtdue'],
                'reccod' => $value['reccod'], // ok
                'recdt' => $value['recdt'],
                'recval' => $value['recval'],
                'banval' => $value['banval']
                );
        }
    }


    public function get() {

        //From Bll to Dal

        $data = array();

        foreach ($this->list as $value) {

            $data[] = array(
                'doc' => $this->doc,
                'reccod' => $value['reccod'],
                'seq' => 1,
                'bandt' => $this->dt,
                'bancc' => $this->cc,
                'banseq' => $this->seq,
                'std' => 'RecBan',
                'recdt' => $value['recdt'],
                'val' => -$value['banval'],
                );

            if ($value['banval'] != $value['recval']) {

                $std = ($value['banval'] > $value['recval']) ? 'RecAdd' : 'RecSub';

                $data[] = array(
                    'doc' => $this->doc,
                    'reccod' => $value['reccod'],
                    'seq' => 2,
                    'bandt' => $this->dt,
                    'bancc' => $this->cc,
                    'banseq' => $this->seq,
                    'std' => $std,
                    'recdt' => $value['recdt'],
                    'val' => $value['banval'] - $value['recval'],
                    );

            }
        }

        return $data;
    }
}


class BanRecService {

    public function getList($dbid, $dt0, $dtn) {

        /*
        Input: token and date range (string format 'yyyy-MM-dd')

        Output: Array of mov data arrays, each one:
            array(
                'cod' => '',
                'seq' => 0,
                'codrec' => '',
                'codban' => '',
                'cpcod' => '',
                'cpname' => '',
                'dtdue' => '',
                'dtrec' => '',
                'deban' => '',
                'cc' => 0,
                'ccr' => 0,
                'val' => 0,
                'valban' => 0
                );

            'dt' will be 'yyyy-MM-dd'
        */

        try {

            // Dependencies

            $blo = new Bas();
            $dao = new BanRecDao();

            // Test

            if (!$dbid or !is_int($dbid)) throw new Exception('db');
            $dt0 = $blo->test_dtStr($dt0);
            $dtn = $blo->test_dtStr($dtn);

            // Get

            $list = $dao->getList($dbid, $dt0, $dtn);

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }


    public function get($dbid, $doc) {     

        /*
        Input:
            token: string
            cod [(string yyyymmdd)date].[(int)cc].[(int)seq]

        Output:
            Array [
                cod,
                dt,
                acc,
                seq,
                hist,
                val,
                token,
                srv,
                list = [
                    reccod,
                    cpname,
                    recdue,
                    recdt,
                    recval,
                    banval
                    ]
                ]
        */

        try {

            // Dependencies
            $dao = new BanRecDao();

            // Tests

            if (!$dbid or !is_numeric($dbid)) throw new Exception('db');
            $this->testDoc($doc);

            // Get

            $data = $dao->get($dbid, $doc);

            return $data;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }


    public function put($input) {

        try {

            // Dependencies

            $mov = new BanRec();
            $dao = new BanRecDao();

            // Tests

            if (!$input['dbid'] or !is_numeric($input['dbid'])) throw new Exception('db');
            $this->test($input);
            $mov->set($input);
            $data = $mov->get();

            // Put

            $data = $dao->put($input['dbid'], $mov->doc, $data);

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }


    public function test($input) {

        // From Uil

        try {

            $this->testDt($input['dt']);
            if (!preg_match("/^[0-9]{1,2}$/", $input['cc'])) throw new exception("invalid cc");
            if (!preg_match("/^[0-9]{1,2}$/", $input['seq'])) throw new exception("invalid seq");

            $i = 1;
            foreach ($input['list'] as $value) {

                if (!$value['cpname']) throw new exception('invalid cpname [{$i}]');
                $this->testDt($value['dtdue'], $key);
                if (!preg_match("/^[A-Z]{1,3}[0-9.\/]{1,15}.[0-2]{1,10}$/", $value['reccod'])) throw new exception("invalid reccod [{$i}]");
                if (!preg_match("/^[0-9]{1,12}[.]{0,1}[0-9]{0,2}$/", $value['recval'])) throw new exception('invalid recval [{$i}]');
                if (!preg_match("/^[0-9]{1,12}[.]{0,1}[0-9]{0,2}$/", $value['banval'])) throw new exception('invalid banval [{$i}]');
                $i++;
            }            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function testDoc($doc) {
        if (!preg_match("/^[a-zA-Z0-9.\/-]{1,30}$/", $doc)) throw new exception("invalid doc");            
    }

    public function testDt($str, $i = null) {
        try {
            if (!preg_match("/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/", $str)) throw new exception();
            $dt = date_create($str);
            if (!$dt) throw new exception();
        } catch (Exception $e) {
            if ($i === null) throw new exception('invalid date');
            else throw new exception('invalid date [{$i}]');
        }
    }

}


?>
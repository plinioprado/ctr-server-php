<?php

class BanPay {

    private $doc;
    private $std;
    private $dt;
    private $seq;
    private $cpcod;
    private $cpname;
    private $instr;
    private $descr;
    private $bac;
    private $bandoc;
    private $val;
    private $list = array();

    public function set($input) {

        $this->doc = $input['doc'];
        $this->std = $input['std'];
        $this->dt = $input['dt'];
        $this->seq = $input['seq'];
        $this->cpcod = $input['cpcod'];
        $this->cpname = $input['cpname'];
        $this->instr = $input['instr'];
        $this->descr = $input['descr'];
        $this->bac = $input['bac'];
        $this->bandoc = $input['bandoc'];
        $this->val = $input['val'];
        $this->list = $input['list'];
    }

    public function get() {

        $data = array(
            'doc'=>$this->doc,
            'std'=>$this->std,
            'dt'=>$this->dt,
            'seq'=>$this->seq,
            'cpcod'=>$this->cpcod,
            'cpname'=>$this->cpname,
            'instr'=>$this->instr,
            'descr'=>$this->descr,
            'bac'=>$this->bac,
            'bandoc'=>$this->bandoc,
            'val'=>$this->val,
            'list'=>$this->list
        );

        return $data;
    }
}

class BanPayService {

    //******
    // Rest
    //******
    
    public function getList($dbid, $dt0, $dtn) {

       try {

            // Dependencies

            $blo = new Bas();
            $dao = new BanPayDao();

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

        try {

            // Dependencies
            $dao = new BanPayDao();

            // Tests

            if (!$dbid or !is_numeric($dbid)) throw new Exception('db');
            $this->testDoc($doc);

            // Get

            if ($doc == '0') {

                date_default_timezone_set('America/Sao_Paulo');
                $dt = date('Y-m-d');

                $data = array(
                    'doc' => $doc,
                    'std' => 'TR',
                    'dt' => $dt,
                    'seq' => 0,
                    'cpcod' => '',
                    'cpname' => '',
                    'instr' => '',
                    'descr' => '',
                    'bac' => '2',
                    'bandoc' => '',
                    'val' => 0,
                    'list' => array()
                    );
            } else {
                $data = $dao->get($dbid, $doc);
            }
            
            $data['stdList'] = $this->getStdList();

            return $data;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function post($input) {

        try {

            // Dependencies

            $mov = new BanPay();
            $dao = new BanPayDao();

            // Tests

            if (!$input['dbid'] or !is_numeric($input['dbid'])) throw new Exception('db');
            $this->test($input);
            $mov->set($input);
            $data = $mov->get();

            // Put

            $data = $dao->post($input['dbid'], $data);

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function put($input) {

        try {

            // Dependencies

            $mov = new BanPay();
            $dao = new BanPayDao();

            // Tests

            if (!$input['dbid'] or !is_numeric($input['dbid'])) throw new Exception('db');
            $this->test($input);
            $mov->set($input);
            $data = $mov->get();

            // Put

            $data = $dao->put($input['dbid'], $data);

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function delete($input) {

        try {

            // Dependencies

            $mov = new BanPay();
            $dao = new BanPayDao();

            // Tests

            if (!$input['dbid'] or !is_numeric($input['dbid'])) throw new Exception('db');
            $this->testDt($input['dt']);
            $this->testSeq($input['seq']);

            // Put

            $data = $dao->delete($input['dbid'], $input['dt'], $input['seq']);

            if ($data != true) throw new Exception('Failed');

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    private function test($input) {
        $this->testStd($input['std']);
        $this->testDt($input['dt']);
        $this->testSeq($input['seq']);
        $this->testCpcod($input['cpCod']);
        $this->testCpname($input['cpName']);
        $this->testInstr($input['instr']);
        $this->testDescr($input['descr']);
        $this->testBac($input['bac']);
        $this->testBandoc($input['banDoc']);
        $this->testVal($input['val']);
    }

    //*******
    // Tests
    //*******

    public function testDoc($doc) {
        if (!preg_match("/^[a-zA-Z0-9.\/-]{1,30}$/", $doc)) throw new exception("invalid doc");
    }

    private function testStd($std) {}

    private function testDt($dt) {
        testDtStr($dt);
    }

    private function testSeq($seq) {
        try {
            if (!$seq) $seq = 0;
            if (!preg_match("/^[0-9]{1,3}$/", $seq)) throw new exception("invalid seq");     
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function testCpcod($cpCod) {}

    private function testCpname($cpName) {}

    private function testInstr($instr) {}

    private function testDescr($descr) {}

    private function testBac($bac) {
        try {
            if (!preg_match("/^[0-9]{1,3}$/", $bac)) throw new exception("invalid bac");
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function testBandoc($banDoc) {

    }

    private function testVal($val) {
        try {
            if (!$val) throw new exception("invalid val");
            if (!preg_match("/^[0-9]{1,15}[.]{0,1}[0-9]{0,2}$/", $val)) throw new exception("invalid val");     
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //********
    // Others
    //********

    public function getStdList() {

        return array(
            ['cod'=>'TR', 'name'=>'Transf.'],
            ['cod'=>'BL', 'name'=>'Boleto'],
            ['cod'=>'DB', 'name'=>'Db.auto.'],
            ['cod'=>'CH', 'name'=>'Cheque'],
            ['cod'=>'DN', 'name'=>'Dinheiro']
            );
    }

    public function getBanCodList($dbid, $val) {

       try {

            // Dependencies

            $dao = new BanPayDao();

            // Test

            if (!$dbid or !is_int($dbid)) throw new Exception('db');

            // Get

            $list = $dao->getBanCodList($dbid, $val);

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function getBanPayItemByRecCod($dbid, $reccod) {

        try {

            /*
            Return

            $data = array(
                'reccod' => '',
                'cpname' => '',
                'colstd' => '',
                'colinstr' => '',
                'val' => 0
                );
            */

            // Dependencies

            $dao = new BanPayDao();

            // Test

            if (!$dbid or !is_int($dbid)) throw new Exception('db');
            $this->testDoc($reccod);

            // Get

            $data = $dao->getBanPayItemByRecCod($dbid, $reccod);

            // $data = array(
            //     'reccod' => 'NFC1.1',
            //     'cpname' => 'Fulano da Silva',
            //     'colstd' => 'TR',
            //     'colinstr' => '001/111/11111-1',
            //     'val' => 100
            //     );

            return $data;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}

?>
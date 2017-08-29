<?php

class RecMov {

    private $codrec;

    private $dtdue;

    private $colstd = '';

    private $colinstr = '';

    private $list;

    public function set($input) {
        $this->codrec = $input['codrec'];
        $this->dtdue = $input['dtdue'];
        $this->colstd = $input['colstd'];
        $this->colinstr = $input['colinstr'];
        $this->list = array();
        foreach ($input['list'] as $value) {
            if (!in_array($value['std'], ['RecAdd', 'RecSub', 'RecRei'])) continue;
            $this->list[] = array(
                'doc' => $value['docto'],
                'reccod' => $input['codrec'],
                'seq' => 1,
                'bandt' => null,
                'bancc' => 0,
                'banseq' => 0,
                'std' => $value['std'],
                'recdt' => $value['dtrec'],
                'val' => $value['val'],
                 );
        }
    }


    public function get() {
        
        $data = array(
            'codrec' => $this->codrec,
            'dtdue' => $this->dtdue,
            'colstd' => $this->colstd,
            'colinstr' => $this->colinstr,
            'list' => $this->list
            );

        return $data;
    }
}

class RecMovService {

   public function getList($dbid, $dc, $dt0, $dtn, $dtParam, $status) {

        /*
        Input: token, date range (string format 'yyyy-MM-dd'), param (string 'dt' or 'dtdue')

        Output: Array of mov data arrays:
            array(
                array(
                    'cod' => 0,
                    'coCod' => '',
                    'cpName' => '',
                    'dt' => 'yyyy-MM-dd',
                    'val' => 0,
                    'bal' => 0,
                    );
                );
        */

        try {

            // Dependencies

            $dao = new RecMovDao();

            // Test

            if (!$dbid or !is_numeric($dbid)) throw new Exception('db');
            $this->testDt($dt0);
            $this->testDt($dtn);
            if ($dtParam != 'dt' and $dtParam != 'dtdue') throw new Exception("dtParam invalid");

            // Get

            $list = $dao->getList($dbid, $dc, $dt0, $dtn, $dtParam, $status);

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        } 
    }

    public function get($dbid, $dc, $cod) {

        /*
        Input token, icodd (0 if new)

        Output: Mov data array
            array(
            ...
            );
        */

        try {

            $data = array();

            // Dependencies

            $dao = new RecMovDao();

            // Test (includes no new record)
            
            if (!$dbid or !is_numeric($dbid)) throw new Exception('db');
            $this->testCodRec($cod);

            // Get

            $data = $dao->get($dbid, $dc, $cod);
            $data['colstdlist'] = $this->getColStdList();

            return $data;
           
        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }

    public function put($dbid, $dc, $input) {

        try {

            // Dependencies

            $mov = new RecMov();
            $dao = new RecMovDao();

            // Test

            if (!$dbid or !is_numeric($dbid)) throw new Exception('db');
            if (!in_array($dc, array('1', '2'))) throw new Exception('srv');
            $this->test($input);

            // Put
            
            $mov->set($input);
            $data = $mov->get();

            $dao->put($dbid, $dc, $data);

            return true;

        } catch (Exception $e) {
            
            throw new exception($e->getMessage());
        }
    }

    // Gets

    public function getColStdList() {

        $data = array(
            ['cod'=>'', 'name'=>''],
            ['cod'=>'TR', 'name'=>'Transf.'],
            ['cod'=>'BL', 'name'=>'Boleto'],
            ['cod'=>'DB', 'name'=>'Db.auto.'],
            ['cod'=>'CH', 'name'=>'Cheque'],
            ['cod'=>'DN', 'name'=>'Dinheiro']
            );

        return $data;
    }

    // Tests

    public function test($input) {

        $this->testCodRec($input['codrec']);
        $this->testDtDue($input['dtdue']);
        $this->testList($input['list']);
        $this->testColStd($input['colstd']);
        $this->testColInstr($input['colinstr']);
    }

    public function testCodRec($codrec) {
        try {
            if (!preg_match("/^[A-Za-z0-9-\/.]{1,20}$/", $codrec)) throw new exception('invalid cod');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function testDtDue($dtdue) {
        try {
            $this->testDt($dtdue);
        } catch (Exception $e) {
            throw new exception("invalid dtdue");
        }
    }

    public function testList($list) {
        try {
            foreach ($list as $key => $value) {
                //Std 'RecIns' and 'RecBan' not handled here
                if (!in_array($value['std'], ['RecAdd', 'RecSub', 'RecRei'])) continue;
                if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $value['dtrec'])) throw new exception("invalid dt[{$key}]");
                if (!preg_match("/^[a-zA-Z0-9.\/-]{1,30}$/", $value['docto'])) throw new exception("invalid docto[{$key}]");
                if (!preg_match("/^[-]{0,1}[0-9]{1,8}[.]{0,1}[0-9]{0,2}$/", $value['val'])) throw new exception("invalid val[{$key}]");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function testDt($dt) {
        try {
            if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dt)) throw new exception();
            $d = new DateTime($dt);
        } catch (Exception $e) {
            throw new exception("invalid dt");
        }
    }

    public function testColStd($colstd) {
        try {
            $list = array_keys($this->getColStdList()) ;
            if (!in_array($colstd, $list)) throw new exception();
        } catch (Exception $e) {
            throw new exception("invalid colstd");
        }
    }

    public function testColInstr($colinstr) {
        try {
            if (!preg_match("/^[0-9.\/-]{0,60}$/", $colinstr)) throw new exception();
        } catch (Exception $e) {
            throw new exception("invalid colinstr");
        }
    }
}


?>
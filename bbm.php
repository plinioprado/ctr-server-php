<?php

class BanMov {

    private $id;
        public function setId($id) {
            try {
                if (!preg_match("/^[0-9]{1,6}$/", $id)) throw new exception();
                $this->id = $id;
            } catch (Exception $e) {
                throw new exception("invalid id");
            }
        }
        public function getId() {
            return $this->id;
        }

    private $dt;
        public function setDt($dt) {
            try {
                if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dt)) throw new exception();
                $d = new DateTime($dt);
                $this->dt = $dt;
            } catch (Exception $e) {
                throw new exception("invalid dt");
            }
        }
        public function getDt() {
            return $this->dt;
        }

    private $seq;
        public function setSeq($seq) {
            try {
                if (!preg_match("/^[0-9]{1,2}$/", $seq)) throw new exception();
                $this->seq = $seq;
            } catch (Exception $e) {
                throw new exception("invalid seq");
            }
        }
        public function getSeq() {
            return $this->seq;
        }

    private $hist;
        public function setHist($hist) {
            try {
                if (!preg_match("/^[0-9a-zA-Z-+*\/_ !@#$%&.,]{0,60}$/", $hist)) throw new exception();
                    $this->hist = $hist;
            } catch (Exception $e) {
                throw new exception("invalid hist");
            }
        }
        public function getHist() {
            return $this->hist;
        }

    private $docto;
        public function setDocto($docto) {
            try {
                if (!preg_match("/^[0-9]{0,8}$/", $docto)) throw new exception();
                $this->docto = $docto;
            } catch (Exception $e) {
                throw new exception("invalid docto");
            }
        }
        public function getDocto() {
            return $this->docto;
        }

    private $cc;
        public function setCc($cc) {
            try {
                if (!preg_match("/^[1-9]{1}[0-9]{0,1}$/", $cc)) throw new exception();
                $this->cc = $cc;
            } catch (Exception $e) {
                throw new exception("invalid cc");
            }
        }
        public function getCc() {
            return $this->cc;
        }

    private $std;
        public function setStd($std) {
            try {
                if (!$std) $std = 'BanOni';
                if (!in_array($std, array_keys($this->getStdList()))) throw new exception();
                $this->std = $std;
            } catch (Exception $e) {
                throw new exception("invalid std");
            }
        }
        public function getStd() {
            return $this->std;
        }

    private $obs;
        public function setObs($obs) {
            try {
                if (!preg_match("/^[a-z0-9!#$%&'()*+,.\/:;<=>?@\[\] \^_`{|}~-]$/", $obs)) new exception("");
                 $this->obs = $obs;
            } catch (Exception $e) {
                throw new exception("invalid obs");
            }
        }
        public function getObs() {
            return $this->obs;
        }

    private $val;
        public function setVal($val) {
            try {
                if (!preg_match("/^[-]{0,1}[0-9]{1,8}[.]{0,1}[0-9]{0,2}$/", $val))throw new exception();
                 $this->val = $val;
            } catch (Exception $e) {
                throw new exception("invalid val");
            }
        }
        public function getVal() {
            return $this->val;
        }

    private $bal;
        public function setBal($bal) {
            try {
                if (!preg_match("/^[-]{0,1}[0-9]{1,8}[.]{0,1}[0-9]{0,2}$/", $bal)) throw new exception();
                $this->bal = $bal;
            } catch (Exception $e) {
                throw new exception("invalid bal");
            }
        }
        public function getBal() {
            return $this->bal;
        }

    public function getStdName($cod) {

        // No need to test since data is hardcoded

        $list = $this->getStdList();

        return $list[$cod];
    }

    function __construct() {

        $this->reset();
    }

    public function reset() {

        $this->id = 0;
        $this->dt = null;
        $this->seq = 0;
        $this->hist = '';
        $this->docto = '';
        $this->cc = 0;
        $this->std = 'BanOni';
        $this->obs = '';
        $this->val = 0;
        $this->bal = 0;
    }

    public function set($input) {

        $this->reset();
        $this->setId($input['id']);
        $this->setDt($input['dt']);
        if ($input['seq']) $this->setSeq($input['seq']);
        $this->setHist($input['hist']);
        $this->setDocto($input['docto']);
        $this->setCc($input['cc']);
        if ($input['std']) $this->setStd($input['std']);
        if ($input['obs']) $this->setObs($input['obs']);
        $this->setVal($input['val']);
        if ($input['bal']) $this->setBal($input['bal']);
    }

    public function get() {

        $data = array(
            'id' => $this->getId(),
            'dt' => $this->getDt(),
            'seq' => $this->getSeq(),
            'hist' => $this->getHist(),
            'docto' => $this->getDocto(),
            'cc' => $this->getCc(),
            'std' => $this->getStd(),
            'obs' => $this->getObs(),
            'val' => $this->getVal(),
            'bal' => $this->getBal(),
            );

        return $data;
    }

    public function getStdList() {

        $list = array();
        $list['BanOni'] = 'Não dentificado';
        $list['BanFdx'] = 'Distr.resultado';
        $list['BanFex'] = 'Aporte capital';
        $list['BanFfu'] = 'Repag.captação';
        $list['BanFfx'] = 'Captação';
        $list['BanIau'] = 'Rec.imobilizado';
        $list['BanIax'] = 'Pag.imoblizado';
        $list['BanIfu'] = 'Resgate aplicação';
        $list['BanIfx'] = 'Aplicação';
        $list['BanMan'] = 'Ajuste Saldo';
        $list['BanOpu'] = 'Estorno Pag.Oper.';
        $list['BanOpx'] = 'Pag.Operacional';
        $list['BanOpx.Cg'] = 'Pag.Custos gerais';
        $list['BanOpx.Cm'] = 'Pag.Custos material';
        $list['BanOpx.Da'] = 'Pag.Desp.Admin.';
        $list['BanOpx.Dc'] = 'Pag.Desp.Comerciais';
        $list['BanOpx.Dp'] = 'Pag.Desp.Pessoal';
        $list['BanOpx.Dt'] = 'Pag.Desp.Trib.';
        $list['BanOpx.Rt'] = 'Pag.Tributos s/Venda';
        $list['BanOru'] =  'Estorno Rec.Oper.';
        $list['BanOrx'] = 'Rec.Cliente';

        return $list;
    }
}


class BanMovService {

    public function getList($dbid, $dt0, $dtn) {

        /*
        Input: dbId and date range (string format 'yyyy-MM-dd')

        Output: Array of mov data arrays, each one:
            array(
                'id' => 0,
                'dt' => null,
                'seq' => 0,
                'hist' => '',
                'docto' => '',
                'std' => '',
                'stdName' => '',
                'cc' => 0,
                'val' => 0
                );

            'dt' will be 'yyyy-MM-dd'
            'bal' will be set at front end
        */

        try {

            // Dependencies

            $blo = new Bas();
            $dao = new BanMovDao();

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


    public function get($dbid, $id, $acc = 0) {

        /*
        Input token, id (0 if new), acc (only if new) 

        Output: Mov data array
            array(
            'id' => 0,
            'dt' => null,
            'seq' => 0,
            'hist' => '',
            'docto' => '',
            'cc' => 0,
            'std' => '',
            'obs' => '',
            'val' => 0,
            'bal' => 0,
            'token' => ''
            );
        */

        try {

            // Dependencies

            $mov = new BanMov();
            $dao = new BanMovDao();

            // Test
            
            $mov->setId($id);
            if (!$dbid or !is_int($dbid)) throw new Exception('db');

            // Get

            if ($id == 0) {
            
                $mov = $dao->getLast($dbid, $acc);
                $mov->setId(0);
                $mov->setHist('');
                $mov->setDocto('');
                $mov->setStd('BanOni');
                $mov->setObs('');
                $mov->setBal(round($row['bal']-$row['val'], 2));
                $mov->setVal(0);

            } else {

                $mov = $dao->get($dbid, $id);
            }

            return $mov->get();
           
        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }


    public function put($input) {

        /*
        Input: Mov data array
            array(
            'id' => 0,
            'dt' => null,
            'seq' => 0,
            'hist' => '',
            'docto' => '',
            'cc' => 0,
            'std' => '',
            'obs' => 0,
            'val' => 0,
            'token' => ''
            );

        Output: True
        */

        try {

            // Dependencies

            $mov = new BanMov();
            $dao = new BanMovDao();

            // Test

            if ($input['dbid'] == 0 or !is_numeric($input['dbid'])) throw new exception('dbid');
            if ($input['dbid'] == '3') throw new exception('demo');

            $mov->setId($input['id']);
            $mov->setDt(substr($input['dt'], 0, 10));
            $mov->setHist($input['hist']);
            $mov->setDocto($input['docto']);
            $mov->setVal($input['val']);
            $mov->setCc($input['cc']);
            $mov->setStd($input['std']);
            $mov->setObs($input['obs']);

            // Test cc

            $accList = $this->getBacList($input['dbid']);

            $count = 0;
            foreach ($accList as $value) {
                if ($value['id'] == $mov->getCc() ) $count++;
            }
            if ($count != 1) throw new exception('invalid cc');

            // Put

            $ok = $dao->put($input['dbid'], $mov);
            if (!$ok) throw new exception('failed');

            return true;
   
        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }       
    }


    public function post($input) {

        /*
        Input: Mov data array
            array(
            'id' => 0,
            'dt' => 'yyyy-mm-dd',
            'seq' => 0,
            'hist' => '',
            'docto' => '',
            'cc' => 0,
            'std' => '',
            'obs' => '',
            'val' => 0
            'token' => ''
            );

        Output: True
        */

        try {

            // Dependencies

            $mov = new BanMov();
            $dao = new BanMovDao();

            // Test
            $mov->set($input);

            if (!$input['dbid'] or !is_int($input['dbid'])) throw new Exception('db');
            if ($input['dbid'] == '3') throw new exception('demo');
            if ($input['id'] != 0) throw new exception('no zero');

            // Test cc

            $accList = $this->getBacList($input['dbid']);
            $count = 0;
            foreach ($accList as $value) {
                if ($value['id'] == $mov->getCc() ) $count++;
            }
            if ($count != 1) throw new exception('invalid cc');

            // Test against last and set seq

            $last = $dao->getLast($input['dbid'], $mov->getCc());

            if ($mov->getDt() < $last->getDt()) {
                throw new exception('invalid dt');
            } elseif($mov->getDt() == $last->getDt()) {
                $mov->setSeq($last->getSeq() + 1);
            } else {
                $mov->setSeq(1);
            }

            // Post

            $ok = $dao->post($input['dbid'], $mov);
            if (!$ok) throw new exception('failed');

            return true;
   
        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }       
    }


    public function delete($dbid, $id) {

        /*
        Input: Token and id

        Output: true
        */

        try {

            // Dependencies
            
            $mov = new BanMov();
            $dao = new BanMovDao();

            // Test

            if ($dbid == 0 or !is_numeric($dbid)) throw new exception('db');
            if ($input['dbid'] == '3') throw new exception('demo');
            $mov->setId($id);

            // Get

            $item = $dao->get($dbid, $id);
            if (!$item) throw new exception('none');

            // Test if last dt

            $last = $dao->getLast($dbid, $item->getCc());
            if ($item->getDt() != $last->getDt() ) throw new exception('not last dt');

            // Delete

            $ok = $dao->delete($dbid, $id);
            if (!$ok) throw new exception('failed');

            return true;
   
        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }       
    }


    public function getBacList($dbid) {

        /*
        Input: dbid 

        Output: Array of accounts:
            array(
                    'id' => 0,
                    'name' => 0,
                    'cod' => '',
                    'active' => true,
                    'obs' => '',
                    'entityCod' => '',
                    'lastDt' => null,
                    'lastBal' => 0,
                    'token' => $token
                );
                cod = ba/ag/cc
        */

        try {

            //Dependencies

            $dao = new BanMovDao();

            // Get
            
            $list = $dao->getByBac($dbid);

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    // Batches

    public function postList($list) {

        try {

            if (count($list) == 0) return 0;

            $i = 0;
            foreach ($list as $input) {
                $this->post($input);
                $i++;
            }

            return $i;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }
}

?>
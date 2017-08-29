<?php

class RecIns {

    private $cod;
    private $cpcod;
    private $cpname;
    private $doctxt;
    private $dt;
    private $list;
    private $std;
    private $val;

    public function set($input) {

        try {

            $this->cod = $input['cod'];
            $this->cpcod = $input['cpcod'];
            $this->cpname = str_replace("'", "", $input['cpname']);
            $this->doctxt = $input['doctxt'];
            $this->dt = $input['dt'];
            $this->list = $input['list'];
            $this->std = $input['std'];
            $this->val = (double)$input['val'];
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function get() {

        $data = array(
            'cod' => $this->cod,
            'cpcod' => $this->cpcod,
            'cpname' => $this->cpname,
            'doctxt' => $this->doctxt,
            'dt' => $this->dt,
            'list' => $this->list,
            'std' => $this->std,  
            'val' => $this->val
            );

        return $data;
    }
}


class RecInsService {

    public function getList($dbid, $dc, $dt0, $dtn) {

        /*
        Input: token and date range (string format 'yyyy-MM-dd')

        Output: Array of mov data arrays, each one:
            array(
                'cod' => 0,
                'cpCod' => null,
                'cpName' => '',
                'dt' => '',
                'val' => 0
                );

            'dt' will be 'yyyy-MM-dd'
            'bal' will be set at front end
        */

        try {

            // Dependencies

            $blo = new Bas();
            $dao = new RecInsDao();

            // Test

            if (!$dbid or !is_int($dbid)) throw new Exception('db');
            if ( $dc != '1' and $dc != '2') throw new Exception('dc');
            $dt0 = $blo->test_dtStr($dt0);
            $dtn = $blo->test_dtStr($dtn);

            // Get

            $list = $dao->getList($dbid, $dc, $dt0, $dtn);

            return $list;
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function get($dbid, $dc, $cod) {

        try {

            $data = array();

            // Dependencies

            $mov = new RecIns();
            $dao = new RecInsDao();

            // Test

            if (!$dbid or !is_int($dbid)) throw new Exception('db');  
            if ( $dc != '1' and $dc != '2') throw new Exception('dc');          
            $this->testCod($cod);

            // Get

            if ($cod == '0') {

                $data = array(
                    'cod' => '',
                    'cpCod' => '',
                    'cpName' => '',
                    'dt' => date('Y-m-d'),
                    'val' => 0,
                    'std' => '',
                    'doctxt' => '',
                    'list' => array (
                        array (
                            'seq' => 1,
                            'dtdue' => date('Y-m-d'),
                            'val' => 0
                            )
                        )
                    );

            } else {

                $data = $dao->get($dbid, $dc, $cod);
            }
            $data['stdList'] = $this->getStdList($dc);

            return $data;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }


    public function post($dc, $input) {

        /*
        Input: recins data array:
            array(
                'cod' => 0,
                'cpCod' => null,
                'cpName' => '',
                'dt' => 'yyyy-MM-dd',
                'val' => 0,
                'doctxt' => ''
                'list' => array(
                    array (
                        'seq' => 0,
                        'dtdue' => 'yyyy-mm-dd',
                        'val' => 0
                        )
                    )
                'token' => ''
                );

        Output: true

        */

        try {

            throw new Exception('db='.$dbid);
            throw new Exception(json_encode($input));

            // Dependencies

            $mov = new RecIns();
            $dao = new RecInsDao();

            // Test

            if (!$input['dbid'] or !is_int($input['dbid'])) throw new Exception('db');
            if ($input['dbid'] == 3) throw new Exception('demo');
            if ( $dc != '1' and $dc != '2') throw new Exception('dc');
            $this->test($input, $dc);
            $mov->set($input);

            $last = $dao->get($input['dbid'], $dc , $input['cod']);
            if ($last) throw new Exception('existent');

            // Put

            $data = $mov->get();

            $ok = $dao->post($input['dbid'], $dc, $data);
            if ($ok !== true) throw new Exception('failed');

            return true;
   
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }       
    }


    public function put($dc, $input) {

        /*
        Input: recins data array:
            array(
                'cod' => 0,
                'cpCod' => null,
                'cpName' => '',
                'dt' => 'yyyy-MM-dd',
                'val' => 0,
                'doctxt' => ''
                'setList' = array (
                    array (
                        'seq' = 0,
                        'dt' = 'yyyy-MM-dd',
                        'val' = 0
                        )
                    )
                'token' => ''
                );

        Output: true

        */

        try {

            // Dependencies

            $mov = new RecIns();
            $dao = new RecInsDao();

            // Test

            if (!$input['dbid'] or !is_int($input['dbid'])) throw new Exception('db');
            if ($input['dbid'] == 3) throw new exception('demo');
            if ( $dc != '1' and $dc != '2') throw new Exception('dc');  
            if (!$input['cod'] or $input['cod'] == '0') throw new exception('cod');
            $this->test($input, $dc);
            $mov->set($input);

            $last = $dao->get($input['dbid'], $dc, $input['cod']);
            if (!$last) throw new exception('inexistent');

            // Post

            $data = $mov->get();

            $ok = $dao->put($input['dbid'], $dc, $data);
            if ($ok !== true) throw new exception('failed');

            return true;
   
        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }       
    }


    public function delete($dbid, $dc, $cod) {

        try {

            // Dependencies
            
            $mov = new RecIns();
            $dao = new RecInsDao();

            // Test

            if ($input['dbid'] == 3) throw new Exception('demo');
            if ( $dc != '1' and $dc != '2') throw new Exception('dc');  
            $mov->setCod($cod);

            // Delete

            $ok = $dao->delete($dbid, $dc, $cod);
            if ($ok !== true) throw new Exception('failed');

            return true;
   
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }       
    }

    // Tests

    private function test($input, $dc) {
        
        //cod
        $this->testCod($input['cod']);
        
        //cpcod   
        if ($input['cod'] == '0' and $input['cpcod'] == '' ) throw new Exception('empty cpcod');
        if (!preg_match("/^[0-9]{1,15}$/", $input['cpcod'])) throw new exception('invalid cpcod');
        
        //doctxt
        if (strpos($input['doctxt'], '\"') !== false) throw new Exception('invalid doctxt');
        if (strpos($input['doctxt'], "\'") !== false) throw new Exception('invalid doctxt');

        //cpname 
        if ($input['cod'] == '0' and $input['cpname'] == '' ) throw new Exception("empty cpname");
        $cpname = str_replace("'", "", $input['cpname']);
        
        //dt
        if (!$this->isValidDtStr($input['dt'])) throw new Exception("invalid dt");
        
        //list 
        $this->testList($input['list']);
        
        //std  
        $list = array_keys($this->getStdList($dc)) ;
        if (!in_array($input['std'], $list)) throw new Exception("invalid std");
        
        //val
        if (!preg_match("/^[-]{0,1}[0-9]{1,8}[.]{0,1}[0-9]{0,2}$/", $input['val'])) throw new exception('invalid val');       
    }

    private function testCod($cod) {
        try {
            if (!preg_match("/^[a-zA-Z0-9.-]{1,30}$/", $cod)) throw new exception();
        } catch (Exception $e) {
            exception("invalid cod");
        }
    }

    private function testList($list) {
        $s = 1;
        foreach( $list as $item) {
            if (array_keys($item) != array('seq', 'dtdue', 'val')) throw new exception("invalid fields in [{$s}]");
            if ($item['seq'] != $s) throw new Exception("invalid seq[$s]");
            if (!$this->isValidDtStr($item['dtdue'])) throw new Exception("invalid dtdue[$s]");
            if (!preg_match("/^[-]{0,1}[0-9]{1,8}[.]{0,1}[0-9]{0,2}$/", $item['val'])) throw new exception("invalid val[$s]");
            $s++;
        }
    }

    private function isValidDtStr($dt) {
        try {
            if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dt)) throw new exception();
            $d = new DateTime($dt);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // Batches

    public function postList($list) {       

        try {                              
           
            $tot = count($list);
            if ( $tot == 0) return '0/0';
            $msg = 0;
            $i = 0;
            foreach ($list as $input) {
               
                $existing = $this->get($input['dbid'], '1' , $input['cod']);

                if (!$existing ) {
                    
                    $this->post($input['dbid'], $input);
                    $i++;
                }
            }
            
            return $i . '/' . $tot;

        } catch (Exception $e) {

            throw new exception($e->getMessage());
        }
    }

    //*******
    // Other
    //*******

    public function getStdList($dc) {

        if ($dc == 1) {

            $data = array(
                ''=> '',
                'BanOrx' => 'Rec.Cliente',
                'BanIau' => 'Rec.imobilizado'
                );

        } else {

            $data = array(
                ''=> '',
                'BanFdx' => 'Distr.resultado',
                'BanIax' => 'Pag.imoblizado',
                'BanOpx' => 'Pag.Operacional',
                'BanOpx.Cg' => 'Pag.Custos gerais',
                'BanOpx.Cm' => 'Pag.Custos material',
                'BanOpx.Da' => 'Pag.Desp.Admin.',
                'BanOpx.Dc' => 'Pag.Desp.Comerciais',
                'BanOpx.Dp' => 'Pag.Desp.Pessoal',
                'BanOpx.Dt' => 'Pag.Desp.Trib.',
                'BanOpx.Rt' => 'Pag.Tributos s/Venda'
                );
        }

        return $data;
    }
}

?>
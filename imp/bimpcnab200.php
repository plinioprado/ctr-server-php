<?php

class BanCnab200Service {
    
    public function imp237($dbid, $lines) {

    /*
    Input: Token and Array of strings with 200 chars, according to CNAB200 bank statement standards (Bradesco version). Restricted to files with one batch/account.

    Output: Input array of arrays (each as described below) ready for the bank statement post service (either Tws lite and tws full).

        array(
            'id' => 0,
            'dt' => null,
            'seq' => 0,
            'hist' => '',
            'docto' => '',
            'std' => '',
            'cc' => 0,
            'val' => 0
            );

            dt, when not null is a string in the yyyy-MM-dd format

        Dependencies:
            Last mov of each bank account with id, cod, lastBal and lastDt

    */

       try {

            // Create movList
            $list = array();
            $input = array();

            // Get last mov

            $movDao = new BanMovDao();
            $accList = $movDao->getByBac($dbid);         

            $acc = array();

            $i = 1;
            foreach ($lines as $lin) {

                // Test

                if (strlen($lin) != 200) throw new Exception("file");
                if (intval(substr($lin, 194,6))!= $i) throw new Exception("file");

                if (substr($lin, 0, 1) == '0') {

                    // If file header

                    // Test

                    if ($i != 1) throw new Exception("file header (1)");
                    if (substr($lin,9,2) != '04') throw new Exception("file header (2)");
                    if (substr($lin,76,3) != '237') throw new Exception("file header (3)");
                    
                    // Get 

                    $ba = substr($lin,76,3);

                } elseif (substr($lin,0,1) == '1' and substr($lin, 41,1) == '0') {

                    // If batch header, test and cc

                    // Test

                    if ($i != 2) throw new Exception("batch header");

                    $ccCod = $ba . '/' . substr($lin,17,4).'/'.ltrim(substr($lin,29,12),'0');
                    if ($ccCod != '237/0134/902403') throw new Exception("cc");
                    
                    foreach ($accList as $value) {
                        if (str_replace('-', '', $value['cod']) ==  $ccCod) $acc = $value;
                    }
                    if (!$acc) throw new Exception("no cc");

                    if ($acc['entityCod'] != substr($lin,3,14)) throw new Exception("company");

                    $dt0 = '20'.substr($lin,84,2).'-'.substr($lin,82,2).'-'.substr($lin,80,2);
                    if (new DateTime($acc['lastDt']) > new DateTime($dt0)) throw new Exception("last date");

                    $bal = round(substr($lin,86,18)/100, 2);
                    if (substr($lin,104,1) == 'D') $bal = -$bal;
                    if ($acc['lastBal'] != $bal) throw new Exception("last bal");

                    $list = array();
                    
                    //echo $dt0.':SI='.$bal.'<br>';

               } elseif (substr($lin,0,1) == '1' and substr($lin, 41,1) == '1') {

                    // If detail, test and load list

                    $input = array();
                    $input['id'] = '0';
                    $input['dt'] = (substr($lin,168,4).'-'.substr($lin,166,2).'-'.substr($lin,164,2));
                    $input['seq'] = '0';
                    $input['hist'] = trim(substr($lin,49,25));
                    $compl = trim(substr($lin,105,32));
                    if ($compl != '') $input['hist'] = $input['hist'] . ' - ' . $compl;
                    $input['docto'] = substr($lin,74,6);
                    $input['cc'] = $acc['id'];
                    $input['std'] = '';
                    $input['val'] = round(substr($lin,86,18)/100, 2);
                    if (substr($lin,104,1) == 'D') $input['val'] = -$input['val'];
                    $bal = round($bal+$input['val'], 2);
                    $input['dbid'] = $dbid;
                    $list[] = $input;

                    //echo $input['dt'].'+'.$input['val'].'='.$bal.'<br>'; 

               } elseif (substr($lin,0,1) == '1' and substr($lin, 41,1) == '2') {

                    // If batch trailler, just test

                    $b = round(substr($lin,86,18)/100, 2);
                    if (substr($lin,104,1) == 'D') $b = -$b;

                    //echo $dt0.':SI='.$bal.', contra'.$b.'<br>';

                    if ($bal != $b) throw new Exception("batch trailler");

               } elseif (substr($lin,0,3) == '900') {

                    // If file trailler, just test

                    if ($i != count($lines)) throw new Exception("file trailler");

                    break;

               } else {

                    throw new Exception("file");
               }
                $i++;
            }

            if ($i != count($lines)) throw new Exception("file (n)");

            return $list;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}

?>
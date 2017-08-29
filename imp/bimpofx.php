<?php

class BanOfx {

   public function imp($dbid, $lines) {

        /*

        Warning: Not fully debugged because development was discontinued due no balance info provide poor validation possibilities

        */

        try {
           
            $msg = '';
            $ba = '';
            $cc = '';

            foreach ($lines as $lin) {

                if (substr($lin,0,8) == "<BANKID>") {

                    $ba = trim(substr($lin, 9));
                } elseif (substr($lin,0,8) == "<ACCTID>") {

                    $cc = trim(substr($lin, 8));
                }
            }

            if ($ba != '237' or $cc != '90240') throw new Exception("account");

            $list = array();
            $input = array();

            foreach ($lines as $lin) {

                if (trim($lin) == "<STMTTRN>") {

                    $input = array();
                    $input['id'] = 0;
                    $input['seq'] = 0;
                    $input['cc'] = 2;
                    $input['dbid'] = $dbid;

                } else if (substr($lin, 0, 10) == "<DTPOSTED>") {

                    $input['dt'] = substr($lin, 10,4).'-'.substr($lin, 14,2).'-'.substr($lin, 16,2);
                } else if (substr($lin, 0, 8) == "<TRNAMT>") {

                    $input['val'] = str_replace(',', '.', substr($lin, 8));
                } else if (substr($lin, 0, 10) == "<CHECKNUM>") {

                    $input['docto'] = substr($lin, 10);
                } else if (substr($lin, 0, 6) == "<MEMO>") {

                    $input['hist'] = substr($lin, 6);
                } else if (trim($lin) == "</STMTTRN>") {

                    $list[] = $input;
                } else if (trim($lin) == "</BANKTRANLIST>") {

                    break;
                }
            }

            $ok = false;
            $srv = new BanMovService();
            $i = 0;
            foreach ($list as $item) {
                $ok = $srv->post($item);
                if (!$ok) throw new Exception('Erro na importação '.$i);
                $i++;
            }

            return 'importados ' . $i . ' movimentos';

        } catch (Exception $e) {

            return ($e->getMessage());
        }
    }

}

?>
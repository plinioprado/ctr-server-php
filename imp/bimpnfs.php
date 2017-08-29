<?php

class ImpNfsService {

    public function imp($dbid, $lines) {

        try {         

            /*

            Input: token and file lines

            Output: List of RecIns arrays to be Posted:
                Array(
                'cod' => 'NFS...',
                'cpcod' => '',
                'cpname' => '',
                'dt' => 'yyyy-mm-dd'
                val => 0
                )

            */                

            $list = array();
            
            $tot = count($lines);
            for ($i = 1; $i < ($tot-1); $i++) {

                $fields = explode(";", $lines[$i]);

                $item = array();
                $item['cod'] = 'NFS' . $fields[1];
                if ($fields[34]) {
                    $item['cpcod'] = str_replace(array('.','/','-'), array('','',''), $fields[34]);
                } else {
                    $item['cpcod'] = 1;
                }
                $item['cpname'] = utf8_encode(ucwords(strtolower($fields[37])));
                $item['dt'] = substr($fields[2],6,4) . '-' . substr($fields[2],3,2) . '-' . substr($fields[2],0,2);
                $item['val'] = round(str_replace(',','.',str_replace('.', '',$fields[26])), 2);
                throw new Exception(utf8_decode($lines[$i]) );
                $item['doctxt'] = utf8_encode($lines[$i]);
                $item['dbid'] = $dbid;
                $list[] = $item;
            }
                                                 
            return $list;
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
 }

?>
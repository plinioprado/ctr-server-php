<?php

class BanMovImpService {

    public function imp($dbid, $file) {

        try {

            // Tests

            if (!$dbid or !is_int($dbid)) throw new Exception('db');
            if ($file[size] > 5242880 ) throw new Exception("big (>5Mb)");
            if (!is_file($file[tmp_name])) throw new Exception("no file");
            if (preg_match("/^[a-zA-Z0-9_].php$/", $file[name])) throw new Exception("php");
         
            // Upload file

            $loaded = move_uploaded_file($file[tmp_name],"./upload/".$file[name]);
            if (!$loaded) throw new Exception("failed");

            // Content test

            $lines = file("./upload/".$file[name]);
            foreach ($lines as &$lin) {
                if (!is_string($lin)) throw new Exception("no string");
                $lin = trim($lin);
            }           
            
            // Handle

            $arr = explode('.', $file[name]);
            $ext = array_reverse($arr)[0];

            if ($ext == 'ofx' and substr($lines[1], 0, 3) == 'OFX') {

                require_once('bimpofx.php');
                require_once('../bbm.php');
                require_once('../dbm.php');

                $srv = new BanOfx();
                $msg = $srv->imp($dbid, $lines);

            } elseif (substr($lines[0], 0, 11) == '0        04') {

                require_once('bimpcnab200.php');
                require_once('../bbm.php');
                require_once('../dbm.php');

                $srv = new BanCnab200Service();
                $list = $srv->imp237($dbid, $lines);            
                $srv = new BanMovService();
                $msg = $srv->postList($list);

            } elseif (substr(urlencode($lines[0]), 0, 29) == 'Tipo+de+Registro%3BN%BA+NFS-e') {
                
                require_once('bimpnfs.php');
                require_once('../bri.php');
                require_once('../dri.php');               

                $srv = new ImpNfsService();
                $list = $srv->imp($dbid, $lines);

                throw new Exception(json_encode($list));

                $srv = new RecInsService();
                $msg = $srv->postList($list);

            } else {
                
                throw new Exception("unforecasted");
            }

            // Delete uploaded file

            $del = unlink("./upload/".$file[name]);

            if (!$del) throw new Exception("not deleted");

            return $msg;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}

?>
<?php  


class BanRepService {

    public function cfl($dbid, $dt0, $dtn) {

        try {

            $list = array();

            // Tests

            $blo = new Bas();
            $dt0 = $blo->test_dtStr($dt0);
            $dtn = $blo->test_dtStr($dtn);
            if (!$dbid or !is_int($dbid)) throw new Exception('db');

            // Get

            $dao = new BanRepDao();
            $list = $dao->cfl($dbid, $dt0, $dtn);

            return $list;

        } catch (Exception $e) {

            throw new exception($e->getMessage());              
        }
    }

    public function pal($dbid, $dt0, $dtn) {

        return $this->cfl($dbid, $dt0, $dtn);
    }
}

?>
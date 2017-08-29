<?php

class MntAuditService {

    public function getList() {

        try {

            require_once('dm.php');
            $dao = new MntAuditDao();
            $list = $dao->getList();
            
            return $list;
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }


    public function get($id) {

        try {

            if (!is_numeric($id)) throw new Exception('id inválido');

            require_once('dm.php');
            $dao = new MntAuditDao();
            $txt = $dao->get($id);

            return $txt;
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}

?>
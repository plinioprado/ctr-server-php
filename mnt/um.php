<?php

class UioPhp {

    public function router($input) {

        if ($input['op'] == 'audit') {

            require_once('../bm.php');
            $obj = new MntAuditService();
            $txt = $obj->get();

            return $txt;

        } else {

            return 'não encontrado';

        }
    }
}



?>
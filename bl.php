<?php

class LoginService {

    public function login($user, $pass) {

        /*
        Input: user (email) and pass

        Output: Config array, with basic settings, user, ans token to be validated at each request:
            [
             'userName' string,
             'userStd' int,
             'companyCod' string,
             'companyFullName',
             'dtMin' = string format 'yyyy-MM-dd',
             'dtMax' = string format 'yyyy-MM-dd',
             'token' = string,
             'accList = [
                'acc = ['id',
                    'name',
                    'cod',
                    'active',
                    'obs'
                    [
            ]
        */

        try {

            $list = array();

            // Test

            $blo = new Bas();
            $blo->test_pass($pass);

            // Get

            $usr = getUsrByUser($user);

            if (!$usr) throw new Exception('invalid');

            $dao = new LoginDao();
            $data = $dao->login($user, $pass, $usr['dbid']);
            $data[0]->token = $usr['token'];

            return $data;

        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}

?>
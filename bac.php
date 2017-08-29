<?php

class Config {

    private companyCod;
        public function setCompanyCod($cod) {
            try {
                $this->testCompanyCod($cod);
                $this->companyCod = $cod;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
        public function getCompanyCod() {
            return $this->companyCod;
        }
        public function testCompanyCod($cod) {
            try {
                if (!preg_match("/^[0-9]{0,16}$/", $cod)) throw new exception();
            } catch (Exception $e) {
                throw new exception('invalid CompanyCod');
            }
        }

    private companyName;
        public function setCompanyName($name) {
            try {
                $this->testCompanyName($name);
                $this->companyName = $name;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
        public function getCompanyName() {
            return $this->companyName;
        }
        public function testCompanyName($name) {
            try {
                if (!preg_match("/^[a-zA-Z0-9]{0,15}$/", $name)) throw new exception();
            } catch (Exception $e) {
                throw new exception('invalid CompanyName');
            }
        }

    private companyFullName;
        public function setCompanyFullName($name) {
            try {
                $this->testCompanyFullName($name);
                $this->companyFullName = $name;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
        public function getCompanyFullName() {
            return $this->companyFullName;
        }
        public function testCompanyFullName($name) {
            try {
                if (!preg_match("/^[a-zA-Z0-9]{0,40}$/", $name)) throw new exception();
            } catch (Exception $e) {
                throw new exception('invalid CompanyFullName');
            }
        }

    private accBanMax;
        public function setAccBanMax($num) {
            try {
                $this->testAccBanMax($num);
                $this->accBanMax = $num;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
        public function getAccBanMax() {
            return $this->accBanMax;
        }
        public function testAccBanMax($num) {
            try {
                if (!is_int($num) or $num < 2 ) throw new exception();
            } catch (Exception $e) {
                throw new exception('invalid accBanMax');
            }
        }

    private dtMin;
        public function setDtMin($dt) {
            try {
                $this->testDtMin($dt);
                $this->dtMin = $dt;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
        public function getDtMin() {
            return $this->dtMin;
        }
        public function testDtMin($dt) {
            try {
                if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dt)) throw new exception();
                $d = new DateTime($dt);
            } catch (Exception $e) {
                throw new exception('invalid dtMin');
            }
        }

    private dtMax;
        public function setDtMax($dt) {
            try {
                $this->testDtMax($dt);
                $this->dtMax = $dt;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
        public function getDtMax()) {
            return $this->dtMax
        }
        public function testDtMax($dt) {
            try {
                if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dt)) throw new exception();
                $d = new DateTime($dt);
            } catch (Exception $e) {
                throw new exception('invalid dtMax');
            }
        }

}

class ConfigService {

    public function get($dbid) {

        try {

            // Dependencies

            $dao = new ConfigDao();

            // Get

            $data = $dao->get($dbid);

            return $data;
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}

?>
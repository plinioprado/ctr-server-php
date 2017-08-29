<?php

class User {
   
   public $id;
   public $email;
   public $name;
   public $std;
   public $active;
}

class UserService {

   public function get($dbid) {
      try {
         $dao = new UserDao();
         $data = $dao->get($dbid);
         return $data;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }      
   }

   public function getById($id, $dbid) {
      try {
         $this->testId($id);
         $dao = new UserDao();
         $data = $dao->getById($id, $dbid);
         return $data;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }      
   }

   public function post($data, $dbid) {
      try {
         $dao = new UserDao();
         $data = $dao->post($data, $dbid);
         return $data;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }      
   }

   public function put($id, $data, $dbid) {
      try {
         $dao = new UserDao();
         $data = $dao->put($id, $data, $dbid);
         return $data;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }      
   }

   public function delete($id, $dbid) {
      try {
         $dao = new UserDao();
         $data = $dao->delete($id, $dbid);
         return $data;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }      
   }

   public function test(array $data) {
      try {
         testId($data->id);
         return true;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }
   }

   public function testId($string) {
      try {
         if (!is_numeric($string)) return false;
         return true;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }
   }

}

?>
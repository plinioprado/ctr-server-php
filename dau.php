<?php

class UserDao {

   public function get($dbid) {

      try {

         $list = array();
         
         // Connection

         $dao = new Dao();
         $db = $dao->getDb($dbid);
         $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
         if ($conn->connect_error) throw new exception('d1');
         mysqli_set_charset($conn,'utf8');

         // Query

         $sql = "SELECT u.Id AS 'id', u.Email AS 'email', u.Name AS 'name', u.Std AS 'std', u.Active AS 'active'"; 
         $sql .= " FROM users u";
         $sql .= " ORDER BY u.Id";        

         $result = $conn->query($sql);
         if (!$result) throw new exception('d2');

         // Set

         if ($result->num_rows == 0) return $list;
         while($row = $result->fetch_assoc()) {
            $row['active'] = ($row['active'] == 'Sim');
            $list[] = $row;
         }

         return $list;

      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }      
   }

   public function getById($id, $dbid) {
      try {

         $list = array();
         
         // Connection

         $dao = new Dao();
         $db = $dao->getDb($dbid);
         $conn = new mysqli($db['servername'], $db['username'], $db['password'], $db['dbname']);
         if ($conn->connect_error) throw new exception('d1');
         mysqli_set_charset($conn,'utf8');

         // Query

         $sql = "SELECT u.Id AS 'id', u.Email AS 'email', u.Name AS 'name', u.FullName AS 'fullname', u.Pass AS 'pass', u.Active AS 'active', u.Std AS 'std'"; 

         $sql .= " FROM users u";
         $sql .= " WHERE u.Id = '{$id}'";

         $result = $conn->query($sql);
         if (!$result) throw new exception('d2');

         // Set

         if ($result->num_rows == 0) return $list;
         $row = $result->fetch_assoc();
         $row['active'] = ($row['active'] == 'Sim');

         return $row;

      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }         
   }

   public function post($data, $dbid) {
      try {
         $data = 'Post {$id} being developed';
         return $data;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }      
   }

   public function put($id, $data, $dbid) {
      try {
         $data = 'Put {$id} being developed';
         return $data;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }      
   }

   public function delete($id, $dbid) {
      try {
         $data = 'Delete {$id} being developed';
         return $data;
      } catch (Exception $e) {
          throw new Exception($e->getMessage());
      }      
   }
}

?>
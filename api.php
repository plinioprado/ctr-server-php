<?php
//error_reporting(E_ERROR | E_PARSE);

require_once('b.php');
require_once('d.php');

// get HTTP method, path and body 

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
if ($method == 'GET') $input = $_GET;

// Response

if ($input['srv'] == 'login') {

  try {

    require_once('bl.php');
    require_once('dl.php');

    $obj = new LoginService();
    $data = $obj->login($input['user'], $input['pass'], $input['token']);

    res(200, $data[0]);

  } catch (Exception $e) {

    res(400, $e->getMessage());
  }

} else {

  try {

    $dbid = getDbIdByToken($input['token']);

    if ($dbid) {

      unset($input['token']);
      $input['dbid'] = $dbid;

    } else {

      response($data, 403, 'not logged');
      exit;
    }

    if ($request[0] == 'user') {

      require_once('bau.php');
      require_once('dau.php');
      $obj = new UserService();

      if ($method == 'GET' and !$request[1]) {
         $data = $obj->get($dbid);
         res(200, $data);
         exit;
      } elseif ($method == 'GET' and $request[1]) {
         $data = $obj->getById($request[1], $dbid);
         res(200, $data);
         exit;
      } elseif ($method == 'POST') {
         $data = $obj->post($input, $dbid);
         res(400, $data);
         exit;
      } elseif ($method == 'PUT') {
         $data = $obj->put($input['id'], $input, $dbid);
         res(400, $data);
         exit;
      } elseif ($method == 'DELETE') {
         $data = $obj->delete($input['id'], $dbid);
         res(400, $data);
         exit;
      } else {
         res(400, 'Bad Request');
         exit;
      }

    } elseif ($input['srv'] == 'banacc' and $method == 'GET') {

      require_once('bbm.php');
      require_once('dbm.php');
      $obj = new BanMovService();

      $data = $obj->getBacList($input['dbid']);

    } elseif ($input['srv'] == 'bancfl' and $method == 'GET') {

      require_once('bb_r.php');
      require_once('db_r.php');
      $obj = new BanRepService();

      $data = $obj->cfl($input['dbid'], $input['dt0'], $input['dtn']);

    } elseif ($input['srv'] == 'banmov') {

      require_once('bbm.php');
      require_once('dbm.php');
      $obj = new BanMovService();        

      if ($method == 'GET' and !isset($input['id'])) {
        $data = $obj->getList($input['dbid'], $input['dt0'], $input['dtn']);
      } elseif ($method == 'GET' and isset($input['id']) and $input['id'] <> 0) {
        $data = $obj->get($input['dbid'], $input['id']);
      } elseif ($method == 'GET' and isset($input['id']) and $input['id'] == 0) {
        $data = $obj->get($input['dbid'], $input['id'], $input['acc']);
      } else if ($method == 'POST') {
        $data = $obj->post($input);
      } elseif ($method == 'PUT') {
        $data = $obj->put($input);
      } else if ($method == 'DELETE') {
        $data = $obj->delete($input['dbid'], $input['id']);
      } else {
        throw new Exception('invalid');
      }

    } elseif ($input['srv'] == 'banpal' and $method == 'GET') {

      require_once('bb_r.php');
      require_once('db_r.php');
      $obj = new BanRepService();

      $data = $obj->pal($input['dbid'], $input['dt0'], $input['dtn']);


    } elseif ($input['srv'] == 'banpay') {

      require_once('bbp.php');
      require_once('dbp.php');
      $obj = new BanPayService(); 

      if ($method == 'GET' and !isset($input['doc'])) {
        $data = $obj->getList($input['dbid'], $input['dt0'], $input['dtn']);
      } elseif ($method == 'GET' and isset($input['doc'])) {
        $data = $obj->get($input['dbid'], $input['doc']);
      } elseif ($method == 'POST') {
        $data = $obj->post($input);
      } elseif ($method == 'PUT') {
        $data = $obj->put($input);
      } elseif ($method == 'DELETE') {
        $data = $obj->delete($input);
      } else {
        throw new Exception('invalid');
      }

    } elseif ($input['srv'] == 'banpayitem') {

      require_once('bbp.php');
      require_once('dbp.php');
      $obj = new BanPayService(); 

      if ($method == 'GET' and isset($input['reccod'])) {
        $data = $obj->getBanPayItemByRecCod($input['dbid'], $input['reccod']);
      } else {
        throw new Exception('invalid');
      }

    } elseif ($input['srv'] == 'banpaybandoc') {

      require_once('bbp.php');
      require_once('dbp.php');
      $obj = new BanPayService();

      $data = $obj->getBanCodList($input['dbid'], $input['val']);      

    } elseif ($input['srv'] == 'banrec') {

      require_once('bbr.php');
      require_once('dbr.php');
      $obj = new BanRecService();        

      if ($method == 'GET' and !isset($input['doc'])) {
        $data = $obj->getList($input['dbid'], $input['dt0'], $input['dtn']);
      } elseif ($method == 'GET' and isset($input['doc'])) {
        $data = $obj->get($input['dbid'], $input['doc']);
      } elseif ($method == 'PUT') {
        $data = $obj->put($input);
      } else {
        throw new Exception('invalid');
      }

    } elseif ($input['srv'] == 'payins') {

      require_once('bri.php');
      require_once('dri.php');
      $obj = new RecInsService();

      if ($method == 'GET' and !isset($input['cod'])) {
        $data = $obj->getList($input['dbid'], '2', $input['dt0'], $input['dtn']);
      } elseif ($method == 'GET') {
        $data = $obj->get($input['dbid'], '2', $input['cod']);
      } elseif ($method == 'POST') {
        $data = $obj->post('2', $input);
      } elseif ($method == 'PUT') {
        $data = $obj->put('2', $input);
      } else if ($method == 'DELETE') {
        $data = $obj->delete($input['dbid'], '2', $input['cod']);
      } else {
        throw new Exception('invalid');
      }

    } elseif ($input['srv'] == 'paymov') {

      require_once('brm.php');
      require_once('drm.php');
      $obj = new RecMovService();

      if ($method == 'GET' and !isset($input['cod'])) {
        $data = $obj->getList($input['dbid'], '2', $input['dt0'], $input['dtn'], $input['dtParam'], $input['status']);
      } elseif ($method == 'GET' and isset($input['cod'])) {
        $data = $obj->get($input['dbid'], '2', $input['cod']);
      } elseif ($method == 'PUT') {
        $data = $obj->put($input['dbid'], '2', $input);
      } else {
        throw new Exception('invalid');
      }

    } elseif ($input['srv'] == 'recins') {

      require_once('bri.php');
      require_once('dri.php');
      $obj = new RecInsService();

      if ($method == 'GET' and !isset($input['cod'])) {
        $data = $obj->getList($input['dbid'], '1', $input['dt0'], $input['dtn']);
      } elseif ($method == 'GET') {
        $data = $obj->get($input['dbid'], '1', $input['cod']);
      } elseif ($method == 'POST') {
        $data = $obj->post('1', $input);
      } elseif ($method == 'PUT') {
        $data = $obj->put('1', $input);
      } else if ($method == 'DELETE') {
        $data = $obj->delete($input['dbid'], '1', $input['cod']);
      } else {
        throw new Exception('invalid');
      }

    } elseif ($input['srv'] == 'recmov') {

      require_once('brm.php');
      require_once('drm.php');
      $obj = new RecMovService();

      if ($method == 'GET' and !isset($input['cod'])) {
        $data = $obj->getList($input['dbid'], '1', $input['dt0'], $input['dtn'], $input['dtParam'], $input['status']);
      } elseif ($method == 'GET' and isset($input['cod'])) {
        $data = $obj->get($input['dbid'], '1', $input['cod']);
      } elseif ($method == 'PUT') {
        $data = $obj->put($input['dbid'], '1', $input);
      } else {
        throw new Exception('invalid');
      }

    } else {

      throw new Exception('invalid');
    }

    if (!is_array($data) and !($data === true) and $data['cod'] !== '0') throw new Exception($data);

    response($data);

  } catch (Exception $e) {

    response($data, 400, $e->getMessage());
  }
}


function response($data, $status = 200, $status_message = 'Ok') {

  //header("Content-Type: application/json; charset=UTF-8");

  header("HTTP/1.1 $status $status_message");
  $response['status'] = $status;
  $response['status_message'] = $status_message;
  $response['data'] = $data;

  $json_response = json_encode($response);
  echo $json_response;
}

function res($status, $data) {

   if ($status == 200) $status_message = 'ok';
   else $status_message = 'error';

    header("HTTP/1.1 $status $status_message");
    header("Content-Type: application/json");
    echo json_encode($data);
}


?>



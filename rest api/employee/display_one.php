<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


include_once '../../db/db.php';
  include_once '../../Employee.php';


  $db2 = new Database();
  $db = $db2->connect();

  $employee = new Employee($db);

  $employee->id = isset($_GET['id']) ? $_GET['id'] : die();

  $employee->display_one();

  $emp_arr = array(
    'id' => $employee->id,
    'name' => $employee->name,
    'city' => $employee->city
  );

  print_r(json_encode($emp_arr));
  ?>
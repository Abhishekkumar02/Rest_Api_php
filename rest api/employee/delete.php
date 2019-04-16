<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, x-Requested-With');

 include_once '../../db/db.php';
  include_once '../../Employee.php';

  $db2 = new Database();
  $db = $db2->connect();

  $employee = new Employee($db);

  $data = json_decode(file_get_contents("php://input"));

  $employee->id = $data->id;
  
  if ($employee->delete()) {
    echo json_encode(
      array('message' => 'Employee Deleted')

    );
  } else {
    echo json_encode(
      array('message' => 'Employee Not Deleted')
    );
  }
  ?>
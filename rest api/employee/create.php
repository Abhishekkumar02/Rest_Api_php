<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, x-Requested-With');


  include_once '../../db/db.php';
  include_once '../../Employee.php';


  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $employee = new Employee($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  $employee->name = $data->name;
   $employee->city = $data->city;

  // create category
  if ($employee->create()) {
    echo json_encode(
      array('message' => 'Employee Created')

    );
  } else {
    echo json_encode(
      array('message' => 'Employee Not Created')
    );
  }
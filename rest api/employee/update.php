<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // set ID to update
  $employee->id = $data->id;
  $employee->name = $data->name;
    $employee->city = $data->city;

  // update category
  if ($employee->update()) {
    echo json_encode(
      array('message' => 'Employee Updated')

    );
  } else {
    echo json_encode(
      array('message' => 'Employee Not Updated')
    );
  }
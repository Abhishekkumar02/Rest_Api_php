<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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
  
  // delete category
  if ($employee->delete()) {
    echo json_encode(
      array('message' => 'Employee Deleted')

    );
  } else {
    echo json_encode(
      array('message' => 'Employee Not Deleted')
    );
  }
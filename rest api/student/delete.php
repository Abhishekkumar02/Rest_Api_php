<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, x-Requested-With');

include_once '../../db/db.php';
  include_once '../../Student.php';


  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate student object
  $student = new Student($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // set ID to update
  $student->id = $data->id;
  
  // delete people
  if ($student->delete()) {
    echo json_encode(
      array('message' => 'student Deleted')

    );
  } else {
    echo json_encode(
      array('message' => 'student Not Deleted')
    );
  }
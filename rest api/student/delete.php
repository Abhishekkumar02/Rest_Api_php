<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, x-Requested-With');

include_once '../../db/db.php';
  include_once '../../Student.php';


  $db2 = new Database();
  $db = $db2->connect();

 
  $student = new Student($db);

  $data = json_decode(file_get_contents("php://input"));

  $student->id = $data->id;
  
  if ($student->delete()) {
    echo json_encode(
      array('message' => 'student Deleted')

    );
  } else {
    echo json_encode(
      array('message' => 'student Not Deleted')
    );
  }
  ?>
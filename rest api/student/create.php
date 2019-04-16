<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');
include_once '../../db/db.php';
  include_once '../../Student.php';
  // Instantiate db & connect
  $database = new Database();
  $db = $database->connect();
  //Instantiate blog post object
  $student = new Student($db);
  // get raw posted data
  $data = json_decode(file_get_contents('php://input'));
  $student->name = $data->name;
   $student->branch = $data->branch;
    $student->section = $data->section;
  // create people
  if ($student->create()) {
    echo json_encode(
      array('message' => 'Student created')
    );
  } else {
    echo json_encode(
      array('message' => 'Student not created')
    );
  }
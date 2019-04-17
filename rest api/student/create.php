<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');
include_once '../../db/db.php';
  include_once '../../Student.php';

  $db2 = new Database();
  $db = $db2->connect();

  $student = new Student($db);

  $data = json_decode(file_get_contents('php://input'));
  $student->name = $data->name;
   $student->branch_id = $data->branch_id;
    $student->section = $data->section;
    if ($student->create()) {
    echo json_encode(
      array('message' => 'Student created')
    );
  } else {
    echo json_encode(
      array('message' => 'Student not created')
    );
  }
  ?>
<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, x-Requested-With');

  include_once '../../db/db.php';
  include_once '../../Student.php';

  $db2 = new Database();
  $db = $db2->connect();

  $Student = new Student($db);

  $data = json_decode(file_get_contents("php://input"));

  $Student->id = $data->id;
  $Student->name = $data->name;
 $Student->branch = $data->branch;
  $Student->section = $data->section;
 
  if ($Student->update()) {
    echo json_encode(
      array('message' => 'Student Updated')

    );
  } else {
    echo json_encode(
      array('message' => 'Student Not Updated')
    );
  }
  ?>
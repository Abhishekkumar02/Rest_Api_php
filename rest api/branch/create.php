<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, x-Requested-With');


  include_once '../../db/db.php';
  include_once '../../Branch.php';

  $db2 = new Database();
  $db = $db2->connect();

  $branch = new Branch($db);

  $data = json_decode(file_get_contents("php://input"));
  $branch->branch_name = $data->branch_name;

  if ($branch->create()) {
    echo json_encode(
      array('message' => 'branch Created')

    );
  } else {
    echo json_encode(
      array('message' => 'branch Not Created')
    );
  }
  ?>
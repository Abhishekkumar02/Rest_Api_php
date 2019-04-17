<?php
 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, x-Requested-With');


   include_once '../../db/db.php';
  include_once '../../Branch.php';

  $db2 = new Database();
  $db = $db2->connect();

  $branch = new Branch($db);

  $data = json_decode(file_get_contents("php://input"));

  $branch->id = $data->id;

  if ($branch->delete()) {
    echo json_encode(
      array('message' => 'branch Deleted')

    );
  } else {
    echo json_encode(
      array('message' => 'branch Not Deleted')
    );
  }
  ?>
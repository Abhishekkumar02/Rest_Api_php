<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


  include_once '../../db/db.php';
  include_once '../../Branch.php';

  $database = new Database();
  $db = $database->connect();

  $branch = new Branch($db);

  $result = $branch->display();

  $n = $result->rowCount();

  if($n > 0) {

    $br_arr = array();
    $br_arr['Branch data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $br_item = array(
        'id' => $id,
        'branch_name' => $branch_name
      );

    
      array_push($br_arr['Branch data'], $br_item);
    }
    echo json_encode($br_arr);


  } else {

    echo json_encode(
      array('message' => 'No branch Found')  


    );

  }
  ?>
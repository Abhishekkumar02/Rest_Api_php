<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


  include_once '../../db/db.php';
  include_once '../../Branch.php';

  $db2 = new Database();
  $db = $db2->connect();

  $branch = new Branch($db);


  $branch->id = isset($_GET['id']) ? $_GET['id'] : die();

  $branch->display_one();

  $br_arr = array(
    'id' => $branch->id,
    'branch_name' => $branch->branch_name,
  );

  print_r(json_encode($br_arr));
  ?>
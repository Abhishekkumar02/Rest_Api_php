<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


include_once '../../db/db.php';
  include_once '../../Employee.php';


  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $employee = new Employee($db);

  // Get ID
  $employee->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get category
  $employee->read_single();

  // create array
  $cat_arr = array(
    'id' => $employee->id,
    'name' => $employee->name,
    'city' => $employee->city
  );

  // Make Json
  print_r(json_encode($cat_arr));
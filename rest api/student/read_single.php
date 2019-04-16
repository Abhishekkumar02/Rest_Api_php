<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

include_once '../../db/db.php';
  include_once '../../Student.php';


  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate people object
  $Student = new Student($db);

  // Get ID
  $Student->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get people
  $Student->read_single();

  // create array
  $peo_arr = array(
    'id' => $Student->id,
    'name' => $Student->name,
    'branch' => $Student->branch,
    'section' => $Student->section,
  );

  // Make Json
  print_r(json_encode($peo_arr));
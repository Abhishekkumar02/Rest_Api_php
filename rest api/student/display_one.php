<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

include_once '../../db/db.php';
  include_once '../../Student.php';

  $db2 = new Database();
  $db = $db2->connect();

  $Student = new Student($db);

  $Student->id = isset($_GET['id']) ? $_GET['id'] : die();

  $Student->display_one();

  $stu_arr = array(
    'id' => $Student->id,
    'name' => $Student->name,
    'branch' => $Student->branch,
    'section' => $Student->section,
  );

  print_r(json_encode($stu_arr));
  ?>
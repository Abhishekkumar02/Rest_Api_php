<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

include_once '../../db/db.php';
  include_once '../../Student.php';

  $db2 = new Database();
  $db = $db2->connect();

  $student = new Student($db);

  $result = $student->display();

  $n = $result->rowCount();

  if($n > 0) {
   
    $stu_arr = array();
    $stu_arr['Student data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $stu_item = array(
        'id' => $id,
        'name' => $name,
        'branch' => $branch,
        'section' => $section
      );

  
      array_push($stu_arr['Student data'], $stu_item);
    }

    echo json_encode($stu_arr);


  } else {
   
    echo json_encode(
      array('message' => 'No student Found')  


    );

  }
  ?>
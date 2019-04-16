<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

 include_once '../../db/db.php';
  include_once '../../Employee.php';

  $db2 = new Database();
  $db = $db2->connect();

  $employee = new Employee($db);

  $result = $employee->display();

  $n = $result->rowCount();

  if($n > 0) {

    $emp_arr = array();
    $emp_arr['Employee data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $emp_item = array(
        'id' => $id,
        'name' => $name,
        'city'=>$city
      );

      array_push($emp_arr['Employee data'], $emp_item);
    }

    echo json_encode($emp_arr);


  } else {
    echo json_encode(
      array('message' => 'No Employee Found')  


    );

  }
  ?>
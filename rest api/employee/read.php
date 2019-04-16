<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

 include_once '../../db/db.php';
  include_once '../../Employee.php';

  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $employee = new Employee($db);


  // category read query
  $result = $employee->read();
  // Get row count
  $num = $result->rowCount();

  //Check if any categories
  if($num > 0) {
    // cat array
    $cat_arr = array();
    $cat_arr['Employee data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $cat_item = array(
        'id' => $id,
        'name' => $name,
        'city'=>$city
      );

      // Push to "data"
      array_push($cat_arr['Employee data'], $cat_item);
    }

    // Turn to JSON & output
    echo json_encode($cat_arr);


  } else {
    // No categories
    echo json_encode(
      array('message' => 'No Employee Found')  


    );

  }
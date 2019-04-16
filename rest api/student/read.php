<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

include_once '../../db/db.php';
  include_once '../../Student.php';


  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate student object
  $student = new Student($db);


  // people read query
  $result = $student->read();
  // Get row count
  $num = $result->rowCount();

  //Check if any people
  if($num > 0) {
    // peo array
    $peo_arr = array();
    $peo_arr['Student data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $peo_item = array(
        'id' => $id,
        'name' => $name,
        'branch' => $branch,
        'section' => $section
      );

      // Push to "data"
      array_push($peo_arr['Student data'], $peo_item);
    }

    // Turn to JSON & output
    echo json_encode($peo_arr);


  } else {
    // No people
    echo json_encode(
      array('message' => 'No student Found')  


    );

  }
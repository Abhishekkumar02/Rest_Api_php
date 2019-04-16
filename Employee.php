<?php
  class Employee {
    // DB stuff
    private $conn;
    private $table = 'employee';

    // properties
    public $id;
    public $name;
    public $city;

    //constructor with database
    public function __construct($db) {
      $this->conn = $db;
    }

    // get categories
    public function read() {
      // create query
      $query = 'SELECT
        id,
        name,
        city
      FROM
        ' . $this->table . '
      ORDER BY
         id';

      // PREPARE STATEMENT
      $stmt = $this->conn->prepare($query);

      // exceute query
      $stmt->execute();

      return $stmt;  
    }

    // Get single category
    public function read_single() {
      // create query
      $query = 'SELECT
            id,
            name,
            city
          FROM
            ' . $this->table . '
       WHERE id = ?
       LIMIT 0,1';

       // prepare statement
       $stmt = $this->conn->prepare($query);

       // bind id
       $stmt->bindParam(1, $this->id);

       // execute query
       $stmt->execute();

       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       // set properties
       $this->id = $row['id'];
       $this->name = $row['name'];
        $this->city = $row['city'];
    }

    // create category
    public function create() {
      // create query
      $query = 'INSERT INTO ' .
        $this->table . '
      SET
        name = :name,
        city = :city';

    // prepare statement
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
       $this->city = htmlspecialchars(strip_tags($this->city));

    // bind data
    $stmt->bindParam(':name', $this->name);
     $stmt->bindParam(':city', $this->city);

    // execute query
    if ($stmt->execute()) {
      return true;
        }

    // print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;   
    }

    //update category
    public function update() {
      // create query
      $query = 'UPDATE ' .
        $this->table . '
      SET 
        name = :name,
        city= :city
        WHERE
        id = :id';

    // prepare statement
    $stmt = $this->conn->prepare($query);


    // clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
      $this->city = htmlspecialchars(strip_tags($this->city));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':city', $this->city);
    $stmt->bindParam(':id', $this->id);

    // execute query
    if ($stmt->execute()) {
      return true;
         }  

    // print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;        
    }

    // Delete category
    public function delete() {
      // create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
      //prepare statement
      $stmt = $this->conn->prepare($query);

      //clean data
      $this->id = htmlspecialchars(strip_tags($this->id));

      // bind data
      $stmt-> bindParam(':id', $this->id);

      // execute query
      if ($stmt->execute()) {
        return true;
        
      }

      // print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);

      return false;
    }
  }
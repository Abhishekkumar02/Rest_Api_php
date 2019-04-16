<?php
  class Student {
    // DB stuff
    private $conn;
    private $table = 'student';
    //properties
    public $id;
    public $name;
    public $branch;
     public $section;
        public function __construct($db) {
      $this->conn = $db;

    }
        public function read() {
    
      $query = 'SELECT
        id,
        name,
        branch,
        section
      FROM
        ' . $this->table  . '
      ORDER BY
        id DESC';
    
      $stmt = $this->conn->prepare($query);
    
      $stmt->execute();

      return $stmt;  
    }

    //  get single people
    public function read_single() {
      // create query
      $query = 'SELECT
            id,
            name,
              branch,
        section
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
        $this->branch = $row['branch'];
        $this->section = $row['section'];

    }
    // create people
    public function create() {
      // create query
      $query = 'INSERT INTO ' .
        $this->table . '
      SET 
        name = :name,
branch = :branch,
section = :section

        ';
    // prepare statement
    $stmt = $this->conn->prepare($query);
    // clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
    // bind data
    $stmt-> bindParam(':name', $this->name);
    $stmt-> bindParam(':branch', $this->branch);
    $stmt-> bindParam(':section', $this->section);
    // execute query
    if ($stmt->execute()) {
      return true;
           
         }
    // print error if something goes wrong
    printf("Error: $s\n", $stmt->error);
    return false;          
    }
    //update people
    public function update() {
      // create query
      $query = 'UPDATE ' .
        $this->table . '
      SET
        name = :name,
        branch = :branch,
        section = :section

        WHERE
        id = :id';
    //prepare statement
    $stmt = $this->conn->prepare($query);
    //clean data
    $this->name = htmlspecialchars(strip_tags($this->name));
     $this->branch = htmlspecialchars(strip_tags($this->branch));
      $this->section = htmlspecialchars(strip_tags($this->section));
    

    $this->id = htmlspecialchars(strip_tags($this->id));
    // bind data
    $stmt->bindParam(':name', $this->name);
    
    $stmt->bindParam(':branch', $this->branch);
    $stmt->bindParam(':section', $this->section);
    $stmt->bindParam(':id', $this->id);
    //execute query
    if ($stmt->execute()) {
      return true;
            # code...
          }
          //print error if something goes wrong
          printf("Error: $s.\n", $stmt->error);
          return false;      
    }

    
    public function delete() {
      
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = id';
      
      $stmt = $this->conn->prepare($query);
     
      $this->id = htmlspecialchars(strip_tags($this->id));
           $stmt->bindParam(':id', $this->id);
    
      if ($stmt->execute()) {
        return true;
          }
    
      printf('Error: $s.\n', $stmt->error);
      return false;


    }
  }
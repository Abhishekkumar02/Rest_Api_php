<?php
  class Student {

    private $conn;
    private $table = 'student';

    public $id;
    public $name;
    public $branch;
     public $section;
        public function __construct($db) {
      $this->conn = $db;

    }
        public function display() {
    
      $query = 'SELECT
        id, name, branch,
        section
      FROM
        ' . $this->table  . '
      ORDER BY
        id DESC';
    
      $stmt = $this->conn->prepare($query);
    
      $stmt->execute();

      return $stmt;  
    }

    public function display_one() {
   
      $query = 'SELECT
            id,
            name,
              branch,
        section
          FROM
            ' . $this->table . '
        WHERE id = ?
        LIMIT 0,1';
   
        $stmt = $this->conn->prepare($query);
   
        $stmt->bindParam(1, $this->id);
      
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->branch = $row['branch'];
        $this->section = $row['section'];

    }
  
    public function create() {
      // create query
      $query = 'INSERT INTO ' .
        $this->table . '
      SET 
        name = :name,
branch = :branch,
section = :section

        ';
   
    $stmt = $this->conn->prepare($query);
    
    $this->name = htmlspecialchars(strip_tags($this->name));
   
    $stmt-> bindParam(':name', $this->name);
    $stmt-> bindParam(':branch', $this->branch);
    $stmt-> bindParam(':section', $this->section);
    // execute query
    if ($stmt->execute()) {
      return true;
           
         }
    
    printf("Error: $s\n", $stmt->error);
    return false;          
    }
    
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
   
    $stmt = $this->conn->prepare($query);
   
    $this->name = htmlspecialchars(strip_tags($this->name));
     $this->branch = htmlspecialchars(strip_tags($this->branch));
      $this->section = htmlspecialchars(strip_tags($this->section));
    

    $this->id = htmlspecialchars(strip_tags($this->id));
   
    $stmt->bindParam(':name', $this->name);
    
    $stmt->bindParam(':branch', $this->branch);
    $stmt->bindParam(':section', $this->section);
    $stmt->bindParam(':id', $this->id);
   
    if ($stmt->execute()) {
      return true;
           
          }
          
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
  ?>
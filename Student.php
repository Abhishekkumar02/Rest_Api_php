<?php
  class Student {

    private $conn;
    private $table = 'student';

    public $id;
    public $name;
    public $branch_id;
     public $section;
        public function __construct($db) {
      $this->conn = $db;

    }
        public function display() {
    
      $query = 'SELECT
      b.branch_name as branch_name,
        s.id, s.name, s.branch_id,
        s.section
      FROM
        ' . $this->table  . '
       s
          LEFT JOIN
            branch b ON s.branch_id = b.id
          ORDER BY
            s.id DESC';
    
      $stmt = $this->conn->prepare($query);
    
      $stmt->execute();

      return $stmt;  
    }

    public function display_one() {
   
      $query = 'SELECT
      b.branch_name as branch_name,
            s.id, s.name, s.branch_id,
        s.section
          FROM
            ' . $this->table . '
            s
          LEFT JOIN
            branch b ON s.branch_id = b.id
        WHERE s.id = ?
        LIMIT 0,1';
   
        $stmt = $this->conn->prepare($query);
   
        $stmt->bindParam(1, $this->id);
      
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->branch_id = $row['branch_id'];
         $this->branch_name = $row['branch_name'];
        $this->section = $row['section'];

    }
  
    public function create() {
      $query = 'INSERT INTO ' .
        $this->table . '
      SET 
        name = :name,
branch_id = :branch_id,
section = :section

        ';
   
    $stmt = $this->conn->prepare($query);
    
    $this->name = htmlspecialchars(strip_tags($this->name));
   
    $stmt-> bindParam(':name', $this->name);
    $stmt-> bindParam(':branch_id', $this->branch_id);
    $stmt-> bindParam(':section', $this->section);

    if ($stmt->execute()) {
      return true;
           
         }
    
    printf("Error: $s\n", $stmt->error);
    return false;          
    }
    
    public function update() {
  
      $query = 'UPDATE ' .
        $this->table . '
      SET
        name = :name,
        branch_id = :branch_id,
        section = :section

        WHERE
        id = :id';
   
    $stmt = $this->conn->prepare($query);
   
    $this->name = htmlspecialchars(strip_tags($this->name));
     $this->branch_id = htmlspecialchars(strip_tags($this->branch_id));
      $this->section = htmlspecialchars(strip_tags($this->section));
    

    $this->id = htmlspecialchars(strip_tags($this->id));
   
    $stmt->bindParam(':name', $this->name);
    
    $stmt->bindParam(':branch_id', $this->branch_id);
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
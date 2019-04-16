<?php
  class Employee {

    private $conn;
    private $table = 'employee';

    public $id;
    public $name;
    public $city;

    public function __construct($db) {
      $this->conn = $db;
    }
    public function display() {

      $query = 'SELECT id,name,city FROM
        ' . $this->table . '
      ORDER BY id';
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;  
    }
    public function display_one() {
   
      $query = 'SELECT
            id, name, city FROM
            ' . $this->table . '
       WHERE id = ?
       LIMIT 0,1';

       $stmt = $this->conn->prepare($query);

       $stmt->bindParam(1, $this->id);

       $stmt->execute();

       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       $this->id = $row['id'];
       $this->name = $row['name'];
        $this->city = $row['city'];
    }

    public function create() {
  
      $query = 'INSERT INTO ' .
        $this->table . '
      SET  name = :name, city = :city';

    $stmt = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
       $this->city = htmlspecialchars(strip_tags($this->city));

    $stmt->bindParam(':name', $this->name);
     $stmt->bindParam(':city', $this->city);

    if ($stmt->execute()) {
      return true;
        }

    printf("Error: $s.\n", $stmt->error);

    return false;   
    }

    public function update() {
      
      $query = 'UPDATE ' .
        $this->table . '
      SET  name = :name, city= :city WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
      $this->city = htmlspecialchars(strip_tags($this->city));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':city', $this->city);
    $stmt->bindParam(':id', $this->id);

    if ($stmt->execute()) {
      return true;
         }  

    printf("Error: $s.\n", $stmt->error);

    return false;        
    }

    public function delete() {
  
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    
      $stmt = $this->conn->prepare($query);

      $this->id = htmlspecialchars(strip_tags($this->id));

      $stmt-> bindParam(':id', $this->id);

      if ($stmt->execute()) {
        return true;
        
      }

      printf("Error: $s.\n", $stmt->error);

      return false;
    }
  }
  ?>
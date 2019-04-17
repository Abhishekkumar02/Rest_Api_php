<?php
  class Branch {
    private $conn;
    private $table = 'branch';

    public $id;
    public $branch_name;
   


    public function __construct($db) {
      $this->conn = $db;
    }

    public function display() {
      $query = 'SELECT
        id,
        branch_name
      FROM
        ' . $this->table . '
      ORDER BY
         id DESC';

      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;  
    }

    public function display_one() {
 
      $query = 'SELECT
            id,
           branch_name
          FROM
            ' . $this->table . '
       WHERE id = ?
       LIMIT 0,1';

       $stmt = $this->conn->prepare($query);

       $stmt->bindParam(1, $this->id);

       $stmt->execute();

       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       $this->id = $row['id'];
       $this->branch_name = $row['branch_name'];
    }

    public function create() {

      $query = 'INSERT INTO ' .
        $this->table . '
      SET
        branch_name = :branch_name';

    $stmt = $this->conn->prepare($query);

    $this->branch_name = htmlspecialchars(strip_tags($this->branch_name));

    $stmt->bindParam(':branch_name', $this->branch_name);

    if ($stmt->execute()) {
      return true;
        }

    printf("Error: $s.\n", $stmt->error);

    return false;   
    }

    public function update() {
  
      $query = 'UPDATE ' .
        $this->table . '
      SET 
        branch_name = :branch_name
        WHERE
        id = :id';

    $stmt = $this->conn->prepare($query);

    $this->branch_name = htmlspecialchars(strip_tags($this->branch_name));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':branch_name', $this->branch_name);
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
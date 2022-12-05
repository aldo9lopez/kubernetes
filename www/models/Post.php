<?php 
  class Post {
    // DB stuff
    private $conn;
    private $table = 'materias';

    // Post Properties
    public $clave;
    public $nombre;
    public $semestre;
    public $pc;
    public $creditos;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table ;
       
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE clave = :clave' ;
          // Prepare statement
          $stmt = $this->conn->prepare($query);
          
          $stmt->bindParam(':clave', $this->clave);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->clave = $row['clave'];
          $this->nombre = $row['nombre'];
          $this->semestre = $row['semestre'];
          $this->pc = $row['pc'];
          $this->creditos = $row['creditos'];
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' VALUES (:clave, :nombre, :semestre, :pc, :creditos)';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->clave = htmlspecialchars(strip_tags($this->clave));
          $this->nombre = htmlspecialchars(strip_tags($this->nombre));
          $this->semestre = htmlspecialchars(strip_tags($this->semestre));
          $this->pc = htmlspecialchars(strip_tags($this->pc));
          $this->creditos = htmlspecialchars(strip_tags($this->creditos));

          // Bindcreditos
          $stmt->bindParam(':clave', $this->clave);
          $stmt->bindParam(':nombre', $this->nombre);
          $stmt->bindParam(':semestre', $this->semestre);
          $stmt->bindParam(':pc', $this->pc);
          $stmt->bindParam(':creditos', $this->creditos);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET nombre = :nombre, semestre = :semestre, pc = :pc, creditos = :creditos
                                WHERE clave = :clave';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->clave = htmlspecialchars(strip_tags($this->clave));
          $this->nombre = htmlspecialchars(strip_tags($this->nombre));
          $this->semestre = htmlspecialchars(strip_tags($this->semestre));
          $this->pc = htmlspecialchars(strip_tags($this->pc));
          $this->creditos = htmlspecialchars(strip_tags($this->creditos));
          
          // Bind data
          $stmt->bindParam(':clave', $this->clave);
          $stmt->bindParam(':nombre', $this->nombre);
          $stmt->bindParam(':semestre', $this->semestre);
          $stmt->bindParam(':pc', $this->pc);
          $stmt->bindParam(':creditos', $this->creditos);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE clave = :clave';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->clave = htmlspecialchars(strip_tags($this->clave));

          // Bind data
          $stmt->bindParam(':clave', $this->clave);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }
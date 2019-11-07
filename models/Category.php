<?php
class Category
{
    // DB config
    private $conn;
    private $table = 'categories';

    // Post Properties
    public $id;
    public $name;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get categories
    public function read()
    {
        // Create query
        $query = 'SELECT
         c.id,
         c.name,
         c.created_at
      FROM
        ' . $this->table . ' c
        ORDER BY
        c.created_at';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        // Return statement
        return $stmt;
    }

    // Get a single category
    public function read_single()
    {
        // Create query
        $query = 'SELECT
        c.id,
        c.name,
        c.created_at
      FROM
        ' . $this->table . ' c
      WHERE
      c.id = :id
      LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind Param
        $stmt->bindParam(':id', $this->id);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    // Create category
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
        name = :name';

        // Prepare statment
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Bind params
        $stmt->bindParam(':name', $this->name);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;

    }

    // Update category
    public function update()
    {
        //Create query
        $query = 'UPDATE ' . $this->table . '
        SET
          name = :name
        WHERE
         id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Bind param
        $stmt->bindParam(':id', $this->id);

        // Bind params
        $stmt->bindParam(':name', $this->name);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;

    }

    // Delete category
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind Param
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;

    }
}

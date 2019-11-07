<?php
class Category
{
    // DB config
    private $conn;
    private $table = 'categories';

    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
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
}

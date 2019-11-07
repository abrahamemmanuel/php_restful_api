<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blog category object
$category = new Category($db);

// Blog post query
$result = $category->read();
// Get row count
$num = $result->rowCount();

// Check if categories exist
if ($num > 0) {
    /** Fetch all categories from the database collection and output the result*/
    $categories_arr['data'] = array();

    // Loop over the result set
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Extract rows
        extract($row);

        $category_items = array(
            'id' => $id,
            'name' => $name,
            'created_at' => $created_at,
        );

        // Push to "dataa"
        array_push($categories_arr["data"], $category_items);
    }

    // Convert to JSON format and echo the reult
    echo json_encode($categories_arr);
} else { // No categories found
    echo json_encode(array('message' => 'No Categories found!'));
}

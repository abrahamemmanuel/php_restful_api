<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$category = new Category($db);

// Get ID from the URL
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Call the read_single method
$result = $category->read_single();

// Fetch result
$row = $result->fetch(PDO::FETCH_ASSOC);

// Set properties
$category_arr = array(
    'id' => $row['id'],
    'name' => $row['name'],
    'created_at' => $row['created_at'],
);

echo json_encode($category_arr);

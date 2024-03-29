<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Get ID from the URL
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Call the read_single method
// Get Post
$post->read_single();
 
// Create array
$post_arr = array(
'id' => $post->id,
'title' => $post->title,
'body' => $post->body,
'author' => $post->author,
'category_id' => $post->category_id,
'category_name' => $post->category_name
);

// Make JSON
echo json_encode($post_arr); 

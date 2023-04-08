<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

session_start();

// TODO: Perform necessary operations to delete the user's account

// Destroy the session
session_destroy();

// Return a JSON response indicating success
header('Content-Type: application/json');
echo json_encode(array('success' => true));
exit();
?>
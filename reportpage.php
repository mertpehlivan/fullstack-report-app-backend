<?php
$id = $_GET['id'];
try {
    $db = new PDO("mysql:host=localhost;dbname=baum;charset=utf8", 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Database connection failed: " . $e->getMessage()));
    exit();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json');

$stmt = $db->prepare("SELECT * FROM sikayet WHERE bilgilerim_id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$data) {
    http_response_code(404);
    echo json_encode(array("message" => "No data found for id " . $id));
    exit();
}

echo json_encode($data);


?>
	


	
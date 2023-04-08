<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
session_start();

if (isset($_SESSION['email'])) {
  // Kullanıcı oturumunda kaydedilmiş, kimlik doğrulaması başarılı
  $response = array(
    'success' => true,
    'message' => 'User authenticated'
  );
} else {
  // Kullanıcı oturumunda kaydedilmemiş, kimlik doğrulaması başarısız
  $response = array(
    'success' => false,
    'message' => 'User not authenticated'
  );
}

header('Content-Type: application/json');
echo json_encode($response);
?>